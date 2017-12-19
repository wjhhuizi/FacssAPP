<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="header">
                            <h4 class="title"><?php echo $result['title'] ?></h4>
                        </div>
                        <hr id="content">
                        <div class="content">
                            <blockquote>
                                <p class="content text-info">
                                    时间：<?php echo $result['datetime'] ?><br>
                                    领队：<?php echo $result['department'] ?><br>
                                    已报名人数：<?php echo $result['signup_cnt'] ?>
                                </p>
                            </blockquote>
                            <p class="content">
                                <?php echo $result['content'] ?><br /><br />
                                
                                <?php if(isset($result['QR_img'])): ?>
                                扫描微信二维码进群：<br>
                                <img src="<?php echo base_url().$result['QR_img'] ?>" alt="QR_CODE" height="60%" width="60%"/>
                                <?php endif ?>
                            </p>
                        </div>
                        <hr id="content">
                        <div class="content">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-6">
                                        <button href="http://www.baidu.com/" class="btn btn-danger btn-block" id="_lh_confirm" disabled>确认报名</button>&nbsp;
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-default btn-block" onclick="window.location.href='localhelp'">返回</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        jQuery.noConflict();
        jQuery('.navbar-brand').text('Local Help 2017');                        // Update Nav Title
        jQuery('#_nav_localhelp').addClass('active'); 
        
        var status = <?php echo $status ?>;
        var LH_ID = <?php echo $result['id'] ?>;
        
        jQuery(document).ready(function(){
            jQuery('#_lh_confirm').removeAttr('disabled');
            if (status == 1){
                jQuery('#_lh_confirm').text('取消报名');
            }
            jQuery('#_lh_confirm').click(function(){
               if (status == 0){
                   window.location.href=LH_ID+'/register';
               } else {
                   window.location.href=LH_ID+'/cancel';
               }
            });
        });
        
    </script>