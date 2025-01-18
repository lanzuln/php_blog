<?php 

$page_name = basename($_SERVER['PHP_SELF']);
echo $page_name;


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Hikers Blog &mdash; Colorlib Website Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700|Playfair+Display:400,700,900" rel="stylesheet">

    <link rel="stylesheet" href="assets/fonts/icomoon/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="assets/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="assets/css/aos.css">

    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
  
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    
    <header class="site-navbar pt-3" role="banner">
      <div class="container-fluid">
        <div class="row align-items-center">

          <div class="col-6 col-xl-6 logo">
            <h1 class="mb-0"><a href="index.php" class="text-black h2 mb-0">Hikers</a></h1>
          </div>
          
          <div class="col-6 mr-auto py-3 text-right" style="position: relative; top: 3px;">
            <div class="social-icons d-inline">
              <a href="#"><span class="icon-facebook"></span></a>
              <a href="#"><span class="icon-twitter"></span></a>
              <a href="#"><span class="icon-instagram"></span></a>
            </div>
            <a href="#" class="site-menu-toggle js-menu-toggle text-black d-inline-block d-xl-none"><span class="icon-menu h3"></span></a></div>
          </div>
          
          <div class="col-12 d-none d-xl-block border-top">
            <nav class="site-navigation text-center " role="navigation">

              <ul class="site-menu js-clone-nav mx-auto d-none d-lg-block mb-0">
                <li class="<?php echo $page_name == "index" ? "active" : ''?>"><a href="index.php">Home</a></li>
                <li class="has-children <?php if($page_name == "index.php" ? "categories" : '');?>">
                  <a href="category.html">Categories</a>
                  <ul class="dropdown">
                    <li><a href="category.html">Architect</a></li>
                    <li><a href="category.html">Minimal</a></li>
                    <li><a href="category.html">Interior</a></li>
                    <li><a href="category.html">Furniture</a></li>
                  </ul>
                </li>
                <li class="<?php echo $page_name == "blog.php" ? "active" : ''?>"><a href="blog.php">Blog</a></li>
                <li><a href="category.html">Contact</a></li>
              </ul>
            </nav>
          </div>
        </div>

      </div>
    </header>