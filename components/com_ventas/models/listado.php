<?php

    defined('_JEXEC') or die;
    jimport('joomla.application.component.model');
    jimport('joomla.event.dispatcher');
    
    class VentasModellistado extends JModel{
        
        function getListadoProducto(){
            $db=  JFactory::getDbo(); //se conecta a la base de datos
            $sql='select * from producto'; //creo la variable estatica q solo tiene la consulta
            $db->setQuery($sql); //y aca la paso..para hacer la consulta en la tabla
            return $db->loadObjectList(); //retorna el objeto con la consulta.
        }
        
        function getListadoCategoria(){
            $db=  JFactory::getDbo();
            $sql='select * from categoria';
            $db->setQuery($sql);
        
            return $db->loadObjectList();
        }
        
        function cargarProducto($nombre,$precio,$cantidad,$descripcion,$categoria,$user,$tipo){
            $db=  JFactory::getDbo();
            $date=  date('y-m-d');

            $sql1="insert into producto values ('','$user','$nombre','$descripcion',$precio,$cantidad,'$date','$date','$tipo',$categoria)";
            $db->setQuery($sql1);
            
          
          
 
            if (!$db->query()){
                throw new Exception($db->getErrorMsg());
                 }
                 $ultimo=  mysql_insert_id();
                 return $ultimo;
        }
       
        function modificarproducto($id,$nombre,$precio,$cantidad,$descripcion,$categoria,$tipo){
            $db=  JFactory::getDbo();
            $date=  date('y-m-d');
            $sql= "update producto set nombre='$nombre', descripcion='$descripcion', precio=$precio, cantidad=$cantidad, modified='$date',tipo='$tipo', idCategoria=$categoria where id=$id";
            $db->setQuery($sql);  
            if (!$db->query()){
                throw new Exception($db->getErrorMsg());
                 }
        }
        
        function borrarProducto($id){
            $db=  JFactory::getDbo();
     
            $sql="delete from producto where id=$id";
            $db->setQuery($sql);
             if (!$db->query())
                {
                   throw new Exception($db->getErrorMsg());
                 }
            
        }
         function getProducto($id){
            $db=  JFactory::getDbo();
            $sql="select * from producto where id=$id";
            $db->setQuery($sql);
        
            return $db->loadObject();
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
