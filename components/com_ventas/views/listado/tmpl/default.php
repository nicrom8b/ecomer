<!DOCTYPE html>
<html lang="en">
<head>
   
  <link rel="stylesheet" href="http://localhost/Joomla2.5/templates/dd_thebrand_17/css/tablas.css" type="text/css" />
 <script src="libraries/js/jquery-1.9.0.js" type="text/javascript"> </script>



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
            }
    });
}
    </script>
</head>

<body>
    <div id="mensaje_insert"> </div>
    <table id="rounded-corner">
      
        <thead> 
    <tr>
        <th>nombre</th>
        <th>descripcion</th>
        <th>precio</th>
        <th>cantidad</th>
        <th> </th>
        <th> </th>
        
    </tr>
        </thead>
   
   


<?php
defined('_JEXEC')or die;
foreach($this->productos as $producto) { ?>
        <tbody>
<tr id="p_<?php echo $producto->id;?>">
    <td> <?php echo $producto->nombre; ?> </td>
    <td> <?php echo $producto->descripcion; ?> </td>
    <td> <?php echo $producto->precio; ?> </td>
    <td> <?php echo $producto->cantidad; ?> </td>
    <td> <a href="javascript:eliminar(<?echo $producto->id;?>)" 
            onclick="return confirm('Desea eliminar el producto <?php echo $producto->nombre;?>')">Borrar</a></td>
    
    <td> <a href="index.php?option=com_ventas&task=modificarProducto&id=<?echo $producto->id; ?>">Modificar</a></td>
</tr>
        </tbody> 
<?php } ?>

</table>
    
</body>
</html>