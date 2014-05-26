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

		parent::_initialize();

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




	/* 生日填写
	   返回的是json 数据
	   return    html
	 */
	public function paddingBrithday(){
		if(IS_AJAX && !empty(I('post.brithday'))){

			$brithday=strtotime(I('post.brithday'));

			if(is_int($brithday) && $brithday<time()){

				if($this->UserApi->updateOneField('u_brithday',$brithday)){
					$result['flag']=true;
					$result['msg']="OK";
				}else{
					$result['flag']=false;
					$result['msg']="录入失败！！！";
				}
			}else{
				$result['flag']=false;
				$result['msg']="请选择正确的生日";
			}
			$this->ajaxReturn($result);
		}else{
			die();
		}


	}


	/*民族填写
	   返回的是json 数据
	   return    html
	 */
	public function paddingNationality(){
		if(IS_AJAX && !empty(I('post.nationality'))){

			if(is_string(I('post.nationality')){

				if($this->UserApi->updateOneField('u_nationality',I('post.nationality'))){
					$result['flag']=true;
					$result['msg']="OK";
				}else{
					$result['flag']=false;
					$result['msg']="录入失败！！！";
				}
			}else{
				$result['flag']=false;
				$result['msg']="请选择您的民族";
			}
			$this->ajaxReturn($result);
		}else{
			die();
		}


	}


/*孩子人数填写
	   返回的是json 数据
	   return    html
	 */
	public function paddingChildren(){
		if(IS_AJAX && !empty(I('post.children'))){

			if(is_int(I('post.children')){

				if($this->UserApi->updateOneField('u_children_count',I('post.children'))){
					$result['flag']=true;
					$result['msg']="OK";
				}else{
					$result['flag']=false;
					$result['msg']="录入失败！！！";
				}
			}else{
				$result['flag']=false;
				$result['msg']="请选择您的有几个孩子";
			}
			$this->ajaxReturn($result);
		}else{
			die();
		}


	}




/*饮酒填写
	   返回的是json 数据
	   return    html
	 */
	public function paddingDrink(){
		if(IS_AJAX && !empty(I('post.drink'))){

			if(is_string(I('post.drink')){
				//载入生活习惯史
				$habitshistoryModel=M('habitshistory');
				$data['hh_name']='饮酒';
				$data['hh_remark']=I('post.drink');
				$data['u_id']=get_user_field('u_id');
				$data['hh_hold_date']=I('post.drink');
				$flag=$habitshistoryModel->data($data)->save();
				if($flag){
					$result['flag']=true;
					$result['msg']="OK";
				}else{
					$result['flag']=false;
					$result['msg']="录入失败！！！";
				}
			}else{
				$result['flag']=false;
				$result['msg']="请选择您的饮酒史";
			}
			$this->ajaxReturn($result);
		}else{
			die();
		}


	}





	/*预防针记录
	  返回的是json 数据
	  return    html
	 */
	public function paddingVaccinations(){
		if(IS_AJAX && is_array(I('post.vaccinations'))){

			//不清楚的就认为是没有打过预防的
			$vaccinations=I('post.vaccinations');
			if(is_array($vaccinations)){
				//载入预防针记录
				$u_id=get_user_field('u_id');
				$vaccinationsModel=M('vaccinationrecord');
				$vaccinationsModel->startTrans();
				$flag=false;
				foreach($vaccinations as $one){
					$tempdate['u_id']=$u_id;	
					$tempdate['vc_name']=$one['name'];
					$tempdate['vc_type']='预防';
					$flag=$vaccinationsModel->data($tempdate)->add();
					if(!$flag){
						break;
					}
				}

				if($flag){
					$vaccinationsModel->commit();
					$result['flag']=true;
					$result['msg']="OK";
				}else{
					$vaccinationsModel->rollback();
					$result['flag']=false;
					$result['msg']="录入失败！！！";
				}
			}else{
				$result['flag']=false;
				$result['msg']="请选择您近期注射过的预防";
			}
			$this->ajaxReturn($result);
		}else{
			die();
		}
	}







/*测评完成
	   返回的是json 数据
	   return    html
	 */
	public function complete(){
		if(IS_AJAX && !empty(I('post.drink'))){

				//TODO::测评完成	
		}
	}
















	/**获取下一步界面构件**/
	//必须传入下一步代号 : next
	//AJAX操作
	public function getNextStep(){
		if(IS_AJAX){

			$next=I('post.next');
			$shownext=null;
			if(empty($next) || $next<=0 || $next>8){
				//不符合规范的操作
				die();
			}else{

				switch ($next){

					case 1: $shownext='gender';
							break;
					case 2: $shownext='birthday';
							break;
					case 3: $shownext='gender';
							break;
					case 4: $shownext='birthday';
							break;
					case 5: $shownext='gender';
							break;
					case 6: $shownext='birthday';
							break;

					case 7: $shownext='gender';
							break;

					default : $shownext=null;
				}
			}

			if(is_int($shownext) && $shownext){

				$this->assign('flag',true);
				$this->assign('shownext',$shownext);
				$this->display('Box:getNextStep');//这里倒时候根据集体情况来定
				//TODO:若测试不过 调用fetch 方法获取后再用ajaxReturn方法来返回xml格式
			}else{
				die();
			}

		}else{
			die();
		}


	}
















}




?>
