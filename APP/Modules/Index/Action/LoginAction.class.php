<?php

	class LoginAction extends Action{
       
        /**
		*前台登录
		*/
		public function login(){
			$this->display();
		}

        /**
		*注册
		*/
		public function register(){
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
		*登录验证
		*/
		public function chk_login(){
		    $loginname=I("name","","htmlspecialchars");
		    $loginpwd=I("pwd","","MD5");
        	$db   = M('users');
			$user = $db->where(array('user_name' =>$loginname))->field('user_id,user_name,password')->limit(1)->select();
			if(!$user || $user[0]['password'] !=$loginpwd){
				echo "0";
			}else{
				echo "1";
			}
		}
		/**
		*用户登录
		*/
        public function userlogin(){
           if(!IS_POST){
           	$this->error('页面不存在');
           }
        	$db   = M('users');
			$user = $db->where(array('user_name' => I('loginname')))->field('user_id,user_name,password,last_login')->limit(1)->select();
				session("userid",$user[0]['user_id']);
	               $codition=array(
	               'user_id'=>$user[0]['user_id']
				);
				$data=array(
					'last_login'=>time()
				);
				$db->where($codition)->setField($data);
	        	$this->redirect(GROUP_NAME.'/Index/index');

			// }
			
        } 
        
        /**
		*注册处理,将用户注册信息插入到users和user_address表
		*/        
        public function user_register(){
        	if(!IS_POST) halt('页面不存在');
        	$full_name=I("full_name","","htmlspecialchars");
        	$email=I("mail","","htmlspecialchars");
            $username=I("username","","htmlspecialchars");
            $mobile=I("mobile","","htmlspecialchars");
            $pwd=I("pwd","","htmlspecialchars");
            $address=I("address","","htmlspecialchars");
            
            $User=M('users');

            $data['email']=$email;
            $data['user_name']=$username;
            $data['password']=MD5($pwd);
            $data['last_login']= time();
            $data['mobile_phone']=$mobile;
            $uid=$User->add($data);

            $U_address=M('user_address');
            $data2['consignee']=$full_name;
            $data2['user_id']=$uid;
            // $data2['consignee']=$username;
            $data2['address']=$address;
            $data2['email']=$email;
            $data2['mobile']=$mobile;
            $addressid=$U_address->add($data2);

            if($uid && $addressid){
            	echo "注册成功";
            }else{
            	echo"注册失败";
            }

        }

        /**
		*注册时验证用户是否已存在
		*/
        public function chk_user(){
           $username=I("name","","htmlspecialchars");
           $db = M('users');
           $user = $db->where(array('user_name' =>$username))->select();
           if($user){
           	   echo "0";
           }else{
           	echo "1";
           }
           // $this->display();
        }
        /**
		*注册验证码处理
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
        public function aaa(){}
		
		/**
		*登陆表单处理
		*/
		// public function loginProcess(){
		// 	if(!IS_POST){
		// 		$this->error('页面不存在');
		// 	}
		// 	if(I('code')!=session('checkpic')){
		// 		$this->error('验证码错误');
		// 	}

		// 	$db   = M('user');
		// 	$user = $db->where(array('username' => I('username')))->field('uid,password,lastTime')->limit(1)->select();
		// 	if(!$user || $user[0]['password'] != I('password','','md5')){
		// 		$this->error('账号或密码错误');
		// 	}
		// 	session('lastTime',date("Y-m-d H:i"),$user[0]['lastTime']);
		// 	$data = array(
		// 		'uid'        => $user[0]['uid'],
		// 		'lastTime' => time(),
		// 		'status'	=>1
		// 		);
		// 	$db->save($data);
		// 	session('uid',$user[0]['uid']);
		// 	session('logintime',date("Y-m-d H:i"),time());
		// 	session('code',null);
		// 	redirect(__GROUP__);
		// }
	}
?>