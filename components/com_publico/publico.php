<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_ventas
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.5
 */

defined('_JEXEC') or die;
//trabaja con la parte de seguridad de joomla. Ningun usuario puede usar el script php a menos q tenga nivel de usuario. Si no esta definido muere xD

//require_once JPATH_COMPONENT.'/helpers/route.php';
//nuestras aplicaciones pueden o no usar helpers

// Launch the controller. Lanza el controllador, es lo 1ro que ejcta.
$controller = JControllerLegacy::getInstance('Publico'); //JCl esuna clase q ya viene en la arq de joomla. 
$controller->execute(JRequest::getCmd('task', 'display')); //es una definicion de tarea :task. 
$controller->redirect(); 
