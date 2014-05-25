<?php
/**====================================管理员控制器============================**/
//用于管理员自身的一些操作
//不涉及到项目本省的业务逻辑



namespace Admin\Controller;
use Think\Controller;

class AdminifController extends AdminController{


	public function _initialize(){

		parent::_initialize();

	}


	//登录界面
	public function index(){

		$this->display();

	}



	//login 操作
	public function login(){


	}




	//password UI
	public function updatePasswordUi(){

		$this->display();
	}




	//update  password 
	public function updatePassword(){




	}

	//base info ui
	public function baseInfo(){

		$this->display();
	}





	//修改个人信息 操作
	public function updateBaseInfo(){



	}


	//修改个人信息 UI
	public function updateBaseInfoUi(){

		$this->display();


	}





}

?>
