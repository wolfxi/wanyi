<?php
namespace Home\Controller;
use Think\Controller;
use User\Api\UserApi;

class RegisterController extends HomeController{

	private $Api=null; 

	//构造函数
	public function _initialize(){
		$Api=new UserApi();

		parent::_initialize();
	} 

	//登录UI
	public function loginUi(){
		$this->display();
	}

	//登录操作
	public function login(){
		if(IS_AJAX){	
			$name=I('post.name');
			$password=I('post.password');
			$verify=I('post.verify');
			if(empty(trim($name)) || empty(trim($password))|| empty(trim($verify)) ){
				$result['flag']= false;
				$result['msg']="请填写用户名和密码";
			}else{
				$flag=$this->Api->login($password,$name);	
				if($flag){
					$result['flag']=true;
					$result['msg']='OK';
				}else{
					$result['flag']=false;
					$result['msg']='用户名或密码错误';
				}
			}

			$this->ajaxReturn($result);
		}else{
			die();
		}
	}


	//注册UI
	public function index(){

		$this->display();
	}



	//注册操作 
	public function register(){

		if(IS_AJAX){
			$nickname=I('post.nickname');
			$email=I('post.email');
			$password1=I('post.password1');
			$password2=I('post.password2');
			$verify=I('post.verify');
			if(empty($nickname) || empty($email) || empty($password1) || empty($password2) || empty(verify)){
				$result['flag']=false;
				$result['msg']='请填写相关信息'];
				$this->ajaxReturn($result);
			}else{

				//检测邮件是否合格和是否被注册
				if(!$this->Api->checkEmail($email)){
					$result['flag']=false;
					$resut['msg']='邮箱已被注册或邮箱格式不正确';
					$this->ajaxReturn($result);
				
				}
				if($password1===$password2){
				
					if($this->Api->register($nickname,$passwprd1,$email){
						//TODO::跳到相应的界面
						
					}else{
					$result['flag']=false;
					$result['msg']='注册失败！！，请稍后在试！！'];
					$this->ajaxReturn($result);
					
					}
				}else{
					$result['flag']=false;
					$result['msg']='密码不一致！！'];
					$this->ajaxReturn($result);
				}
			}

		}else{

			die();
		}
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


	//验证码，登录和注册
	public function createVerify(){
		$verify=new \Think\Verify();
		$verify->legth=4;
		$verify->expire=180;
		$verify->entry();
	}












}



?>
