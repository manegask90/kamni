<?php
/**
 * @package     mod_combo_news
 * @copyright   Wantweb (C) 2013 - 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later;
 
 * The module allows you to display articles from one or more categories in the view: 
 * - Blog (can be multiple columns) 
 * - Tabs 
 * - Accordion
 * Added additional filtering articles for tags. 
**/

defined('_JEXEC') or die;

$lessOn = true;
require_once __DIR__ . '/helper.php';

$list = ModComboNewsHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

if ($params->get('less_on')) {
  require_once __DIR__ . '/params.less.php';
}

jimport('joomla.filesystem.folder');
$imagesFolder = JPATH_SITE.'\cache\images_combo';

if (!JFolder::exists($imagesFolder) && $params->get('image')){
  JFolder::create( $path = $imagesFolder, $mode = 0755 );
}  
if ($params->get('include_css')) {
  jimport('joomla.filesystem.file');
  $document = JFactory::getDocument();
  $siteUrl = JURI::root(true);
  $rpsPath = $siteUrl.'/modules/mod_combo_news/css/mod_combo_news.css';
  $document->addStyleSheet($rpsPath);
}

require JModuleHelper::getLayoutPath('mod_combo_news', $params->get('layout', 'blog'));

?>