<?php

/**==============用户本身API中心================**/




namespace User\Api;
use User\Api\Api;



class UserApi extends Api{


	//初始化（构造函数的一部分）
	//实例化用户模型
	function _init(){
		$this->model=D('User');	

	}

	//用户注册接口
	//return boolean 
	//成功：true   失败：false
	public function register($nickname,$email,$password){

		//TODO::
	}


	//登录接口
	//return boolean 
	//成功：ture  失败：false
	//支持email 和帐号登录
	public function login($password,$account=null,$email=null){

		//TODO:: 


	} 


	//发送邮件接口
	//return boolean 
	//成功：ture  失败：false
	//@param email <用户邮箱>
	//@param content <发送的内容>
	//支持用户注册激活，邮箱找回密码
	public function sendEmail($email,$content){

		return true;

		return false;

	}



	//检测帐号
	//return boolean
	//帐号存在false 不存在true
	//@param account
	public function checkAccount($account){
		if(!empty($account)){
			$result=$this->model->where('u_account="%s"',$account)->find();
			if($result && is_array($result)){
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}

	}


	//检测邮箱是否可
	//return boolean
	//邮箱存在false 不存在true
	//@param email 用户邮箱
	public function checkEmail($email){
		if(is_email($email)){
			$result=$this->model->where('u_email="%s"',$email)->find();
			if($result && is_array($result)){
				return false;
			}else{
				return true;
			}
		}else{

			return false;
		}	
		return false;
	}


	//验证验证码
	//return boolean
	//正确true 错误false
	//@param code <验证吗>
	public function checkVerify(){


		return false;
	}






}



?>
