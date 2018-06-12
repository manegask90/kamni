<?php
/**
 *
 * loads the add to cart button
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2015 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @version $Id: addtocartbtn.php 8024 2014-06-12 15:08:59Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');

//if($viewData['orderable']) {
//	echo '<input type="submit" name="addtocart" class="addtocart-button" value="'.vmText::_( 'COM_VIRTUEMART_CART_ADD_TO' ).'" title="'.vmText::_( 'COM_VIRTUEMART_CART_ADD_TO' ).'" />';
//} else {
//	echo '<span name="addtocart" class="addtocart-button-disabled" title="'.vmText::_( 'COM_VIRTUEMART_ADDTOCART_CHOOSE_VARIANT' ).'" >'.vmText::_( 'COM_VIRTUEMART_ADDTOCART_CHOOSE_VARIANT' ).'</span>';
//}

if($viewData['orderable']) {
	echo '<button type="submit" name="addtocart" class="addtocart-button shop-btn type-2 buy" value="'.vmText::_( 'COM_VIRTUEMART_CART_ADD_TO' ).'" title="'.vmText::_( 'COM_VIRTUEMART_CART_ADD_TO' ).'" ><div class="icon">
                                                <svg class="icon_color" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="22" height="18" viewBox="0 0 22 18">
                                                    <path d="M17.499,8.999 C15.013,8.999 12.999,6.984 12.999,4.499 C12.999,2.014 15.013,-0.001 17.499,-0.001 C19.984,-0.001 21.999,2.014 21.999,4.499 C21.999,6.984 19.984,8.999 17.499,8.999 ZM19.999,3.999 C19.999,3.999 17.999,3.999 17.999,3.999 C17.999,3.999 17.999,1.999 17.999,1.999 C17.999,1.999 16.999,1.999 16.999,1.999 C16.999,1.999 16.999,3.999 16.999,3.999 C16.999,3.999 14.999,3.999 14.999,3.999 C14.999,3.999 14.999,4.999 14.999,4.999 C14.999,4.999 16.999,4.999 16.999,4.999 C16.999,4.999 16.999,6.999 16.999,6.999 C16.999,6.999 17.999,6.999 17.999,6.999 C17.999,6.999 17.999,4.999 17.999,4.999 C17.999,4.999 19.999,4.999 19.999,4.999 C19.999,4.999 19.999,3.999 19.999,3.999 ZM14.350,8.999 C14.350,8.999 6.635,8.999 6.635,8.999 C6.635,8.999 6.998,10.999 6.998,10.999 C6.998,10.999 17.998,10.999 17.998,10.999 C17.998,10.999 17.998,12.999 17.998,12.999 C17.998,12.999 4.998,12.999 4.998,12.999 C4.998,12.999 2.998,1.999 2.998,1.999 C2.998,1.999 -0.001,1.999 -0.001,1.999 C-0.001,1.999 -0.001,-0.001 -0.001,-0.001 C-0.001,-0.001 4.998,-0.001 4.998,-0.001 C4.998,-0.001 5.362,1.999 5.362,1.999 C6.398,1.999 9.526,1.999 12.627,1.999 C12.239,2.752 11.999,3.594 11.999,4.499 C11.999,6.363 12.932,8.004 14.350,8.999 ZM6.998,13.999 C8.103,13.999 8.999,14.895 8.999,15.999 C8.999,17.103 8.103,17.999 6.998,17.999 C5.894,17.999 4.998,17.103 4.998,15.999 C4.998,14.895 5.894,13.999 6.998,13.999 ZM16.998,13.999 C18.103,13.999 18.998,14.895 18.998,15.999 C18.998,17.103 18.103,17.999 16.998,17.999 C15.894,17.999 14.998,17.103 14.998,15.999 C14.998,14.895 15.894,13.999 16.998,13.999 Z" id="path-1" class="cls-2" fill-rule="evenodd"></path>
                                                </svg>
                                            </div></button>';
} else {
	echo '<span name="addtocart" class="addtocart-button-disabled" title="'.vmText::_( 'COM_VIRTUEMART_ADDTOCART_CHOOSE_VARIANT' ).'" >'.vmText::_( 'COM_VIRTUEMART_ADDTOCART_CHOOSE_VARIANT' ).'</span>';
}