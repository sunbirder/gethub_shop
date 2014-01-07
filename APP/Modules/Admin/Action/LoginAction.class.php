<?php 
 Class LoginAction extends Action{
    /**
	*后台登录
	*/
 	public function login(){
        $this->display();
 	}
    /**
	*生成验证码图片
	*/
 	public function check(){
 		import("Class.Check",APP_PATH);
		$check=new Check(110,35,'./Data/Fonts/comicz.ttf');
 
	 	echo  $check->output();
 	}
    
    /**
	*后台登录验证
	*/
 	public function check_Login(){
 		if(!IS_POST){
 			$this->error('页面不存在');
 		}
         
 		$db=M('admin_user');
 		$condition['user_name']=I('username','','htmlspecialchars');
 		$user=$db->where($condition)->field('user_id,user_name,password')->limit(1)->select();
 		if(!$user||$user[0]['password']!=I('password','','MD5')){
 			$this->error("账号或密码错误");
 			// alert("aaa");
 		}else{
 			session("admin_id",$user[0]['user_id']);
 			$condition=array(
               'user_id'=>$user[0]['user_id']
 			);
 			$data=array(
               'last_login'=>time()
 			);
 			$db->where($condition)->setField($data);
 			$this->redirect(GROUP_NAME.'/Index/index');

 		}

 	}


 	/**
	*验证码验证
	*/
    public function chk_code(){
        $code=session('checkpic');
        $user_code=I("code","","htmlspecialchars");
        
        if($code==$user_code){
        	echo '1';
        }else{
        	echo'0';
        }
    }
    


 }
 ?>