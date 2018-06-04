<?php // no direct access
defined ('_JEXEC') or die('Restricted access');

if($show_cat_title) echo "<h3 class = \"cat_title\">$cat_info->category_name</h3>";
if($show_cat_desc) echo "<div class=\"cat_desc\">$cat_info->category_description</div>";
//echo'<div class="randcatprod_slider">';

	

//foreach ($products as $product) {
//    echo '<div class="sliderelement">';
//        if (!empty($product->images[0])) {
//            //$image = $product->images[0]->displayMediaThumb ('class="featuredProductImage" border="0"', FALSE);
//			$image = $product->images[0]->displayMediaThumb('',FALSE,"",true,false,false, 210,210);
//            $image = preg_replace("/src=(.*) /",'data-lazy=\1 ', $image);
//        } else {
//            $image = '';
//        }
//        $url = JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id='.$product->virtuemart_category_id);
//    echo'<div class="mod_rand_image">'.JHTML::_ ('link', $url, $image, array('title' => $product->product_name)).'</div>';
//    echo '<div class="mod_rand_naz"><a href="'.$url.'">'.$product->product_name.'</a></div>';
//
//    echo'<div class="mod_rand_price">';
//    if (!empty($product->prices['salesPrice'])) {
//        echo $currency->createPriceDiv ('salesPrice', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
//    }
//    if (!empty($product->prices['salesPriceWithDiscount'])) {
//        echo $currency->createPriceDiv ('salesPriceWithDiscount', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
//    }
//    echo'</div>';
//
//    echo'</div>';
//}
//echo "</div>";

echo '<ul class="slider">';
foreach ($products as $product) {
    echo '<li>';
    $url = JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id='.$product->virtuemart_category_id);
    echo '<a href="'.$url.'">'.$image = $product->images[0]->displayMediaThumb('',FALSE,"",true,false,false, 675,350).'</a>';
    echo '</li>';
}
?>