<!-- 数据库读写分离的好处 -->
1、将读写操作分离到不同的服务器上，避免主服务器出现性能瓶颈；
2、主服务器进行写操作时，不影响查询应用服务器的查询功能，降低阻塞，提高并发；
3、数据库拥有多个容灾副本，提高数据安全性。同时，当主服务器故障时，可立即切换到其他服务器，提高系统可用性。

<!-- 读写分离的基本原理 -->
让主数据库处理事务性增、改、删操作(INSERT、UPDATE、DELETE)，而从数据库处理SELECT查询操作。数据库复制被用来把事务性操作导致的变更同步到其他从数据库。
以SQL为例，主库负责写数据、读数据。读库仅负责读数据。每次有写库操作，同步更新到读库。写库就一个，读库可以有多个，采用日志同步的方式实现主库和多个读库的数据同步。


<!-- Replication(复制)原理 -->
Mysql的Replication是一个异步的复制过程，从一个MySQL节点(称之为Master)复制到另一个MySQL节点(称之为Slave)。
在Master与Slave之间实现整个复制过程主要有由三个线程来完成，其中两个线程(SQL线程和I/O线程)在Slave端，另一个线程(I/O线程)在Master端。

要实现MySQL的Replication，首先必须打开Master端的Binary Log,因为整个复制过程实际上就是Slave从Master端获取该日志然后再在自己身上完全顺序地执行日志中所记录的各种操作。

总结：
1、每个从数据库仅可以设置一个主数据库。
2、主数据库在执行sql之后，记录二进制log文件(bin-log)。
3、从数据库链接主数据库，并从主库获取bin-log，存于本地relay-log，并从上次记住的位置起执行sql，一旦遇到错误则停止同步。

推论：
1、主从服务器间的数据库不是实时同步，就算网络链接正常，也存在瞬间，主从数据不一致。
2、如果主从的网络断开，从会在网络正常后，批量同步。
3、如果对从库进行数据修改，那么很可能从库在执行主库的bin-log时出现错误而停止同步，这个是很危险的操作。所以一般情况下，非常小心地修改从库上的数据。
4、一个衍生的配置是双主，互为主从配置，只要双方的修改不冲突，可以工作良好。
5、如果需要多主的话，可以用环形配置，这样任意一个节点的修改都可以同步到所有节点。

<!-- 主从设置： -->
首先，在主MySQL节点上，位slave创建一个用户：
GRANT REPLICATION SLAVE, REPLICATION CLIENT ON *.* TO 'slave'@'192.168.1.10' IDENTIFIED BY 'slave';
实际上，为支持主从动态同步，或者手动切换，一般都是在所有主从节点上创建好这个用户。
然后就是MySQL本身的配置了，这需要修改my.cnf或者my.ini文件。在mysqld这一节下面增加：

主库
server-id=1
auto-increment-increment=2
auto-increment-offset=1
log-bin
binlog-do-db=stest
binlog_format=mixed

从库
master-host=192.168.1.62
master-user=slave
master-password=slave
replicate-do-db=mtest

上面这两段设置，前一段是为主而设置，后一段是为从而设置。也就是说在两个MySQL节点上，各加一段就好。
binlog-do-db和replicate-do-db就是设置相应的需要做同步的数据库了，auto-increment-increment和auto-increment-offset是为了支持双主而设置的，在只做主从的时候，也可以不设置。

<!-- 双主的设置 -->
从原理论来看MySQL也支持双主的设置，即两个MySQL节点互为主备，不过虽然理论上，双主只要数据不冲突就可以工作的很好，但实际情况中还是很容易发生数据冲突的，比如在同步完成之前，双方都修改同一条记录。
因此在实际中，最好不要让两边同时修改。即逻辑上仍按照主从的方式工作。但双主的设置仍然是有意义的，因为这样做之后，切换主备会变得很简单。
因为在出现故障后，如果之前配置了双主，则直接切换主备会很容易。

双主在设置时，只需将上面的一段设置复制一份，分别写入两个MySQL节点的配置文件，但要修改相应的server-id、auto-increment-offset和master-host。
auto-increment-offset就是为了让双主同时在一张表中进行添加操作时不会出现id冲突，所以在两个节点上auto-increment-offset设置为不同的值就好。
另：不要忘了，在两个节点上都为对方创建用户。应用层的负载均衡本文只介绍了MySQL自身的Replication配置，在上面的图中也可以看出，有了Replication，还需要应用层(或者中间件)做一个负载均衡，这样才能最大程度发挥MySQL Replication的优势。

MySQL的Replication 是一个异步的复制过程，从一个MySQL instance(Master)复制到另一个MySQL instance(Slave)。
在Master与Slave之间的实现整个复制过程主要由三个线程来完成，其中两个线程(sql线程和I/O线程)在Slave端，另一个线程(I/O线程)在Master端。

要实现MySQL的Replication，首先必须打开Master端的Binary Log(mysql-bin.xxxxxx)功能，否则无法实现。
因为整个复制过程实际上就是Slave从Master端获取该日志然后再在自己身上完全顺序地执行日志中所记录的各种操作。打开MySQL的Binary Log可以通过在启动MySQL Server的过程中使用'-log-bin'参数选项，或者在my.cnf配置文件中的mysqld参数组([mysqld]标识后的参数部分)增加"log-bin"参数项。



MySQL复制的基本过程如下：
1、Slave上面的IO线程连接上Master，并请求从指定日志文件的指定位置(或者从最开始的日志)之后的日志内容；
2、Master接收到来自Slave的IO线程的请求后，通过负责复制的IO线程根据请求信息读取指定日志指定位置之后的日志信息，返回给Slave端的IO线程。返回信息中除了日志所包含的信息之外，还包括本次返回的信息在Master端的Binary Log文件的名称以及在Binary Log中的位置；

