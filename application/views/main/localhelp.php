<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">FACSS 2018 Spring Local Help</h4>
                            <p class="category">&nbsp;更新时间： 2017-12-19</p>
                        </div>
                        
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>标题</th>
                                    <th>负责人/部门</th>
                                    <th>日期时间</th>
                                    <th>注册人数</th>
                                    <th>当前状态</th>
                                </thead>
                                <tbody>
                                <?php foreach ($result as $item):?>
                                <tr>
                                <?php foreach ($item as $i => $j): ?>
                                    <td><?php 
                                    if($i=='state'){
                                        switch ($j) {
                                        case 0: 
                                            echo '未开放报名';
                                            break;
                                        case 1:
                                            echo '<a href="localhelp/'.$item['id'].'" class="_lh_signup" lhid="'.$item['id'].'">'.'点此报名</a>';
                                            break;
                                        case 2:
                                            echo '报名已截止';
                                            break;
                                        case 3:
                                            echo '已过期';
                                            break;
                                        default:
                                            echo '报名已截止';
                                            break;
                                        }
                                    } else {
                                        echo $j;
                                    }
                                    ?></td>
                                <?php endforeach; ?>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        jQuery.noConflict();
        jQuery('#_nav_localhelp').addClass('active');                           // Active Side Menu
        jQuery('.navbar-brand').text('Local Help 2017');                        // Update Nav Title
        /*
        jQuery(document).ready(function(){
           jQuery('._lh_signup').click(function(e){
              e.preventDefault(); 
              jQuery.ajax({
                  method:     'GET',
                  url:        'lh_getcontent/'+ jQuery(this).attr('lhid'),
                  dataType:   'html',
                  success:    function(result){
                      jQuery('#ajax_content').html(result);
                  }
              });
           });
        });
     */
    </script>