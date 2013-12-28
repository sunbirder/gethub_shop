<?php

	class LoginAction extends Action{

		public function index(){
			$this->display();
		}

		/**
		*生成验证码图片
		*/
		// public function check(){
		// 	import("Class.Check",APP_PATH);
		// 	$check=new Check(110,35,'./Data/Fonts/comicz.ttf');
	 	// 		echo  $check->output();
		// }

		
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