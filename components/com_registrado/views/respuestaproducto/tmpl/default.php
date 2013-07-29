
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Catalogos</title>
        <script src="/Joomla2.5/libraries/js/jquery-1.9.0.js" type="text/javascript"> </script>
        <script type="text/javascript" src="/Joomla2.5/libraries/js/jquery.fancybox.pack.js"></script>  
            
 
<!--	 Add jQuery library -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="/Joomla2.5/libraries/js/jquery.mousewheel-3.0.6.pack.js"></script>


        
	<script type="text/javascript" src="/Joomla2.5/libraries/js/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="/Joomla2.5/templates/dd_thebrand_17/css/jquery.fancybox.css">
        <link rel="stylesheet" type="text/css" href="/Joomla2.5/templates/dd_thebrand_17/css/global.css">
	<!-- Add Button helper (this i  <link rel="stylesheet" type="text/css" href="/Joomla2.5/templates/dd_thebrand_17/css/global.css">s optional) -->
	<link rel="stylesheet" type="text/css" href="/Joomla2.5/templates/dd_thebrand_17/css/jquery.fancybox-buttons.css?v=2.0.3" />
	<script type="text/javascript" src="/Joomla2.5/libraries/js/jquery.fancybox-buttons.js?v=2.0.3"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="/Joomla2.5/templates/dd_thebrand_17/css/jquery.fancybox-thumbs.css?v=2.0.3" />
	<script type="text/javascript" src="/Joomla2.5/libraries/js/jquery.fancybox-thumbs.js?v=2.0.3"></script>

<script type="text/javascript">
		$(document).ready(function() {
			/*
				Simple image gallery. Use default settings
			*/

			$('.fancybox').fancybox();

			/*
				Different effects
			*/

			// Change title type, overlay opening speed and opacity
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedIn : 500,
						opacity : 0.95
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background-color' : '#eee'	
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
				Button helper. Disable animations, hide close button, change title type and content
			*/

			$('.fancybox-buttons').fancybox({
				openEffect: 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : true,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
				Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			*/

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : { 
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

		});
	</script>
	
	<style type="text/css">
		.fancybox-custom .fancybox-outer {
			box-shadow: 0 0 50px #222;
		}
	</style>

        <article>
            <table>
              <tbody>
                  <tr>
                	<td width="200" height="200">
         	        	<fieldset> 
	        	            <a class="fancybox" href="<?php echo JURI::root();?>images/<?php echo $this->producto->nombrefoto; ?>" data-fancybox-group="gallery" title="<?php echo $this->producto->nombreproducto; ?>"><img width="150" height="150" src="<?php echo JURI::root();?>images/<?php echo $this->producto->nombrefoto; ?>" alt="" /></a>
                	    </fieldset>
		            </td>
              		<td width="350" height="200">
						<h3><?php echo $this->producto->nombreproducto; ?></h3>
                        <p> <?php echo $this->producto->descripcion; ?> </p>
                        <div> 
                        	<h2> $ <?php echo $this->producto->precio; ?> </h2>
                        </div>
                        <div align="center"> 
                           <button class="button" type="submit"> Comprar </button>
                        </div>
					</td>
              	  </tr>
               </tbody>
            </table>

<!-- ESTA ES LA SECCIÓN DE RESPUESTAS -->

     <?php foreach ($this->consultas as $consultas) { ?>
        <div>
        <?php if (strlen($consultas->respuesta)==0) { ?>
            <form  action="<?php echo JRoute::_('index.php?option=com_registrado&task=guardarRespuesta');?>" method="post">
            <input type="hidden" id="id" value="<?php echo $consultas->id;?>"  name="idConsulta" >        
            <input type="hidden" id="id" value="<?php echo $this->producto->identproducto;?>"  name="idProducto" >    

            <div style="background-color: #c2e1dd ">
                <p>Pregunta:</p>
                <textarea name="consulta"  disabled row="4" cols="70" name="pregunta">
                     <?php echo $consultas->consulta;?>
                </textarea>
           
                <p>Responder:</p>
                <div style="background-color: #c2e1ef ">
                    <textarea name="respuesta" placeholder="Escribe tu respuesta..." width="70%" cols="70" ></textarea>
                    <input type="submit" name="saveQuest" value="Responder">
                </div>
            </div>
           </form>  
        <?php }?>    
        </div>
    <?php } ?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
