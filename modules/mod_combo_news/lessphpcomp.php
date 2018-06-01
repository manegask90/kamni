<?php
 require 'lessc.inc.php';
 $docroot = rtrim($_SERVER['DOCUMENT_ROOT'], '\\/');
 $less = new lessc($docroot.'/modules/mod_combo_news/less/mcn.less');
  //$less->setPreserveComments(true);
 file_put_contents($docroot.'/modules/mod_combo_news/css/mod_combo_news.css', $less->parse());
?>