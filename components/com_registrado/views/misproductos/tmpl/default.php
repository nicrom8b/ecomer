<html>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="imagetoolbar" content="no" />
<script type="text/javascript" src="libraries/js/jquery-1.4.3.min.js"></script>
<!--<script type="text/javascript" src="libraries/js/jquery-ui-1.8.22.custom.min.js"></script>-->

<style type="text/css" title="currentStyle">
			@import "/cursophp/templates/dd_thebrand_17/css/demo_page.css";
			@import "/cursophp/templates/dd_thebrand_17/css/demo_table.css";
                        @import "/cursophp/templates/dd_thebrand_17/css/jquery.dataTables.css";
</style>
<script type="text/javascript" language="javascript" src="libraries/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="libraries/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="libraries/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="libraries/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

<script type="text/javascript">
                                $(document).ready(function() {
                                $("a#example6").fancybox({
                                  'titlePosition'	: 'inside'
                                });
        			});

</script>

<script>
                        $(document).ready(function() {
                                     $(document).ready(function() {
                                $('#example').dataTable();
                                }
                        );
                        });

</script>

    <script>
        function eliminar(idProducto){
        $.ajax({
           url: "<?php echo JURI::Root()?>index.php?option=com_ventas&task=borrarProducto",
            type: "GET",
            data: {"id": idProducto}, // pasa el valor de la variable js para ir luego al metodo eliminar
            success: function(data){
//                alert(data);
                $('#p_' + idProducto).remove();
//                   $('#c-' + id).remove();
//                   $('#mensaje_update').hide();
                   $('#mensaje_insert').html('<br><span><font color="green"><b>Se ha eliminado correctamente la categoría seleccionada</b></font></span>');
                   },
            
            error:function (xhr, ajaxoptions, thrownError) {
                alert (xhr.status);
                alert (thrownError);
            },
    });
}
    </script>

<head>
	<title>Mis productos</title>
</head>
<body>
   <!--<div id="mensaje_insert"> </div>-->
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
        <thead>
            <tr>
                <th></th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>CATEGORIA</th>
                <th>EL ARTÍCULO ES...</th>
                <th>CONSULTAS</th>
                <th colspan=2>ACCIONES</th>
            </tr>
        </thead>
                
        <?php foreach ($this->productos as $producto) { ?>
            <tbody>
                <tr class="gradeA">
                    <td><a id="example6" href="<?php echo JURI::root();?>images/<?php echo $producto->nomf;?>" title="<?php echo $producto->descripcion;?>"><img width="115" height="90" alt="img" src="<?php echo JURI::root();?>images/<?php echo $producto->nomf;?>"/></a></td>
                    <td><?php echo $producto->name;?></td>
                    <td>$<?php echo $producto->precio;?></td>
                    <td><?php echo $producto->nombreCategoria;?></td>
                    <td><?php echo $producto->tipo;?></td>
                    <td><a href="index.php?option=com_registrado&task=responder&id=<?php echo $producto->idProd;?>"> <?php echo $producto->cont;?> </a></td>
                    <td><a href="javascript:eliminar('<?php echo $producto->idProd;?>')" onclick="return confirm ('Desea eliminar este producto: <?php echo $producto->nombre;?>')">Borrar</a></td>
                    <td> <a href="index.php?option=com_ventas&task=modificarProducto&id=<?php echo $producto->idProd; ?>">Modificar</a></td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
</body>
</html>