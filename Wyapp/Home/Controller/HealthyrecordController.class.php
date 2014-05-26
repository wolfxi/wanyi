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


	/***=========================添加疾病 start===================**/


	//拼音快速查找
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















	/***=========================添加疾病 end===================**/

	///////////////////////////////////////////////////////////////

	/***=========================添加用药 start===================**/
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/***=========================添加用药 end===================**/

	///////////////////////////////////////////////////////////////

	/***=========================添加检查 start===================**/
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/***=========================添加检查 end===================**/









}



?>
