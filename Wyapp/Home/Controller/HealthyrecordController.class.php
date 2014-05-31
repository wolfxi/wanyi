<?php
/**===================================主要用于登录以后添加个人的疾病/用药/检查/==============================*/
/**========================================以及健康状况/管理目标/风险评估===========================***/

namespace Home\Controller;
use Think\Controller;
use User\Api\DictionaryApi;


class HealthyrecordController extends HomeController{

	private $DictionaryApi=null;

	//构造函数
	public function _initialize(){
	
		parent::_initialize();
	
		$this->DictionaryApi=new DictionaryApi();
	}


	/***=========================添加疾病  D   start===================**/


	//拼音快速查找疾病
	//根据疾病字典获取数据
	//return 二维数组
	public function quickFindDisease(){
		if(IS_AJAX && empty(I('post.disease'))){
			$search_str=I('post.desease');	
			$result=$this->DictionaryApi->PinYinSearch('diseasedictionary','dd_pinying',$search_str);	
			$res=array();
			if($result && is_array($result)){
				$res['flag']=true;
				$res['msg']=$result;
			}else{
				$res['flag']=true;
				$res['msg']='';
			}
			$this->ajaxReturn($res);
		}else{
			die();
		}
	
	}


	//选定疾病
	//将疾病存在session中 session的ID可以发送到界面
	//返回的时候要携带该ID来获取存在session中的数据
	//该session中存的是一个数组
	public function choseConfirmDisease(){

		if(IS_AJAX && !empty(I('post.dname'))){
			$dname=(string)I('post.dname');
			$result=array();
			if($this->DictionaryApi->existSelect('diseasedictionary','dd_name',$dname)){
				$temp_id=uniqid();
				$temp_array['dname']=$dname;
				//存如一个session中
				session($temp_id,$temp_array);
				$result['uniqid']=$temp_id;
				$result['flag']=true;
				$result['msg']='OK';

			}else{
				$result['flag']=false;
				$result['msg']='没有该疾病';
			}
			$this->ajaxReturn($result);
		}else{
			die();
		}
	} 



	//返回确认确诊界面
	//根据用户选择的疾病来提供界面
	//return html界面
	//必须获取疾病的名称
	public function getConfirmDHtml(){
		if(IS_AJAX && !empty(I('post.uniqid'))){
			$uniqid=I('post.uniqid');
			if(is_string($uniqid)){

				$temp_array=session($uniqid);
				$this->assign('flag',true);
				$this->assing('uniqid',$uniqid);
				$this->assign('dname',$temp_array['dname']);
				$this->display();//TODO::需要界面的支持

			}else{
				$result['flag']=false;
				$result['msg']='请选择相关的疾病';
				$this->ajaxReturn($result);
			}

		}else{
			die();
		}
	}


	//确认是否确诊
	//确诊操作
	//return json
	public function getConfirmD(){
		if(IS_AJAX && !empty(I('post.ok')) && !empty(I('post.uniqid'))){
			$ok=I('post.ok');
			$uniqid=I('post.uniqid');
			$temp_array=session($uniqid);
			$result=array();
			if($ok=='yes'){
				$temp_array['dok']='yes';
				$result['date']='yes';
			}else{
				$temp_array['dok']='no';
			}
			//更新session
			session($uniqid,$temp_array);
			$result['flag']=true;
			$result['msg']='OK';
			$this->ajaxReturn($result);
		}else{
			die();
		}
	} 


	//获取疾病确诊的日期界面元素
	//获取界面操作
	//return html
	public function getDateDHtml(){
	
		if(IS_AJAX && !empty(I('post.date'))){
		
			$showdate=I('post.date');
			if($showdate=='yes'){
				//返回日期界面
				//TODO::--------------
				$this->display(); 
			}else{

				//返回确定按钮
				//TODO::-------------------
				$this->display();
			}
		}else{
			die();
		}
	}


	//存取疾病确诊时间
	//return json
	public function getDate(){
	
		if(IS_AJAX && !empty(I('post.date')) && !empty(I('post.uniqid'))){

			$uniqid=I('post.uniqid');
			$temp_array=session($uniqid);
			$temp_array['date']=strtotime(I('post.date'));
			$session($uniqid,$temp_array);

			$result['flag']=true;
			$result['msg']='OK';
			$this->ajaxReturn($result);

		
		}else{
			die();
		}
	
	
	}


	//获取并发症界面HTML
	//return html
	public function getSideEffectDHtml(){

		if(IS_AJAX && !empty(I('post.dname'))){
			$this->assign('dname',I('post.dname'));
			$this->assign('flag',true);

			//根据提供的界面来判断
			$this->display();

		}else{
			die();
		}



	}


