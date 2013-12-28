<?php

	class IndexAction extends Action{

		/* 显示后台初始页面*/
		public function index(){
			$this->display('', $date);
		}
		public function top_view(){
			$this->display('top_frame');
		}
		public function left_view(){
			$this->display('left_frame');
		}
		public function right_view(){
			$this->display('right_frame');
		}
		public function toggle_view(){
			$this->display('toggle_frame');
		}

	}
?>