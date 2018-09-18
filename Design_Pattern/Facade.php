<?php 
	// 外观模式(Facade)
	// 为子系统中的一组接口提供一个一致的界面，Facade模式定义了一个高层接口，这个接口使得这一子系统更加容易使用。
	// 提供一个统一地接口去访问多个子系统的多个不同的接口，它为子系统中的一组接口提供一个统一的高层接口。使子系统更容易使用。

	// 适用性
	// 当你要为一个复杂子系统提供简单接口时。子系统往往因为不断演化而变得越来越复杂。大多数模式使用时都会产生更多更小的类。
	// 这使得子系统更具可重用性，也更容易对子系统进行定制，但这也给那些不需要定制子系统的用户带来一些使用上的困难。
	// Facade可以提供一个简单的缺省视图，这一视图对大多数用户来说已经足够，而那些需要更多的可定制性的用户可以越过Facede层。

	// 客户程序与抽象类的实现部分之间存在着很大的依赖性。引入Facade将这个子系统与客户以及其它子系统分离，可以提高子系统的独立性和可移植性。

	// 当你需要构建一个层次结构的子系统时，使用外观模式定义子系统中每层的入口点。如果子系统之间是相互依赖的，你可以让它们仅通过Facade进行通讯，从而简化了它们之间的依赖关系。

	// 角色：
	// Facade：外观角色：此角色封装一个高层接口，将客户端的请求代理给适当的子系统对象，是门面模式的核心接口。
	// SubSystem：子系统角色：实现子系统的具体功能，处理FacadeCompany对象指派的任务。子系统没有FacadeCompany的任何信息，没有对FacadeCompany对象的引用。

	// 优点：
	// 对客户屏蔽子系统组件，减少了客户处理的对象数目并使得子系统使用起来更加容易。通过引入外观模式，客户代码将变得很简单，与之关联的对象也很少。
	// 实现了子系统与客户之间的松耦合关系,这使得子系统的组件变化不会影响到调用它的客户类,只需要调整外观类即可。
	// 降低了大型软件系统中的编译依赖性，并简化了系统在不同平台之间的移植过程，因为编译一个子系统一般不需要编译所有其他的子系统。一个子系统的修改对其它子系统没有任何影响，而且子系统内部变化也不会影响到外观对象。
	// 只是提供了一个访问子系统的统一入口，并不影响用户直接使用子系统类。

	// 缺点：
	// 不能很好地限制客户使用子系统类，如果对客户访问子系统类做太多的限制则减少了可变性和灵活性。
	// 在不引入抽象外观类的情况下，增加新的子系统可能需要修改外观类或客户端的源代码，违背了“开闭原则”。

	class Sub_system_one {
		public function method_one(){
			echo "subsystem one method one<br/>";
		}
	}

	class Sub_system_two {
		public function method_two(){
			echo "subsystem one method two<br/>";
		}
	}

	class Sub_system_three {
		public function method_three(){
			echo "subsystem one method three<br/>";
		}
	}

	class Sub_system_four {
		public function method_four(){
			echo "subsystem one method four<br/>";
		}
	}

	class Facade {
		private $_one;
		private $_two;
		private $_three;
		private $_four;

		public function __construct() {
			$this->_one = new Sub_system_one();
			$this->_two = new Sub_system_two();
			$this->_three = new Sub_system_three();
			$this->_four = new Sub_system_four();
		}

		public function method_A() {
			echo "method group A<br/>";
			$this->_one->method_one();
			$this->_two->method_two();
			$this->_four->method_four();
		}

		public function method_B() {
			echo "method group B<br/>";
			$this->_two->method_two();
			$this->_three->method_three();

		}

	}
	$facade = new Facade();
	$facade->method_A();
	$facade->method_B();
?>