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
	// 行为型模式：模板方法模式(Template)、命令模式(Command)、迭代器模式(lterator)、观察者模式、中介者模式、备忘录模式、解释器模式(Interpreter模式)、状态模式、策略模式、职责链(责任链)模式、访问者模式。
	// ==============================================


	// ==============================================
	// 迭代器模式(lterator)
	// 迭代器模式是遍历集合的成熟模式，迭代器模式的关键是将遍历集合的任务交给一个叫做迭代器的对象，它的工作是遍历并选择序列中的对象，而客户端程序员不必知道或关心该集合序列底层的结构。
	// 在不需要了解内部实现的前提下，遍历一个聚合对象的内部元素。
	// 相比传统的编程模式，迭代器模式可以隐藏遍历元素的所需操作。
	
	// 角色：
	// 1、Iterator(迭代器)：迭代器定义访问和遍历元素的接口
	// 2、Concretelterator(具体迭代器)：具体迭代器实现迭代器接口，对该聚合遍历时跟踪当前位置
	// 3、Aggregate(聚合)：聚合定义创建相应迭代器对象的接口(可选)
	// 4、ConcreteAggregate(具体聚合)：具体聚合实现创建相应迭代器的接口

	// 例：
	//抽象迭代器
	abstract class IIterator
	{
		public abstract function First();
		public abstract function Next();
		public abstract function IsDone();
		public abstract function CurrentItem();
	}

	// 具体迭代器
	class ConcreteIterator extends IIterator
	{
		private $aggre;
		private $current = 0;
		public function __construct(array $_aggre)
		{
			$this->aggre = $_aggre;
		}

		// 返回第一个
		public function First()
		{
			return $this->aggre[0];
		}

		// 返回下一个
		public function Next()
		{
			$this->current++;
			if($this->current<count($this->aggre))
			{
				return $this->aggre[$this->current];
			}
			return false;
		}

		//返回是否IsDone
		public function IsDone()
		{
			return $this->current>=count($this->aggre)?true:false;
		}

		//返回当前聚集对象
		public function CurrentItem()
		{
			return $this->aggre[$this->current];
		}


	}

	$iterator = new ConcreteIterator(array('周杰伦','王菲','周润发'));
	$item = $iterator->First();
	echo $item."<br/>";
	while(!$iterator->IsDone())
	{
		echo "{$iterator->CurrentItem()}:请买票！<br/>";
		$iterator->Next();
	}

	// 使用场景：
	// 1、访问一个聚合对象的内容而无需暴露它的内部表示
	// 2、支持对聚合对象的多种遍历
	// 3、为遍历不同的聚合结构提供一个统一的接口






?>