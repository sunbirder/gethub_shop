<?php
	session_start();
	header("Content-Type:text/html;charset=utf-8");
	/*
	 *checkclass
	 *验证码类
	 */
	class Check
	{
		//private $charset = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789';
		private $check;//验证码
		private $checklen=4;//验证码长度
		private $width;//图片宽度
		private $height;//图片高度
		private $img;//图片资源
		private $font;//字体
		/*
		 *构造函数__construct($w,$h,$f)
		 *初始化方法时提供背景图片的宽度，高度，以及字体路径
		 */
		function __construct($w,$h,$f)
		{
			$this->width=$w;
			$this->height=$h;
			$this->font=$f;
		}
		/*
		*create_bg()
		*生成背景图片
		*/
		private function create_bg()
		{
			$this->img=imagecreatetruecolor($this->width,$this->height);
			$bgcolor=imagecolorallocate($this->img,rand(0,255),rand(0,255),rand(0,255));
		}
		/*
		 *create_check()
		 *生成随机验证码
		 */
		private function create_check()
		{
			//使用纯数字
			$a=rand(0,9);
			$b=rand(0,9);
			$c=rand(0,9);
			$d=rand(0,9);
			$this->check=$a.$b.$c.$d;
			session('checkpic',$this->check);
			$rand_colour1=imagecolorallocate($this->img,rand(0,255),rand(0,255),rand(0,255));
			$rand_colour2=imagecolorallocate($this->img,rand(0,255),rand(0,255),rand(0,255));
			$rand_colour3=imagecolorallocate($this->img,rand(0,255),rand(0,255),rand(0,255));
			$rand_colour4=imagecolorallocate($this->img,rand(0,255),rand(0,255),rand(0,255));
			imagettftext($this->img,rand($this->width*0.10,$this->width*0.18),rand(-45,45),rand($this->width*0.1,$this->width*0.15),rand($this->height*0.5,$this->height*0.8),$rand_colour1,$this->font,$a);
			imagettftext($this->img,rand($this->width*0.10,$this->width*0.18),rand(-45,45),rand($this->width*0.3,$this->width*0.35),rand($this->height*0.5,$this->height*0.8),$rand_colour1,$this->font,$b);
			imagettftext($this->img,rand($this->width*0.10,$this->width*0.18),rand(-45,45),rand($this->width*0.5,$this->width*0.55),rand($this->height*0.5,$this->height*0.8),$rand_colour3,$this->font,$c);
			imagettftext($this->img,rand($this->width*0.10,$this->width*0.18),rand(-45,45),rand($this->width*0.7,$this->width*0.75),rand($this->height*0.5,$this->height*0.8),$rand_colour4,$this->font,$d);
		}

		/*
		 *create_pix_line()
		 *生成线条和噪点干扰
		 */
		private function create_pix_line()
		{
			//生成干扰线条
			for($i=0;$i<$this->width*0.02;$i++)
			{
				$line_color=imagecolorallocate($this->img,rand(0,255),rand(0,255),rand(0,255));
				imageline($this->img,rand(0,$this->width),rand(0,$this->height),rand(0,$this->width),rand(0,$this->height),$line_color);
			}
			//生成干扰噪点
			$pix_color=imagecolorallocate($this->img,rand(0,255),rand(0,255),rand(0,255));
			for($i=0;$i<$this->width*0.5;$i++)
			{
				imagesetpixel($this->img,rand(0,$this->width),rand(0,$this->height),$pix_color);
			}
		}

		/*
		 *create_img()
		 *创建图片
		 */
		private function create_img()
		{
			header('Content-Type:image/jpeg');
			imagejpeg($this->img);
			imagedestroy($this->img);
		}

		/*
		 *output()
		 *对外输出图片
		 */
		public function output()
		{
			$this->create_bg();
			$this->create_check();
			$this->create_pix_line();
			$this->create_img();
		}
	}
	/*
	*创建对象并输出
	*/
	 // $check=new checkclass(110,40,'./Fonts/comicz.ttf');
	 // return $check->output();
?>