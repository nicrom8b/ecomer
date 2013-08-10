<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');
class RegistradoViewmisproductos extends JView{
    function display ($tpl=null) {
        parent::display($tpl);
        $document = JFactory::getDocument();
        $document->setName('report');
    }
}
?>