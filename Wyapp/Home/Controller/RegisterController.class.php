<?php
namespace Home\Controller;
use Think\Controller;
use User\Api\UserApi;

class RegisterController extends HomeController{

	private $Api=null; 
	//构造函数
	public function _initialize(){
	

			$Api=new UserApi();
	} 

	//注册UI
	public function index(){
	
		$this->display();
	}



	//注册操作 
	public function register(){
	
	
	}
	



	//找回秘密UI 
	public function forgetPasswordUi(){
	
		$this->display();
	
	}



	//找回秘密操作
	public function forgetPassword(){
	

	
	}

	//注册激活操作
	public function activation(){
	
	}

	
	//ajax 用户email是否可用
	public function	emailIsable(){
		$email=I('post.email');
		if(IS_AJAX && !empty($email)){
			$flag=$Api->checkEmail($email);
			if($flag){
				$result['flag']=true;
				$result['msg']="OK";
			}else{
				$result['flag']=false;
				if(is_email($email)){
				$result['msg']='邮箱已经被注册!!!';
				}else{
				$result['msg']='邮箱格式错误!!!';
				}
			}

			$this->ajaxReturn($result);
		}else{
			exit();
		}
	} 


	//ajax 用户用户名是否可用
	public function	accountIsable(){
		if(IS_AJAX && !empty(I('post.account'))){
			$flag=$Api->checkAccount(I('post.account'));
			if($flag){
				$result['flag']=true;
				$result['msg']="OK";
			}else{
				$result['flag']=false;
				$result['msg']='帐号已经被注册！!!';
			}

			$this->ajaxReturn($result);
		}else{
			exit();
		}
	} 



	//ajax 验证验证码是否正确 
	public function	verifyIsRight(){
		if(IS_AJAX && !empty(I('post.verifycode'))){
			$flag=$Api->checkVerify(I('post.verifycode'));
			if($flag){
				$result['flag']=true;
				$result['msg']="OK";
			}else{
				$result['flag']=false;
				$result['msg']='验证码错误！！';
			}

			$this->ajaxReturn($result);
		}else{
			exit();
		}
	} 


	//验证码，用户登录和注册
	public function createVerify(){
		$verify=new \Think\Verify();
		$verify->legth=4;
		$verify->expire=180;
		$verify->entry();
	}












}



?>
