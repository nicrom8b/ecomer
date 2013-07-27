<?php
/**
 * @version    SVN $Id: default_activities.php 882 2013-01-07 11:53:44Z dhorsfall $
 * @package    hwdMediaShare
 * @copyright  Copyright (C) 2011 Highwood Design Limited. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 * @author     Dave Horsfall
 * @since      15-Dec-2011 10:08:09
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$this->items = $this->activities;
$this->view_item = 'activity';  
$this->elementType = 3;
$this->elementName = 'Activity';

?>
<div class="categories-list"> 
	<?php echo $this->getActivities($this->items); ?> 
</div>