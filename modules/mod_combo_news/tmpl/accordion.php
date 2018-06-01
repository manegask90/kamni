<?php
/** mod_combo_news - accordion */

defined('_JEXEC') or die;
$idMod = substr($params->get('layout'),2).$module->id;
$accordion_class = 'accordion newsflash clearfix ';
if ($params->get('responsive_mode')) {
  $accordion_class .= $params->get('responsive_mode');
}
?>
<div class="<?php echo $accordion_class ?>" id="<?php echo $idMod; ?>">
<?php for ($i = 0, $n = count($list); $i < $n; $i ++) {
	$item = $list[$i];
  
  //create index articles       
  $articleId = $item->alias.$item->id;
  $collapseId = $idMod.'-a'.$i;
  $activecollapse = '';

  if ($i == 0 && $params->get('accordion_active')) {
    $activecollapse = ' in';
  }
?>
	<div class="accordion-group">
    <?php require JModuleHelper::getLayoutPath('mod_combo_news', '_item_accordion'); ?>
	</div>
<?php } ?>
</div>