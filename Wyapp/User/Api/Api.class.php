<?php
	/**************接口********/
	//用户api
	//所有接口都必须继承该抽象类

namespace User\Api;


abstract class Api{





	//模型
	protected $model;

	//构造函数
	public function __construct(){
	
		self::_init();
	}



	//初始化操作
	abstract protected _init();
	
	





}










?>
