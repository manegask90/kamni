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
defined('_JEXEC') or die();

class plgSystemExtbuttonbackInstallerScript {
    /**
     * Called after any type of action
     *
     * @param     string              $route      Which action is happening (install|uninstall|discover_install)
     * @param     jadapterinstance    $adapter    The object responsible for running this script
     *
     * @return    boolean                         True on success
     */
    public function postflight($route, JAdapterInstance $adapter) {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->update('#__extensions')->set("`enabled`='1'")->set("`ordering`='99'")->where("`type`='plugin'")->where("`folder`='system'")->where("`element`='extbuttonback'");
        $db->setQuery($query);
        $db->query();
        return true;
    }
}