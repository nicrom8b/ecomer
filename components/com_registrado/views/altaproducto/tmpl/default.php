<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Producto</title>
    
    
    <script type="text/javascript">
var numero = 0; //Esta es una variable de control para mantener nombres
            //diferentes de cada campo creado dinamicamente.
evento = function (evt) { //esta funcion nos devuelve el tipo de evento disparado
   return (!evt) ? event : evt;
}

//Aqui se hace lamagia... jejeje, esta funcion crea dinamicamente los nuevos campos file
addCampo = function () { 
//Creamos un nuevo div para que contenga el nuevo campo
   nDiv = document.createElement('div');
//con esto se establece la clase de la div
   nDiv.className = 'archivo';
//este es el id de la div, aqui la utilidad de la variable numero
//nos permite darle un id unico
   nDiv.id = 'file' + (++numero);
//creamos el input para el formulario:
   nCampo = document.createElement('input');
//le damos un nombre, es importante que lo nombren como vector, pues todos los campos
//compartiran el nombre en un arreglo, asi es mas facil procesar posteriormente con php
   nCampo.name = 'archivos[]';
//Establecemos el tipo de campo
   nCampo.type = 'file';
//Ahora creamos un link para poder eliminar un campo que ya no deseemos
   a = document.createElement('a');
//El link debe tener el mismo nombre de la div padre, para efectos de localizarla y eliminarla
   a.name = nDiv.id;
//Este link no debe ir a ningun lado
   a.href = '#';
//Establecemos que dispare esta funcion en click
   a.onclick = elimCamp;
//Con esto ponemos el texto del link
   a.innerHTML = 'Eliminar';
//Bien es el momento de integrar lo que hemos creado al documento,
//primero usamos la función appendChild para adicionar el campo file nuevo
   nDiv.appendChild(nCampo);
//Adicionamos el Link
   nDiv.appendChild(a);
//Ahora si recuerdan, en el html hay una div cuyo id es 'adjuntos', bien
//con esta función obtenemos una referencia a ella para usar de nuevo appendChild
//y adicionar la div que hemos creado, la cual contiene el campo file con su link de eliminación:
   container = document.getElementById('adjuntos');
   container.appendChild(nDiv);
}
//con esta función eliminamos el campo cuyo link de eliminación sea presionado
elimCamp = function (evt){
   evt = evento(evt);
   nCampo = rObj(evt);
   div = document.getElementById(nCampo.name);
   div.parentNode.removeChild(div);
}
//con esta función recuperamos una instancia del objeto que disparo el evento
rObj = function (evt) { 
   return evt.srcElement ?  evt.srcElement : evt.target;
}

</script>

</head>
<?php defined('_JEXEC') or die;  ?>
<body>
	<fieldset id="contmiformu">
        <legend>Producto:</legend>
        <form id="miformu" action="<?php echo JRoute::_('index.php?option=com_registrado&task=cargarProducto');?>" method="post" enctype="multipart/form-data">
            <!-- inputs y label -->
        <p><label><span>Nombre:</span> <input type="text" id="nombre" name="nombre" placeholder="Nombre del producto" required="required" autofocus ></label></p>
        <p><label><span>Precio:</span> <input type="text" id="precio" name="precio" placeholder="Precio del producto" required="required"  ></label></p>
        <p><label><span>Cantidad:</span> <input type="text" id="cantidad" name="cantidad" placeholder="cantidad" required="required" ></label></p>
        <p><label><span>Descripcion:</span> <textarea id="descripcion" name="descripcion" placeholder="Escribe aquí" cols="17" rows="5" maxlength="256"></textarea></label></p>
        
        Tipo: <br>
                 <input type="radio" name="tipo" value="usado"> usado
                 <input type="radio" name="tipo" value="nuevo"> nuevo <br>
          
        Categoria:
        <select name="Categoria"> 

          <?php 
           
             defined('_JEXEC')or die;
             foreach($this->categorias as $categoria) {
                 echo "(<option value='$categoria->id'>$categoria->nombre</option>)";
                 
             }
            
        ?>   
                         
                         
                         
        </select>
      
         
        <p><label class="label"><span>Fotografia</span><input type="file" name="fotografia"></p>
         
         
       <!-- Botón de enviar -->
       <button class="button" type="submit"> Guardar </button>
       
        </form>
        </fieldset>
    
</body>
</html>

<?php


?>

