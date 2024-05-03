<header>
            <!-- header  -->
            <div class="header header-1">
                <!-- container  -->
                <div class="container">
                    <!-- header inner -->
                    <div class="header-inner">
                        <div class="logo">
                            <a href="index"><img src="<?php echo base_url('media/website/assets/logo_la.png');?>" alt="Logo" class="logo-img"></a>
                        </div>
                        <div class="header-right">
                            <div class="header-menu d-none d-lg-block">
                                <nav class="cf-header-menu" id="header-menu">
                                    <ul>
                                        <li class=""><a href="<?php echo base_url()?>">Home</a>
                                          
                                        </li>
                                        <li ><a href="<?php echo base_url()?>site/about">About Us</a>
                                           
                                        </li>
                                        <!-- class="has-submenu" -->
                                        <li ><a href="<?php echo base_url()?>site/team">Our Team</a>
                                            <!-- <ul class="submenu">
                                                <li><a href="#">Team 1</a></li>
                                                <li><a href="#">Team 2</a></li>
                                            </ul> -->
                                        </li>
                                      
                                        <li ><a href="<?php echo base_url()?>site/product">Product</a>
                                           
                                        </li>
                                        <li ><a href="<?php echo base_url()?>site/Gallery">gallery</a>
                                           
                                        </li>
                                        <li ><a href="<?php echo base_url()?>site/legal">legal</a>
                                           
                                        </li>
                                       
                                     
                                        <li><a href="<?php echo base_url()?>site/contact">Contact</a>
                                           
                                        </li>
                                        <!-- <li class="set-bttt">
                                            <button class="btn btn-primary"><a style="border-top:none;color:white" href="<?php echo base_url('site/register');?>" class="nav-bb py-0">Register</a></button>
                                        </li> -->
                                        <li class="set-bttt">
                                            <button class="nav-bb-set"><a style="border-top:none;color:white;" href="<?php echo base_url('site/login');?>" class="nav-bb py-0">login</a></button>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="header-right-search-phone d-none d-lg-none  d-lg-block ml-35">
                                    <a href="#" class="header-search" id="search"><span
                                        class="icofont-search-1"></span></a>
                                    <a href="tel:<?php echo config_item('mobile_number')?>" class="header-phone"><i class="fa-solid fa-phone-volume"></i> <?php echo config_item('mobile_number')?></a>
                                    
                            </div>
                            <div class="d-lg-none dr-navbar-mobile-sign side-toggle">
                                <!-- <span class="headeer-navigaiton"><i class="icofont-navigation-menu"></i></span> -->
                                <div class="dr-navbar-sign menu-tab">
                                    <span class="dr-line-1"></span>
                                    <span class="dr-line-2"></span>
                                    <span class="dr-line-3"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- header inner end  -->
                    <div class="search-form-wrapper">
                        <form action="#">
                            <div class="p-1 bg-light search-form shadow-sm mt-3" id="searchForm">
                                <div class="input-group">
                                    <input type="search" placeholder="What're you searching for?" class="form-control search-input border-0 bg-light">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- container end  -->
            </div>
            <!-- nav end -->
        </header>