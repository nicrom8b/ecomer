<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Modificar producto</title>
    <link rel="stylesheet" type="text/css" href="/Joomla2.5/templates/dd_thebrand_17/css/global.css">
</head>
<?php defined('_JEXEC') or die;  ?>
<body>
    <fieldset id="contmiformu">
        
        <form id="miformu" action="<?php echo JRoute::_('index.php?option=com_ventas&task=cargarProducto');?>" method="post" >
            <!-- inputs y label -->
        <input type="hidden" id="id" value="<?php echo $this->productos->id;?>"  name="id" >
        <p><label><span>Nombre:</span> <input type="text" id="nombre" value="<?php echo $this->productos->nombre; ?>" name="nombre" placeholder="Nombre del producto" required="required" autofocus ></label></p>
        <p><label><span>Precio:</span> <input type="text" id="precio" value="<?php echo $this->productos->precio; ?>" name="precio" placeholder="Precio del producto" required="required"  ></label></p>
        <p><label><span>Cantidad:</span> <input type="text" id="cantidad" value="<?php echo $this->productos->cantidad; ?>" name="cantidad" placeholder="cantidad" required="required" ></label></p>
        <p><label><span>Descripcion:</span> <textarea id="descripcion" name="descripcion" placeholder="Escribe aquí" cols="17" rows="5" maxlength="256"> <?php echo $this->productos->descripcion; ?> </textarea></label></p>
        
        Categoria:
        <select name="Categoria"> 

          <?php 
           
 
             
             foreach($this->categorias as $categoria) {
                if($categoria->id==$this->productos->idCategoria){
                    echo "(<option value='$categoria->id' selected>$categoria->nombre</option>)";
                } else {
                 echo "(<option value='$categoria->id'>$categoria->nombre</option>)";
                 
             }
             }
            
        ?>   
                         
                         
                         
        </select>
        <p><label><span>Fotografia</span><input type="file" name="fotografia" /></label> </p>
       <!-- Botón de enviar -->
       <button class="button" type="submit"> Guardar </button>
       
        </form>
        </fieldset>
    
</body>
</html>

<?php


?>

