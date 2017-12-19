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
      <title>请登录 - Facss Local Help</title>
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/login.css">  
      <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   </head>

   <body>
      <div class="container">
         <section id="content">
             <form action="<?php echo base_url() ?>index.php/index/login" autocomplete="off" method="post" id="form">
               <h1>Student Login</h1>
               <div>
                   <input type="text" placeholder="NetID (例如:abc123456)" required="" id="username" name="username" />
               </div>
               <div>
                   <input type="password" placeholder="密码" required="" id="password" name="password"/>
               </div>
               <div>
                   <input type="submit" value="登&nbsp;&nbsp;录" />
                  <a href="<?php echo base_url() ?>index.php/forgetpass">忘记了密码？</a>
                  <a href="<?php echo base_url() ?>index.php/register">注册账号</a>
               </div>
            </form><!-- form -->
            
            <div class="button">
               <a href="http://facss.us/"><b>返回Facss主页&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></a>
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
                    var ps_ptn = /^[a-zA-Z0-9+=\-_@,\!#\.]{4,20}$/;
                    /*
                    console.log();
                    console.log($('#username').val());
                    */
                    if((!(id_ptn.test($('#username').val())))){
                        $('#username').css('background', 'pink');
                    }
                    else{
                        vaildated= true;
                        $('#form').submit();
                    }
                }
            }); 
            $('#username').focus(function(){
                $(this).css('background', 'White');
            });
            $('#username').blur(function(){
                $(this).css('background', '#eae7e7');
            });
            
       });
   </script>
</html>