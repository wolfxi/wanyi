<?php
/**============================================仅仅发送邮件===========================**/
namespace User\Api;
use User\Api\Api;

class SendemailApi extends Api{

	//构造器
	//初始化发送邮件的一些设置
	public function _init(){

		Vendor('PhpEmail.PHPMailerAutoload');//引入phpemail类库

		//获取配置信息
		$email_setting=C('EMAIL_SETTING');


		$this->model=new PHPMailer();


		$this->isSMTP();


		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$this->model->SMTPDebug = $email_setting['STMPDebug'];


		//Ask for HTML-friendly debug output
		$this->model->Debugoutput = $email_setting['Debugoutput'];


		//Set the hostname of the mail server
		$this->model->Host = $email_setting['Host'];

		//Set the SMTP port number - likely to be 25, 465 or 587
		$this->model->Port = $email_setting['Port'];

		//Whether to use SMTP authentication
		$this->model->SMTPAuth =$email_setting['SMTPAuth'];


		//Username to use for SMTP authentication
		$this->model->Username =$email_setting['Username'];

		//Password to use for SMTP authentication
		$this->model->Password =$email_setting['Password'];


		//Set who the message is to be sent from
		$this->model->setFrom($email_setting['From_account'],$email_setting['From_name'] );

		//Set an alternative reply-to address
		$this->model->addReplyTo($email_setting['Reply_account'],$email_setting['Reply_name']);




	}



	//发送邮件
	/*共系统和用户发送邮件
	  @param $array 数组最少4个元素 
	  $array['faccount']:发送者的邮箱
	  $array['fname']:发送者的称呼
	  $array['aaccount']:接受者的邮箱
	  $array['aname']:接受者的姓名
	  $array['subject']:邮件的主题
	  $array['body']:邮件的内容
	  返回值：
	  return boolean     true/false(成功/失败) 
	  
	*/
	public function send($array){
		if(count($array)>4){
			//用户发送
			$this->model->setFrom($array['faccount'],$array['fname']);

			$this->model->addReplyTo($array['faccount'],$array['fname']);

		}
		$this->model->addAddress($array['aaccount'],$array['aname']);
		$this->model->Subject=$array['subject'];
		$this->model->AltBody=$array['body'];

		if($this->model->send()){
			return true;	
		}else{
			return false;
		}

	}


}






?>
