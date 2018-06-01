<?php
/** mod_combo_news - tabs */
defined('_JEXEC') or die;
$idMod = 'tablist'.$module->id;
$tabs_class = 'newsflash newsflash-tabs ';

if ($params->get('responsive_mode')) {
  $tabs_class .= $params->get('responsive_mode');
}
switch ($params->get('nav_position')) {
  case '1':
    $tabs_class .= ' top-tabs';
    break;
  case '2':
    $tabs_class .= ' tabs-left';
    break;
  case '3':
    $tabs_class .= ' tabs-right';
    break;
}
?>

<div class="<?php echo $tabs_class; ?>" id="<?php echo substr($params->get('layout'),2).$module->id; ?>">
<?php //Navigation ?>
  <ul id="<?php echo $idMod; ?>" class="<?php echo $params->get('tabs_style'); ?>">
    <?php for ($i = 0, $n = count($list); $i < $n; $i ++) :
      $item = $list[$i];
      $tabId = $idMod.'-a'.$i;
      $activeTab = '';
      if ($i == 0) {
        $activeTab = ' active';
      }
    ?>
      <li class="tbs<?php echo $activeTab; ?>">
        <a href="#<?php echo $tabId;?> " data-toggle="tab"><?php echo $item->title;?> </a>
      </li>
    <?php endfor; ?>
  </ul>
<?php //Content ?>
  <div class="tab-content">
  <?php for ($i = 0, $n = count($list); $i < $n; $i ++) {
    $item = $list[$i]; 
    $tabId = $idMod.'-a'.$i;
    $activeTab = '';
    if ($i == 0) {
      $activeTab = ' active';
    }
    require JModuleHelper::getLayoutPath('mod_combo_news', '_item_tabs');
  } ?>
  </div>
</div>