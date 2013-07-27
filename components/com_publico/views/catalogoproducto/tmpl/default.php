<html>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="imagetoolbar" content="no" />

<!--jquery-->
<script type="text/javascript" src="<?php echo JURI::Root()?>libraries/js/jquery-1.9.0.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<!--funcybox -->
<script type="text/javascript" src="<?php echo JURI::Root()?>jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo JURI::Root()?>jquery.fancybox.css" media="screen" />

<link rel="stylesheet" type="text/css" href="<?php echo JURI::Root()?>jquery.fancybox-buttons.css" media="screen" />

<script src="<?php echo JURI::Root()?>libraries/js/jquery.fancybox-buttons.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="<?php echo JURI::Root()?>css/jquery.fancybox-thumbs.css">
<script type="text/javascript" src="<?php echo JURI::Root()?>libraries/js/jquery.fancybox-thumbs.js"></script>



<script type="text/javascript" src="<?php echo JURI::Root()?>libraries/js/jquery.mousewheel-3.0.4.pack.js"></script>


<!--Css y Js de DataTable integrado con Bootstrap -->
<script type="text/javascript" src="<?php echo JURI::Root()?>libraries/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo JURI::Root()?>libraries/js/DT_bootstrap.js"></script>
<link rel="styesheet" type="text/css" href="<?php echo JURI::Root()?>css/DT_bootstrap.css" />

<!-- scripts-->

<!-- <script type="text/javascript">
                                $(document).ready(function() {
                                $("a#example6").fancybox({
                                  'titlePosition'   : 'inside'
                                });
                    });

</script> -->
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
                closeEffect : 'none',

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
                openEffect  : 'none',
                closeEffect : 'none',

                prevEffect : 'none',
                nextEffect : 'none',

                closeBtn  : false,

                helpers : {
                    title : {
                        type : 'inside'
                    },
                    buttons : {}
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
</head>



<head>
    <title>Mis productos</title>
</head>
<body>




   <!--<div id="mensaje_insert"> </div>-->
    <table cellpadding="0" cellspacing="0" border="0" class="table table-hover" id="example">
        <thead>
            <tr>
                <th align="center">Foto</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Categoria</th>
                <th>Estado</th>
            </tr>
        </thead>
                
        <?php foreach ($this->productos as $producto) { ?>
            <tbody>
                <tr class="funcybox-buttons">
                    <td><a class="funcybox-buttons" href="<?php echo JURI::root();?>images/<?php echo $producto->nomf;?>" title="<?php echo $producto->descripcion;?>"><img width="115" height="90" alt="img" src="<?php echo JURI::root();?>images/<?php echo $producto->nomf;?>"/></a></td>
                    <td><a href="index.php?option=com_publicofinal&task=detalleProducto&id=<?echo $producto->ident; ?>"><?php echo $producto->name;?></td>
                    <td>$<?php echo $producto->precio;?></td>
                    <td><?php echo $producto->nombreCategoria;?></td>
                    <td><?php echo $producto->tipo;?></td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
</body>
</html>