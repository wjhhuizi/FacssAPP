<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

        <div class="sidebar" data-color="azure" data-image="<?php echo base_url() ?>assets/img/sidebar-5.jpg">    

        <!--   

            Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" 
            Tip 2: you can also add an image using data-image tag

        -->
        
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                        <b>FACSS&nbsp;&nbsp;2017</b>
                    </a>
                </div>

                <ul class="nav">
                    <li id="_nav_welcome">
                        <a href="<?php echo base_url() ?>index.php/main/index">
                            <i class="pe-7s-star"></i> 
                            <p>欢迎登录 Facss APP</p>
                        </a>            
                    </li>
                    <li id="_nav_profile">
                        <a href="<?php echo base_url() ?>index.php/main/profile">
                            <i class="pe-7s-user"></i> 
                            <p>个人信息</p>
                        </a>
                    </li> 
                    <hr id="nav_hr">
                    
                    <?php if($perm >= 0): ?> <!-- 所需权限等级：3 -->
                    <li id="_nav_localhelp">
                        <a href="<?php echo base_url() ?>index.php/main/localhelp">
                            <i class="pe-7s-way"></i>
                            <p>FACSS Local Help</p>
                        </a>        
                    </li>
                    <?php endif; ?>
                    
                    <?php if($perm >= 0): ?> <!-- 所需权限等级：0 -->
                    <li id="_nav_ac_01">
                        <a href="<?php echo base_url() ?>index.php/activity/insurance_talk">
                            <i class="pe-7s-anchor"></i> 
                            <p>Insurance talk</p>
                        </a>        
                    </li>
                    <?php endif; ?>
                    
                    
                    
<?php /*
                    <li>
                        <a href="typography.html">
                            <i class="pe-7s-news-paper"></i> 
                            <p>Typography</p>
                        </a>        
                    </li>
                    <li>
                        <a href="icons.html">
                            <i class="pe-7s-science"></i> 
                            <p>Icons</p>
                        </a>        
                    </li>
                    <li>
                        <a href="maps.html">
                            <i class="pe-7s-map-marker"></i> 
                            <p>Maps</p>
                        </a>        
                    </li>
                    <li>
                        <a href="notifications.html">
                            <i class="pe-7s-bell"></i> 
                            <p>Notifications</p>
                        </a>        
                    </li>
 */ ?>
                </ul> 
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                                <span class="sr-only">展开菜单</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"></a>
                    </div>

                    <div class="collapse navbar-collapse">       
                            <ul class="nav navbar-nav navbar-left">
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-dashboard"></i>
                                    </a>
                                </li>
                                <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-globe"></i>
                                            <!--<b class="caret"></b>-->
                                            <!--<span class="notification">5</span>-->
                                      </a>
                                      <!--<ul class="dropdown-menu">-->
                                        <!--<li><a href="#">Notification 1</a></li>-->
                                        <!--<li><a href="#">Notification 2</a></li>-->
                                        <!--<li><a href="#">Notification 3</a></li>-->
                                        <!--<li><a href="#">Notification 4</a></li>-->
                                        <!--<li><a href="#">Another notification</a></li>-->
                                      <!--</ul>-->
                                </li>
        <!--                        <li>
                                   <a href="">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </li> -->
                            </ul>

                            <ul class="nav navbar-nav navbar-right">
        <!--                        <li>
                                   <a href="">
                                       Account
                                    </a>
                                </li>
                                <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            Dropdown
                                            <b class="caret"></b>
                                      </a>
                                      <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                      </ul>
                                </li>-->
                                <li>
                                    <a href="<?php echo base_url() ?>index.php/main/logout">
                                        Log out
                                    </a>
                                </li> 
                            </ul>
                    </div>
                </div>
            </nav>
            
            <div class="content" id="ajax_content"><?php #Start of content, id='ajax_content' ?>