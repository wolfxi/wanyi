<?php

/**前台用户共用函数模块**/


//判断用户是否登录
//return boolean 
//true:登录    false:未登录
function is_login(){
	if(session('?USER_INFO')){ 
		return true;
	}else{
		return false;

	}

}


//货物用户信息
//return array or boolean
//array()-->关联数组（用户信息，除密码）  false-->为登录
function get_user_info(){
	if(is_login()){
		return session('USER_INFO'); 
	}else{
		return false;
	}
}	



























?>
