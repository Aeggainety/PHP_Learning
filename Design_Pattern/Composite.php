<?php
	header("Content-Type:text/html;charset=utf-8");

	// 组合模式(Composite)
	// 将对象组合成树形结构以表示“部分-整体”的层次结构。组合模式使得用户对单个对象和组合对象的使用具有一致性。

	// 特点：1、必须存在不可分割基本元素。
		  // 2、组合后的物体可以被组合。


	// 适用性
	// 你想表示对象的部分——整体层次结构。
	// 你希望用户忽略组合对象与单个对象的不同，用户将统一地使用组合结构中的所有对象。


	// 例：
	/*
	*组合模式抽象基类
	*
	*/
	abstract class CompanyBase{
		//节点名称
		protected $name;

		public function __construct($name){
			$this->name = $name;
		}

		public function getName(){
			return $this->name;
		}

		//增加节点
		abstract function add(CompanyBase $c);

		//删除节点
		abstract function remove(CompanyBase $c);

		//输出节点信息
		abstract function show($deep);

		//节点职责
		abstract function work($deep);
	}

	// 公司类
	class Company extends CompanyBase{
		protected $item = [];

		public function add(CompanyBase $c){
			$nodeName = $c->getName();

			if(!isset($this->item[$nodeName])){
				$this->item[$nodeName] = $c;
			}else{
				throw new Exception("该节点已存在，节点名称：".$nodeName);
			}
		}

		public function remove(CompanyBase $c){
			$nodeName = $c->getName();

			if(isset($this->item[$nodeName])){
				unset($this->item[$nodeName]);
			}else{
				throw new Exception("该节点不存在，节点名称：".$nodeName);
			}
		}

		public function show($deep = 0){
			echo str_repeat("-", $deep).$this->name;
			echo "<br>";
			foreach ($this->item as $value) {
				$value->show($deep+4);
			}
		}

		public function work($deep = 0){
			foreach ($this->item as $value) {
				echo str_repeat("&emsp;", $deep)."[{$this->name}]<br>";
				$value->work($deep+2);
			}
		}

	}

	/*
	*人力资源部
	*/
	class HumanResources extends CompanyBase{

		public function add(CompanyBase $c){
			throw new Exception("该节点下不能增加节点");
		}

		public function remove(CompanyBase $c){
			throw new Exception("该节点下无子节点");
		}

		public function show($deep = 0){
			echo str_repeat("-", $deep).$this->name;
			echo "<br>";
		}

		public function work($deep = 0){
			echo str_repeat("&emsp;", $deep)."人力资源部门的工作是为公司招聘人才";
			echo "<br>";
		}

	}

	/*
	*商务部门
	*/
	class Commerce extends CompanyBase{

		public function add(CompanyBase $c){
			throw new Exception("该节点下不能增加节点");
		}

		public function remove(CompanyBase $c){
			throw new Exception("该节点下无子节点");
		}

		public function show($deep = 0){
			echo str_repeat("-", $deep).$this->name;
			echo "<br>";
		}

		public function work($deep = 0){
			echo str_repeat("&emsp;", $deep)."商务部门的工作是为公司赚取利润";
			echo "<br>";
		}

	}

	$c = new Company("北京某科技公司");
	$h = new HumanResources("人力资源部门");
	$com = new Commerce("商务部门");
	$c->add($h);
	$c->add($com);

	//天津分公司
	$c1 = new Company("天津分公司");
	$c1->add($h);
	$c1->add($com);
	$c->add($c1);

	//武汉分公司
	$c2 = new Company("武汉分公司");
	$c2->add($h);
	$c2->add($com);
	$c->add($c2);


	$c->show();
	$c->work();
?>