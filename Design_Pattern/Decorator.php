<?php
	header("Content-Type:text/html;charset=utf-8");

	//装饰模式(Decorator)
	// 装饰模式是在不必改变原类文件和使用继承的情况下，动态地扩展一个对象的功能。它是通过创建一个包装对象，也就是装饰来包裹真实的对象。

	// 动态的给一个对象添加一些额外的职责。就增加功能来说，Decorator模式相比生成子类更为灵活。
	// 一个类提供了一项功能，如果要在修改并添加额外的功能，传统的编程模式，需要写一个子类继承它，并重新实现类的方法
	// 使用装饰器模式，仅需在运行时添加一个装饰器对象即可实现，可以实现最大的灵活性

	// 角色
	// 组件对象的接口：可以给这些对象动态的添加职责
	// 所有装饰器的父类：需要定义一个与组件接口一致的接口，并持有一个Component对象，该对象其实就是被装饰的对象。
	// 具体的装饰器类：实现具体要向被装饰对象添加的功能。用来装饰具体的组件对象或者另外一个具体的装饰器对象。

	// 适用性
	// 需要扩展一个类的功能，或给一个类添加附加职责。
	// 需要动态的给一个对象添加功能，这些功能可以再动态的撤销。
	// 需要增加由一些基本功能的排列组合而产生的非常大量的功能，从而使继承关系变的不现实。
	// 当不能采用生成子类的方法进行扩充时。一种情况是，可能有大量独立的扩展，为支持每一种组合将产生大量的子类，使得子类数目呈爆炸性增长。另一种情况可能是因为类定义被隐藏，或类定义不能用于生成子类。

	// 优点
	// Decorator模式与继承关系的目的都是要扩展对象的功能，但是Decorator可以提供比继承更多的灵活性。
	// 通过使用不同的具体装饰类以及这些装饰类的排列组合，设计师可以创造出很多不同行为的组合。

	// 缺点
	// 这种比继承更加灵活机动的特性，也同时意味着更加多的复杂性。
	// 装饰模式会导致设计中出现许多小类，如果过度使用，会使程序变得很复杂。
	// 装饰模式是针对抽象组件类型编程。但是，如果你要针对具体组件编程时，就应该重新思考你的应用架构，以及装饰者是否合适。当然也可以改变抽象组件接口，增加新的公开的行为，实现“半透明”的装饰者模式。

	// 例：
	/**
	*	输出一个字符串
	*	装饰器动态添加功能
	*	Class EchoText
	*/

	class EchoText
	{
		protected $decorator = [];

		public function Index()
		{
			// 调用装饰器前置操作
			$this->beforeEcho();
			echo "你好，我是装饰器";
			// 调用装饰器后置操作
			$this->afterEcho();
		}

		// 增加装饰器
		public function addDecorator(Decorator $decorator)
		{
			$this->decorator[] = $decorator;
		}

		// 执行装饰器前置操作 先进先出原则
		protected function beforeEcho()
		{
			foreach($this->decorator as $decorator)
				$decorator->before();
		}

		// 执行装饰器后置操作 先进后出原则
		protected function afterEcho()
		{
			$tmp = array_reverse($this->decorator);
			foreach ($tmp as $decorator) {
				$decorator->after();
			}
		}


	}

	//装饰器接口
	interface decorator
	{
		public function before();

		public function after();
	}


	/*
	*	颜色装饰器实现
	*	Class ColorDecorator
	*/

	class ColorDecorator implements Decorator
	{
		protected $color;

		public function __construct($color)
		{
			$this->color = $color;
		}

		public function before()
		{
			echo "<div style='color:{$this->color}'>";
		}

		public function after()
		{
			echo "</div>";
		}

	}


	/*
	*	字体大小装饰器
	*	Class SizeDecorator
	*/

	class SizeDecorator implements Decorator
	{
		protected $size;

		public function __construct($size)
		{
			$this->size = $size;
		}

		public function before()
		{
			echo "<div style='font-size:{$this->size}px'>";
		}

		public function after()
		{
			echo "</div>";
		}

	}



	// 实例化输出类
	$echo = new EchoText();
	// 增加装饰器
	$echo->addDecorator(new ColorDecorator('red'));
	//增加装饰器
	$echo->addDecorator(new SizeDecorator('22'));
	// 输出
	$echo->Index();
	

	
?>