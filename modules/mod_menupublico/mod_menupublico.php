<?php
//don't allow other scripts to grab and execute our file
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
  
//This is the parameter we get from our xml file above
$categoriesCount = $params->get('categoriescount');
  
// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';
  
//Returns the path of the layout file
require JModuleHelper::getLayoutPath('mod_menupublico', $params->get('layout', 'default'));
?>