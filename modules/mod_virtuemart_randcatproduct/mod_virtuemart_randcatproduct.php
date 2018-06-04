<?php
defined('_JEXEC') or die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/*
 * Module mod_virtuemart_randcatproduct
 * @package VirtueMart
 * @copyright (C) 2016 - borro@joomlaforum.ru
 */

 
 
if (!class_exists( 'VmConfig' )) require(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'config.php');
$mainframe = Jfactory::getApplication();
// параметры
$category_id = $params->get(virtuemart_category_id);
$show_cat_title = $params->get(disp_cat_title);
$show_cat_desc = $params->get(disp_cat_desc);

function appendScript( $scriptPath ){
	$scripts = JFactory::getDocument()->_scripts;
	foreach ( $scripts as $key => $script ) {
		if ( strpos( $key, basename( $scriptPath ) )!== false ) return;
	}
	JFactory::getDocument()->addScript($scriptPath);
}
function appendCss( $scriptPath ){
	$scripts = JFactory::getDocument()->_css;
	foreach ( $scripts as $key => $script ) {
		if ( strpos( $key, basename( $scriptPath ) )!== false ) return;
	}
	JFactory::getDocument()->addStyleSheet($scriptPath);
}
 

$doc = JFactory::getDocument();

appendCss(JUri::base(true).'/modules/mod_virtuemart_randcatproduct/assets/slick.css');
appendCss(JUri::base(true).'/modules/mod_virtuemart_randcatproduct/assets/slick-theme.css');

appendScript(JUri::base(true).'/modules/mod_virtuemart_randcatproduct/assets/slick.min.js');
appendScript(JUri::base(true).'/modules/mod_virtuemart_randcatproduct/assets/mod_randcatprod.js');
/*$exec_js='
jQuery(document).ready(function() {
  jQuery(".randcatprod_slider").slick({
    infinite:false,
    lazyLoad: "ondemand",
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 360,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
    ]
  });
});
';
$doc->addScriptDeclaration($exec_js);
*/
/* Load  VM function */
if (!class_exists( 'mod_virtuemart_product' )) require('helper.php');

$db = JFactory::getDBO();
$query = $db->getQuery(true);
$query->select('c.virtuemart_product_id');
$query->from('#__virtuemart_product_categories as c');
$query->from('#__virtuemart_products as p');
$query->where("c.virtuemart_product_id = p.virtuemart_product_id");
$query->where("p.published='1'");
$query->where("c.virtuemart_category_id = '".$category_id."'");
$query->order("RAND()");

$db->setQuery($query);
$ids = $db->loadColumn();
$productModel = VmModel::getModel('Product');
$products = $productModel->getProducts($ids, TRUE, TRUE, TRUE, FALSE);
$productModel->addImages($products);

if($show_cat_title or $show_cat_desc){
	$categoryModel = VmModel::getModel('Category');
	$cat_info = $categoryModel->getCategory($category_id, FALSE);
}

if(empty($products)) return false; //если ничего нет вернем false
$currency = CurrencyDisplay::getInstance( );

/* Load tmpl default */
ob_start();
require(JModuleHelper::getLayoutPath('mod_virtuemart_randcatproduct',$layout));
$output = ob_get_clean();
echo $output;
?>
