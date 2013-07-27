<?php

    defined('_JEXEC') or die;
    jimport('joomla.application.component.model');
    jimport('joomla.event.dispatcher');
    
    class PublicoModelpublico extends JModel{
        
    function getCatalogarProducto() {
        $db=JFactory::getDbo(); //establece conexion  
        $sql="SELECT p.id AS ident, p.nombre AS name, precio, tipo, descripcion, categoria.nombre AS nombreCategoria , f.nombre as nomf FROM producto p, categoria, foto f WHERE categoria.id = p.idCategoria AND p.id = f.id_producto";
        $db->setQuery($sql);
        return $db->loadObjectList();  //retorna el listado de los productos
    }

    function getProducto($id){
        $db= JFactory::getDbo();
        $sql="select * from producto where id=$id";
        $db->setQuery($sql);
        return $db->loadObject();
    }

    function getFoto($id){
        $db=JFactory::getDbo();
        $sql= "select * from foto where id_producto=$id";
        $db->setQuery($sql);
        return $db->loadObject();
    }

    //MODELO-MENSAJES 

    function getConsultas($id){
        $db= JFactory::getDbo();
        $sql="select * from consulta where idProducto=$id";
        $db->setQuery($sql);
        return $db->loadObjectList();
        }

    function cargarConsulta($idUser,$idProducto,$consulta){
            $db=  JFactory::getDbo();
            $date=  date('y-m-d');
            $sql="insert into consulta values ('',$idProducto,'$consulta','$date',$idUser,'')";
            $db->setQuery($sql);

            if (!$db->query()){
                throw new Exception($db->getErrorMsg());
            }
            
        }

    function getCategoriaProducto($id){
        //retorna los productos perteneciente a una categoría.
        $db= JFactory::getDbo();
        $sql="SELECT p.id AS ident, p.nombre AS name, precio, tipo, descripcion, categoria.nombre AS nombreCategoria , f.nombre as nomf FROM producto p, categoria, foto f WHERE categoria.id = p.idCategoria AND p.id = f.id_producto AND p.idCategoria=$id";
        $db->setQuery($sql);
        return $db->loadObjectList();
    }
}
?>