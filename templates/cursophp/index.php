<?php
defined('_JEXEC') or die;
// detecting site title
$app = JFactory::getApplication();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <jdoc:include type="head" />
<link rel="stylesheet" type="text/css" href="templates/cursophp/bootstrap/css/bootstrap.css">   
<link href="templates/cursophp/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

</head>
  <body >
  

  	<div class="navbar navbar-inverse navbar-fixed-top"> 
  		<div class="navbar-inner"> 
	        <div class="container-fluid">
	          
              <a class="brand" href="#"><?php echo $app->getCfg('sitename'); ?></a>
              <jdoc:include type="modules" name="top-menu"/>
	          
	        </div>
		  </div>
   </div>
   
   <div class="row-fluid">
      <div class="hero-unit"  style="background-image:url(images/fondo-banner.jpg)">
        <h1>Ecommer Jujuy</h1>
        <h3>Compra y venta</h3> 
      </div>
    </div>

  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span3">
      
        <div class="well sidebar-nav">
        <jdoc:include type="modules" name="categoria" style="none" />
        <jdoc:include type="modules" name="producto" style="none" />
       </div><!--/.well -->
      <div class="well sidebar-nav">
        <jdoc:include type="modules" name="left" style="none" />

      </div><!--/.well -->
     </div><!--/span-->

      <div class="span9">
        <div class="hero-unit">
          <jdoc:include type="component" name='publicofinal' />
        </div>
      </div><!--/row-->
    <!-- </div><!/span--> 

   </div><!--/row-->
  </div><!--/.fluid-container-->

<script type="text/javascript" src="templates/cursophp/bootstrap/js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="templates/cursophp/bootstrap/js/bootstrap.min.js"></script>

  <footer>
    <p>&copy; Curso PHP - Openix 2013</p>
  </footer>

</body>
</html>