	//记录下并发症
	//return json
	public function getSideEffectD(){

		if(IS_AJAX && !empty(I('post.dename')) && !empty(I('post.uniqid'))){
			$temp_array=session(I('post.uniqid'));

			$temp_array['dename']=I('post.dename');
			session(I('post.uniqid'),$temp_array);
			$result['flag']=true;
			$result['msg']='OK';
			$this->ajaxReturn($result);
		}else{
			die();	
		}
	}


	//获取完成界面的按钮
	//return html 
	public function getDoneDHtml(){
	
		if(IS_AJAX){
		
			$this->assign('flag',true);
			$this->display();
		}else{
		die();
		}
	
	}



	//点击完成按钮界面
	//return json
	public function	addDoneDisease(){
		if(IS_AJAX && !empty(I('post.uniqid'))){
			$temp_array=session(I('post.uniqid'));
			$uid=get_user_field('u_id');
			$Dmodel=M();
			$Dmodel->startTrans();
			//insert into dr
			$data['u_id']=$uid;
			$data['br_name']=$temp_array['dname'];
			$data['dr_diagnose']=$temp_array['dok'];
			$data['dr_diagnose_date']=isset($temp_array['date']) ? $temp_array['date'] : 0; 

			$flag=$Dmodel->table('diseaserecords')->data($data)->add();

			if($flag){
				//insert into drd
				$data_de['dr_id']=$flag;
				$data_de['drd_item']='并发症';
				$data_de['drd_introduce']=isset($temp_array['dename']) ? $temp_array['dename'] : '';

				$flag=$Dmodel->table('dr_detial')->data($data_de)->add();
				if($flag){
					$result['flag']=true;
					$result['msg']='OK';

					$Dmodel->commit();
				}else{
					$result['flag']=false;
					$result['msg']='添加疾病失败';
					$Dmodel->rollback();
				}

			}else{
				$Dmodel->rollback();
				$result['flag']=false;
				$result['msg']='添加疾病失败';
			}
			$this->ajaxReturn($result);


		}else{
			die();	

		}
	}



	/***=========================添加疾病 end===================**/

	///////////////////////////////////////////////////////////////

	/***=========================添加用药 M   start===================**/
	
	//添加用药界面
	//显示界面
	public function addMedicle(){
	
		$this->display();
	
	}
	
	//拼音快速查找用药
	//从字典中获取数据
	//return json 二维数组
	public function quickFindMedicle(){
		if(IS_AJAX && empty(I('post.medicle'))){
			$search_str=I('post.desease');	
			$result=$this->DictionaryApi->PinYinSearch('medicinedictionary','md_name_pinying',$search_str);	
			$res=array();
			if($result && is_array($result)){
				$res['flag']=true;
				$res['msg']=$result;
			}else{
				$res['flag']=true;
				$res['msg']='';
			}
			$this->ajaxReturn($res);
		}else{
			die();
		}

	}
	
		
	
	//选定用药
	//将用药存在session中 session的ID可以发送到界面
	//返回的时候要携带该ID来获取存在session中的数据
	//该session中存的是一个数组
	public function choseConfirmMedicle(){

		if(IS_AJAX && !empty(I('post.mname'))){
			$dname=(string)I('post.mname');
			$result=array();
			if($this->DictionaryApi->existSelect('medicinedictionary','md_name',$mname)){
				$temp_id=uniqid();
				$temp_array['mname']=$mname;
				//存如一个session中
				session($temp_id,$temp_array);
				$result['uniqid']=$temp_id;
				$result['flag']=true;
				$result['msg']='OK';

			}else{
				$result['flag']=false;
				$result['msg']='没有该药';
			}
			$this->ajaxReturn($result);
		}else{
			die();
		}
	} 


