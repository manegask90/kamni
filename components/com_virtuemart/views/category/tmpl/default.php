<?php
/**
 *
 * Show the products in a category
 *
 * @package    VirtueMart
 * @subpackage
 * @author RolandD
 * @author Max Milbers
 * @todo add pagination
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 9669 2017-11-15 14:25:58Z Milbo $
 */

defined ('_JEXEC') or die('Restricted access');

if (vRequest::getInt('dynamic',false) and vRequest::getInt('virtuemart_product_id',false)) {
	if (!empty($this->products)) {
		if($this->fallback){
			$p = $this->products;
			$this->products = array();
			$this->products[0] = $p;
			vmdebug('Refallback');
		}

		echo shopFunctionsF::renderVmSubLayout($this->productsLayout,array('products'=>$this->products,'currency'=>$this->currency,'products_per_row'=>$this->perRow,'showRating'=>$this->showRating));

	}

	return ;
}
?> <div class="category-view"> <?php
$js = "
jQuery(document).ready(function () {
	jQuery('.orderlistcontainer').hover(
		function() { jQuery(this).find('.orderlist').stop().show()},
		function() { jQuery(this).find('.orderlist').stop().hide()}
	)
});
";
vmJsApi::addJScript('vm.hover',$js);

if ($this->show_store_desc and !empty($this->vendor->vendor_store_desc)) { ?>
	<div class="vendor-store-desc">
		<?php echo $this->vendor->vendor_store_desc; ?>
	</div>
<?php }

if (!empty($this->showcategory_desc) and empty($this->keyword)){
	if(!empty($this->category)) {
	?>
        <div class="category_name">
            <?php if (!empty($this->category->category_name)) { ?>
                <h1><?php echo vmText::_($this->category->category_name); ?></h1>
            <?php } ?>
        </div>
<div class="category_description">
	<?php echo $this->category->category_description; ?>
</div>
<?php }
	if(!empty($this->manu_descr)) {
		?>
        <div class="manufacturer-description">
			<?php echo $this->manu_descr; ?>
        </div>
	<?php }
}

// Show child categories
if ($this->showcategory and empty($this->keyword)) {
	if (!empty($this->category->haschildren)) {
		echo ShopFunctionsF::renderVmSubLayout('categories',array('categories'=>$this->category->children, 'categories_per_row'=>$this->categories_per_row));
	}
}

if (!empty($this->products) or ($this->showsearch or $this->keyword !== false)) {
?>
<div class="browse-view">
<?php

if ($this->showsearch or $this->keyword !== false) {
	//id taken in the view.html.php could be modified
	$category_id  = vRequest::getInt ('virtuemart_category_id', 0); ?>

	<!--BEGIN Search Box -->
	<div class="virtuemart_search">
		<form action="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=category&limitstart=0', FALSE); ?>" method="get">
			<?php if(!empty($this->searchCustomList)) { ?>
			<div class="vm-search-custom-list">
				<?php echo $this->searchCustomList ?>
			</div>
			<?php } ?>

			<?php if(!empty($this->searchCustomValues)) { ?>
			<div class="vm-search-custom-values">
				<?php echo $this->searchCustomValues ?>
			</div>
			<?php } ?>
			<div class="vm-search-custom-search-input">
				<input name="keyword" class="inputbox" type="text" size="40" value="<?php echo $this->keyword ?>"/>
				<input type="submit" value="<?php echo vmText::_ ('COM_VIRTUEMART_SEARCH') ?>" class="button" onclick="this.form.keyword.focus();"/>
				<?php //echo VmHtml::checkbox ('searchAllCats', (int)$this->searchAllCats, 1, 0, 'class="changeSendForm"'); ?>
				<span class="vm-search-descr"> <?php echo vmText::_('COM_VM_SEARCH_DESC') ?></span>
			</div>

			<!-- input type="hidden" name="showsearch" value="true"/ -->
			<input type="hidden" name="view" value="category"/>
			<input type="hidden" name="option" value="com_virtuemart"/>
			<input type="hidden" name="virtuemart_category_id" value="<?php echo $category_id; ?>"/>
			<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>"/>
		</form>
	</div>
	<!-- End Search Box -->
<?php
	/*if($this->keyword !== false){
		?><h3><?php echo vmText::sprintf('COM_VM_SEARCH_KEYWORD_FOR', $this->keyword); ?></h3><?php
	}*/
	$j = 'jQuery(document).ready(function() {

jQuery(".changeSendForm")
	.off("change",Virtuemart.sendCurrForm)
    .on("change",Virtuemart.sendCurrForm);
})';

	vmJsApi::addJScript('sendFormChange',$j);
} ?>

