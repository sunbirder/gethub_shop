<?php
import('TagLib');
	Class TagLibHd extends TagLib{
		protected $tags = array(
			'nav_top' => array('attr'=>'order,limit', 'close'=>1), 

			);

		public function _nav_top($attr, $content){
			$tag = $this->parseXmlAttr($attr, 'nav_top');
			$str = <<<str
<?php
	\$nav_top_date = M('nav')->field('id,name,url,opennew')->where("type='top' AND ifshow=1")->order('vieworder')->select();
	foreach (\$nav_top_date as \$date):
?>
str;
	$str .= $content;
	$str .= '<?php endforeach; ?>';
	return $str;

		}


	}
