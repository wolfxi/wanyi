<?php

/**==============用户本身API中心================**/




namespace User\Api;
use User\Api\Api;
use User\Api\SendemailApi;


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
		$data['u_email']=$email;
		$data['u_account']=$email;
		$data['u_password']=md5($password);
		$data['u_nickname']=$nickname;
		$UserModel=M('user');
		//开启事物
		$UserModel->startTrans();
		$flag=$UserModel->data($data)->add();
		if($flase){
			//发送激活邮件
			$subject="万医网站注册成功，激活邮件";
			$content='点击一下内容激活你的帐号';

			//:TODO：：	倒是后设置邮箱验证规则
			$send=$this->sendEmail($email,$content,$nickname,$subject);
			if($send){
				$UserModel->commit();
				return true;
			}else{
				$UserModel->rollback();
				return false;
			}
		}else{
			return false;
		}
	}


	//登录接口
	//return boolean 
	//成功：ture  失败：false
	//支持email 和帐号登录
	public function login($password,$account=null,$email=null){
		$result=false;
		if(is_null($email)){
			//帐号登录
			$result=$this->model->where("u_account='%s' AND u_password='%s'",$account,md5($password))->find();
		}else{
			//邮箱登录
			$result=$this->model->where("u_email='%s' AND u_password='%s'",$email,md5($password))->find();
		}
		if(is_array($return) && md5($password)===$result['u_password']){
			$result['u_password']=null;
			session('USER_INFO',$result);
			//更新用户信息
			$data['u_login_times']=$result['u_login_times']+1;
			if($this->model->where('u_id=%d',$result['u_id'])->data($data)->save()){
				return true;
			}else{
				return false;
			}

		}else{
			return false;
		}



	} 


	//发送邮件接口
	//return boolean 
	//成功：ture  失败：false
	//@param email <用户邮箱>
	//@param content <发送的内容>
	//支持用户注册激活，邮箱找回密码
	public function sendEmail($email,$content,$name,$subject){
		if(is_email($email)){
			$email_api=new SendemailApi();
			$send['aname']=$name;
			$send['aaccount']=$email;
			$send['subject']=$subject;
			$send['body']=$content;
			if($email_api->send($send)){
				return true;

			}else{
				return false;
			}
		}else{
			return false;
		}
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


	//检测邮箱是否可以注册
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
	public function checkVerify($verify){
		$verify=new \Think\Verify();
		return $verify->check($verify);

	}


	/*跟新用户信息  单个字段更新
	  @param $field :字段名
	  @param $value :值
	  return boolean true /flase
	 */
	public function updateOneFiels($field,$value){

		$valuetype="%s";
		if(is_int($value)){
			$valuetype="%d";
		}
		$flag=$this->model->where("u_id=%d",get_user_field('u_id'))->data(array($field=>$value))->save();
		if($flag){
			return true;
		}else{
			return false;
		}
	}




}



?>