	//获取用药时间界面
	//@param mname :药名
	//return html
	public function getDateMHtml(){
		if(IS_AJAX && !empty(I('post.mname'))){
			$this->assign('mname',I('post.mname'));
			$this->assign('flag',true);
			$this->display();
		
		}else{
		die();
		}	
	
	}
	
	
	//获取用药有没有效果界面
	//@param mname
	//return html
	public function getEffectMhtml(){

		if(IS_AJAX && !empty(I('post.mname')) ){
			$mname=I('post.mname');
			$this->assign('mname',$mname);
			$this->assign('flag',true);
			$this->display();

		}else{
			die();
		}

	}

	
	//获取用药是否有效
	//@param meffect yes/no
	//@param uniqid session索引
	//return json
	public function getEffectM(){

		if(IS_AJAX && !empty(I('post.meffect')) && !empty(I('post.uniqid'))){
			$uniqid=I('post.uniqid');
			$result=array();
			if(session('?'.$uniqid){
					$temp_array=session($uniqid);
					$meffect=I('post.meffect');
					$effect=0;
					switch($meffect){
	 					case 1 : 
							$effect='有效';
							break;
						case 2 :
							$effect='无效';
							break;
						//TODO:: 根据具体情况
						default:
							$effect=0;
					}
					$result['flag']=true;
					$result['msg']='OK';
					$this->ajaxReturn($result);
			}else{
				$result['falg']=false;
				$result['msg']='没有存在信息';
				$this->ajaxReturn($result);
			}
		}else{
			die();
		}
	}



	//获取用药有没有副作用界面
	//@param mname
	//return html
	public function getFeffectMhtml(){

		if(IS_AJAX && !empty(I('post.mname')) ){
			$mname=I('post.mname');
			$this->assign('mname',$mname);
			$this->assign('flag',true);
			$this->display();

		}else{
			die();
		}

	}


	//获取用药是否有副作用
	//@param mfeffect yes/no
	//@param mfeffectstr  副作用的说明
	//@param uniqid session索引
	//return json
	public function getFeffectM(){

		if(IS_AJAX && !empty(I('post.mfeffect'))  && !empty(I('post.mfeffectstr')) && !empty(I('post.uniqid'))){
			$uniqid=I('post.uniqid');
			$result=array();
			if(session('?'.$uniqid){
					$temp_array=session($uniqid);
					$temp_array['mfeffect']=I('post.meffect');
					$temp_array['mfeffectstr']=I('post.mfeffectstr');

					$result['flag']=true;
					$result['msg']='OK';
					$this->ajaxReturn($result);
			}else{
				$result['falg']=false;
				$result['msg']='没有存在信息';
				$this->ajaxReturn($result);
			}
		}else{
			die();
		}
	}

	//获取完成界面的按钮
	//return html 
	public function getDonMHtml(){
	
		if(IS_AJAX){
		
			$this->assign('flag',true);
			$this->display();
		}else{
		die();
		}
	
	}

	//添加用药完成按钮操作
	//return json
	public function addDoneM(){
		if(IS_AJAX && !empty(I('post.uniqid'))){
			$uniqid=I('post.uniqid');
			$temp_array=session($uniqid);
			//TODO::需要修改表结构在做
		
		}else{
		die();
		}
	
	}

	
	
	
	
	/***=========================添加用药 end===================**/

	/////////////////////////////////////////////////////////////// 
	/***=========================添加检查 C start===================**/
	
	
	//检查界面
	public function addCheck(){
	
		$this->display();
	
	}
	
	//拼音快速查找检查
	//根据检查字典获取数据
	//return 二维数组
	public function quickFindCheck(){
		if(IS_AJAX && empty(I('post.check'))){
			$search_str=I('post.check');	
			$result=$this->DictionaryApi->PinYinSearch('checksurgeytreatment','cst_pinying',$search_str);	
			$res=array();
			if($result && is_array($result)){
				$res['flag']=true;
				$res['msg']=$result;
			}else{
				$res['flag']=true;
				$res['msg']='';
			}
			$this->ajaxReturn($res);
		}else{
			die();
		}
	
	}


	//选定检查项目
	//将检查项目放在session中 session的ID可以发送到界面
	//返回的时候要携带该ID来获取存在session中的数据
	//该session中存的是一个数组
	public function choseConfirmCheck(){

		if(IS_AJAX && !empty(I('post.cname'))){
			$cname=(string)I('post.cname');
			$result=array();
			if($this->DictionaryApi->existSelect('checksurgeytreatment','cst_name',$cname)){
				$temp_id=uniqid();
				$temp_array['cname']=$cname;
				//存如一个session中
				session($temp_id,$temp_array);
				$result['uniqid']=$temp_id;
				$result['flag']=true;
				$result['msg']='OK';

			}else{
				$result['flag']=false;
				$result['msg']='没有该检查';
			}
			$this->ajaxReturn($result);
		}else{
			die();
		}
	} 


	//获取检查值界面
	//return html
	public function getCheckValueHtml(){
		if(IS_AJAX && !empty(I('post.cname'))){
			$this->assign('flag',true);
			$this->assign('cname',I('post.cname'));

			$this->display();
		
		}else{
			die();
		}
	
	
	}


	//完成按钮操作
	//return json
	public function addDoneCheck(){
	
		if(IS_AJAX && !empty(I('post.uniqid')) && !empty(I('post.cvalue'))){
		
			$uniqid=I('post.uniqid');
			$cvalue=I('post.cvalue');

			$temp_array=session($uniqid);
			//TODO::修改好表后在再做
		}else{
			die();
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	/***=========================添加检查 end===================**/









}



?>
