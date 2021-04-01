<?php
namespace app\index\controller;
 // use app\index\controlle\Index;
/**
 * 
 */
 class User extends Index
{   const ONE=1;
	// public function s();
	protected static $name="撒";
	public function as(){
		$model = new \app\index\controller\Index;
		echo $model->a();
		echo "<hr>";
         $model1 =new Index;
         echo $model1->a();
		echo "<hr>";
		$model2 =controller("Index");
		 echo $model2->a();
	}
	//  function __construct(){
 //       echo 2;
	// }
	// private
	
	// function __construct(argument)
	// {
	// 	# code...
	// }
}