<?php
	header("Content-Type:text/html;charset=utf-8");
	// 桥接模式(Bridge)：将抽象部分与它的实现部分分离，使它们都可以独立地变化。

	// 适用性：
	// 1、不希望在抽象和它的实现部分之间有一个固定的绑定关系。例如这种情况可能是因为，在程序运行时刻实现部分应可以被选择或者切换。
	// 2、类的抽象以及它的实现都应该可以通过生成子类的方法加以扩充。这时桥接模式使你可以对不同的抽象接口和实现部分进行组合，并分别对它们进行扩充。
	// 3、对一个抽象的实现部分的修改应对客户不产生影响，即客户的代码不必重新编译。
	// 4、(C++)你想对客户完全隐藏抽象的实现部分。在C++中，类的表示在类接口中是可见的。
	// 5、有许多类要生成。这样一种类层次结构说明你必须将一个对象分解成两个部分。Rumbaugh称这种类层次结构为“嵌套的普化”(nested generalizations)。
	// 6、想在多个对象间共享实现(可能使用引用计数)，但同时要求客户并不知道这一点。一个简单的例子便是Coplien的String类，在这个类中多个对象可以共享同一个字符串表示(StringRep)。

	// 角色解析：
	// 1、抽象化角色：抽象化给出的定义，并保存一个对实现化对象的引用。
	// 2、修正抽象化角色：扩展抽象化角色，改变和修正父类对抽象化的定义。
	// 3、实现化角色：这个角色给出实现化角色的接口，但不给出具体的实现。必须指出的是，这个接口不一定和抽象化角色的接口定义相同，实际上，这两个接口可以非常不一样。
	// 4、具体实现化角色：这个角色给出实现化角色接口的具体实现。

	// 优点:
	// 1、抽象和实现的分离。
	// 2、优秀的扩展能力。
	// 3、实现细节对客户透明。

	// 缺点：
	// 桥接模式的引入会增加系统给的理解与设计难度，由于聚合关联关系建立在抽象层，要求开发者针对抽象进行设计与编程。
	
	// 使用场景：
	// 1、如果一个系统需要在构建的抽象化角色和具体化角色之间增加更多的灵活性，避免在两个层次之间建立静态的联系。
	// 2、设计要求实现化角色的任何改变不应当影响客户端，或者说实现化角色的改变对客户端是完全透明的。
	// 3、一个构件有多于一个的抽象化角色和实现化角色，系统需要它们之间进行动态耦合。
	// 4、虽然在系统中使用继承是没有问题的，但是由于抽象化角色和具体化角色需要独立变化，设计要求需要独立管理这两者。

	// 例：
	//员工分组
	abstract class Staff
	{
		abstract public function staffData();
	}

	class CommonStaff extends Staff
	{
		public function staffData()
		{
			return '阿萨德';
		}
	}

	class VipStaff extends Staff
	{
		public function staffData()
		{
			return '爱迪生';
		}
	}

	//发送形式
	abstract class SendType
	{
		abstract public function send($to,$content);
	}

	class QQSend extends SendType
	{
		public function __construct()
		{
			//与QQ接口连接方式
		}

		public function send($to,$content)
		{
			return $content.' to '.$to.' From QQSend<br>';
		}
	}

	//发送信息
	class SendInfo
	{
		protected $_level;//员工分组
		protected $_method;//发送方式

		public function __construct($level,$method)
		{
			//这里可以使用单例控制资源的消耗
			$this->_level = $level;
			$this->_method = $method;
		}

		public function sending($content)
		{
			//当前员工分组的成员数组
			$staffArr = $this->_level->staffData();
			//通过传入的发送方式，向成员发送内容
			$result = $this->_method->send($staffArr,$content);
			echo $result;
		}

	}

	//调用
	$info = new SendInfo(new VipStaff(),new QQSend());
	$info->sending('666');

	$info = new SendInfo(new commonStaff(),new QQSend());
	$info->sending('777');


?>