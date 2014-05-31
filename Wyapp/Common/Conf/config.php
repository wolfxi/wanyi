<?php
return array(
		//'配置项'=>'配置值'




		/*加载全局函数库*/
		'LOAD_EXT_FILE'		=>'gloabl.func',

		/* 数据库设置 */
		'DB_TYPE'               =>  'mysqli',     // 数据库类型
		'DB_HOST'               =>  'localhost', // 服务器地址
		'DB_NAME'               =>  'wydb',          // 数据库名
		'DB_USER'               =>  'root',      // 用户名
		'DB_PWD'                =>  'wolf',          // 密码
		'DB_PORT'               =>  '3306',        // 端口
		'DB_PREFIX'             =>  '',    // 数据库表前缀
		'DB_FIELDTYPE_CHECK'    =>  false,       // 是否进行字段类型检查
		'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
		'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8

		/*可以访问的模块*/
		'MODULE_ALLOW_LIST'		=> array('Home','Admin'),
		'MODULE_DENY_LIST'		=>array('Common','Runtime','User'),



		/*模板引擎设置*/
		'TAGLIB_BEGIN'          =>  '<%',  // 标签库标签开始标记
		'TAGLIB_END'            =>  '%>',  // 标签库标签结束标记

		'TMPL_L_DELIM'          =>  '<{',            // 模板引擎普通标签开始标记
		'TMPL_R_DELIM'          =>  '}>',            // 模板引擎普通标签结束标记



		









			/* URL设置 */
			'URL_CASE_INSENSITIVE'  =>  true,   // 默认false 表示URL区分大小写 true则表示不区分大小写

			'URL_MODEL'				=>	2  ,     //采用重写机制



			/***邮件配置***/
			'EMAIL_SETTING'=>array(

					//stmp debug
					'STMPDebug'=>2,//0 = off(for production use) 1 = client messages 2 = client and server message

					'Debugoutput'=>'html',

					//hostname of email server
					'Host'=>'imap.qq.com',

					//port number 
					'Port'=>143,

					'SMTPAuth'=>true,

					//send username
					'Username'=>'1150665265@qq.com',

					//send username password
					'Password'=>'nebs1992fmxWJ',

					//from who email
					'From_account'=>'发送者帐号',

					//from who name 
					'From_name'=>'发送者',


					//回复给谁
					'Reply_account'=>'回复接受邮件帐号',

					//回复 接受者姓名
					'Reply_name'=>'回复接受者的姓名'

					)




		);
