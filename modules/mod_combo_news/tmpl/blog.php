<?php
/** mod_combo_news - blog */
defined('_JEXEC') or die;
$column_count = $params->get('column_count');
$blog_class = 'newsflash newsflash-blog '.$params->get('blog_type');
$last_article = '';

if ($params->get('responsive_mode')) {
  $blog_class .= $params->get('responsive_mode');
}
if ($params->get('vertical_separator')) {
  $blog_class .= ' '. $params->get('vertical_separator');
}

if (($column_count > 1) && (count($list) > 1)) {
  if ($column_count >= count($list)) {
    $column_count = count($list);
  }
  $colspan = 'span'.(12 / $column_count);
  $remain = count($list) - (floor(count($list)/$column_count) * $column_count);
}
$counter = 0;
?>
<div class="<?php echo $blog_class; ?>" id="<?php echo substr($params->get('layout'),2).$module->id; ?>">
<?php for ($i = 0, $n = count($list); $i < $n; $i ++) {
  $item = $list[$i];
  $flag_row = ($counter % $column_count) + 1;

  if(($flag_row == 1) && ($column_count != 1)) {
    echo '<div class="row-fluid">';
  }
  if($counter + 1 == count($list) && $remain == 1) {
    $last_article = ' last-article';
  }
?>
    <article <?php if($colspan) {echo 'class="'.$colspan.$last_article.'"';} ?>>
      <?php require JModuleHelper::getLayoutPath('mod_combo_news', '_item_blog'); ?>
    </article>
<?php
  $counter++;

  if(($flag_row == $column_count) && ($column_count != 1)) {
    echo '</div>';
  }
} ?>
</div>

