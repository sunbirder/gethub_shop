<?php 

  class UserAction extends CommonAction{

  	/*
    *会员列表显示
    */
    public function user_list(){
      	$db=M('users');
		import('ORG.Util.Page');// 导入分页类
		$field='users.user_id,users.email,user_name,mobile_phone,user_money,pay_points,address.consignee,address';
		$count=$db->table('ecs_users users,ecs_user_address address')->where('users.user_id=address.user_id')->count();
		$Page= new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录
		$show= $Page->show();// 分页显示输出
		$list=$db->table('ecs_users users,ecs_user_address address')->where('users.user_id=address.user_id')->field($field)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
		$this->assign('show',$show);// 赋值分页输出
		$this->display(); // 输出模板
    }
    
    /*
    *会员搜索
    */
    public function user_search(){
        $gt_point=I('pay_points_gt','','htmlspecialchars');
        $lt_point=I('pay_points_lt','','htmlspecialchars');
        $u_name=I('keyword','','htmlspecialchars');
        // echo $u_name;
        if($gt_point!=''){
        	$condition['pay_points']=array('gt',$gt_point);
        }
        if($lt_point!=''){
        	$condition['pay_points']=array('lt',$lt_point);  	 
        }
        if($gt_point!='' && $lt_point!=''){
        	$condition['pay_points']=array(array('gt',$gt_point),array('lt',$lt_point));
        }
        if($u_name!=''){
        	// $condition['address.consignee']=$u_name;
            $condition['address.consignee']=array('like','%'.$u_name.'%');

        }

        $db=M('users');
		import('ORG.Util.Page');
		$field='users.user_id,users.email,user_name,mobile_phone,user_money,pay_points,address.consignee,address';
		if($condition){
		  $count=$db->table('ecs_users users,ecs_user_address address')->where('users.user_id=address.user_id')->where($condition)->field($field)->count();
		}else{
		  $count=$db->table('ecs_users users,ecs_user_address address')->where('users.user_id=address.user_id')->field($field)->count();
		}
		$Page= new Page($count,10);
		$show= $Page->show();
		if($condition){
		  $list=$db->table('ecs_users users,ecs_user_address address')->where('users.user_id=address.user_id')->where($condition)->field($field)->limit($Page->firstRow.','.$Page->listRows)->select(); 
		}else{
		  $list=$db->table('ecs_users users,ecs_user_address address')->where('users.user_id=address.user_id')->field($field)->limit($Page->firstRow.','.$Page->listRows)->select(); 		
		}
        $this->assign('list',$list);
		$this->assign('show',$show);
		$this->display("user_list");


    }

    /*
    *会员信息修改
    */
    public function alert_user(){
       $user_id=I('user_id');
       $condition['users.user_id']=$user_id;
       $db=M('users');
	   $field='users.user_id,users.email,user_name,mobile_phone,user_money,pay_points,address.consignee,address';
       $arr=$db->table('ecs_users users,ecs_user_address address')->where('users.user_id=address.user_id')->where($condition)->field($field)->limit(1)->select();
       $this->assign("data",$arr);
       $this->display();
    }
    
    /*
    *会员信息修改提交处理
    */
     
     public function alert_user_submit(){
        $user_id=I('user_id','','htmlspecialchars');
     	$user_sn=I('user_sn','','htmlspecialchars');
     	$user_name=I('user_name','','htmlspecialchars');
     	$user_email=I('user_email','','htmlspecialchars');
     	$user_phone=I('user_phone','','htmlspecialchars');
     	$user_address=I('user_address','','htmlspecialchars');
     	$user_money=I('user_money','','htmlspecialchars');
     	$user_point=I('user_point','','htmlspecialchars');
     	// echo  $user_point;
        
        $db1=M('users');
     	$condition1['user_id']=$user_id;
     	$data1['email']=$user_email;
     	$data1['pay_points']=$user_point;
     	$data1['user_money']=$user_money;
     	$data1['mobile_phone']=$user_phone;
     	$count1=$db1->where($condition1)->save($data1);
         // echo $count1;
        // if($count1 >= 0){
        // 		$this->success("修改成功");
        	// $db2=M('user_address');
     	   //  $condition2['user_id']=$user_id;
         //    $data2['consignee']=$user_name;
         //    $data2['email']=$user_email;
         //    $data2['mobile']=$user_phone;
         //    $count2=$db2->where($condition2)->save($data2);
         //    if($count2>0){
         //    	$this->success("修改成功");
         //    }else{
         //    	$this->error("修改失败");
         //    }

        // }else{
        // 	$this->error("修改失败");
        // }

        $db2=M('user_address');
     	$condition2['user_id']=$user_id;
        $data2['consignee']=$user_name;
        $data2['email']=$user_email;
        $data2['mobile']=$user_phone;
        $data2['address']=$user_address;
        $count2=$db2->where($condition2)->save($data2);
        if($count1>0 || $count2>0){
        	$this->success("修改成功");
        }else{
            	$this->error("修改失败");
        }


     }

     public function delete_user(){
        $user_id=I("userid");
        // echo var_dump($user_id);
        $db1=M('users');
        $db2=M('user_address');
        $total=count($user_id);
        // echo $total;
        $num=0;
        foreach($user_id as $value){
            $data['user_id']=$value;
           $result1=$db1->where($data)->delete();
           $result2=$db2->where($data)->delete();
            if($result1 && $result2){
                ++$num;
            }
            // echo $result1."+++++++".$result2;
          
        }
        // echo $num."++++++".$total;
        if($num==$total){
            echo "1";
        }else{
            echo "0";
        }
        // $this->display();
     }

  
}

 ?>