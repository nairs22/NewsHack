<!doctype html>
<html class="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">	
	<title>News Hack</title>
		
    <link href="libraries/bootstrap/bootstrap.min.css" rel="stylesheet" />
    <linK href="libraries/owl-carousel/owl.carousel.css" rel="stylesheet" /> 
    <linK href="libraries/owl-carousel/owl.theme.css" rel="stylesheet" /> 
	<link href="libraries/flexslider/flexslider.css" rel="stylesheet" /> 
	<link href="libraries/fonts/font-awesome.min.css" rel="stylesheet" />
	<link href="libraries/animate/animate.min.css" rel="stylesheet" />
   <link href="css/components.css" rel="stylesheet"/>
	<link href="style.css" rel="stylesheet" />
    <link href="css/media.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5/html5shiv.min.js"></script>
      <script src="js/html5/respond.min.js"></script>
    <![endif]-->

	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <style type="text/css">
.styled-button-8 {
	background: #25A6E1;
	background: -moz-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0%,#25A6E1),color-stop(100%,#188BC0));
	background: -webkit-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	background: -o-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	background: -ms-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	background: linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#25A6E1',endColorstr='#188BC0',GradientType=0);
	padding:8px 13px;
	color:#fff;
	font-family:'Helvetica Neue',sans-serif;
	font-size:17px;
	border-radius:4px;
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
	border:1px solid #1A87B9
}                
</style>
</head>
<body data-offset="200" data-spy="scroll" data-target=".primary-navigation">

	<a id="top"></a>
	
	<!-- Header Section -->
	<header id="header" class="header" style="box-shadow: inset 0px 0px 88px #CDCCCC;">

		
		<!-- logo-add-block -->
		<div class="logo-add-block">
			<!-- container -->
			<div class="container">
				<div class="row">
					<div class="col-md-3 logo-block col-sm-3">
						<a href="index.php"><img src="images/logo.png" alt="logo"></a>
					</div>
					<div class="col-md-9 add-block col-sm-9">
						<div id="sb-search" class="sb-search">
							<form method="post" action="search.php">
<input class="sb-search-input" placeholder=" " type="text" value="" name="q" id="search" style="right: 130px;width: 70%;">
<input class="sb-search-input" placeholder=" " type="submit" value="Search" name="submit" id="search" style="  right: 20px;width: 11%;z-index: 999;background: #002AB0;color: #fff;">
								<button  class="sb-search-submit"><i class="fa fa-search"></i></button>
								<span class="sb-icon-search"></span>
							</form>
						</div>
					</div>
				</div>
			</div><!-- container /- -->
		</div><!-- logo-add-block /- -->
		

	</header>
	<!-- Header Section /- -->

	<!-- Post --> 
	<div id="category-post-section" class="category-post-section">
		<!-- Container -->
		<div class="container">
			<div class="row">
				
				
				
<?php
if(isset($_POST['submit']))
{
$s=$_POST['q'];
$var=str_replace(' ','+',$s);
$row=1;
if (($handle = fopen("http://localhost:8983/solr/collection1/select?q='.$var.'&sort=last_modified+desc&start=0&rows=15&wt=csv&indent=true", "r")) !== FALSE) 
{  

$data = fgetcsv($handle, 1000, ",");
$num = count($data);

while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
	{              	
	  for ($c=$num; $c>=0; $c--) 
		    {     
		         $img=$data[6];
				 if($img=='')
			     {
					 $link='images/logo.png';
				 }
				 else
				 {
					 $link=$data[6];
					 $allowed =  array('gif','png' ,'jpg');
					 $ext = pathinfo($link, PATHINFO_EXTENSION);
					 if(!in_array($ext,$allowed) ) 
					 {
					     $link='images/logo.png';
					 }
					 else
					 {
					     $link=$data[6];
					 }
				 }
		         $cat=$data[1];
				 $title=stripslashes($data[4]);
				 $category=$data[2];
				 $url=$data[7];
				 $gval=stripslashes($data[0]);
				 $content = substr($gval , 0, 250).'...';
          	   }
					
			echo "<div class='col-md-4 col-sm-6'>
					<div class='post-box'>
						<div class='image-box'>
							<img src='$link' style='width:370px;height:220px'/>
							<a href='$url' ><img src='images/icon/big-plus.png' alt='big-plus'  target='_blank'/></a>
						</div>
						
						<div class='post-box-inner'>
							<a href='$url' class='box-read-more'><img src='images/icon/arrow.png' alt='arrow' target='_blank'/> Read More</a>
							<div class='box-content'>
								
								<a href='$url' class='block-title' target='_blank'>$title</a>
								
								<p>$content</p>
								
							</div>
						</div>
					</div>
				</div>";			

 	        $row++;
	
	       
}
fclose($handle);
	     }
    
}  

if ($row==1)
{
echo "SEARCH RESULT NOT FOUND!";
}
?>
				
		
			</div>
		</div><!-- Container /- -->
	</div><!-- Post Section /- -->
	

	
	<!-- Footer Section -->
	<div id="footer-section" class="footer-section">
	
		<!-- Footer Bootom -->
		<div class="footer-bottom">
			<div class="container">
				<div class="col-md-6 col-sm-6">
					<p>&copy; 2015 News Hack All Rights Reserved. </p>
				</div>
				<div class="col-md-6 col-sm-6">
					
				</div>
			</div>
		</div><!-- Footer Bootom /- -->
	</div>
	<!-- Footer Section /- -->
	
	<!-- jQuery Include -->
	<script src="libraries/jquery.min.js"></script>	
	<script src="libraries/jquery.easing.min.js"></script><!-- Easing Animation Effect -->
	<script src="libraries/bootstrap/bootstrap.min.js"></script> <!-- Core Bootstrap v3.2.0 -->
	<script src="libraries/jquery.animateNumber.min.js"></script> <!-- Used for Animated Numbers -->
	<script src="libraries/jquery.appear.js"></script> <!-- It Loads jQuery when element is appears -->
	<script src="libraries/jquery.knob.js"></script> <!-- Used for Loading Circle -->
	<script src="libraries/wow.min.js"></script> <!-- Use For Animation -->
	<script src="libraries/flexslider/jquery.flexslider-min.js"></script> <!-- flexslider   -->
	<script src="libraries/owl-carousel/owl.carousel.min.js"></script> <!-- Core Owl Carousel CSS File  *	v1.3.3 -->
	<script src="libraries/expanding-search/modernizr.custom.js"></script> <!-- Core Owl Carousel CSS File  *	v1.3.3 -->
	<script src="libraries/expanding-search/classie.js"></script> 
	<script src="libraries/expanding-search/uisearch.js"></script>
	<script>
		new UISearch( document.getElementById( 'sb-search' ) );
	</script>
	<script type="text/javascript" src="libraries/jssor.js"></script>
    <script type="text/javascript" src="libraries/jssor.slider.js"></script>
	<script type="text/javascript" src="libraries/jquery.marquee.js"></script>
	<!-- Customized Scripts -->
	<script src="js/functions.js"></script>
	
</body>

<!-- Mirrored from wpmines.com/demos/ranzim/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Apr 2015 08:26:31 GMT -->
</html>
