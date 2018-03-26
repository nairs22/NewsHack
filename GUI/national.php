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
    <link rel="stylesheet" href="demo.css">
	<link rel="stylesheet" href="bjqs.css">
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="js/bjqs-1.3.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5/html5shiv.min.js"></script>
      <script src="js/html5/respond.min.js"></script>
    <![endif]-->

	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    
</head>
<body data-offset="200" data-spy="scroll" data-target=".primary-navigation">
<style type="text/css">
.col-md-4 {
  height: 370px;
  margin-bottom: 50px;
}
</style>
	<!-- Post --> 
	<div id="category-post-section" class="category-post-section" style="  padding-top: 0px;">
		<!-- Container -->
		<div class="container" style="margin:0px;padding:0px">
			<div class="row">
			
			
		<div class="col-md-4 col-sm-6" style="padding:10px">	
		<div style="  background: #EFEEF0; padding: 5px;text-align: center; font-size: 16px;font-weight: bold;">Nation</div>
		<div id="banner-fade1">		
        <ul class="bjqs">
<?php
$row = 1;
if (($handle = fopen("http://localhost:8983/solr/collection1/select?q=category%3ANation&sort=last_modified+desc&wt=csv&indent=true", "r")) !== FALSE) 
{  
$data = fgetcsv($handle, 1000, ",");
$num = count($data);
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
	{        
        if ($row == 1) 
	    {
	      $row++;
        }
	    else
	   {        
	      if($row%2==0)
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
					
			echo "          <li>
		      <div class='post-box' style='width:500px;height:450px'>
						<div class='image-box'>
							<img src='$link' style='width:500px;height:280px'/>
							<a href='$url' ></a>
						</div>
						
						<div class='post-box-inner'>
							<a href='$url' class='box-read-more' target='_blank'><img src='images/icon/arrow.png' alt='arrow' /> Read More</a>
							<div class='box-content'>
								
								<a href='$url' class='block-title' target='_blank'>$title</a>
								
								<p>$content</p>
								
							</div>
						</div>
		    </div>
		</li>	";	
			

 	        $row++;
	
	       }
	       else
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
			echo "          <li>
		     <div class='post-box' style='width:500px;height:450px'>
						<div class='image-box' >
							<img src='$link' style='width:500px;height:280px'/>
							<a href='$url' ></a>
						</div>
						
						<div class='post-box-inner'>
							<a href='$url' class='box-read-more' target='_blank'><img src='images/icon/arrow.png' alt='arrow' /> Read More</a>
							<div class='box-content'>
								
								<a href='$url' class='block-title' target='_blank'>$title</a>
								
								<p>$content</p>
								
							</div>
						</div>
		    </div>
		</li>	";		
		
 	        $row++;
	

	       }
	   }       
   }
    fclose($handle);
  }
?>
        </ul>
        </div>
	    </div>
		
		
		
	  
	  
	 
	  	
	  	
      <!-- End outer wrapper -->
      <script class="secret-source">
        jQuery(document).ready(function($) {

          $('#banner-fade1').bjqs({
            height      : 450,
            width       : 500,
            responsive  : true
          });

        });
		jQuery(document).ready(function($) {

          $('#banner-fade2').bjqs({
            height      : 450,
            width       : 500,
            responsive  : true
          });

        });
				jQuery(document).ready(function($) {

          $('#banner-fade3').bjqs({
            height      : 450,
            width       : 500,
            responsive  : true
          });

        });
				jQuery(document).ready(function($) {

          $('#banner-fade4').bjqs({
            height      : 450,
            width       : 500,
            responsive  : true
          });

        });
				jQuery(document).ready(function($) {

          $('#banner-fade5').bjqs({
            height      : 450,
            width       : 500,
            responsive  : true
          });

        });
				jQuery(document).ready(function($) {

          $('#banner-fade6').bjqs({
            height      : 450,
            width       : 500,
            responsive  : true
          });

        });
      </script>
			</div>
		</div><!-- Container /- -->
	</div><!-- Post Section /- -->
	


	
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
