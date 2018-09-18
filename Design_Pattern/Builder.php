<?php
	header("Content-Type:text/html;charset=utf-8");
	// 建造者模式(Builder)：
	// 将一个复杂对象的构建与它的表示分离，使得同样的构建过程可以创建不同的表示。
	// 这种类型的设计模式属于创建型模式，它提供了一种创建对象的最佳方式。
	// 注：与工厂模式的区别是：建造者模式更加关注于零件装配的顺序。

	// 适用性：
	// 1、当创建复杂对象的算法应该独立于该对象的组成部分以及它们的装配方式时。
	// 2、当构造过程必须允许被构造的对象有不同的表示时。

	// 主要解决在软件系统中，有时候面临着“一个复杂对象”的创建工作，其通常由各个部分的子对象用一定的算法构成；由于需求的变化，这个复杂对象的各个部分经常面临着剧烈的变化，但是将它们组合在一起算法却相对稳定。

	// 优点：
	// 1、建造者独立、易扩展。
	// 2、便于控制细节风险。

	// 缺点：
	// 1、产品必须有共同点，范围有限制。
	// 2、如内部变化复杂，会有很多的建造类。

	// 使用场景：
	// 1、需要生成的对象具有复杂的内部结构。
	// 2、需要生成的对象内部属性本身相互依赖。

	// 建造者模式一般认为有四个角色：
	// 1、产品角色，产品角色定义自身的组成属性
	// 2、抽象建造者，抽象建造者定义了产品的创建过程以及如何返回一个产品
	// 3、具体建造者，具体建造者实现了抽象建造者创建产品过程的方法，给产品的具体属性进行赋值定义
	// 4、指挥者，指挥者负责与调用客户端交互，决定创建什么样的产品

	// 例：
	/*	具体产品类  汽车
	*	定义属性、方法
	*/
	class car
	{
		public $name;
		public $color;
		public $speed;
		function show()
		{
			echo '品牌:'.$this->name.'<br>';
			echo '颜色:'.$this->color.'<br>';
			echo '速度:'.$this->speed.'<br>';
		}
	}

	//抽象汽车的建造者类
	abstract class CarBuilder
	{
		protected $car;
		//构造函数  实例化产品类
		function __construct()
		{
			$this->car = new car();
		}
		//抽象方法  
		abstract function BuildName();
		abstract function BuildColor();
		abstract function BuildSpeed();
		abstract function GetCar();


	}

	//具体汽车建造者(生成器) 宝马
	class BMW extends CarBuilder
	{
		//调用抽象方法，定义car类中的name字段
		function BuildName()
		{
			$this->car->name = 'BMW';
		}

		function BuildColor()
		{
			$this->car->color = 'orange';
		}

		function BuildSpeed()
		{
			$this->car->speed = '300km/h';
		}

		function GetCar()
		{
			return $this->car;
		}
	}

	class porshe extends CarBuilder
	{
		function BuildName()
		{
			$this->car->name = 'porshe';
		}

		function BuildColor()
		{
			$this->car->color = 'black';
		}

		function BuildSpeed()
		{
			$this->car->speed = '325km/h';
		}

		function GetCar()
		{
			return $this->car;
		}
	}

	//指挥者
	class Director
	{
		/*
		*	param $builder	建造者
		*	return mixed	产品类：车
		*/
		function Construct($builder)
		{
			$builder->BuildName();
			$builder->BuildColor();
			$builder->BuildSpeed();
			return $builder->GetCar();
		}

	}

	$director = new Director();
	$porshe = $director->Construct(new porshe());
	$BMW = $director->Construct(new BMW());
	$porshe->show();
	echo '<hr>';
	$BMW->show();
?>