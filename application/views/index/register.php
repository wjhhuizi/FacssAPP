<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--
Current Page Templete:
Copyright (c) 2017 by Brad Bodine (http://codepen.io/bbodine1/pen/hflzK)
-->
<html>
   <head>
      <meta charset="UTF-8">
      <title>注册 - Facss Local Help</title>
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/login.css">  
      <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   </head>

   <body>
      <div class="container">
         <section id="content">
             <form action="<?php echo base_url() ?>index.php/index/reg" method="post" id="form">
               <h1>Student Register</h1>
               <div>
                   <input type="text" placeholder="NetID (例如:abc123456)" required="" id="username" name="username"/>
               </div>
               <div>
                   <input type="password" placeholder="密码 (独立于NetID的密码,至少4位)" required="" id="password" name="password"/>
               </div>
               <div>
                   <input type="password" placeholder="再输入一次密码 (至少4位)" required="" id="password_confirm" name="password_confirm"/>
               </div>
               <div>
                   <input type="text" placeholder="您的邮箱 (最好是UTD邮箱)" required="" id="email" name="email"/>
               </div>
               <div>
                   <input type="submit" value="确认注册"/>
               </div>
            </form><!-- form -->
            
            <div class="button">
                <a href="<?php echo base_url() ?>index.php/index"><b>已经注册了？ 点此登录&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></a>
            </div>
            
         </section><!-- content -->
      </div><!-- container -->
   </body>
   
   <script>
       $(document).ready(function(){
           var vaildated = false;
          $('#form').submit(function(e){
              if(vaildated === false){
                e.preventDefault();
                console.log('submitted');
                var id_ptn = /^[a-zA-Z]{3}\d{6}$/;
                var ps_ptn = /^[\w\-\.\+@$#%]{4,20}$/;
                var em_ptn = /^[^\_][\w\-\.]+@[\w\.]+[\w]{2,3}$/;
                //var str = "";
                
              if((!(id_ptn.test($('#username').val())))){
                  $('#username').css('background', 'pink');
              }
              else if((!(ps_ptn.test($('#password').val())))){
                  $('#password').css('background', 'pink');
              }
              else if((!(em_ptn.test($('#email').val())))){
                  $('#email').css('background', 'pink');
              }
              else if($('#password').val() !== $('#password_confirm').val()){
                  console.log($('#password').val() + '   ' + $('#password_confirm').val());
                  $('#password_confirm').css('background', 'pink');
              }
              else{
                  vaildated= true;
                  $('#form').submit();
              }
            }
          }); 
<?php /*
            $('#password').focus(function(){
                $(this).css('background', 'White');
            });
            $('#password_confirm').focus(function(){
                $(this).css('background', 'White');
            });
            $('#password').blur(function(){
                $(this).css('background', '#eae7e7');
            });
            $('#password_confirm').blur(function(){
                $(this).css('background', '#eae7e7');
            });
*/ ?>
            $('input[type!="submit"]').focus(function(){
                $(this).css('background', 'White');
            });
            $('input[type!="submit"]').blur(function(){
                $(this).css('background', '#eae7e7');
            });
       });
   </script>
</html>