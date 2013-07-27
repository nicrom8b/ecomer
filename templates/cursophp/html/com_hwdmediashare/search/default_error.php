<?php
/**
 * @version    SVN $Id: default_error.php 882 2013-01-07 11:53:44Z dhorsfall $
 * @package    hwdMediaShare
 * @copyright  Copyright (C) 2011 Highwood Design Limited. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 * @author     Dave Horsfall
 * @since      25-Nov-2011 17:33:20
 */

// no direct access
defined('_JEXEC') or die;
?>

<?php if($this->error): ?>
<div class="alert alert-error">
<?php echo $this->escape($this->error); ?>
</div>
<?php endif; ?>
