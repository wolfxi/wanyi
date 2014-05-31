<?php
namespace Admin\Controller;
use Think\Controller;

class IndexController extends Controller{

    //login 登录
    public function index(){
        $this->display("index");
    }



    //ajax 请求验证是否存在用户名
    public function check_account(){
        if(IS_AJAX){
            $account=I("post.account");
            if(empty($account)){
                $data['flag']=false;
                $data['msg']="请填写账号";
                $this->ajaxReturn($data);
            }else{
                $adminmodel=M('administrator');
                trace($adminmodel);
                $result=$adminmodel->where("a_account='%s'",$account)->getField("a_account");
                if($result && !empty($result)){
                    $data['flag']=true;
					$data['msg']='OK';
                    $this->ajaxReturn($data);
                }else{
                    $data['flag']=true;
                    $data['msg']="账号不存在";
                    $this->ajaxReturn($data);
                }   
            }
        }else{
            exit();
        }
    }


    //ajax 请求   验证 验证码是否正确
    public function check_verify(){
        if(IS_AJAX){
            $verifystring=I("post.verify_code");
            if(empty($verifystring)){
                $data['flag']=true;
                $data['message']="请填写验证码";
                $this->ajaxReturn($data);
            }else{
                $flag=$this->check_verify_code($verifystring);
                if($flag){
                    $data['flag']=true;
                    $this->ajaxReturn($data);
                }else{
                    $data['flag']=true;
                    $data['message']="验证码错误！";
                    $this->ajaxReturn($data);
                }   
            }
        }else{
            exit();
        }
    }


    //验证登录
    public function loging(){
        if(IS_AJAX){
            $useraccount=I("post.useraccount");
            $userpassword=I("post.password");
            $verify_code=I("post.verify_text");
            if(empty($useraccount) || empty($userpassword) || empty($verify_code)){
                $data['flag']=true;
                $data['message']="请填完整信息！！！";
                $this->ajaxReturn($data);
            }else{
                    $adminmodel=M("administrator");
                    $result=$adminmodel->where("a_account='%s' AND a_password='%s'",$useraccount,md5($userpassword))->find();
                    if(is_array($result) && $result){
                        session(null);//如果验证就清除session中的验证码
                        session("ADMIN_INFO",$result);
                        //修改管理员登录信息
                        $clint_ip=get_client_ip();
                        $data['a_last_login_ip']=$clint_ip;
                        $data['a_last_login_time']=date("Y-m-d :H:i:s");
                        $data['a_login_time']=$result['a_login_time']+1;
                        $flag1=$adminmodel->where("a_id=%d",$result['a_id'])->save($data);
                        //返回信息
                        $data1['flag']=true;
                        $data1['url']=U('Admin/Index/main');
                        $data1['message']="登录成功";
                        $this->ajaxReturn($data1);
                    }else{
                        $data['flag']=true;
                        $data['message']="密码或账号错误！！！";
                        $this->ajaxReturn($data);
                    }
            }
        }else{
            exit();
        }
    }




    //主界面
    public function main(){
        if(session('?ADMIN_INFO')){
            $this->display();
        }else{
            $this->index();
        }
        
    }


    //生成验证码
    public function create_verify(){
        $Verify = new \Think\Verify();
        $Verify->length=4;
        $Verify->expire=60;
        $Verify->useImgBg = true;
        $Verify->useNoise = false;
        $Verify->entry();
    }

    private function check_verify_code($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }


	
	/*
    //验证锁屏
    public function lock_check(){
            $useraccount=I("post.useraccount");
            $userpassword=I("post.password");
            if(empty($useraccount) || empty($userpassword)){
                $this->error("请输入秘密！！！");
            }else{
                    $adminmodel=M("Admin");
                    $result=$adminmodel->where("a_account='%s' AND a_password='%s'",$useraccount,md5($userpassword))->find();
                    if(is_array($result) && $result){
                        session("landadmin",$result);
                        $this->redirect('main');
                    }else{
                       $this->error("解锁失败！！！");
                    }
               
            }
    }*/

    public function exitsystem(){
        session(null);
        $this->redirect('index');
    }

    public function home(){
        $this->redirect('main');
    }

}







?>
