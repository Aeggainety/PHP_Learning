<!-- 事务 -->
事务(Transaction)指访问并可能更新数据库中各种数据项的一个程序执行单元(unit)。
事务通常由高级数据库操纵语言或编程语言(如SQL,C++或JAVA)书写的用户程序的执行所引起，并用形如begin transaction和end transaction语句(或函数调用)来界定。
事务由事务开始(begin transaction)和事务结束(end transaction)之间执行的全体操作组成。

<!-- 概念 -->
在关系数据库中，一个事务可以是一条SQL语句，一组SQL语句或整个程序。

<!-- 特性 -->
事务是恢复和并发控制的基本单位。
事务应该具有4个属性：原子性、一致性、隔离性、持久性。这四个属性通常称为ACID特性。
原子性(atomicity)。一个事务是一个不可分割的工作单位，事务中包括的诸操作要么都做，要么都不做。
一致性(consistency)。事务必须是使数据库从一个一致性状态变到另一个一致性状态。一致性与原子性是密切相关的。
隔离性(isolation)。一个事务的执行不能被其他事务干扰。即一个事物内部的操作及使用的数据对并发的其他事务是隔离的，并发执行的各个事务之间不能相互干扰。
持久性(durability)。持久性也称永久性(permanence)，指一个事务一旦提交，它对数据库中数据的改变就应该是永久性的。接下来的其他操作或故障不应该对其有任何影响。


<!-- 事务类型 -->
（1）手动事务
手动事务允许显式处理若干过程，这些过程包括：开始事务、控制事务边界内的每个连接和资源登记、确定事务结果(提交或中止)以及结束事务。
尽管此模型提供了对事务的标准控制，但它缺少一些内置于自动事务模型的简化操作。例如，在手动事务中数据存储区之间没有自动登记和协调。此外，与自动事务不同，手动事务中事务不在对象间流动。

如果选择手动控制分布式事务，则必须管理恢复、并发、安全性和完整性。也就是说，必须应用维护与事务处理关联的ACID属性所需的所有编程方法。

（2）自动事务
.NET页、XML Web services方法或.NET Framework类一旦被标记为参与事务，它们将自动在事务范围内执行。
您可以通过在.NET 页、XML Web services方法或 .NET Framework 类中设置一个事务属性值来控制对象的事务行为。
特性值反过来确定实例化对象的事务性行为。
因此，根据声明特性值的不同，对象将自动参与现有事务或正在进行的事务，成为新事务的根或者根本不参与事务。
声明事务属性的语法在.NET Frameword类、.NET页和XML Web services方法中稍有不同。

声明性事务特性指定对象如何参与事务，如何以编程方式被配置。
尽管此声明性级别表示事务的逻辑，但它是一个已从物理事务中移除的步骤。
物理事务在事务性对象访问数据库或消息队列这样的数据资源时发生。
与对象关联的事务自动流向合适的资源管理器，诸如OLE DB、开放式数据库连接(ODBC)或ActiveX数据对象(ADO)的关联驱动程序在对象的上下文中查找事务，并通过分布式事务处理协调器(DTC)在此事务中登记。整个物理事务自动发生。



例：
……关键语句讲解………
	BEGIN TRANSACTION
	/*--定义变量，用于累计事务执行过程中的错误--*/
	DECLARE @errorSum INT
	SET @errorSum=0 --初始化为0，即无错误
	/*--转账：张三的账户少1000元，李四的账户多1000元*/
	UPDATEbankSET currentMoney=currentMoney-1000
	WHERE customerName='张三'
	SET @errorSum=@errorSum+@@error
	UPDATE bank SET currentMoney=currentMoney+1000
	WHERE customerName='李四'
	SET @errorSum=@errorSum+@@error --累计是否有错误
	IF @errorSum<>0 --如果有错误
	BEGIN
	print '交易失败，回滚事务'
	ROLLBACK TRANSACTION
	END?
	ELSE
	BEGIN
	print '交易成功，提交事务，写入硬盘，永久的保存'
	COMMIT TRANSACTION
	END
	GO
	print '查看转账事务后的余额'
	SELECT * FROM bank?
	GO


