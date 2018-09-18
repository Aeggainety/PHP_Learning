<?php
	header("Content-Type:text/html;charset=utf-8");
	// 适配器模式(Adapter)：是作为两个不兼容的接口之间的桥梁。将一个类的接口转换成客户希望的另一个接口(适配器模式要解决的核心问题)。适配器模式使得原本由于接口不兼容而不能一起工作的那些类可以一起工作。
	
	// 角色分析：
	// 1、待适配(ForeignPlayer)角色：此角色的接口规则与内部的接口规则不一致，但内部需要调用该角色的方法功能。
	// 2、内部接口(IPlayer)角色：这是一个抽象角色，此角色给出内部期待的接口规则。
	// 3、适配器(Adapter)角色：通过在内部包装一个Adapter对象，把待适配接口转换成目标接口，此角色为适配器模式的核心角色，也是适配器模式所解决问题的关键。

	// 使用：
	// 1、系统需要使用现有的类，而此类的接口不符合系统的需要。
	// 2、想要建立一个可以重复使用的类，用于与一些彼此之间没有太大关联的一些类，包括一些可能在将来引进的类一起工作，这些源类不一定有一致的接口。
	// 3、通过接口转换，将一个类插入另一个类系中。

	// 场景：修改一个已经上线的接口时，主要用于拓展应用。
	// 1、接口中规定了所有要实现的方法；
	// 2、但要有一个实现此接口的具体类，只用到了其中的几个方法，而其它的方法都是没有用的。

	// 优点：
	// 1、可以让任何两个没有关联的类一起运行。
	// 2、提高了类的复用。
	// 3、增加了类的透明度。
	// 4、灵活性好。

	// 缺点：
	// 1、过多地使用适配器，会让系统非常零乱，不易整体进行把握。
	// 2、不支持多继承，只能适配一个适配者类，而且必须是抽象类。
	
	// ==============================================
	// 例
	// 类适配器
	// 内部抽象用户信息接口
	interface IUserInfo
	{
		public function getUserName();
		public function getUserId();
	}

	// 用户信息类，实现IUserInfo接口
	class UserInfo implements IUserInfo
	{
		//实现接口方法
		public function getUserId()
		{
			return 123;
		}

		public function getUserName()
		{
			return '阮豆';
		}
	}

	interface IOutUserId
	{
		public function getOutUserId();
	}

	interface IOutUserName
	{
		public function getOutUserName();
	}

	class OutUserId implements IOutUserId
	{
		public function getOutUserId()
		{
			return array('id'=>'321');
		}
	}

	class OutUserName implements IOutUserName
	{
		public function getOutUserName()
		{
			return array('name'=>'余佳运');
		}
	}
	
	// $userinfo = new UserInfo();
	// var_dump($userinfo->getUserId());//int 123
	// var_dump($userinfo->getUserName());//string '阮豆'

	// $outuserid = new OutUserId();
	// var_dump($outuserid->getOutUserId());//array('id'=>'321')
	// $outusername = new OutUserName();
	// var_dump($outusername->getOutUserName());//array('name'=>'余佳运')

	// 如代码所示，现外部是由两个接口组成，但php不支持多继承，那就用类关联

	//对象适配器
	class OutUserInfo implements IUserInfo{  
	    private $outUserid = null;  
	    private $outUserName = null;  
	    public function __construct($outUserid,$outUserName){  
	        $this->outUserid = $outUserid;  
	        $this->outUserName = $outUserName;  
	    }  
	    public function getUserId() {  
	        $return = $this->outUserid->getOutUserId();  
	        return $return['id'];  
	    }  
	    public function getUserName() {  
	        $return = $this->outUserName->getOutUserName();  
	        return $return['name'];  
	    }  
	}  
	$outUserid = new OutUserId();  
	$outUserName = new OutUserName();  
	$outUserInfo = new OutUserInfo($outUserid,$outUserName);  
	var_dump( $outUserInfo->getUserId() );//string '321'
	var_dump( $outUserInfo->getUserName() );//string '余佳运'

	// 类适配器是类间继承。对象适配器是对象的合成关系，也可以说是类的关联关系。
	// 类适配器采用“多继承”的实现方式，带来了不良的高耦合，所以一般不推荐使用。对象适配器采用“对象组合”的方式，更符合松耦合精神。

	// 注意事项：
	// 1、充当适配器角色的类就是实现已有接口的抽象类；
	// 2、为什么要用抽象类：此类是不要被实例化的。而只充当适配器的角色，也就为其子类提供了一个共同的接口，但其子类又可以将精力只集中在其感兴趣的地方。
?>