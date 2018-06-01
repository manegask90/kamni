<?php
/**
 * @package     mod_combo_news
 * @copyright   Wantweb (C) 2013 - 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later;
 */

$unit_none = ';';
$unit_perc = '%;';
$unit_px = 'px;';

$mcnParams = array();
$mcnParams[] = '@blogSideImageMaxWidth:'   .$params->get('blogSideImageMaxWidth') . $unit_none;
$mcnParams[] = '@blogArticlePadding:'      .$params->get('blogArticlePadding') . $unit_none;
$mcnParams[] = '@blogTitleFontSize:'       .$params->get('blogTitleFontSize') . $unit_none;
$mcnParams[] = '@blogTitleStringCount:'    .$params->get('blogTitleStringCount') . $unit_none;
$mcnParams[] = '@blogTitleColor:'          .$params->get('blogTitleColor') . $unit_none;
$mcnParams[] = '@blogBackground:'          .$params->get('blogBackground','rgba(0, 0, 0, 0)') . $unit_none;
$mcnParams[] = '@blogArticleMargin:'       .$params->get('blogArticleMargin') . $unit_none;
$mcnParams[] = '@blogArticleBorderColor:'  .$params->get('blogArticleBorderColor','rgba(0, 0, 0, 0.5)') . $unit_none;

$mcnParams[] = '@accordContentPadding:'    .$params->get('accordContentPadding') . $unit_none;
$mcnParams[] = '@accordBackground:'        .$params->get('accordBackground','transparent') . $unit_none;
$mcnParams[] = '@accordHeadingBackground:' .$params->get('accordHeadingBackground','transparent') . $unit_none;
$mcnParams[] = '@accordBorderColor:'       .$params->get('accordBorderColor') . $unit_none;
$mcnParams[] = '@accordSideImageMaxWidth:' .$params->get('accordSideImageMaxWidth') . $unit_none;

$mcnParams[] = '@tabsContentPadding:'      .$params->get('tabsContentPadding') . $unit_none;
$mcnParams[] = '@tabsContentMinHeight:'    .$params->get('tabsContentMinHeight') . $unit_none;
$mcnParams[] = '@tabsBorderColor:'         .$params->get('tabsBorderColor') . $unit_none;
$mcnParams[] = '@tabsBorderRadius:'        .$params->get('tabsBorderRadius') . $unit_none;
$mcnParams[] = '@tabsContentBackground:'   .$params->get('tabsContentBackground') . $unit_none;
$mcnParams[] = '@tabsActiveColor:'         .$params->get('tabsActiveColor') . $unit_none;
$mcnParams[] = '@tabsActiveBackground:'    .$params->get('tabsActiveBackground') . $unit_none;
$mcnParams[] = '@tabsHoverBackground:'     .$params->get('tabsHoverBackground') . $unit_none;
$mcnParams[] = '@tabsNavBackground:'       .$params->get('tabsNavBackground') . $unit_none;
$mcnParams[] = '@tabsNavigationMaxWidth:'  .$params->get('tabsNavigationMaxWidth') . $unit_none;
$mcnParams[] = '@tabsSideImageMaxWidth:'   .$params->get('tabsSideImageMaxWidth') . $unit_none;

// Write to file
$fp = file_put_contents(__DIR__.'/less/blog_params.less', $mcnParams);

// Compile LESS
include('lessphpcomp.php');
?>
