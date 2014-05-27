/**======================ajax===============================**/
//所有数据格式：json


var ajaxhelper={

	/**
	  主要用户提交表单,返回的数据为json格式
	  @param data :格式：json,发送的数据
	  @param urlstr:  格式:string;请求地址
	  @param callback_function :格式：string; 回调函数
	  返回数据中必须包含flag=>value(ture/false)数据
	**/
	post:function(data,urlstr,callback_funtion){
			$.ajax({
				url:urlstr,
				data:data,
				type:'POST',
				datatype:'json',
				success:function(message){
					var flag=$(message).flag;
					if(flag=='true' && typeof(callback_function)!='undefind'){
						callback_function(message);
						return false;
					}else{
						this.show_wrong(message);
						return false;
					}
				}
			}) 
	 },



	/**
	  主要用于更新数据，替换界面元素，返回html构件，
	  @param data :格式：json,发送的数据
	  @param urlstr:  格式:string;请求地址
	  @param callback_function :格式：string; 回调函数
	  @param replace_element :格式：string(id:#element_id,class:.classname) 需要替换的元素 
	  返回数据中必须包含<div id="flag">value(ture/flase)</div>数据
	  re标签
	**/
	replace:function(data,urlstr,callback_function,replace_element){ 
		$.ajax({
				url:urlstr,
				data:data,
				type:"post",
				datatype:"json",
				success:function(message){

					var flag=$.trim($(message).children("#flag").text());
				
					if(flag=='true'){
					
						if(typeof(callback_function)!='undefind'){
						
							callback_function(message);
							return ;
						}else{
							//TODO::自动替换---->调用本身的方法
							var element=$.trim($(message).children("res").html());
							$("'"+replace_element+"'").empty().append(element);
						}
					}else{
					
						this.show_wrong(message);
						return ;
					}
				}
		})	
	},

	

	/**
	  主要用于失败处理，ajax发送成功，但返回标志为错误，flag=>false;
	  @param data :格式：json/html 包含错误信息
	  弹窗显示错误信息
	**/
	show_wrong:function(message){
			   var error="";
			   if(typeof($(message).flag)!="undefined"){//json格式数据
				   error=$(message).msg;
			   }else{//html格式数据
				   error=$.trim($(message).children("#result").text());
			   }

			   //TODO:：到时侯换成dialog
			   window.alert(error);

			   return ;
			   
			   
	}





}
