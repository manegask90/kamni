<?php
/**
 *
 * Show the product details page
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers
 * @todo handle child products
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2015 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_addtocart.php 7833 2014-04-09 15:04:59Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$product = $viewData['product'];

if(isset($viewData['rowHeights'])){
	$rowHeights = $viewData['rowHeights'];
} else {
	$rowHeights['customfields'] = TRUE;
}

$init = 1;
if(isset($viewData['init'])){
	$init = $viewData['init'];
}

if(!empty($product->min_order_level) and $init<$product->min_order_level){
	$init = $product->min_order_level;
}

$step=1;
if (!empty($product->step_order_level)){
	$step=$product->step_order_level;
	if(!empty($init)){
		if($init<$step){
			$init = $step;
		} else {
			$init = ceil($init/$step) * $step;

		}
	}
	if(empty($product->min_order_level) and !isset($viewData['init'])){
		$init = $step;
	}
}

$maxOrder= '';
if (!empty($product->max_order_level)){
	$maxOrder = ' max="'.$product->max_order_level.'" ';
}

$addtoCartButton = '';
if(!VmConfig::get('use_as_catalog', 0)){
	if(!$product->addToCartButton and $product->addToCartButton!==''){
		$addtoCartButton = self::renderVmSubLayout('addtocartbtn',array('orderable'=>$product->orderable)); //shopFunctionsF::getAddToCartButton ($product->orderable);
	} else {
		$addtoCartButton = $product->addToCartButton;
	}
}
$position = 'addtocart';

if ($product->min_order_level > 0) {
	$minOrderLevel = $product->min_order_level;
}
else {
	$minOrderLevel = 1;
}


if (!VmConfig::get('use_as_catalog', 0)  ) { ?>

    <div class="addtocart-bar">
	<?php
	// Display the quantity box
	$stockhandle = VmConfig::get('stockhandle_products', false) && $product->product_stockhandle ? $product->product_stockhandle : VmConfig::get('stockhandle','none');
	if (($stockhandle == 'disableit' or $stockhandle == 'disableadd') and ($product->product_in_stock - $product->product_ordered) < $minOrderLevel) { ?>
        <a href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&layout=notify&virtuemart_product_id=' . $product->virtuemart_product_id); ?>" class="notify"><?php echo vmText::_ ('COM_VIRTUEMART_CART_NOTIFY') ?></a><?php
	} else {
		$tmpPrice = (float) $product->prices['costPrice'];
		if (!( VmConfig::get('askprice', true) and empty($tmpPrice) ) ) {
			$editable = 'hidden';
			if ($product->orderable) {
				$editable = 'text';
			} ?>
<!--            <label for="quantity--><?php //echo $product->virtuemart_product_id; ?><!--" class="quantity_box">Количество: </label>-->
            <div class="product-amount">
            <div class="amount-title">Количество:</div>
            <div class="shop-product-amount">
            <?php if ($product->orderable) { ?>
                <button type="button" class="quantity-controls quantity-minus amount-minus">-</button>
                <input type="<?php echo $editable ?>" class="quantity-input js-recalculate" name="quantity[]"
                       data-errStr="<?php echo vmText::_('COM_VIRTUEMART_WRONG_AMOUNT_ADDED') ?>"
                       value="<?php echo $init; ?>" init="<?php echo $init; ?>"
                       step="<?php echo $step; ?>" <?php echo $maxOrder; ?> />
                <button type="button" class="quantity-controls quantity-plus amount-plus">+</button>
                </div>
                </div>
                <div class="price_and_buy">
                <div class="product-price one_price">
                    <div class="price-current">
                        <strong><?php echo $product->prices['salesPrice']; ?></strong>                         <em class="rouble_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="11" height="13" viewBox="0 0 11 13">
                                <path d="M6.826,7.150 C9.125,7.150 10.989,5.549 10.989,3.575 C10.989,1.601 9.125,0.000 6.826,0.000 C6.826,0.000 0.771,0.000 0.771,0.000 C0.771,0.000 0.771,5.850 0.771,5.850 C0.771,5.850 0.014,5.850 0.014,5.850 C0.014,5.850 0.014,7.150 0.014,7.150 C0.014,7.150 0.771,7.150 0.771,7.150 C0.771,7.150 0.771,7.930 0.771,7.930 C0.771,7.930 0.014,7.930 0.014,7.930 C0.014,7.930 0.014,9.230 0.014,9.230 C0.014,9.230 0.771,9.230 0.771,9.230 C0.771,9.230 0.771,13.000 0.771,13.000 C0.771,13.000 2.285,13.000 2.285,13.000 C2.285,13.000 2.285,9.230 2.285,9.230 C2.285,9.230 8.037,9.230 8.037,9.230 C8.037,9.230 8.037,7.930 8.037,7.930 C8.037,7.930 2.285,7.930 2.285,7.930 C2.285,7.930 2.285,7.150 2.285,7.150 C2.285,7.150 6.826,7.150 6.826,7.150 ZM2.285,1.300 C2.285,1.300 6.826,1.300 6.826,1.300 C8.289,1.300 9.475,2.319 9.475,3.575 C9.475,4.831 8.289,5.850 6.826,5.850 C6.826,5.850 2.285,5.850 2.285,5.850 C2.285,5.850 2.285,1.300 2.285,1.300 Z" fill-rule="evenodd"></path>
                            </svg>
                        </em>
                    </div>
                </div>
            <?php }

            if(!empty($addtoCartButton)){
                ?>
                <?php echo $addtoCartButton ?>
                <?php
            } ?>
                <div class="clear"></div>
                </div>

            <input type="hidden" name="virtuemart_product_id[]" value="<?php echo $product->virtuemart_product_id ?>"/>
            <noscript><input type="hidden" name="task" value="add"/></noscript> <?php
		}
	} ?>

    </div><?php
} ?>