<?php // Show child categories

if(!empty($this->orderByList)) { ?>
<div class="orderby-displaynumber">
	<div class="floatleft vm-order-list">
		<?php echo $this->orderByList['orderby']; ?>
		<?php echo $this->orderByList['manufacturer']; ?>
	</div>
	<div class="vm-pagination vm-pagination-top">
		<?php echo $this->vmPagination->getPagesLinks (); ?>
		<span class="vm-page-counter"><?php echo $this->vmPagination->getPagesCounter (); ?></span>
	</div>
	<div class="floatright display-number"><?php echo $this->vmPagination->getResultsCounter ();?><br/><?php echo $this->vmPagination->getLimitBox ($this->category->limit_list_step); ?></div>

	<div class="clear"></div>
</div> <!-- end of orderby-displaynumber -->

<?php } ?>

    <div class="shop-sorting-panel">
        <div class="sorting">
            <div class="push_to_open_filter">Фильтр товаров</div>
            <div class="title_sort">Сортировать по:</div>
            <div class="body_sort">
                <ul>
                    <li><a class="sort-reset" href="#">Не сортировать</a></li>
                    <li>
                        <a class="shop2-sorting-price sort-param sort-param-asc" data-name="price" href="#">Цена
                            <span class="arrow_icon">
                                <svg class="icon_color" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="10" height="13" viewBox="0 0 10 13">
                                    <path d="M7.000,5.000 C7.000,5.000 7.000,13.000 7.000,13.000 C7.000,13.000 3.000,13.000 3.000,13.000 C3.000,13.000 3.000,5.000 3.000,5.000 C3.000,5.000 -0.000,5.000 -0.000,5.000 C-0.000,5.000 5.000,-0.000 5.000,-0.000 C5.000,-0.000 9.999,5.000 9.999,5.000 C9.999,5.000 7.000,5.000 7.000,5.000 Z" id="path-1" class="cls-2" fill-rule="evenodd"></path>
                                </svg>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a class="shop2-sorting-price sort-param sort-param-desc" data-name="price" href="#">Цена
                            <span class="arrow_icon">                            <svg class="icon_color" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="10" height="13" viewBox="0 0 10 13">
                                <path d="M7.000,5.000 C7.000,5.000 7.000,13.000 7.000,13.000 C7.000,13.000 3.000,13.000 3.000,13.000 C3.000,13.000 3.000,5.000 3.000,5.000 C3.000,5.000 -0.000,5.000 -0.000,5.000 C-0.000,5.000 5.000,-0.000 5.000,-0.000 C5.000,-0.000 9.999,5.000 9.999,5.000 C9.999,5.000 7.000,5.000 7.000,5.000 Z" id="path-1" class="cls-2" fill-rule="evenodd"></path>
                            </svg>
                                                </span>
                        </a>
                    </li>
                    <li>
                        <a class="shop2-sorting-name sort-param  sort-param-desc" data-name="name" href="#">Название
                            <span class="arrow_icon">                            <svg class="icon_color" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="10" height="13" viewBox="0 0 10 13">
                                <path d="M7.000,5.000 C7.000,5.000 7.000,13.000 7.000,13.000 C7.000,13.000 3.000,13.000 3.000,13.000 C3.000,13.000 3.000,5.000 3.000,5.000 C3.000,5.000 -0.000,5.000 -0.000,5.000 C-0.000,5.000 5.000,-0.000 5.000,-0.000 C5.000,-0.000 9.999,5.000 9.999,5.000 C9.999,5.000 7.000,5.000 7.000,5.000 Z" id="path-1" class="cls-2" fill-rule="evenodd"></path>
                            </svg>
                                                </span>
                        </a>
                    </li>
                    <li>
                        <a class="shop2-sorting-name sort-param sort-param-asc" data-name="name" href="#">Название
                            <span class="arrow_icon">                            <svg class="icon_color" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="10" height="13" viewBox="0 0 10 13">
                                <path d="M7.000,5.000 C7.000,5.000 7.000,13.000 7.000,13.000 C7.000,13.000 3.000,13.000 3.000,13.000 C3.000,13.000 3.000,5.000 3.000,5.000 C3.000,5.000 -0.000,5.000 -0.000,5.000 C-0.000,5.000 5.000,-0.000 5.000,-0.000 C5.000,-0.000 9.999,5.000 9.999,5.000 C9.999,5.000 7.000,5.000 7.000,5.000 Z" id="path-1" class="cls-2" fill-rule="evenodd"></path>
                            </svg>
                                                </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="view-sorting">
            <div class="active_view view-sorting-thumbs">
                <svg class="icon_color" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="14" height="14" viewBox="0 0 14 14">
                    <path d="M8.000,14.000 C8.000,14.000 8.000,8.000 8.000,8.000 C8.000,8.000 14.000,8.000 14.000,8.000 C14.000,8.000 14.000,14.000 14.000,14.000 C14.000,14.000 8.000,14.000 8.000,14.000 ZM8.000,-0.000 C8.000,-0.000 14.000,-0.000 14.000,-0.000 C14.000,-0.000 14.000,6.000 14.000,6.000 C14.000,6.000 8.000,6.000 8.000,6.000 C8.000,6.000 8.000,-0.000 8.000,-0.000 ZM-0.000,8.000 C-0.000,8.000 6.000,8.000 6.000,8.000 C6.000,8.000 6.000,14.000 6.000,14.000 C6.000,14.000 -0.000,14.000 -0.000,14.000 C-0.000,14.000 -0.000,8.000 -0.000,8.000 ZM-0.000,-0.000 C-0.000,-0.000 6.000,-0.000 6.000,-0.000 C6.000,-0.000 6.000,6.000 6.000,6.000 C6.000,6.000 -0.000,6.000 -0.000,6.000 C-0.000,6.000 -0.000,-0.000 -0.000,-0.000 Z" id="path-1" class="cls-2" fill-rule="evenodd"></path>
                </svg>
            </div>
            <div class="view-sorting-dropdown">
                <a href="#" class="view_button grid active-view">
                    <svg class="icon_color" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="14" height="14" viewBox="0 0 14 14">
                        <path d="M8.000,14.000 C8.000,14.000 8.000,8.000 8.000,8.000 C8.000,8.000 14.000,8.000 14.000,8.000 C14.000,8.000 14.000,14.000 14.000,14.000 C14.000,14.000 8.000,14.000 8.000,14.000 ZM8.000,-0.000 C8.000,-0.000 14.000,-0.000 14.000,-0.000 C14.000,-0.000 14.000,6.000 14.000,6.000 C14.000,6.000 8.000,6.000 8.000,6.000 C8.000,6.000 8.000,-0.000 8.000,-0.000 ZM-0.000,8.000 C-0.000,8.000 6.000,8.000 6.000,8.000 C6.000,8.000 6.000,14.000 6.000,14.000 C6.000,14.000 -0.000,14.000 -0.000,14.000 C-0.000,14.000 -0.000,8.000 -0.000,8.000 ZM-0.000,-0.000 C-0.000,-0.000 6.000,-0.000 6.000,-0.000 C6.000,-0.000 6.000,6.000 6.000,6.000 C6.000,6.000 -0.000,6.000 -0.000,6.000 C-0.000,6.000 -0.000,-0.000 -0.000,-0.000 Z" id="path-1" class="cls-2" fill-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="#" class="view_button list">
                    <svg class="icon_color" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="14" height="14" viewBox="0 0 14 14">
                        <path d="M-0.001,13.999 C-0.001,13.999 -0.001,7.999 -0.001,7.999 C-0.001,7.999 13.999,7.999 13.999,7.999 C13.999,7.999 13.999,13.999 13.999,13.999 C13.999,13.999 -0.001,13.999 -0.001,13.999 ZM-0.001,-0.001 C-0.001,-0.001 13.999,-0.001 13.999,-0.001 C13.999,-0.001 13.999,5.999 13.999,5.999 C13.999,5.999 -0.001,5.999 -0.001,5.999 C-0.001,5.999 -0.001,-0.001 -0.001,-0.001 Z" id="path-1" class="cls-2" fill-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="#" class="view_button pricelist">
                    <svg class="icon_color" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="14"
                         height="14" viewBox="0 0 14 14">
                        <path d="M-0.001,13.999 C-0.001,13.999 -0.001,12.000 -0.001,12.000 C-0.001,12.000 13.999,12.000 13.999,12.000 C13.999,12.000 13.999,13.999 13.999,13.999 C13.999,13.999 -0.001,13.999 -0.001,13.999 ZM-0.001,7.999 C-0.001,7.999 13.999,7.999 13.999,7.999 C13.999,7.999 13.999,9.999 13.999,9.999 C13.999,9.999 -0.001,9.999 -0.001,9.999 C-0.001,9.999 -0.001,7.999 -0.001,7.999 ZM-0.001,4.000 C-0.001,4.000 13.999,4.000 13.999,4.000 C13.999,4.000 13.999,5.999 13.999,5.999 C13.999,5.999 -0.001,5.999 -0.001,5.999 C-0.001,5.999 -0.001,4.000 -0.001,4.000 ZM-0.001,-0.001 C-0.001,-0.001 13.999,-0.001 13.999,-0.001 C13.999,-0.001 13.999,1.999 13.999,1.999 C13.999,1.999 -0.001,1.999 -0.001,1.999 C-0.001,1.999 -0.001,-0.001 -0.001,-0.001 Z"
                              id="path-1" class="cls-2" fill-rule="evenodd">

                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </div>




	<?php
	if (!empty($this->products)) {
		//revert of the fallback in the view.html.php, will be removed vm3.2
		if($this->fallback){
			$p = $this->products;
			$this->products = array();
			$this->products[0] = $p;
			vmdebug('Refallback');
		}

	echo shopFunctionsF::renderVmSubLayout($this->productsLayout,array('products'=>$this->products,'currency'=>$this->currency,'products_per_row'=>$this->perRow,'showRating'=>$this->showRating));

	if(!empty($this->orderByList)) { ?>
		<div class="vm-pagination vm-pagination-bottom"><?php echo $this->vmPagination->getPagesLinks (); ?><span class="vm-page-counter"><?php echo $this->vmPagination->getPagesCounter (); ?></span></div>
	<?php }
} elseif ($this->keyword !== false) {
	echo vmText::_ ('COM_VIRTUEMART_NO_RESULT') . ($this->keyword ? ' : (' . $this->keyword . ')' : '');
}
?>
</div>

