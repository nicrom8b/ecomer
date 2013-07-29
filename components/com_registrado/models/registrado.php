<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.model');
jimport('joomla.event.dispatcher');

class RegistradoModelregistrado extends JModel {

// MIS PRODUCTOS

	function getListadoProducto($id) {
		$db=  JFactory::getDbo(); 
        $sql="SELECT p .nombre AS name, precio, tipo, descripcion, p.id as idProd,
        categoria.nombre AS nombreCategoria, f.nombre as nomf,
        ( SELECT COUNT( c.idProducto ) FROM consulta c WHERE respuesta = ' ' AND c.idProducto = p.id ) AS cont 
        FROM producto p, categoria, foto f 
        WHERE p.idUsuario =$id and categoria.id = p.idCategoria AND p.id = f.id_producto";
        $db->setQuery($sql); 
        return $db->loadObjectList();
        }

//////////////////////////////////////////////////////////////////////

// CATÁLOGO PRODUCTO /////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////

// RESPUESTA PRODUCTO

    function getProducto($id){
	    $db=  JFactory::getDbo();
	    $sql="SELECT p.id AS identproducto, p.nombre AS nombreproducto, precio, descripcion, cantidad, tipo, f.nombre as nombrefoto from producto p, foto f where p.id=$id AND f.id_producto=$id";
	    $db->setQuery($sql);
	    return $db->loadObject();
        }

	function getConsultas($id){
            $db= JFactory::getDbo();
            $sql="select * from consulta where idProducto=$id";
            $db->setQuery($sql);
            return $db->loadObjectList();
        }

    function cargarRespuesta($idConsulta, $respuesta){
            $db= JFactory::getDbo();
            $sql= "update consulta set respuesta='$respuesta' where id=$idConsulta";
            $db->setQuery($sql);

            if (!$db->query()){
                throw new Exception($db->getErrorMsg());
            }
    }

//ALTA PRODUCTO
    function getListadoCategoria(){
            $db=  JFactory::getDbo();
            $sql='select * from categoria';
            $db->setQuery($sql);
        
            return $db->loadObjectList();
        }

      function cargarProducto($nombre,$precio,$cantidad,$descripcion,$categoria,$user,$tipo){
            $db=  JFactory::getDbo();
            $date=  date('y-m-d');
            $sql1="INSERT INTO producto VALUES ('','$user','$nombre','$descripcion',$precio,$cantidad,'$date','$date','$tipo',$categoria)";
            $db->setQuery($sql1);
            if (!$db->query()){
                throw new Exception($db->getErrorMsg());
                 }
            $ultimo=mysql_insert_id();
            return $ultimo;
        }

      function cargarFoto($id,$nombreFoto,$idProducto)
        {
            
            $db=  JFactory::getDbo();
            $date=  date('y-m-d');
            $sql="insert into foto values ($id,'$nombreFoto','','$date','$date',$idProducto)";
            $db->setQuery($sql);
            if (!$db->query()){
                throw new Exception($db->getErrorMsg());
                 }
            
        }

}
?>