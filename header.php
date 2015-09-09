<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title><?php echo $title; ?> | operations</title>    

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <!-- <link rel="icon" href="favicon.ico" type="image/x-icon"> -->

    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="assets/css/headers/header-default.css">
    <link rel="stylesheet" href="assets/css/footers/footer-v1.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="assets/plugins/animate.css">
    <link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!--[if lt IE 9]><link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms-ie8.css"><![endif]-->

    <!-- CSS Theme -->    
    <link rel="stylesheet" href="assets/css/theme-colors/default.css" id="style_color">  
    <!-- <link rel="stylesheet" href="assets/css/theme-skins/dark.css"> -->

    <!-- CSS Customization -->
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- CSS KWP Customisation -->
    <link rel="stylesheet" href="css/kwp_custom.css">
</head>	

<body>

<div class="wrapper">
    <!--=== Header ===-->    
    <div class="header">
        <div class="container">
            <!-- Logo -->
            <a class="logo" href="index.php">
                <img src="img/Service_Design_Development_logo_s.png" alt="Logo">
            </a>
            <!-- End Logo -->
            
            <!-- Topbar -->
            <div class="topbar">
                <ul class="loginbar pull-right">
                    <!-- <li class="hoverSelector">
                        <i class="fa fa-globe"></i>
                        <a>Languages</a>
                        <ul class="languages hoverSelectorBlock">
                            <li class="active">
                                <a href="#">English <i class="fa fa-check"></i></a> 
                            </li>
                            <li><a href="#">Spanish</a></li>
                            <li><a href="#">Russian</a></li>
                            <li><a href="#">German</a></li>
                        </ul>
                    </li> 
                    <li class="topbar-devider"></li>-->   
                    <!-- <li><a href="page_faq.html">Help</a></li> -->  
                    <!-- <li class="topbar-devider"></li> -->
                    <!-- <li><a href="page_login.html">Login</a></li> --> 
                    <li><a href="#">Welcome, <?php echo $displayname; ?></a></li>
                </ul>
            </div>
            <!-- End Topbar -->

        </div><!--/end container-->

    </div>
    <!--=== End Header ===-->

    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left"><?php echo $subtitle; ?></h1>
            <ul class="pull-right breadcrumb">
                <li><a href="index.php">home</a></li>
                <!-- <li><a href="">Tables</a></li> -->
                <li class="active"><?php echo $subtitle; ?></li>
            </ul>
        </div><!--/container-->
    </div><!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->

    <!--=== Content ===-->
    <div class="container content">
        <!-- Write Your HTML Codes Here -->
    