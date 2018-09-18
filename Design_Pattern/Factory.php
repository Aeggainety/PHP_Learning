<?php
	header("Content-Type:text/html;charset=utf-8");
	// ②、Factory Method(工厂模式)：定义一个用于创建对象的接口，让子类决定将哪一个类实例化。Factory Method使一个类的实例化延迟到其子类。
	// 尽量将长的代码分派“切割”成每段，将每段再“封装”起来(减少段和段之间耦合联系性)，这样，就会将风险分散，以后如果需要修改，只要更改每段，不会再发生牵一动百的事情。
	
	// 工厂模式：根据不同的参数生成不同的类实例。

	// 工厂模式分为：简单工程模式、工厂方法模式、抽象工厂模式。

	// 简单工厂模式，通过静态方法创建对象。可以理解成，只负责生产统一等级结构中的任何一个产品，但是不能新增产品。

	// 工厂方法模式，去掉了简单工厂模式中方法的静态属性，使其可以被子类继承，定义一个创建对象的接口，让子类去决定实例化哪个类。可以理解成，用来生成同一等级结构中的固定产品，但是支持增加产品。

	// 抽象工厂模式，提供一个创建一系列相关或者相互依赖的对象的接口。可以理解成，用来生产不同类型的全部产品，但是不能增加新品，支持增加新的类型。

	// 例子：
	// 基本工厂模式(其实就是一个简单的类)
	class User
	{
		private $username;
		public function __construct($username)
		{
			$this->username = $username;
		}
		public function getUser()
		{
			return $this->username;
		}
	}
	//用户工厂类
	class userFactory
	{
		static public function createUser()
		{
			//工厂类中实例化User类
			return new User('jack');
		}
	}

	$user = userFactory::createUser();
	echo $user->getUser();

	// 简单工厂模式:通过静态方法创建对象。可以理解成，只负责生产统一等级结构中的任何一个产品，但是不能新增产品。
	interface userProperties
	{
		function getUsername();
		function getGender();
		function getJob();
	}

	class User implements userProperties
	{
		private $username;
		private $gender;
		private $job;
		public function __construct($username,$gender,$job)
		{
			$this->username = $username;
			$this->gender = $gender;
			$this->job = $job;
		}

		public function getUsername()
		{
			return $this->username;
		}

		public function getGender()
		{
			return $this->gender;
		}

		public function getJob()
		{
			return $this->job;
		}
	}

	class userFactory
	{
		static public function createUser($properties = [])//property的复数形式(属性、内容)
		{
			return new User($properties['username'],$properties['gender'],$properties['job']);
		}
	}

	$employers = [
	['username'=>'jack','gender'=>'male','job'=>'coder'],
	['username'=>'Marry','gender'=>'female','job'=>'designer'],
	];

	$user = userFactory::createUser($employers[0]);
	echo $user->getUsername().' ';
	echo $user->getGender().' ';
	echo $user->getJob();

	// 工厂方法模式:去掉了简单工厂模式中方法的静态属性，使其可以被子类继承，定义一个创建对象的接口，让子类去决定实例化哪个类。可以理解成，用来生成同一等级结构中的固定产品，但是支持增加产品。
	interface userProperties
	{
		function getUsername();
		function getGender();
		function getJob();
	}

	interface createUser
	{
		function create($properties);
	}

	// 实现用户参数类
	class User implements userProperties
	{
		private $username;
		private $gender;
		private $job;
		public function __construct($username,$gender,$job)
		{
			$this->username = $username;
			$this->gender = $gender;
			$this->job = $job;
		}

		public function getUsername()
		{
			return $this->username;
		}

		public function getGender()
		{
			return $this->gender;
		}

		public function getJob()
		{
			return $this->job;
		}
	}

	//用户工厂
	class userFactory
	{
		private $user;
		// 构造方法，初始化用户属性，实例化用户对象
		public function __construct($properties = [])
		{
			$this->user = new User($properties['username'],$properties['gender'],$properties['job']);
		}

		public function getUser()
		{
			return $this->user;
		}
	}

	//实现创建用户接口
	class FactoryMan implements createUser
	{
		//创建用户接口中的创建方法
		function create($properties)
		{
			// 返回实例化的用户工厂对象
			return new userFactory($properties);
		}
	}

	class FactoryWoman implements createUser
	{
		function create($properties)
		{
			return new userFactory($properties);
		}
	}

	class clientUser
	{
		static public function getClient($properties)
		{
			$fac = new FactoryMan;
			$man = $fac->create($properties);
			echo $man->getUser()->getUsername();
		}
	}

	$employers = [
    	['username' => '温柔只给意中人', 'gender' => 'male', 'job' => 'coder'],
    	['username' => 'Marry', 'gender' => 'female', 'job' => 'designer'],
    ];

    $user = clientUser::getClient($employers[0]);

	// 抽象工厂模式：提供一个创建一系列相关或者相互依赖的对象的接口。可以理解成，用来生产不同类型的全部产品，但是不能增加新品，支持增加新的类型。
	interface userProperties
	{
		function getUsername();
		function getGender();
		function getJob();
	}
	//将对象的创建抽象成一个接口
	interface createUser
	{
		function createOpen($properties);//内向创建
		function createIntro($properties);//外向创建
	}

	class User implements userProperties
	{
		private $username;
		private $gender;
		private $job;
		public function __construct($username,$gender,$job)
		{
			$this->username = $username;
			$this->gender = $gender;
			$this->job = $job;
		}

		public function getUsername()
		{
			return $this->username;
		}
		public function getGender()
		{
			return $this->gender;
		}
		public function getJob()
		{
			return $this->job;
		}

	}

	class userFactory
	{
		private $user;
		public function __construct($properties = [])
		{
			$this->user = new User($properties['username'],$properties['gender'],$properties['job']);
		}

		public function getUser()
		{
			return $this->user;
		}

	}

	class FactoryMan implements createUser
	{
		function createOpen($properties)
		{
			return new userFactory($properties);
		}

		function createIntro($properties)
		{
			return new userFactory($properties);
		}
	}

	class FactoryWoman implements createUser
	{
		function createOpen($properties)
		{
			return new userFactory($properties);
		}

		function createIntro($properties)
		{
			return new userFactory($properties);
		}
	}

	class clientUser
	{
		static public function getClient($properties)
		{
			$fac = new FactoryMan;
			$man = $fac->createOpen($properties);
			echo $man->getUser()->getUsername();
		}
	}

	$employers = [
		['username'=>'jack','gender'=>'male','job'=>'coder'],
		['username'=>'marry','gender'=>'female','job'=>'designer'],
	];
	$user = clientUser::getClient($employers[0]);
?>