<?php
/*=================================字典API=============================*/
//主要用于更新数据库字典和数据库字典快速查询


namespace User\Api;
use User\Api\Api;
use User\Api\PinyinApi;


class DictionaryApi extends Api{

	private $pin_yin_api=null;


	//构造函数 
	//初始化一个空类
	public function _init(){
	
	
		$this->model=M();
		$this->pin_yin_api=new PinyinApi();
	
	} 



	//更新字典表
	//@param table :要更新的表名
	//@param ffield: 根据哪个字段来更新
	//@param id :更新表的主键
	//@param tfield :要更新那个字段
	public function updateDictionary($table,$id,$ffield,$tfield){
	
		$result=$this->model->table($table)->select();

		if(is_array($result) && count($result)>0){
			
			//开启事物
			$this->model->startTrans();

			foreach($result as $one){

				//转化称拼音首字母
				$temp_str=$this->pin_yin_api->pinyin_long($one[$ffield]);

				$flag=$this->model->table($table)->where([$id]."=%d",$one[$id])->setField($tfield,$temp_str);

				if($flag){
					continue ;
				}else{

					$this->model->rollback();
					return false;
				}
			}
			$this->model->commit();
			return true;
		}else{
			return true;
		}
	}


	//快速查询
	//@param table :要更新的表名
	//@param field: 根据哪个字段来获取数据
	//@param search_str:  查询过滤的条件
	//return array 二维数组
	public function PinYinSelect($table,$field,$search_str){

		$result=$this->model->table($table)->where($field." LIKE ",'%'.$search_str.'%')->select();

		if(is_array($result) && count($result)){
			return $result;
		}else{
			return null;
		}



	}











}






?>
