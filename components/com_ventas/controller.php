<?php

class VentasController extends JControllerLegacy {
    
    
    public function display(){
        
        echo ("hola mundo"); 
    }
    
    public function listado(){
        $view=$this->getView('listado','html');
        $model=$this->getModel('listado'); //instanciamos el modelo.. listad.php.
        $productos=$model->getListadoProducto(); //llama a model y ahi a getLisstado blabla..
        $view->assignRef('productos',$productos); //los asigna a una cadena, en la vista se convierte en una variable q para mostrar debere recorrer con un foreach-. (en default.php)
        $view->display();
    }
    
     public function altaProducto() {
        
         
         $user=  JFactory::getUser();
       
         if (!$user->guest) {
             
         $view=$this->getView('alta','html');
         $model=$this->getModel('listado');
         $categorias=$model->getListadoCategoria();
         $view->assignRef('categorias',$categorias);
         $view->display();	
         
            }else {
          $app = JFactory::getApplication();
          $link = 'index.php';
          $msg = 'Debe loguearse!';
          $app->redirect($link, $msg, $msgType='message');
            }
      
    }
    
    public function cargarProducto(){
        $nombre=JRequest::getString('nombre');
        $precio=JRequest::getFloat('precio');
        $cantidad=JRequest::getInt('cantidad');
        $descripcion=  JRequest::getString('descripcion');
        $categoria=  JRequest::getInt('Categoria');
        
        $user=  JFactory::getUser();
        $tipo= JRequest::getString('tipo');
        $model=$this->getModel('listado');
        
         $idProducto=$model->cargarProducto($nombre,$precio,$cantidad,$descripcion,$categoria,$user->id,$tipo);
         
         
    
       if (isset($_FILES['fotografia'])) {
            $dir="images/";
            $idFoto= time();
            $nombreFichero=$idFoto."-".$_FILES['fotografia']['name'];
            if (move_uploaded_file($_FILES['fotografia']['tmp_name'],$dir.$nombreFichero)) {
                $model->cargarFoto($idFoto,$nombreFichero,$idProducto);
            }
            else {
                      $nombreFichero="fotoNoDisponible.jpg";
                      $idFoto=time();
                      $model->cargarFoto($idFoto,$nombreFichero,$idProducto);
                    }
        }
        
      
       
    
             
            
           
             $app = JFactory::getApplication();
            
           
             
             $link = 'index.php?option=com_ventas&task=listado';
             $msg = 'Producto guardado con exito =D!!'; 
             $app->redirect($link, $msg, $msgType='message');
       
        
         
    }
    
    public function borrarProducto(){
       
       $id=JRequest::getInt('id');
       $model=$this->getModel('listado');
       $model=$model->borrarProducto($id);
       
       $app=  JFactory::getApplication();
       $link='index.php?option=com_ventas&task=listado';
       $msg= 'Borrado';
       $app->redirect($link, $msg, $msgType='message');
      
      
    }
    
    public function modificarProducto(){
        $view=$this->getView('modificar','html');
        $id=JRequest::getInt('id');
        $model=$this->getModel('listado');
        $producto=$model->getProducto($id);
        $view->assignRef('productos',$producto);
        $categorias=$model->getListadoCategoria();
        $view->assignRef('categorias',$categorias);
        $view->display();
        
    }
    
          
    
}
?>