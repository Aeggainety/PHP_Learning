<?php
	// ==============================================
	// 享元模式(Flyweight Pattern)
	// 运用共享技术有效地支持大量细粒度对象的复用。系统只使用少量的对象，而这些对象都很相似，状态变化很小，可以实现对象的多次复用。
    // 由于享元模式要求能够共享的对象必须是细粒度对象，因此它又称为轻量级模式，它是一种对象结构型模式。
	// 享元模式使用共享物件，用来尽可能减少内存使用量以及分享资讯给尽可能多的相似物件；它适合用于只是因重复而导致使用无法令人接受的大量内存的大量物件。
    // 通常物件中的部分状态是可以分享。常见做法是把它们放在外部数据结构，当需要使用时再将它们传递给享元。
	
	// 角色分析
	// 1、享元工厂角色(FWFactory)：创建并管理BlogModel对象。
	// 2、所有具体享元父接口角色(BlogModel)：接受并作用与外部状态。
	// 3、具体享元角色(JobsBlog)：具体变化点，为内部对象增加储存空间。

	// 优点：
	// 1、减少运行时对象实例的个数，节省内存；
	// 2、将许多“虚拟”对象的状态集中管理

	// 缺点：
	// 一旦被实现，单个的逻辑实现将无法拥有独立而不同的行为

	// 使用场景：
	// 当一个类有许多的实例，而这些实例能被同一方法控制的时候，我们就可以使用享元模式。



 
/**所有享元父接口角色
 * Interface IBlogModel
 */
interface IBlogModel
{
    function showTime();
    function showColor();
}
 
/**乔布斯的博客模板
 * Class JobsBlog
 */
class JobsBlog implements IBlogModel
{
    function showTime()
    {
        echo "纽约时间：5点整<br/>";
    }
 
    function showColor()
    {
        echo "<div style='color: #006600;height: 30;width: 30;background-color: #898989;'>Jobs</div>";
    }
}
 
/**雷军博客模板
 * Class LeiJunBlog
 */
class LeiJunBlog implements IBlogModel
{
    function showTime()
    {
        echo "北京时间：17点整<br/>";
    }
 
    function showColor()
    {
        echo "<div style='color:#c7254e;height: 30;width: 100;background-color: #898989;'>雷军</div>";
    }
}
 
/**博客模板工厂
 * Class BlogFactory
 */
class BlogFactory
{
    private $model=array();
 
    function getBlogModel($name)
    {
        if(isset($this->model[$name]))
        {
            echo "我是缓存里的<br/>";
            return $this->model[$name];
        }
        else
        {
            try
            {
                echo "我是新创建的<br/>";
                $class=new ReflectionClass($name);
                $this->model[$name]=$class->newInstance();
                return $this->model[$name];
            }
            catch(ReflectionException $e)
            {
                echo "<span style='color: #ff0000;'>你要求的对象我不能创建哦。</span><br/>";
                return null;
            }
 
        }
    }
}

// ==============================================
header("Content-Type:text/html;charset=utf-8");
//------------------------门面模式测试代码------------------

$factory=new BlogFactory();
$jobs=$factory->getBlogModel("JobsBlog");
if($jobs)
{
    $jobs->showTime();
    $jobs->showColor();
}
 
 
$jobs1=$factory->getBlogModel("JobsBlog");
if($jobs1)
{
    $jobs1->showTime();
    $jobs1->showColor();
}
 
 
$leijun=$factory->getBlogModel("LeiJunBlog");
if($leijun)
{
    $leijun->showTime();
    $leijun->showColor();
}
 
 
$leijun1=$factory->getBlogModel("LeiJunBlog");
if($leijun1)
{
    $leijun1->showTime();
    $leijun1->showColor();
}
 
$aFanda=$factory->getBlogModel("aFanda");
if($aFanda)
{
    $aFanda->showTime();
    $aFanda->showColor();
}

?>