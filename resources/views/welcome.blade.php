@extends('layouts.welcome')
@section('content')

    <header class="header">
        <div class="container">
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="navbar-header">
                    <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand scroll-top logo"><b><img src="{{ url('assets/img/newlogo.png') }} " alt="" class="hidden-xs" height="104px"></b></a>
                </div>
                <!--/.navbar-header-->
                <div id="main-nav" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav" id="mainNav">
                        <li class="active"><a href="#home" class="scroll-link"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a></li>
                        <li><a href="#portfolio" class="scroll-link"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Portfolio</a></li>
                        <li><a href="#aboutUs" class="scroll-link"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;About Us</a></li>
                        <li><a href="{{ url('/login') }}" class="scroll-link"><span class="glyphicon glyphicon-user"></span>&nbsp;Login</a></li>
                    </ul>
                </div>
                <!--/.navbar-collapse-->
            </nav>
            <!--/.navbar-->
        </div>
        <!--/.container-->
    </header>
    <!--/.header-->

    <div id="#top"></div>
    <section id="home">
        <div class="banner-container">
            <img src="images/banner-bg.jpg" alt="banner" />
            <div class="container banner-content">
                <div id="da-slider" class="da-slider">
                    <div class="da-slide">
                        <h2>Living Advantage Inc.</h2>
                        <p>Is to utilize innovative technology, social networking and media to reduce the disconnect of services to foster care and homeless youth living in Los Angeles County. </p>
                        <div class="da-img"></div>
                    </div>
                    <div class="da-slide">
                        <h2> e-Lockbox</h2>
                        <p>E-management system helps foster kids in Los Angeles county to remote access their critical documents </p>
                        <div class="da-img"></div>
                    </div>
                    <div class="da-slide">
                        <h2>Our Services</h2>
                        <p>Youth Internships, Job Training and Employment</p>
                        <div class="da-img"></div>
                    </div>
                    <!--<nav class="da-arrows">
                           <span class="da-arrows-prev"></span>
                           <span class="da-arrows-next"></span>
                       </nav> -->
                </div>
            </div>
        </div>
    </section>

    <section id="introText">
        <div class="container">
            <div class="text-center">
                <h1>We create new e-Lockbox website system for youth</h1>
                <p>We hope this website will be perfect as you like </p>
            </div>
        </div>
    </section>

    <!--Portfolio-->
    <section id="portfolio" class="page-section section appear clearfix secPad">
        <div class="container">

            <div class="heading text-center">
                <!-- Heading -->
                <h2>Portfolio</h2>
                <p>learn more about us from the pictures</p>
            </div>

            <div class="row">
                <nav id="filter" class="col-md-12 text-center">
                    <ul>
                        <li><a href="#" class="current btn-theme btn-small" data-filter="*">All</a></li>
                        <li><a href="#" class="btn-theme btn-small" data-filter=".sw">Social work</a></li>
                        <li><a href="#" class="btn-theme btn-small" data-filter=".fy">Foster youth</a></li>
                        <li><a href="#" class="btn-theme btn-small" data-filter=".print">Posters</a></li>
                    </ul>
                </nav>
                <div class="col-md-12">
                    <div class="row">
                        <div class="portfolio-items isotopeWrapper clearfix" id="3">
                            <article class="col-sm-4 isotopeItem sw">
                                <div class="portfolio-item">
                                    <img src="images/portfolio/img1.jpg" alt="" />
                                    <div class="portfolio-desc align-center">
                                        <div class="folio-info">
                                            <a href="images/portfolio/img1.jpg" class="fancybox">
                                                <i class="fa fa-arrows-alt fa-2x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <article class="col-sm-4 isotopeItem fy">
                                <div class="portfolio-item">
                                    <img src="images/portfolio/img2.jpg" alt="" />
                                    <div class="portfolio-desc align-center">
                                        <div class="folio-info">
                                            <a href="images/portfolio/img2.jpg" class="fancybox">

                                                <i class="fa fa-arrows-alt fa-2x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>


                            <article class="col-sm-4 isotopeItem fy">
                                <div class="portfolio-item">
                                    <img src="images/portfolio/img3.jpg" alt="" />
                                    <div class="portfolio-desc align-center">
                                        <div class="folio-info">
                                            <a href="images/portfolio/img3.jpg" class="fancybox">

                                                <i class="fa fa-arrows-alt fa-2x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <article class="col-sm-4 isotopeItem print">
                                <div class="portfolio-item">
                                    <img src="images/portfolio/img4.jpg" alt="" />
                                    <div class="portfolio-desc align-center">
                                        <div class="folio-info">
                                            <a href="images/portfolio/img4.jpg" class="fancybox">

                                                <i class="fa fa-arrows-alt fa-2x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <article class="col-sm-4 isotopeItem fy">
                                <div class="portfolio-item">
                                    <img src="images/portfolio/img5.jpg" alt="" />
                                    <div class="portfolio-desc align-center">
                                        <div class="folio-info">
                                            <a href="images/portfolio/img5.jpg" class="fancybox">

                                                <i class="fa fa-arrows-alt fa-2x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <article class="col-sm-4 isotopeItem sw">
                                <div class="portfolio-item">
                                    <img src="images/portfolio/img6.jpg" alt="" />
                                    <div class="portfolio-desc align-center">
                                        <div class="folio-info">
                                            <a href="images/portfolio/img6.jpg" class="fancybox">

                                                <i class="fa fa-arrows-alt fa-2x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <article class="col-sm-4 isotopeItem print">
                                <div class="portfolio-item">
                                    <img src="images/portfolio/img7.jpg" alt="" />
                                    <div class="portfolio-desc align-center">
                                        <div class="folio-info">
                                            <a href="images/portfolio/img7.jpg" class="fancybox">

                                                <i class="fa fa-arrows-alt fa-2x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <article class="col-sm-4 isotopeItem fy">
                                <div class="portfolio-item">
                                    <img src="images/portfolio/img8.jpg" alt="" />
                                    <div class="portfolio-desc align-center">
                                        <div class="folio-info">
                                            <a href="images/portfolio/img8.jpg" class="fancybox">

                                                <i class="fa fa-arrows-alt fa-2x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <article class="col-sm-4 isotopeItem print">
                                <div class="portfolio-item">
                                    <img src="images/portfolio/img9.jpg" alt="" />
                                    <div class="portfolio-desc align-center">
                                        <div class="folio-info">
                                            <a href="images/portfolio/img9.jpg" class="fancybox">

                                                <i class="fa fa-arrows-alt fa-2x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>

                    </div>


                </div>
            </div>

        </div>
    </section>
    <!--About-->
    <section id="aboutUs" class="secPad">
        <div class="container">
            <div class="heading text-center">
                <!-- Heading -->
                <h2>Living Advatage Inc. e-Lockbox</h2>
                <p>e-management system helps fosters in Los Angeles County </p>
            </div>
            <div class="row">
                <!-- item -->
                <div class="col-md-4 text-center tileBox">
                    <div class="txtHead"> <i class="fa fa-desktop"></i>
                        <h3>Pamela <span class="id-color">R. Clay</span></h3></div>
                    <p>The administrator of Living Advantage.</p>
                </div>
                <!-- end: -->

                <!-- item -->
                <div class="col-md-4 text-center tileBox">
                    <div class="txtHead"><i class="fa fa-css3"></i>
                        <h3>Janice <span class="id-color">Elizabeth Kreh</span></h3></div>
                    <p>The Case Manager in Living Advantage.</p>
                </div>
                <!-- end: -->

                <!-- item -->
                <div class="col-md-4 text-center tileBox">
                    <div class="txtHead"><i class="fa fa-lightbulb-o"></i>
                        <h3>Team10 <span class="id-color">USC</span></h3></div>
                    <p>Development team of a new version of e-Lockbox.</p>
                </div>
                <!-- end: -->
            </div>
        </div>
    </section>
    <!--Quote-->
    <section id="quote" class="bg-parlex">
        <div class="parlex-back">
            <div class="container secPad text-center">
                <h2>If I asked people what they wanted, they would have said ‘Faster Horses’.</h2><h3>-Henry Ford</h3>
            </div>
            <!--/.container-->
        </div>
    </section>


    <footer>
        <div class="container">
            <div class="social col-sm-6 text-left">
                <b>Address</b>: 7095 Hollywood Blvd. #726 Hollywood, CA 90028 <br>
                <b>Email</b>: info@LivingAdvantageInc.org<br>
                <b>Phone</b>: 323.731.6471<br>
                <b>Fax</b>: 323.731.8278
            </div>
            <div class="social col-sm-4 col-sm-offset-2 text-left" style="padding-top: 0%">
                <h5 class="text-left" style="color: #787878">FOLLOW US</h5>
                <a href="https://twitter.com/LivAdvInc"><i class="fa fa-twitter"></i></a>
                <a href="https://www.facebook.com/livingadvantage"><i class="fa fa-facebook"></i></a>
                <a href="https://www.youtube.com/user/LivingAdvantage"><i class="fa fa-youtube"></i></a>
                <a href="https://www.linkedin.com/start/join?trk=login_reg_redirect&session_redirect=http%3A%2F%2Fwww.linkedin.com%2Fprofile%2Fview%3Ftrk%3Dtab_pro%26id%3D39187473"><i class="fa fa-linkedin"></i></a>
            </div>

            <div class="clear"></div>
            <!--CLEAR FLOATS-->
        </div>
    </footer>
    <!--/.page-section-->
    <section class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    Copyright 2016 Living Advantage, Inc. All Rights Reserved.
                </div>
            </div>
            <!-- / .row -->
        </div>
    </section>
@stop

@section('footer')
    <a href="#top" class="topHome"><i class="fa fa-chevron-up fa-2x"></i></a>

    <!--[if lte IE 8]><script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script><![endif]-->
    <script src="js/modernizr-latest.js"></script>
    <script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/jquery.isotope.min.js" type="text/javascript"></script>
    <script src="js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="js/jquery.nav.js" type="text/javascript"></script>
    <script src="js/jquery.cslider.js" type="text/javascript"></script>
    <script src="js/custom.js" type="text/javascript"></script>
    <script src="js/owl-carousel/owl.carousel.js"></script>

@stop