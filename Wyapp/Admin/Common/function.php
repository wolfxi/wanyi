<?php
	
	/**后台公共函数模块**/

	//判断管理员是否登录
	//return boolean
	//true:登录成功   false:登录失败
	function is_login(){
		if(session('?ADMIN_INFO')){
			return true;	
		}else{
			return false;	
		}
	
	
	}


	//获取管理员信息
	//return array
	//array--->关联数组（管理员信息，除密码外）  flase:没有登录
	function get_admin_info(){
		if(is_login()){
			return session('ADMIN_INFO');
		}else{
			return false;
		}		
	
	}




















?>
