<?php

	class IndexAction extends Action{

		public function index(){

			$this->assign('cat_hd_display',true);
			$this->display('', $date);
		}
		/**
		*退出登陆
		*/
		// public function quit(){
		// 	$db  = M('user');
		// 	$data = array(
		// 		'uid'        => session('uid'),
		// 		'status'	=>0
		// 		);
		// 	$db->save($data);
		// 	session_unset();
		// 	session_destroy();
		// 	$this->redirect(GROUP_NAME.'/Login/index');
		// }
	}
?>