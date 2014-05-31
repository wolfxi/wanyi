<?php
/**====================================管理员控制器============================**/
//用于管理员自身的一些操作
//不涉及到项目本省的业务逻辑



namespace Admin\Controller;
use Think\Controller;

class AdmininfoController extends AdminController{


	public function _initialize(){

		parent::_initialize();

	}

	//left 边栏
	public function left(){
		$this->display();
	}


	//top 边栏
	public function top(){
		$this->display();
	}



	//管理员信息
	public function index(){

		$this->display();

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
