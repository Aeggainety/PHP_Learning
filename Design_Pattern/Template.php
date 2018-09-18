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
	// 行为型模式：模板方法模式(Template)、命令模式、迭代器模式、观察者模式、中介者模式、备忘录模式、解释器模式(Interpreter模式)、状态模式、策略模式、职责链(责任链)模式、访问者模式。
	// ==============================================


	// ==============================================
	// 模板方法模式(Template)
    // 模板方法模式；准备一个抽象类，将部分逻辑以具体方法以及具体构造形式实现，然后声明一些抽象方法来迫使子类实现剩余的逻辑。
    // 不同的子类可以以不同的方式实现这些抽象方法，从而对剩余的逻辑有不同的实现。先制定一个顶级逻辑框架，而将逻辑的细节留给具体的子类去实现。
    // 通俗来说：在抽象父类中定义一个模板方法的方法，通过子类的覆盖使得相同算法框架可以有不同的执行结果。

    // 角色分析：
    // 抽象模板角色：抽象模板类，定义了一个具体的算法流程和一些留给子类必须实现的抽象方法。
    // 具体子类角色：实现AbstractClass中的抽象方法，子类可以有自己独特的实现形式，但是执行流程受AbstractClass控制。

    // 特点：灵活性高，可扩展性强。

	// 适用场景及优势：
	// 1、完成某一细节层次一致的一个过程或一系列步骤，但其个别步骤在更详细的层次上的实现可能不同时。我们通常考虑用模板模式来处理。
	// 2、当不变的和可变的行为在方法的子类实现中混合在一起的时候，不变的行为就会在子类中重复出现，我们通过模板模式把这些行为搬移到单一的地方，这样就帮助子类摆脱重复的不变行为的纠缠。
	// 3、模板模式通过把不变的行为搬移到超级抽象类，去除子类中的重复代码来体现它的优势。模板模式提供了一个很好的代码复用平台。

	// 例：
	// 抽象模板(AbstractClass)角色
	abstract class AbstractClass
	{
		public abstract function PrimitiveOperation1();
		public abstract function PrimitiveOperation2();
		public function method(){
			$this->PrimitiveOperation1();
			$this->PrimitiveOperation2();
			var_dump("method");
		}
	}

	// 具体模板(ConcrteClass)角色
	class ConcreteClassA extends AbstractClass
	{
		public function PrimitiveOperation1()
		{
			var_dump("类A方法1实现");
		}
		public function PrimitiveOperation2()
		{
			var_dump("类A方法2实现");
		}
	}

	class ConcreteClassB extends AbstractClass
	{
		public function PrimitiveOperation1()
		{
			var_dump("类B方法1实现");
		}
		public function PrimitiveOperation2()
		{
			var_dump("类B方法2实现");
		}
	}


	$a = new ConcreteClassA();
	$a->method();

	$b = new ConcreteClassB();
	$b->method();




?>