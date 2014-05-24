
/**================================js工具函数库==============================**/

var jshelper={


	//将数据转换为json格式
	//@param input_data  需要转化的数据 必须是关联数组
	//return json格式data
	tojson:function(input_data){
	  var json_data={}; 
		for(key in input_data){
			json_data[key]=input_data[key];	
		}
		return json_data;
	},

	




	//弹出对话框alert
	//@param message: 格式：string
	//无返回值 void
	show_message:function(message){
				 
				 
		return ;		 
	},

	//跳转
	//@param url : 格式：string
	redirect:function(url){
		if(typeof(url)!="string"){
			return false;
		}
		window.location.href=url;
	 }





}
