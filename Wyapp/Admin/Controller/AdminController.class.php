<?php
namespace Admin\Controller;
use Think\Controller;


class AdminController extends Controller{


	public function _initialize(){
		if((is_login())){
			$this->assign('admin_info',session('ADMIN_INFO'));
		
		}else{
			//跳到登录界面：TODO：：
			exit();	
		}


		/**对输入的变量进行过滤**/
		$_POST=self::filterInput($_POST);







	}




	//对输入的内容进行处理
	//@param $input 可以是数组或变量
	protected function filterInput($input){
		if(is_array($input) && count($input)>0){
			foreach($input as $key => $one){
				$input[$key]=self::fileterVar($one);

			}

		}else{

			$input=self::fileterVar($input);
		}
		return $input;

	}

	//对单个变量进行过滤
	//@param $input_var  单个变量
	//return 过滤后的字符串
	protected function fileterVar($input_var){

		if(is_numeric($input_var)){
			return $input_var;
		}else{
		$input_var=safe_replace($input_var);
		$input_var=remove_xss($input_var);
		$input_var=preg_replace('/<script.*>.*(\r)*(\n)*(\a)*(\s)*(<\/script>)?/','',$input_var);
		}
		return $input_var;
	}









}




?>
