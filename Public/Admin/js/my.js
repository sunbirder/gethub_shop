$(function(){
    var result=1;
    $("#login_button").click(function(){
    var username=$("#username").val(); 
    var password=$("#password").val();
    var capital=$("#capital").val();
      if(username==''){
         $("#username").addClass('border_line');
         $("#username").parent().next().children("span").css({"display":"inline-block"});
         result=0;
      }
       if(password==''){
         $("#password").addClass('border_line');
         $("#password").parent().next().children("span").css({"display":"inline-block"});
         result=0;
      }
      if(capital==''){
        $("#capital").addClass('border_line');
        $("#capital").parent().next().children("span").css({"display":"inline-block"})
        result=0;
      }
      // ajax用户名密码提交
      // $.post("{:U(GROUP_NAME.'Login/check_Login')}",{name:username,pwd:password},function(msg){
          
      // })
      //ajax验证码提交
      $.post("{:U(GROUP_NAME.'/Login/chk_code')}",{code:capital},function(msg){
          if(msg==1){
            $("#capital").removeClass('border_line');
            $("#capital").parent().next().children("span").css({"display":"none"});
            if(result==1){
              $("#admin_login").submit();
            }   
          }else{
            $("#capital").addClass('border_line');
            $("#capital").parent().next().children("span").css({"display":"inline-block"})
          }
      })

    });
    $("#username,#password,#capital").focus(function(){
       $(this).removeClass('border_line');
      $(this).parent().next().children("span").css({"display":"none"});
    })
       
    
  })