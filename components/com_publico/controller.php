<?php

class PublicoController extends JControllerLegacy {
    
    
    public function display(){
        
        echo ("Esta la componente publica final"); 

    }

    public function catalogoProducto(){
        $view=$this->getView('catalogoproducto','html');
        $model=$this->getModel('publico'); //instanciamos el modelo.. listad.php.
        $productos=$model->getCatalogarProducto(); //llama a model y ahi a getLisstado blabla..
        $view->assignRef('productos',$productos);
      //los asigna a una cadena, en la vista se convierte en una variable q para mostrar debere recorrer con un foreach-. (en default.php)
       
        $view->display();
   }

   public function categoriaProducto(){
      //$view=$this->getView('categoriaProducto','html');
      $view=$this->getView('categoriaproducto','html');
      $idCategoria=JRequest::getInt('id');
      $model=$this->getModel('publico');
      $productos=$model->getCategoriaProducto($idCategoria); //Retorna los productos de una categoria
      if (empty($productos)) {
          $app = JFactory::getApplication();
          $link = 'index.php';
          $msg = 'La categoría no contiene productos';
          $app->redirect($link, $msg, $msgType='message');
        
      }else{
          $view->assignRef('productos',$productos);
          $view->display();
            }
   }

    public function detalleProducto(){
        $view=$this->getView('detalleproducto','html');
         $id=JRequest::getInt('id');
         $model=$this->getModel('publico');
         $producto=$model->getProducto($id);
         $view->assignRef('productos',$producto);
         $consultas=$model->getConsultas($id);  //Busca las consultas y respuestas asociadas a cada producto.
         $view->assignRef('consultas', $consultas);
         $foto=$model->getFoto($id); //Busca las fotos del producto.
         $view->assignRef('foto',$foto);
         $view->display();
   }

    public function guardarMensajes(){
     $user= JFactory::getUser();
     if (!$user->guest) {
         $idUser=$user->id;
         $idProducto= JRequest::getInt('idProducto');
         $consulta= JRequest::getString('consulta');
         $model=$this->getModel('publico');
         $model->cargarConsulta($idUser,$idProducto,$consulta);
         
           $app = JFactory::getApplication();
           $link = 'index.php?option=com_publico&task=detalleProducto&id='.$idProducto;
           $msg = 'Su consulta fue realizada con exito!!';
           $app->redirect($link, $msg, $msgType='message');
         
     }else {
          $app = JFactory::getApplication();
          $link = 'index.php';
          $msg = 'Debe loguearse.';
          $app->redirect($link, $msg, $msgType='message');
            }
    }

  
}   
?>
