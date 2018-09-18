<?php
	header("Content-Type:text/html;charset=utf-8");

	$time = date('Y-m-d H:i:s',time());
	
	echo $time.'<hr>';
	// ==============================================
	echo '面向对象编程OOP';
	// OOP（Object-Oriented Programming）, 面向对象的编程)技术为编程人员敞开了一扇大门，使其编程的代码更简洁、更易于维护，并且具有更强的可重用性
	echo '<hr>';
	// ==============================================


	// ==============================================
	echo 'OOP软件的三个目标';
	// 重用性、拓展性、灵活性
	echo '<hr>';
	// ==============================================


	// ==============================================
	echo '面向对象编程的三大特性';
	// 封装：面向对象的软件的重要优点是封装也叫“数据隐藏”。封装就是把对象中的成员属性和成员方法加上修饰符，使其尽可能隐藏对象的内部细节，以达到对成员的访问控制
	// 继承：继承允许子类与类之间创建层次关系，子类将从它的超类(父类)中继承属性和方法，通过继承可以在原有类的基础上创建出新的类，有一个类衍生出更复杂更专门的类，使代码具有更好的重用性，这对于功能的设计和抽象很有用，使其升级和维护更加的灵活。
	// 多态：面向对象的语音必须支持多态
	// 1、父类被子类继承之后拥有不同的数据类型和行为表现
	// 2、一个接口可以有多种不同的实现，对应不同的数据类型和行为表现
	// 3、一个类可以被实例化多个对象，不同对象也有不同的数据类型和表现行为

	echo '<hr>';

	// ==============================================


	// ==============================================
	echo '类和对象的概念';
	// 类：类是对具有相同或者相似特征事物抽象出的描述，其中静态的特征称为“属性”，动态的行为称为“方法”。
	// 1、类名使用class关键字定义，类名遵从标识符统一规范
	// 2、类中成员只能包含属性、方法和常量，不能有其他语句块
	// 3、成员属性必须加上修饰符，成员方法可以不加，默认为public
	// 4、成员属性可以初始化值，但只能是固定类型的值，不能含有运算符或变量
	// 5、当一个方法在类定义内部被调用时，有一个可用的伪变量$this。$this是一个到主叫对象的引用
	// 对象：面向对象的软件中，对象几乎可以表示所有的实物对象和概念对象，可以表示无力实际存在的对象：一个人，一棵树等。也可以表示软件中才有的概念对象：一个文件，一个资源等。
	// 类和对象的关系：
	// 1、类是对象的抽象描述，没有类就不可能有对象，每一个对象必须隶属于某个类。
	// 2、对象是类的具体体现，没有具体对象的类毫无意义，就是一堆死代码，想发挥一个类的作用，就必须让这个类有对象。

	echo '<hr>';

	// ==============================================



	// ==============================================
	echo '访问控制';
	// 对属性或方法的访问控制，是通过在前面添加关键字public(公有)，protected(受保护)或private(私有)来实现的。
	// ===============================================
	// |           |本类       |子类      |外部      |
	// |===========|===========|==========|==========|
	// |public     |可以访问   |可以访问  |可以访问  |
	// |===========|===========|==========|==========|
	// |protected  |可以访问   |可以访问  |不可以访问|
	// |===========|===========|==========|==========|
	// |private    |可以访问   |不可以访问|不可以访问|
	// ===============================================
	echo '<hr>';

	// ==============================================


	// ==============================================
	// 继承的实现
	// 1、一个类可以通过继承拥有另一个类的属性和方法，其中被继承的类称为基类、超类或父类，继承的类称为子类。
	// 2、PHP继承是单向的，子类可以从父类或者超类继承特性，父类不可以从子类获取特性
	// 3、子类就会继承父类所有的和受保护的方法。除非子类覆盖了父类的方法，被继承的方法都会保留其原有功能。
	class HumanF{}
	class blackMan extends HumanF{}
	class whiteMan extends HumanF{}
	class englishMan extends HumanF{}
	$bm = new blackMan();
	$wm = new whiteMan();
	$em = new englishMan();
	var_dump($bm);
	var_dump($wm);
	var_dump($em);
	echo '<hr>';

	// ==============================================


	// ==============================================
	// 静态属性
	// 使用static修饰的成员为静态成员，只隶属类本身，可以看成是有对象的“公有数据”。
	// 1、静态属性使用类名访问，在类中可以使用self代替类本身
	// 类名::$静态属性名
	// 注释：双冒号::是范围解析操作符，用于访问静态成员，类常量，还可以用于覆盖类中的属性和方法。
	// 2、静态方法中不能出现动态内容，即不能有$this这样的内容。
	// 注释：由于静态方法不需要通过对象即可调用，所以伪变量$this在静态方法中不可用。
	// 3、如果一个方法中不含有$this则认为这个方法是静态方法，按照严格语法最好在方法体上加上static修饰
	// 4、用静态方式调用一个非静态方法会导致一个E_STRICT级别的错误
	// 5、静态属性不可以由对象通过->操作符来访问。
	// 静态实例

	class demo
	{
		public static $counter;
		public function __construct()
		{
			echo "这是第".++self::$counter."个对象";
		}
	}

	new demo();echo '<br>';
	new demo();echo '<br>';
	new demo();echo '<br>';
	new demo();echo '<br>';


	echo '<hr>';

	//单列设计模式的基本写法
	class Single
	{
		//定义一个静态属性，用于存储一个实例化的对象
		private static $instance=null;
		//私有化构造方法
		private function __construct()
		{
			//初始化代码
		}

		//产生对象的方法
		public static function getObj(){
			if(!isset(self::$instance))
			{
				$obj = new self;
				self::$instance = $obj;
				return $obj;
			}else{
				return self::$instance;
			}
		}

		//私有化魔术克隆方法
	    private function __clone()
	    {
	        //代码
	    }

	}

	$obj1 = Single::getObj();
    $obj2 = Single::getObj();
    var_dump($obj1);echo '<br>';
    var_dump($obj2);


	echo '<hr>';

	//工厂模式部分
	// class Human{};
	class Animal{};
	class factory
	{
		static function getObj($className)
		{
			$obj = new Animal();
			return $obj;
		}
	}
	$obj3 = factory::getObj("Human");
	$obj4 = factory::getObj("Animal");
	var_dump($obj3);echo '<br>';
    var_dump($obj4);

    echo '<hr>';
    // ==============================================


    // ==============================================
	//覆盖override (重写)
    class Human{
    	public $id;
    	public $name;
    	public $sex;
    	private $age;
    	protected $addr;
    	public function __construct($id,$name,$sex,$age,$addr)
    	{
    		$this->id = $id;
    		$this->name = $name;
    		$this->sex = $sex;
    		$this->age = $age;
    		$this->addr = $addr;
    	}
    }


    class pre extends Human
    {
    	public $num;
    	public $nationality;
    	public $skin;
    	public function __construct($id,$name,$sex,$age,$addr,$num,$nationality,$skin)
    	{
    		parent::__construct($id,$name,$sex,$age,$addr);
    		$this->num = $num;
    		$this->nationality = $nationality;
    		$this->skin = $skin;
    	}
    	public function __clone()
		{
			$this->handle = fopen("./readme.txt","r");
		}

		public function __destruct()
		{
			fclose($this->handle);
		}
    }
	// ==============================================


	// ==============================================
    //重载overloading
    //通过魔术方法动态地创建类属性和方法。
    // 属性重载
    // public void __set(string $name,mixed $value);
    // public mixed __get(string $name);
    // public bool __isset(string $name);
    // public void __unset(string $name);
    //$name 变量名  __set()方法的$value制定了$name变量的值。
    // 方法重载
    // public mixed __call(string $name , array $arguments);
    // public static mixed __callStatic(string $name,array $arguments);
    //$name 是要调用的方法名  $arguments 是枚举数组，包含要传递给方法的参数

	// ==============================================

	// ==============================================
    // final关键字
    // 如果父类中的方法被声明为 final，则子类无法覆盖该方法。如果一个类被声明为 final，则不能被继承

	// ==============================================


	// ==============================================
    // 对象复制
    // 对象为引用类型，这里赋值类似于起别名，赋值产生的对象是复制的“引用关系，赋值产生的还是同一个对象
	// 通过克隆可以产生一个完全独立的对象，使用关键字：clone  
	// 仅仅使用clone关键字去克隆一个对象，只能克隆出他的非资源费非对象数据，要完整克隆一个对象，需要使用__clone()魔术方法，在克隆时自动触发  

	// 在外部克隆时，自动触发

		

	$person1 = new Human('1','岳飞','male','18','宋');

	$person2 = clone($person1);
	var_dump($person1);
	var_dump($person2);
	echo '<hr>';
	// ==============================================


	// ==============================================
	// 对象信息保存
	// 序列化serialize()
	// 所有php里面的值都可以使用函数serialize()来返回一个包含字节流的字符串来表示。
	// unserialize()函数能够重新吧字符串变回php原来的值。序列化一个对象将会保存对象的所有变量，但是不会保存对象的方法，只会保存类的名字。
	// 序列化serialize()：
	// 用来将对象转化成字符创保存的函数，将转化后的字符串保存至文本或者数据库中，便于跨脚本使用。
	// 当对一个对象进行“序列化”操作的时候，会自动调用类中的sleep()方法。
	// “sleep()魔术方法中可以进行一些数据（资源）的清理工作，并返回一个数组，该数组可以存储一些想要进行序列化的对象的属性——即可以挑选属性进行序列化。”
	//例：
	class Fish
	{
		public $name;
		public $sex;
		public function __construct($name,$sex)
		{
			$this->name = $name;
			$this->sex = $sex;

		}

		// public function __sleep()
		// {
		// 	$this->handle = fopen("./readme.txt","r");
		// 	return array('name',"sex","handle");
		// }
		 //在反序列化的时候自动调用的魔术方法__wakeup();
	    public function __wakeup()
	    {
	        $this->handle=fopen("./readme.txt","r");
	    }
		public function __destruct()
		{
			$this->handle = fopen("./readme.txt","r");
			fclose($this->handle);
		}

	}

	$person = new Fish('O鱼','fish');
	$str = serialize($person);
	// var_dump(file_put_contents('./readme.txt', $str));
	var_dump(file_get_contents('./readme.txt', $str));

	// ==============================================


	// ==============================================
	// 自动加载 __autoload()
	// autoload()是一个单独的函数不是一个类方法。autoload()的主要用途是尝试包含或请求任何用来初始化所需要的类文件。
	// __autoload()会在实例化一个还没有被声明的类时自动调用
	// function __autoload($classname)
	// {
		// require "./libs/{$classname}.class.php";
	// }
	// $p = new Human("","");
	// var_dump($p);

	// 补充：spl_autoload_register()注册给定的函数作为__autoload的实现【参看PHP手册】

	// ==============================================


	// ==============================================
	// 抽象类
	// 可以定义不含方法体的方法，即为：抽象方法，需要是使用abstract定义，含有抽象方法的类，一定是抽象类，必须abstract声明成抽象类。
	// 1、抽象方法必须只声明调用方式，不能定义具体功能实现
	// 2、抽象方法不能被设置为私有(不能被private修饰)
	// 3、抽象方法不能有{}，直接;结束
	// 4、抽象类不能被实例化
	// 5、继承抽象类的子类，必须定义所有的抽象方法，子类中定义的抽象方法访问控制，不能比抽象类中定义的更严格
	// 6、子类中必须完成继承过来的抽象方法的具体实现，这就是抽象类的约束作用。
	// 7、抽象类的约束作用可以有效的做到项目开发中的规范性要求，实现项目管理。

	abstract class Bobo
	{
		public $name;
		public $addr;
		public function __construct($name,$addr)
		{
			$this->name = $name;
			$this->addr = $addr;
		}

		//公有的抽象方法
		public abstract function reading();

		//受保护的抽象方法
		protected abstract function runing();
	}

	class person extends Bobo
	{
		public function reading()
		{
			// 抽象方法实现类
		}

		public function runing()
		{
			// 抽象方法实现类
		}
	}

	// ==============================================


	// ==============================================
	echo '接口';
	// 如果在一个抽象类中只包含抽象方法时，我们把该“类”称为接口(interface)，它需要单独的类去实现(implements)
	// 基本规则：
	// 1、接口的所有方法都是抽象方法，但是不需要使用abstract修饰
	// 2、接口中定义的所有方法都必须是公有
	// 3、要实现一个接口，必须使用implements操作符，类中必须实现接口中定义的所有方法
	// 4、一个类可以实现多个接口，实现多个接口时，接口中的方法名不能重复
	// 5、接口与接口之间可以继承，使用extends
	// 6、接口中也可以定义常量。接口常量和类常量的使用完全相同，但是不能被子类或子接口所覆盖。
	interface Boss
	{
		public function fun1();
		public function fun2();
		public function fun3();
	}

	interface Message
	{
		public function fun4();
		public function fun5();
		public function fun6();
	}

	abstract class Engineer implements Boss,Message
	{
		// 实现抽象方法1
		public function fun1()
		{

		}

		// 实现抽象方法2
		public function fun2()
		{

		}

		public function fun3(){}
		public function fun4(){}
		public function fun5(){}

		// 实现抽象方法6
		public function fun6()
		{

		}
	}

	class Programmer extends Engineer
	{
		public function fun3(){}
		public function fun4(){}
		public function fun5(){}
	}

    // ==============================================


    // ==============================================
    // 常见的魔术方法
    // __construct() 构造函数的类会在每次创建新对象时先调用此方法，所以非常适合在使用对象之前做一下初始化工作
    // __destruct() 析构函数会在到某个对象的所有引用都被删除或者当对象被显示销毁时执行
    // __set() 在给不可访问属性赋值时，__set()会被调用
    // __get() 读取不可访问属性的值时，__get()会被调用
    // __call() 在对象中调用一个不可访问方法时，__call()会被调用
    // __callStatic() 在静态方法中调用一个不可访问方法时，__callStatic()会被调用
    // __isset() 当对不可访问属性调用isset()或empty()时，__isset()会被调用
    // __unset() 当对不可访问属性调用unset()时，__unset()会被调用
    // __sleep() serialize()函数会检查类中是否存在一个魔术方法__sleep()。如果存在，该方法会先被调用，然后才执行序列化操作。此功能可以用于清理对象，并返回一个包含对象中所有应被序列化的变量名称的数组
    // __wakeup() unserialize()会检查是否存在一个wakeup()方法。如果存在，则会先调用wakeup()方法，预先准备对象需要的资源。__wakeup()经常用在反序列化操作中，例如重新建立数据库连接，或执行其他初始化操作。
    // __clone() 对象复制可以通过clone关键字来完成，这将调用对象的__clone()方法。
    // __toString() __toString()方法用于一个类被当成字符串时应怎样回应
    
	// ==============================================



?>