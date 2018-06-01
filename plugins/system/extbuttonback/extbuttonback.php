<?php
/*
# ------------------------------------------------------------------------
# Extensions for Joomla 2.5.x - Joomla 3.x
# ------------------------------------------------------------------------
# Copyright (C) 2011-2013 Ext-Joom.com. All Rights Reserved.
# @license - PHP files are GNU/GPL V2.
# Author: Ext-Joom.com
# Websites:  http://www.ext-joom.com 
# Date modified: 05/11/2013 - 13:00
# ------------------------------------------------------------------------
*/

// No direct access.
defined('_JEXEC') or die;

class plgSystemExtbuttonback extends JPlugin {	
	public function onBeforeCompileHead() {	
		$document 			= JFactory::getDocument();
		$document->addStyleSheet(JURI::base() . 'plugins/system/extbuttonback/assets/css/style.css');	
	}	
	public function onAfterRender() {
		
		if (JFactory::getApplication()->isAdmin()){
			return true;
		}		

		$ext_class 			= $this->params->get('ext_class', '');
		$ext_value 			= $this->params->get('ext_value', ' < ');
		$ext_home			= $this->params->get('ext_home', 1);
		
		$ext_code 			= '</body>';
		$ext_replace_tmpl	= '<input type="button" class="ext-buttonback '.$ext_class.'" value="'.$ext_value.'" onclick="history.go(-1);">  </body>';		
					
		$ext_buffer 		= JResponse::getBody();			
		$ext_buffer 		= str_replace($ext_code, $ext_replace_tmpl, $ext_buffer);		
		
		if ($ext_home == 0) {
			$app = JFactory::getApplication();
			$menu = $app->getMenu();
			$lang = JFactory::getLanguage();
			if ($menu->getActive() != $menu->getDefault($lang->getTag())) {
				JResponse::setBody($ext_buffer);
			}
		} else {
				JResponse::setBody($ext_buffer);
			}
		return true;		
	}
}