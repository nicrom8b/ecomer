<?php
/**
 * @version    $Id: default.php 882 2013-01-07 11:53:44Z dhorsfall $
 * @package    hwdMediaShare
 * @copyright  Copyright (C) 2007 - 2011 Highwood Design Limited. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 * @author     Dave Horsfall
 * @since      15-Apr-2011 10:13:15
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.modal');
JHtml::_('behavior.framework', true);
JHtml::_('behavior.tooltip');

$user = JFactory::getUser();
$canEdit = ($user->authorise('core.edit', 'com_hwdmediashare.media.'.$this->item->id) || ($user->authorise('core.edit.own', 'com_hwdmediashare.media.'.$this->item->id) && ($this->item->created_user_id == $user->id)));
$canEditState = $user->authorise('core.edit.state', 'com_hwdmediashare.media.'.$this->item->id);
$canDelete = ($user->authorise('core.delete', 'com_hwdmediashare.media.'.$this->item->id) || ($user->authorise('core.edit.own', 'com_hwdmediashare.media.'.$this->item->id) && ($this->item->created_user_id == $user->id)));
$hasDownloads = $this->hasDownloads();
$hasQualities = $this->hasQualities();
$hasMeta = $this->hasMeta();
?>
<div id="hwd-container"> <a name="top" id="top" title="top"></a> <?php echo hwdMediaShareHelperNavigation::getInternalNavigation(); ?>
  <!-- Media Header -->
  <div class="media-header">
    <?php if ($this->params->get('mediaitem_meta_title') != 'hide') : ?><div class="page-header"><h2><?php echo $this->escape($this->item->title); ?></h2></div><?php endif; ?>
    <?php if ($this->params->get('enable_subscriptions') && $this->params->get('mediaitem_subscribe_button') != 'hide' && $this->item->created_user_id != 0) : ?>
    <div class="media-details pull-left">
      <?php if ($this->item->subscribed) : ?>
      <form action="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=user.unsubscribe&id=' . $this->item->created_user_id . '&return=' . $this->return . '&tmpl=component'); ?>" method="post" id="media-subscribe-form" class="form-inline">
        <a href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getUserRoute($this->item->created_user_id)); ?>"><?php echo $this->escape($this->item->author); ?></a>
        <input class="btn" type="submit" value="<?php echo JText::_('COM_HWDMS_UNSUBSCRIBE'); ?>" id="media-unsubscribe" />
        <input class="btn" type="submit" value="<?php echo JText::_('COM_HWDMS_SUBSCRIBE'); ?>" id="media-subscribe" style="display:none;"/>
        <span id="media-subscribe-loading"></span>
      </form>
      <?php else : ?>
      <form action="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=user.subscribe&id=' . $this->item->created_user_id . '&return=' . $this->return . '&tmpl=component'); ?>" method="post" id="media-subscribe-form">
        <a href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getUserRoute($this->item->created_user_id)); ?>"><?php echo $this->escape($this->item->author); ?></a>
        <input class="btn" type="submit" value="<?php echo JText::_('COM_HWDMS_SUBSCRIBE'); ?>" id="media-subscribe" />
        <input class="btn" type="submit" value="<?php echo JText::_('COM_HWDMS_UNSUBSCRIBE'); ?>" id="media-unsubscribe" style="display:none;" />
        <span id="media-subscribe-loading"></span>
      </form>
      <?php endif; ?>
    </div>
    <?php endif; ?>
    <?php if ($this->params->get('mediaitem_navigation') != 'hide') : ?>
    <div class="btn-group pull-right">
      <?php if (isset($this->item->navigation->prev->id)) :
        $tip = '<img src="'.JRoute::_(hwdMediaShareDownloads::thumbnail($this->item->navigation->prev)).'" border="0" alt="'.$this->escape($this->item->navigation->prev->title).'" style="max-width:100%;" />'; ?>
        <a href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getMediaItemRoute($this->item->navigation->prev->id)); ?>" class="btn"> <i class="icon-arrow-left"></i> <span class="editlinktip hasTip" title="<?php echo $this->escape($this->item->navigation->prev->title); ?>::<?php echo $this->escape(strip_tags($tip, '<img>,<br>')); ?>"><?php echo JText::_('JPREV'); ?> </span> </a>
      <?php else : ?>
        <a href="#" class="btn btn-disabled"> <i class="icon-arrow-left"></i> <span class="editlinktip hasTip" title="::<?php echo JText::_('COM_HWDMS_NO_PREVIOUS_MEDIA'); ?>"><?php echo JText::_('JPREV'); ?></span> </a>
      <?php endif; ?>
      <a href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&view=slideshow&id=' . $this->item->id . '&tmpl=component&return=' . $this->return); ?>" class="btn"> <i class="icon-search"></i> <?php echo JText::_('COM_HWDMS_ZOOM'); ?></a>
      <?php if (isset($this->item->navigation->next->id)) :
        $tip = '<img src="'.JRoute::_(hwdMediaShareDownloads::thumbnail($this->item->navigation->next)).'" border="0" alt="'.$this->escape($this->item->navigation->next->title).'" style="max-width:100%;" />'; ?>
        <a href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getMediaItemRoute($this->item->navigation->next->id)); ?>" class="btn"> <span class="editlinktip hasTip" title="<?php echo $this->escape($this->item->navigation->next->title); ?>::<?php echo $this->escape(strip_tags($tip, '<img>,<br>')); ?>" > <i class="icon-arrow-right"></i> <?php echo JText::_('JNEXT'); ?> </span> </a>
      <?php else : ?>
        <a href="#" class="btn btn-disabled"> <span class="editlinktip hasTip pagenav-disabled pagenav-next" title="::<?php echo JText::_('COM_HWDMS_NO_NEXT_MEDIA'); ?>"><?php echo JText::_('JNEXT'); ?></span> </a>
      <?php endif; ?>
      <?php if ($canEdit || $canEditState || $canDelete || $hasMeta || $hasDownloads) : ?>
      <a href="#" class="btn dropdown-toggle" data-toggle="dropdown"> <i class="icon-arrow-down"></i> &nbsp; <span class="caret"></span> </a>
      <ul class="dropdown-menu">
        <?php if ($canEdit) : ?>
        <li><?php echo JHtml::_('hwdicon.edit', 'media', $this->item, $this->params); ?></li>
        <?php endif; ?>
        <?php if ($canEditState) : ?>
        <?php if ($this->item->published != '1') : ?>
        <li><?php echo JHtml::_('hwdicon.publish', 'media', $this->item, $this->params); ?></li>
        <?php else : ?>
        <li><?php echo JHtml::_('hwdicon.unpublish', 'media', $this->item, $this->params); ?></li>
        <?php endif; ?>
        <?php endif; ?>
        <?php if ($canDelete) : ?>
        <li><?php echo JHtml::_('hwdicon.delete', 'media', $this->item, $this->params); ?></li>
        <?php endif; ?>
        <?php if ($hasMeta): ?>
        <li><a href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=mediaform.meta&id=' . $this->item->id . '&return=' . $this->return . '&tmpl=component'); ?>" class="pagenav-meta modal" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize(); ?>}}"><?php echo JText::_('COM_HWDMS_VIEW_META_DATA'); ?></a></li>
        <?php endif; ?>
        <?php if ($hasDownloads): ?>
        <li><a href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=mediaform.download&id=' . $this->item->id . '&return=' . $this->return . '&tmpl=component'); ?>" class="pagenav-sizes modal" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize(); ?>}}"><?php echo JText::_('COM_HWDMS_VIEW_ALL_SIZES'); ?></a></li>
        <?php endif; ?>
      </ul>
      <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="clear"></div>
  </div>
  <div id="media-item-container" class="media-item-container">
    <!-- Item Media -->
    <div class="media-item-full" id="media-item" style="width:100%;">
    <?php echo hwdMediaShareMedia::get($this->item); ?>
    </div>
    <!-- Item Meta -->
    <div class="media-info-container">
      <?php if ($this->params->get('mediaitem_meta_hits') != 'hide') : ?><div class="media-count"><?php echo (int) $this->item->hits; ?></div><?php endif; ?>
      <?php if ($this->params->get('mediaitem_meta_author') != 'hide') : ?><div class="media-maker"> <?php echo JText::sprintf('COM_HWDMS_CREATED_BY', '<a href="'.JRoute::_(hwdMediaShareHelperRoute::getUserRoute($this->item->created_user_id)).'">'.htmlspecialchars($this->item->author, ENT_COMPAT, 'UTF-8').'</a>'); ?> </div><?php endif; ?>
      <?php if ($this->params->get('mediaitem_meta_created') != 'hide') : ?><div class="media-date"> <?php echo JText::sprintf('COM_HWDMS_CREATED_ON', JHtml::_('date', $this->item->created, $this->params->get('list_date_format'))); ?> </div><?php endif; ?>
      <?php if ($this->params->get('mediaitem_meta_likes') != 'hide') : ?><div class="media-rating-stats"><?php echo JText::sprintf('COM_HWDMS_XLIKES', '<span id="media-likes">'.$this->item->likes.'</span>'); ?>, <?php echo JText::sprintf('COM_HWDMS_XDISLIKES', '<span id="media-dislikes">'.$this->item->dislikes.'</span>'); ?></div><?php endif; ?>
      <div class="clear"></div>
    </div>
    <!-- Media Actions -->
    <div class="btn-group pull-left">
        <?php if ($this->params->get('mediaitem_like_button') != 'hide') : ?>
          <a title="<?php echo JText::_('COM_HWDMS_LIKE'); ?>" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=mediaitem.like&id=' . $this->item->id . '&return=' . $this->return . '&tmpl=component'); ?>" class="btn" id="media-like-link"> <i class="icon-ok"></i> <?php echo JText::_('COM_HWDMS_LIKE'); ?> </a> 
          <a title="<?php echo JText::_('COM_HWDMS_DISLIKE'); ?>" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=mediaitem.dislike&id=' . $this->item->id . '&return=' . $this->return . '&tmpl=component'); ?>" class="btn" id="media-dislike-link"> <i class="icon-remove"></i> <?php echo JText::_('COM_HWDMS_DISLIKE'); ?> </a>
        <?php endif; ?>
        <?php if ($this->params->get('mediaitem_favourite_button') != 'hide') : ?>
          <?php if ($this->item->favoured) : ?>
            <a title="<?php echo JText::_('COM_HWDMS_FAVOURITE'); ?>" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=mediaitem.unfavour&id=' . $this->item->id . '&return=' . $this->return . '&tmpl=component'); ?>" class="btn active" id="media-favadd-link"> <i class="icon-heart"></i> <?php echo JText::_('COM_HWDMS_FAVOURITES'); ?> </a>
          <?php else : ?>
	    <a title="<?php echo JText::_('COM_HWDMS_FAVOURITE'); ?>" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=mediaitem.favour&id=' . $this->item->id . '&return=' . $this->return . '&tmpl=component'); ?>" class="btn" id="media-fav-link"> <i class="icon-heart"></i> <?php echo JText::_('COM_HWDMS_FAVOURITES'); ?> </a>
          <?php endif; ?>
        <?php endif; ?>
        <?php if (($this->params->get('enable_categories') || $this->params->get('enable_albums') || $this->params->get('enable_groups') || $this->params->get('enable_playlists')) && $this->params->get('mediaitem_add_button') != 'hide') : ?><a title="<?php echo JText::_('COM_HWDMS_ADD_TO'); ?>" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=mediaform.link&id=' . $this->item->id . '&return=' . $this->return . '&tmpl=component'); ?>" class="btn modal" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize(); ?>}}"> <i class="icon-plus"></i> <?php echo JText::_('COM_HWDMS_ADD_TO'); ?> </a><?php endif; ?>
        <?php if ($this->params->get('mediaitem_share_button') != 'hide') : ?><a title="<?php echo JText::_('COM_HWDMS_SHARE'); ?>" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=mediaform.share&id=' . $this->item->id . '&return=' . $this->return . '&tmpl=component'); ?>" class="btn modal" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize(); ?>}}"> <i class="icon-share"></i> <?php echo JText::_('COM_HWDMS_SHARE'); ?></a><?php endif; ?>
        <?php if ($this->params->get('mediaitem_report_button') != 'hide') : ?><a title="<?php echo JText::_('COM_HWDMS_REPORT'); ?>" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=mediaform.report&id=' . $this->item->id . '&return=' . $this->return . '&tmpl=component'); ?>" class="btn modal" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize(); ?>}}"> <i class="icon-exclamation-sign"></i> <?php echo JText::_('COM_HWDMS_REPORT'); ?></a><?php endif; ?>
        <?php if ($this->params->get('mediaitem_download_button') != 'hide' && $hasDownloads): ?>
	  <a title="<?php echo JText::_('COM_HWDMS_DOWNLOAD'); ?>" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=mediaform.download&id=' . $this->item->id . '&return=' . $this->return . '&tmpl=component'); ?>" class="btn modal" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize(); ?>}}"> <i class="icon-download"></i> <?php echo JText::_('COM_HWDMS_DOWNLOAD'); ?></a>
        <?php endif; ?>
        <?php if ($this->params->get('mediaitem_quality_button') != 'hide' && $hasQualities): ?>
          <a title="<?php echo JText::_('COM_HWDMS_QUALITY'); ?>" href="javascript:void(0)" data-toggle="dropdown" class="btn dropdown-toggle"> <i class="icon-cog"></i> <?php echo JText::_('COM_HWDMS_QUALITY'); ?> <?php echo (JRequest::getInt('quality') > 0 ? ' ('.JRequest::getInt('quality').'p)' : ''); ?> <span class="caret"></span> </a>
          <ul class="dropdown-menu">
            <li<?php echo (JRequest::getInt('quality') == 240 ? ' class="active"' : ''); ?>><a href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getMediaItemRoute($this->item->id, array('quality'=>'240'))); ?>"><?php echo JText::_('COM_HWDMS_240P'); ?></a></li>
            <li<?php echo (JRequest::getInt('quality') == 240 ? ' class="active"' : ''); ?>><a href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getMediaItemRoute($this->item->id, array('quality'=>'360'))); ?>"><?php echo JText::_('COM_HWDMS_360P'); ?></a></li>
            <li<?php echo (JRequest::getInt('quality') == 240 ? ' class="active"' : ''); ?>><a href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getMediaItemRoute($this->item->id, array('quality'=>'480'))); ?>"><?php echo JText::_('COM_HWDMS_480P'); ?></a></li>
            <li<?php echo (JRequest::getInt('quality') == 240 ? ' class="active"' : ''); ?>><a href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getMediaItemRoute($this->item->id, array('quality'=>'720'))); ?>"><?php echo JText::_('COM_HWDMS_720P'); ?></a></li>
            <li<?php echo (JRequest::getInt('quality') == 240 ? ' class="active"' : ''); ?>><a href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getMediaItemRoute($this->item->id, array('quality'=>'1080'))); ?>"><?php echo JText::_('COM_HWDMS_1080P'); ?></a></li>
          </ul>                        
        <?php endif; ?>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <!-- Tabs -->
    <?php if ($this->params->get('mediaitem_description_tab') != 'hide' || $this->params->get('mediaitem_related_tab') != 'hide' || $this->params->get('mediaitem_location_tab') != 'hide' || $this->params->get('mediaitem_tags_tab') != 'hide' || $this->params->get('mediaitem_associations_tab') != 'hide') : ?>
    <?php echo JHtml::_('tabs.start', 'pane'); ?>
      <?php if ($this->params->get('mediaitem_description_tab') != 'hide' && !empty($this->item->description)) : ?>
        <?php echo JHtml::_('tabs.panel', JText::_('COM_HWDMS_DESCRIPTION'), 'description'); ?>
          <?php echo JHtml::_('content.prepare',$this->item->description); ?>
          <div class="clear"></div>
      <?php endif; ?>
      <?php if ($this->params->get('mediaitem_related_tab') != 'hide' && count($this->related) > 0) : ?>
        <?php echo JHtml::_('tabs.panel', JText::_('COM_HWDMS_RELATED'), 'related'); ?>
          <?php echo $this->loadTemplate('related'); ?>
          <p class="readmore">
            <a class="modal" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize('large'); ?>}}" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=search.search&searchphrase=any&areas[0]=media&searchword='.urlencode($this->searchword).'&tmpl=component&layout=related'); ?>">
              <?php echo JText::_('COM_HWDMS_VIEW_ALL'); ?>
            </a>
          </p>
          <div class="clear"></div>
      <?php endif; ?>
      <?php if ($this->params->get('mediaitem_location_tab') != 'hide' && !empty($this->item->location)) : ?>
        <?php echo JHtml::_('tabs.panel', '<div id="paneMap">'.JText::_('COM_HWDMS_LOCATION').'</div>', 'map'); ?>
          <?php echo ($this->item->map); ?>
          <div class="clear"></div>
      <?php endif; ?>
      <?php if ($this->params->get('mediaitem_tags_tab') != 'hide' && !empty($this->item->tags)) : ?>
        <?php echo JHtml::_('tabs.panel', JText::_('COM_HWDMS_TAGS'), 'tags'); ?>
          <ul class="media-tags">
            <?php foreach ($this->item->tags as $id => &$tag) : ?>
              <li><a href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getMediaRoute(array('filter_tag'=>$tag->tag))); ?>"><?php echo $this->escape($tag->tag); ?></a></li>
            <?php endforeach; ?>
          </ul>
          <div class="clear"></div>
      <?php endif; ?>        
      <?php if ($this->params->get('mediaitem_associations_tab') != 'hide') : ?>
        <?php echo JHtml::_('tabs.panel', JText::_('COM_HWDMS_ASSOCIATIONS'), 'associations'); ?>
          <dl class="article-info">
            <dt class="article-info-term"><?php echo JText::_('COM_HWDMS_DETAILS'); ?> </dt>
            <dd class="media-createdby"> <?php echo JText::_('COM_HWDMS_USER_CHANNEL'); ?>: <?php echo $this->getChannel($this->item); ?></dd>
            <?php if ($this->params->get('enable_categories')): ?><dd class="media-category-name"> <?php echo JText::_('COM_HWDMS_CATEGORIES'); ?>: <?php echo $this->getCategories($this->item); ?></dd><?php endif; ?>
            <?php if ($this->params->get('enable_albums')): ?><dd class="media-album"> <?php echo JText::_('COM_HWDMS_ALBUMS'); ?>: <?php echo $this->getLinkedAlbums($this->item); ?></dd><?php endif; ?>
            <?php if ($this->params->get('enable_groups')): ?><dd class="media-group"> <?php echo JText::_('COM_HWDMS_GROUPS'); ?>: <?php echo $this->getLinkedGroups($this->item); ?></dd><?php endif; ?>
            <?php if ($this->params->get('enable_playlists')): ?><dd class="media-group"> <?php echo JText::_('COM_HWDMS_PLAYLISTS'); ?>: <?php echo $this->getLinkedPlaylists($this->item); ?></dd><?php endif; ?>
            <dd class="media-group"> <?php echo JText::_('COM_HWDMS_OTHER_MEDIA'); ?>: <?php echo $this->getLinkedMedia($this->item); ?></dd>
            <dd class="media-group"> <?php echo JText::_('COM_HWDMS_OTHER_PAGES'); ?>: <?php echo $this->getLinkedPages($this->item); ?></dd>        
          </dl>
          <div class="clear"></div>
      <?php endif; ?>        
    <?php echo JHtml::_('tabs.end'); ?>
    <?php endif; ?>
    <div class="clear"></div>
    <dl class="media-article-info">
        <?php foreach ($this->item->customfields['fields'] as $group => $groupFields) : ?>
          <dt class="media-article-info-term"><?php echo JText::_( $group ); ?></dt>
          <?php foreach ($groupFields as $field) :
          $field	= JArrayHelper::toObject ( $field );
          $field->value = $this->escape( $field->value );
          $value = $this->getCustomFieldData($field); ?>
            <?php if (!empty($value)) : ?>
            <dd class="media-createdby" title="" class="hasTip" for="jform_<?php echo $field->id;?>" id="jform_<?php echo $field->id;?>-lbl">
              <?php echo JText::_( $field->name );?>: <strong><?php echo $value; ?></strong>
            </dd>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endforeach; ?>
    </dl>
    <div class="clear"></div>
    <?php if ($this->params->get('mediaitem_activity') != 'hide') : ?>
    <form action="<?php echo JRoute::_('index.php?option=com_hwdmediashare'); ?>" method="post">
    <!-- Comments -->
    <div class="media-comments">
    <h3><?php echo JText::_('COM_HWDMS_ACTIVITY'); ?></h3>
    <?php if ($this->params->get('commenting') == 1) : ?>
    <div class="categories-list">
      <ul class="category-module">
        <li class="">
          <div class="category-desc">
            <fieldset>
              <!--<legend><strong><?php echo JText::_('COM_HWDMS_WRITE_A_COMMENT'); ?></strong></legend>-->
              <a class="image-left" href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getUserRoute($this->item->created_user_id)); ?>"><img border="0" src="<?php echo JRoute::_($this->utilities->getAvatar(JFactory::getUser($this->item->created_user_id))); ?>" class="avatar-small" /></a>
              <div><textarea class="required" rows="10" cols="50" id="jform_comment" name="jform[comment]" required="required" style="width:350px; margin-bottom:10px; height: 50px;"></textarea></div>
              <div class="clear"></div>
              <?php echo $this->getRecaptcha(); ?>
              <input class="button" type="submit" value="<?php echo JText::_('COM_HWDMS_ADD_COMMENT'); ?>" />
              <input type="hidden" name="task" value="activity.comment" />
              <input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
              <input type="hidden" name="element_type" value="1" />
              <input type="hidden" name="return" value="<?php echo $this->return; ?>" />
            </fieldset>
            <div class="clear"></div>
          </div>
        </li>
      </ul>
    </div>
    <?php endif; ?>
    <div class="categories-list"> <?php echo $this->getActivities($this->item->activities); ?> </div>
    </div>
    </form>
    <?php endif; ?>
    <?php if ($this->params->get('commenting') != 1) : ?>
    <?php echo $this->getComments($this->item); ?>
    <?php endif; ?>
  </div>
  <div class="clear"></div>
  <!-- Clears Top Link -->
  <div class="clear"></div>
  <a class="media-tos" href="<?php echo htmlspecialchars(JFactory::getURI()->toString()); ?>#top">Back to Top</a> </div>
<div class="clear"></div>