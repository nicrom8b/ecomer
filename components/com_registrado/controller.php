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


// ALTA PRODUCTO 

 public function altaProducto() {
        
         
         $user=  JFactory::getUser();
       
         if (!$user->guest) {
             
         $view=$this->getView('altaproducto','html');
         $model=$this->getModel('registrado');
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
        $model=$this->getModel('registrado');
        
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
             $link = 'index.php?option=com_registrado&task=catalogar';
             $msg = 'Producto guardado con exito =D!!'; 
             $app->redirect($link, $msg, $msgType='message'); 
    }


    public function exportarExel(){

       
        /** Error reporting */
    // error_reporting(E_ALL);

    /** Include path **/
    // ini_set('include_path', ini_get('include_path').';../Classes/');
    require_once JPATH_LIBRARIES . '/PHPExcel/library/PHPExcel.php';
// jimport('phpexcel.library.PHPExcel');
        /** PHPExcel */
    include '/ecomer/libraries/PHPExcel/library/PHPExcel.php';

    /** PHPExcel_Writer_Excel2007 */
    include '/ecomer/libraries/PHPExcel/library/PHPExcel/Writer/Excel2007.php';

    // Create new PHPExcel object
    echo date('H:i:s') . " Create new PHPExcel object\n";
    $objPHPExcel = new PHPExcel();

    // Set properties
    echo date('H:i:s') . " Set properties\n";
    $objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
    $objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
    $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
    $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
    $objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");


    // Add some data
    echo date('H:i:s') . " Add some data\n";
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Hello');
    $objPHPExcel->getActiveSheet()->SetCellValue('B2', 'world!');
    $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Hello');
    $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'world!');

    // Rename sheet
    echo date('H:i:s') . " Rename sheet\n";
    $objPHPExcel->getActiveSheet()->setTitle('Simple');

        
    // // Save Excel 2007 file
    // echo date('H:i:s') . " Write to Excel2007 format\n";
    // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

    
    // $Excelsito= $objWriter->save(str_replace('.php', '.xlsx', "yorx"));


    // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
    // header('Content-Disposition: attachment;filename=$Excelsito');
    // header('Cache-Control: max-age=0');
    // // Echo done
    // echo date('H:i:s') . " Done writing file.\r\n";
// Save Excel5 file
        //echo date('H:i:s') , " Write to Excel5 format" , EOL;
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save(str_replace('.html', '.xls', __FILE__));

        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');

        // It will be called file.xls
        header('Content-Disposition: attachment; filename="file.xls"');

        // Write file to the browser
        $objWriter->save('php://output');
    }
}
?>