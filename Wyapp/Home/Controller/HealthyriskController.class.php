<?php

/**============================健康风险评估模块===========================**/
/*======================主要为初次登录添加个人的健康模块===================*/

namespace Home\Controller;
use Think\Controller;
use User\Api\UserApi;

class HealthyriskController extends HomeController{

	private $UserApi=null;


	//构造函数，检测是否登录 
	public function _initialize(){

		parent:_initialize();

		$this->UserApi=new UserApi();
	}



	/* 性别填写
	   返回的是json 数据
	   return    html
	 */
	public function paddingGender(){
		if(IS_AJAX && !empty(I('post.gender'))){

			if(is_int(I('post.gender'))){

				if($this->UserApi->updateOneField('u_gender',I('post.gender'))){
					$result['flag']=true;
					$result['msg']="OK";
				}else{
					$result['flag']=false;
					$result['msg']="录入失败！！！";
				}
			}else{
				$result['flag']=false;
				$result['msg']="请选择您的性别";
			}
			$this->ajaxReturn($result);
		}else{
			die();
		}


	}



	/**获取下一步界面构件**/
	//必须传入下一步代号 : next
	//AJAX操作
	public function getNextStep(){
		if(IS_AJAX){

			$this->assign('flag',true);
			$this->assign('shownext',I('post.next');
			$this->display('Box:getNextStep');//这里倒时候根据集体情况来定
			//TODO:若测试不过 调用fetch 方法获取后再用ajaxReturn方法来返回xml格式
		
		}else{
			die();
		}
	
	
	}
















}




?>
