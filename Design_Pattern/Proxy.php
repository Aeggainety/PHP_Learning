<?php
	header("Content-Type:text/html;charset=utf-8");

	// 代理模式(Proxy)
    // 代理模式为其他对象提供一种代理以控制对这个对象的访问。在某些情况下，一个对象不适合或者不能直接引用另一个对象，而代理对象可以在客户端和目标对象之间起到中介作用。
	
    // 角色分析：
    // 1、抽象主题角色(IGiveGift)：定义了Follower和Proxy公用接口，这样就在任何使用Follower的地方都可以使用Proxy。
    // 2、主题角色(Follower)：定义了Proxy所代表的真实实体。
    // 3、代理对象(Proxy)：保存一个引用使得代理可以访问实体，并提供一个与Follower接口相同的接口，这样代理可以用来代替实体(Follower)。


    // 优点：
    // 1、职责清晰：真实的角色就是实现实际的业务逻辑，不用关心其它非本职责的事务，通过后期的代理完成一件事务，附带的结果就是编程简洁清晰。
    // 2、代理对象可以在客户端和目标对象之间起到中介的作用，这样起到了中介和保护了目标对象的作用。
    // 3、高扩展性


    // 适用场景：
    // 远程代理，也就是为了一个对象在不同地址空间提供局部代表。隐藏一个对象存在于不同地址空间的事实。
    // 虚拟代理，根据需要来创建开销很大的对象，通过它来存放实例化需要很长时间的真实对象。
    // 安全代理，用来控制真实对象的访问对象。
    // 智能指引，取代了简单的指针，它在访问对象时执行一些附加操作。
    // 1、对指向实际对象的引用计数，这样当该对象没有引用时，可以自动释放它。
    // 2、当第一次引用一个持久对象时，将它装入内存。
    // 3、在访问一个实际对象前，检查是否已经锁定了它，以确保其他对象不能改变它。
    // Copy-on-Write代理，它是虚拟代理的一种，把复制(克隆)操作延迟到只有在客户端真正需要时才执行。

    // 通过代理实现MySQL的读写分离，如果是读操作，就连接127.0.0.1的数据库，写操作就读取127.0.0.2的数据库
    class Proxy {
        protected $reader;
        protected $writer;
        public function __construct(){
            $this->reader = new PDO('mysql:host=127.0.0.1;port=3306;dbname=laravel;','root','root');
            $this->writer = new PDO('mysql:host=127.0.0.2;port=3306;dbname=laravel;','root','root');
        }
        public function query($sql) {
            if (substr($sql, 0, 6) == 'select') {
                echo "读操作: ".PHP_EOL;
                return $this->reader->query($sql); 
            } else {
                echo "写操作：".PHP_EOL;
                return $this->writer->query($sql); 
            }
        }
    }
    //数据库代理
    $proxy = new Proxy;
    //读操作
    $proxy->query("select * from articles");
    //写操作
    // $proxy->query("INSERT INTO articles SET title = 'hello'");

    // var_dump($a);
    //对于数据库来说，这里应该使用单例模式的方法来存放$reader和$writer,但我只是举个例子，不想把单例加进来把代码搞复杂。 
    //但是如果你要实现这样的一个数据库代理，还是有必要用上单例模式的知识





?>