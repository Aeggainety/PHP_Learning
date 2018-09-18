<?php
	header("Content-Type:text/html;charset=utf-8");
	// ①单例模式：保证一个类仅有一个实例，并提供一个访问它的全局访问点。单例模式是最简单的设计模式之一，但是对于Java的开发者来说，它却有很多缺陷。在九月的专栏中，David Geary探讨了单例模式以及在面对多线程(multithreading)、类装载器(class loaders)和序列化(serialization)时如何处理这些缺陷。
	// // 适用性：
	// // ·当类只能有一个实例而且客户可以从一个众所周知的访问点访问它时。
	// // ·当这个唯一实例应该是通过子类化可扩展的，并且客户应该无需更改代码就能使用一个扩展的实例时。
	class User{
		//声明一个私有的实例变量
		private $name;
		//静态变量保存全局实例
		static private $_instance = null;
		////声明私有构造方法，防止外界实例化对象，使用final关键字，防止继承后修改访问权限 
		final private function __construct()
		{
		}
		//私有克隆函数，防止外部克隆对象，使用final关键字，防止继承后修改访问权限 
		final private function __clone()
		{
		}
		//静态方法，单例统一访问入口
		static public function getInterface()
		{
			if(self::$_instance instanceof self)
			{
				return self::$_instance;
			}
			self::$_instance = new self();
			return self::$_instance;
		}

		public function setName($n)
		{
			$this->name = $n;
		}

		public function getName()
		{
			return $this->name;
		}

	}
	// 调用getName方法
	$na = User::getInterface();
	$nb = User::getInterface();
	$na->setName('张三');
	echo $nb->getName();
	$nb->setName('李四');
	echo $nb->getName();
	// // 所有的单例模式至少拥有以下三种公共元素：
	// // 1、它们必须拥有一个构造函数，并且必须被标记为private
	// // 2、它们拥有一个保存类的实例的静态成员变量
	// // 3、它们拥有一个访问这个实例的公共的静态方法
	// // 单例类不能在其它类中直接实例化，只能被其自身实例化。他不会创建实例副本，而是会向单例类内部存储的实例返回一个引用。

	// // 要创建对象需要有类这是必须的，而且不能是抽象类。这个类要防止别人可以多次创建函数。
	// // 我们自然而然考虑到了从构造函数入手。

	// // 使用单例模式可以避免大量的new操作。因为每一次new操作都会消耗系统和内存的资源。
	// // 设置访问权限private或protected防止多次创建对象实例。

	// // 利用关键字final声明构造函数不可继承，防止继承后更改访问权限。

	// // 不受是否创建对象影响都能调用的方法的解决方案毋庸置疑那就是利用关键字--static
	// // ※ 在没有实例化对象的情况下，通过static关键词调用类内方法。

	// // 静态方法，不受是否创建对象影响都能调用
?>