<?php 
class OrderAction extends CommonAction{
    /*
    *订单列表显示
    */
	public function order_list(){
		$db=M('order_info');
		import('ORG.Util.Page');// 导入分页类
		$field='order_sn,add_time,address.consignee,goods_amount,order_amount,order_status,shipping_status,pay_status';
		$count=$db->table('ecs_order_info info,ecs_user_address address')->where('info.user_id=address.user_id')->count();
		$Page= new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录
		$show= $Page->show();// 分页显示输出
		$list=$db->table('ecs_order_info info,ecs_user_address address')->where('info.user_id=address.user_id')->field($field)->limit($Page->firstRow.','.$Page->listRows)->order('add_time DESC')->select();
        $this->assign('list',$list);// 赋值数据集
		$this->assign('show',$show);// 赋值分页输出
		$this->display(); // 输出模板
	}
    
    /*
    *订单搜索
    */
	public function order_select(){
		$order_sn=I("order_sn","","htmlspecialchars");
		$consignee=I("consignee","","htmlspecialchars");
		$status=I("status");
		if($order_sn!=''){
			// $condition['order_sn']=$order_sn;
            $condition['order_sn']=array('like','%'.$order_sn.'%');
		}
		if($consignee!=''){
            // $condition['address.consignee']=$consignee;
            $condition['address.consignee']=array('like','%'.$consignee.'%');

		}     
        switch($status){
        	case '1':
        	      $condition['order_status']="0";
        	      break;
        	case '2':
        	      $condition['order_status']="1";
        	      break;
        	case '3':
        	      $condition['order_status']="3";
        	      break;
        	case '4':
        	      $condition['pay_status']="0";
        	      break;
        	case '5':
        	      $condition['pay_status']="2";
        	      break;
        	case '6':
        	      $condition['shipping_status']="0";
        	      break;
        	case '7':
        	      $condition['shipping_status']="1";
        	      break;
        	case '8':
        	      $condition['shipping_status']="2";
        	      break;
        	case '9':
        	      $condition['shipping_status']="3";
        	      break;
        	case '10':
        	      $conditon['order_status']="2";
        	      break;
        	 default:
        	      break;
        }

		$db=M('order_info');
		import('ORG.Util.Page');
		//查询字段
		$field='order_sn,add_time,address.consignee,goods_amount,order_amount,order_status,shipping_status,pay_status';
		//获取满足条件总数据条数
		if($condition){
		  $count=$db->table('ecs_order_info info,ecs_user_address address')->where('info.user_id=address.user_id')->where($condition)->field($field)->count();	
		}else{
		  $count=$db->table('ecs_order_info info,ecs_user_address address')->where('info.user_id=address.user_id')->field($field)->count();
		}
		$Page= new Page($count,10);
		$show= $Page->show();
		//获取满足条件的数据
		if($condition){
		  $list=$db->table('ecs_order_info info,ecs_user_address address')->where('info.user_id=address.user_id')->where($condition)->field($field)->limit($Page->firstRow.','.$Page->listRows)->order('add_time DESC')->select();			
		}else{
		  $list=$db->table('ecs_order_info info,ecs_user_address address')->where('info.user_id=address.user_id')->field($field)->limit($Page->firstRow.','.$Page->listRows)->order('add_time DESC')->select();			
		}
        $this->assign('list',$list);
		$this->assign('show',$show);
		$this->display("order_list");
	}
    
    /*
    *删除订单
    */
	public function delete_order(){
        $order_id=I("orderId");
        $db=M("order_info");
        $total=count($order_id);
        // echo dump($order_id);
        $num=0;
        foreach($order_id as $value){
         $data['order_sn']=$value;
         $db->where($data)->delete();
         ++$num;
        }
        
        if($num==$total){
          echo "1";
        }else{
          echo"0";
        }
	}
    
    /*
    *修改订单
    */
	public function alert_order(){
        $order_sn=I("order_id");
        $db=M("order_info");
        $field='order_sn,add_time,consignee,goods_amount,order_amount,order_status,shipping_status,pay_status';
        $data['order_sn']=$order_sn;
        $arr=$db->where($data)->field($field)->limit(1)->select();
        // dump($arr);
        $this->assign('data',$arr);
        $this->display();

	}

    /*
    *修改订单提交处理
    */

    public function alert_submit(){
        $order_sn=I('order_sn','','htmlspecialchars');
        $order_time=I('order_time','','htmlspecialchars');
        $consignee=I('consignee','','htmlspecialchars');
        $goods_amount=I('goods_amount','','htmlspecialchars');
        $order_amount=I('order_amount','','htmlspecialchars');
        $order_status=I('order_status','','htmlspecialchars');
        $pay_status=I('pay_status','','htmlspecialchars');
        $shipping_status=I('shipping_status','','htmlspecialchars');

        $db=M('order_info');
        $codition['order_sn']=$order_sn;
        $data['consignee']=$consignee;
        $data['goods_amount']=$goods_amount;
        $data['order_amount']=$order_amount;
        $data['order_status']=$order_status;
        $data['pay_status']=$pay_status;
        $data['shipping_status']=$shipping_status;      
        $count=$db->where($codition)->save($data);
        if($count>0){
            $this->success("修改成功");
        }else{
            $this->error("修改失败");
        }

    }
}


 ?>