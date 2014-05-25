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


//货物用户单个字段信息  根据ID来获取
//@param $field 要获取的字段
//@type 模式 boolean 为true时，从数据库获取，并更新session 
function get_user_field($field,$type=false){
	if(is_login()){

		$user_info=get_user_info();
		if($type){
			$model=M('user');
			$result=$model->where("u_id='%s'",$user_info['u_id'])->find();
			$result['u_password']=null;
			session('USER_INFO',$result);
		}
		return $user_info[$field];
	}else{
		return false;
	}

}
























?>