<?php } ?>
</div>

<?php
if(VmConfig::get ('ajax_category', false)){
	$j = "Virtuemart.container = jQuery('.category-view');
	Virtuemart.containerSelector = '.category-view';";

	vmJsApi::addJScript('ajax_category',$j);
	vmJsApi::jDynUpdate();
}
?>
<!-- end browse-view -->

<script>
    var productView = localStorage.getItem('productView');
    if(productView == 'list'){
        jQuery('.view-sorting-dropdown .grid').removeClass('active-view');
        jQuery('.view-sorting-dropdown .list').addClass('active-view');
        jQuery('.category-view .browse-view .product-list').removeClass('grid-view').addClass('list-view');
        jQuery('.category-view .browse-view .product-list .shop2-product-item').removeClass('product-thumb').addClass('product-simple');
    } else if (productView == 'pricelist'){
        jQuery('.view-sorting-dropdown .grid').removeClass('active-view');
        jQuery('.view-sorting-dropdown .list').removeClass('active-view');
        jQuery('.view-sorting-dropdown .pricelist').addClass('active-view');
        jQuery('.category-view .browse-view .product-list').removeClass('grid-view').addClass('list-view');
        jQuery('.category-view .browse-view .product-list .shop2-product-item').removeClass('product-thumb product-simple').addClass('product-pricelist');
    }

    jQuery('.view-sorting-dropdown .grid').click(function(){
        localStorage.removeItem('productView');
        localStorage.setItem('productView', 'grid');
        jQuery('.view-sorting-dropdown .list').removeClass('active-view');
        jQuery('.view-sorting-dropdown .pricelist').removeClass('active-view');
        jQuery(this).addClass('active-view');
        jQuery('.category-view .browse-view .product-list').removeClass('list-view').addClass('grid-view');
        jQuery('.category-view .browse-view .product-list .shop2-product-item').removeClass('product-simple product-pricelist').addClass('product-thumb');
        return false;
    });
    jQuery('.view-sorting-dropdown .list').click(function(){
        localStorage.removeItem('productView');
        localStorage.setItem('productView', 'list');
        jQuery('.view-sorting-dropdown .grid').removeClass('active-view');
        jQuery('.view-sorting-dropdown .pricelist').removeClass('active-view');
        jQuery(this).addClass('active-view');
        jQuery('.category-view .browse-view .product-list').removeClass('grid-view').addClass('list-view');
        jQuery('.category-view .browse-view .product-list .shop2-product-item').removeClass('product-thumb product-pricelist').addClass('product-simple');
        return false;
    });
    jQuery('.view-sorting-dropdown .pricelist').click(function(){
        localStorage.removeItem('productView');
        localStorage.setItem('productView', 'pricelist');
        jQuery('.view-sorting-dropdown .grid').removeClass('active-view');
        jQuery('.view-sorting-dropdown .list').removeClass('active-view');
        jQuery(this).addClass('active-view');
        jQuery('.category-view .browse-view .product-list').removeClass('grid-view').addClass('list-view');
        jQuery('.category-view .browse-view .product-list .shop2-product-item').removeClass('product-thumb product-simple').addClass('product-pricelist');
        return false;
    });
</script>