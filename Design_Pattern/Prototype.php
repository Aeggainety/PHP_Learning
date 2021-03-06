<?php
	header("Content-Type:text/html;charset=utf-8");
	
	// 原型模式：用原型实例指定创建对象的种类，并且通过拷贝这个原型来创建新的对象。在运行期建立和删除原型。
	// 用于创建重复的对象，同时又能保证性能。它提供了一种创建对象的最佳方式。
	// 这种模式是实现了一个原型接口，该接口用于创建当前对象的克隆。当直接创建对象的代价比较大时，则采用这种模式。
	// 例如：一个对象需要在一个高代价的数据库操作之后被创建。我们可以缓存该对象，在下一个请求时返回它的克隆，在需要的时候更新数据库，以此来减少数据库调用。

	// 适用性：
	// 1、当一个系统应该独立于它的产品创建，构成和表示时。
	// 2、当要实例化的类是在运行时刻指定时，例如，通过动态装载。
	// 3、为了避免创建一个与产品类层次平行的工厂类层次时。
	// 4、当一个类的实例只能有几个不同状态组合中的一种时。
	// 建立相应数目的原型并克隆它们可能比每次用合适的状态手工实例化该类更方便一些。

	// 利用已有的一个原型对象，快速地生成和原型对象一样的实例。

	// 用原型实例指定创建对象的种类，并且通过拷贝这个原型来创建新的对象。
	// 原型模式允许一个对象再创建另一个可定制的对象，根本无需知道任何如何创建的细节，通过将一个原型对象传给那个要发动创建的对象，这个要发动创建的对象通过请求原型对象拷贝它们自己来实施创建。
	// 它主要面对的问题是：“某些结构复杂的对象”的创建工作；由于需求的变化，这些对象经常面临着剧烈的变化，但是它们却拥有比较稳定一致的接口。

	// php中已经实现了原型模式，有个魔术方法__clone()，会克隆出一个这样的对象，开发过程中直接使用即可。。

	// 角色分析：
	// 1、抽象原型，提供了一个克隆的接口；
	// 2、具体的原型，实现克隆的接口。

	// 例子：
	/*抽象原型类
	*Class Prototype
	*/
	abstract class Prototype
	{
		abstract function cloned();
	}

	/*具体原型类
	*Class Seagull
	*/
	class Seagull extends Prototype
	{
		public $color;
		function Fly()
		{
			echo "小螺号瞎几把吹，{$this->color}海鸥听了瞎几把飞";
		}

		function cloned()
		{
			return clone $this;
		}
	}

	$seagull = new Seagull();
	$seagull->color = "<font style='color:gray'>灰色的</font>";

	$seagull->Fly();

?>