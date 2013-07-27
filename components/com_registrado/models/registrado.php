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
	    $sql="select * from producto where id=$id";
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

/////////////////////////////////////////////////////////////

}
?>