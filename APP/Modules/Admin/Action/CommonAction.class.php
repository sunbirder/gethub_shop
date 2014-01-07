<?php 

class CommonAction extends Action{
	/*判断用户是否登录*/ 
	    public function _initialize(){
	    	if(!isset($_SESSION['admin_id'])||$_SESSION['admin_id']==''){
			  $this->redirect(GROUP_NAME.'/Login/login');
		    }
	    }
}
 ?>