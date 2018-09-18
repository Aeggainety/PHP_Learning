<?php
	header("Content-Type:text/html;charset=utf-8");

	$time = date('Y-m-d H:i:s',time());
	
	echo $time.'<hr>';
	// ==============================================
	// 设计模式
	// ==============================================

	// ==============================================
	// 基本模式
	// 综述
	// 设计模式分为三种类型，共23种。
	// 创建型模式：单例模式、抽象工厂模式、建造者模式、工厂模式、原型模式。
	// 结构型模式：适配器模式(Adapter)、桥接模式(Bridge)、装饰模式(Decorator)、组合模式(Composite)、外观模式(Facade)、享元模式(Flyweight Pattern)、代理模式(Proxy)。
	// 行为型模式：模板方法模式(Template)、命令模式(Command)、迭代器模式、观察者模式、中介者模式、备忘录模式、解释器模式(Interpreter模式)、状态模式、策略模式、职责链(责任链)模式、访问者模式。
	// ==============================================


	// ==============================================
	// 命令模式(Command)
	// 在软件系统中，“行为请求者”与“行为实现者”通常呈现一种“紧耦合”。但在某些场合，比如要对行为进行“记录、撤销/重做、事务”等处理，这种无法抵御变化的紧耦合是不合适的。在这种情况下，如何将“行为请求者”与“行为实现者”解耦？将一组行为抽象为对象，实现二者之间的松耦合。这就是命令模式。

	// 角色分析：
	// 抽象命令：定义命令的接口，声明执行的方法。
	// 具体命令；命令接口实现对象，是“虚”的实现；通常会有接收者，并调用接收者的功能来完成命令要执行的操作。
	// 命令接收者：接收者，真正执行命令的对象。任何类都可能成为一个接收者，只要它能够实现命令要求实现的相应功能。
	// 控制者：要求命令对象执行请求，通常会持有命令对象，可以持有很多的命令对象。这个是客户端真正触发命令并要求命令执行相应操作的地方，也就是说相当于使用命令对象的入口。
	
    // 例：


	/**
	 * 电视机是请求的接收者，
	*遥控器上有一些按钮，不同的按钮对应电视机的不同操作。
	*抽象命令角色由一个命令接口来扮演，有三个具体的命令类实现了抽象命令接口，
	*这三个具体命令类分别代表三种操作：打开电视机、关闭电视机和切换频道。
	*显然，电视机遥控器就是一个典型的命令模式应用实例。
	 */


    /* 命令接收者
	*	Class TV
	*/
	class TV
	{
		public $curr_channel=0;

		// 打开电视机
		public function turnOn()
		{
			echo "The television is on."."<br/>";
		}

		// 关闭电视机
		public function turnOff()
		{
			echo "The television is off"."<br/>";
		}

		/* 切换频道
		*	@param $channel 频道
		*/
		public function turnChannel($channel)
		{
			$this->curr_channel = $channel;
			echo "This TV Channel is ".$this->curr_channel."<br/>";
		}

	}

	/**执行命令接口
	*	Interface ICommand
	*/
	interface ICommand
	{
		function execute();
	}

	/**开机命令
	*	Class CommandOn
	*/
	class CommandOn implements ICommand
	{
		private $tv;

		public function __construct($tv)
		{
			$this->tv = $tv;
		}

		public function execute()
		{
			$this->tv->turnOn();
		}
	}


	/**关机命令
	*	Class CommandOff
	*/
	class CommandOff implements ICommand
	{
		private $tv;

		public function __conctruct($tv)
		{
			$this->tv = $tv;
		}

		public function execute()
		{
			$this->tv->turnOff();
		}

	}


	/*切换频道命令
	*Class CommandOn
	*/
	class CommandChannel implements ICommand
	{
		private $tv;
		private $channel;

		public function __construct($tv,$channel)
		{
			$this->tv=$tv;
			$this->channel = $channel;
		}

		public function execute()
		{
			$this->tv->turnChannel($this->channel);
		}

	}

	/*遥控器
	*Class Control
	*/
	class Control
	{
		private $_onCommand;
		private $_offCommand;
		private $_changeChannel;

		public function __construct($on,$off,$channel)
		{
			$this->_onCommand = $on;
			$this->_offCommand = $off;
			$this->_changeChannel = $channel;
		}

		public function turnOn()
		{
			$this->_onCommand->execute();
		}

		public function turnOff()
		{
			$this->_offCommand->execute();
		}

		public function changeChannel()
		{
			$this->_changeChannel->execute();
		}

	}

	//命令接收者
	$myTV = new Tv();

	// 开机命令
	$on = new CommandOn($myTV);

	// 关机命令
	$off = new CommandOff($myTV);

	// 频道切换命令
	$channel = new CommandChannel($myTV,2);

	// 控制命令对象
	$control = new Control($on,$off,$channel);

	// 开机
	$control->turnOn();

	// 切换频道
	$control->changeChannel();

	// 关机
	$control->turnOff();


	// 适用场景
	// 1、系统需要将请求调用者和请求接收者解耦，使得调用者和接收者不直接交互。
	// 2、系统需要在不同的时间指定请求、将请求排队和执行请求。
	// 3、系统需要支持命令的撤销(Undo)操作和恢复(Redo)操作。
	// 4、系统需要将一组操作组合在一起，即支持宏命令。

	// 优点：
	// 1、减低对象之间的耦合度。
	// 2、新的命令可以很容易的加入到系统中。
	// 2、可以比较容易的设计一个组合命令。
	// 4、调用同一方法实现不同的功能。

	// 缺点：
	// 使用命令模式可能会导致某些系统有过多的具体命令类。因为针对每个命令都需要设计一个具体命令类，因此某些系统可能需要大量具体命令类，这将影响命令模式的使用。




?>