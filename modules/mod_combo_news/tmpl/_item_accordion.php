<?php
/** mod_combo_news - accordion */

defined('_JEXEC') or die;
$images = json_decode($item->images);
if (!$images->image_intro) {
  $sourse_img = 'modules/mod_combo_news/images/no-img.jpg';
} else {
  $sourse_img = $images->image_intro;
}
$image_class = "news-image";

switch ($params->get('image_position')) {
  case 1:
    $image_class .= " pull-left";
    break;
  case 2:
    $image_class .= " pull-right";
    break;
  default:
    $image_class .= " center-image";
}

$date_before_title = $params->get('date_position');
if ($params->get('date_icon')) {
  $date_icon = '<i class="icon-calendar"></i>';
}
?>

<div class="accordion-heading">
  <a class="accordion-toggle" data-toggle="collapse" data-parent="#<?php echo $idMod; ?>" href="#<?php echo $collapseId; ?>">
    <?php echo $item->title;?>
  </a>
  <?php if ($params->get('date_publ') && !$params->get('date_position')) { ?>
    <div class="modnews-date">      
      <?php echo $date_icon. JHtml::_('date', $item->publish_up, JText::_($params->get('date_format'))); ?>
    </div>
  <?php } ?>
</div>

<div id="<?php echo $collapseId; ?>" class="accordion-body collapse<?php echo $activecollapse; ?>">

  <div class="accordion-inner">

    <?php // Image 
    if (!empty($images->image_intro) and $params->get('image')) { ?>
    <div class="<?php echo $image_class; ?>">
      <a href="<?php echo $item->link;?>">
        <?php $image_src = ModComboNewsHelper::imageResizer($sourse_img,$module->id,$params->get('image_width'),$params->get('image_height'),$params->get('image_quality')); ?>
        <img src="<?php echo $image_src; ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/>
      </a>
    </div>
    <?php } ?>

    <?php if ($params->get('date_publ') && $params->get('date_position')) { ?>
      <div class="modnews-date">      
        <?php echo $date_icon. JHtml::_('date', $item->publish_up, JText::_($params->get('date_format'))); ?>
      </div>
    <?php } ?>

    <?php
    if (!$params->get('text_size')) {
        echo $item->introtext;
    } else {
        echo JHtml::_('string.truncate', $item->introtext, $params->get('text_size'));
    }
    if (isset($item->link) && $params->get('readmore')) { ?>
    <div class="readmore <?php echo $params->get('readmore_position'); ?>">
      <a class="btn <?php echo $params->get('readmore_color'); ?> btn-small" href="<?php echo $item->link; ?>"><?php echo $item->linkText; ?></a>
    </div>
    <?php } ?>

  </div>
</div>