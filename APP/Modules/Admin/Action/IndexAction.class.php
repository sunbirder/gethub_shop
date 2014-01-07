<?php 
class IndexAction extends CommonAction{
	
       
	    /* 显示后台初始页面*/
		public function index(){
			$this->display('Index/index');
		}
		public function top_view(){
			$this->display('Index/top_frame');
		}
		public function left_view(){
			$this->display('Index/left_frame');
		}
		public function right_view(){
			$this->display('Index/right_frame');
		}
		public function toggle_view(){
			$this->display('Index/toggle_frame');
		}
}
 ?>