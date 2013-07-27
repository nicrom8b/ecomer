<?php

class RegistradoController extends JControllerLegacy {
    
    public function display(){
        echo ("Esta es la componente registrado final"); 
    }

// MIS PRODUCTOS

    public function catalogar() {
        $user= JFactory::getUser();
            if (!$user->guest) {
            $id=$user->id;
            $view=$this->getView('misproductos','html');
            $model=$this->getModel('registrado');
            $producto=$model->getListadoProducto($id);
            $view->assignRef('productos',$producto);
            // var_dump($producto);
            // break;
            $view->display(); }
                else {
                    $app = JFactory::getApplication();
                    $link = 'index.php';
                    $msg = 'USTED NO ES UN USUARIO REGISTRADO';
                    $app->redirect($link, $msg, $msgType='message');
                }
        }

// RESPUESTA PRODUCTO

    public function responder(){
        $user= JFactory::getUser();
        if (!$user->guest) {
            // $id=$user->id;
            $view=$this->getView('respuestaproducto','html');
            $id=JRequest::getInt('id');
            $model=$this->getModel('registrado');
            $producto=$model->getProducto($id);
            $view->assignRef('producto',$producto);
            $consultas=$model->getConsultas($id);
            $view->assignRef('consultas', $consultas);
            $view->display(); }
            else {
                $app = JFactory::getApplication();
                $link = 'index.php';
                $msg = 'USTED NO ES UN USUARIO REGISTRADO';
                $app->redirect($link, $msg, $msgType='message');
            }
        }
    

    public function guardarRespuesta(){
        $user= JFactory::getUser();
        if (!$user->guest) {   
             $idUser=$user->id;
             $idProducto= JRequest::getInt('idProducto');
             $idConsulta= JRequest::getInt('idConsulta');
             $respuesta = JRequest::getString('respuesta');
             $model=$this->getModel('registrado');
             $model->cargarRespuesta($idConsulta,$respuesta);
             $app = JFactory::getApplication();
             // $link='index.php?option=com_registradofinal&task=catalogar'
             $link = 'index.php?option=com_registrado&task=responder&id='.$idProducto;
             $msg = 'Se guardo su respuesta con exito!!';
             $app->redirect($link, $msg, $msgType='message');
             }else {
                 $app = JFactory::getApplication();
                $link = 'index.php';
                $msg = 'Debe loguearse!';
                $app->redirect($link, $msg, $msgType='message');
            }
    }

}

?>