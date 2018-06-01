<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/** @var JDocumentHtml $this */

$app  = JFactory::getApplication();
$user = JFactory::getUser();

// Output as HTML5
$this->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if ($task === 'edit' || $layout === 'form')
{
    $fullWidth = 1;
}
else
{
    $fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add template js
JHtml::_('script', 'template.js', array('version' => 'auto', 'relative' => true));

// Add theme js
JHtml::_('script', 'theme.js', array('version' => 'auto', 'relative' => true));

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add Stylesheets
JHtml::_('stylesheet', 'template.css', array('version' => 'auto', 'relative' => true));

// Add Custom Stylesheets
JHtml::_('stylesheet', 'theme.scss.css', array('version' => 'auto', 'relative' => true));

// Add Custom Stylesheets
JHtml::_('stylesheet', 'style.css', array('version' => 'auto', 'relative' => true));

// Use of Google Font
if ($this->params->get('googleFont'))
{
    JHtml::_('stylesheet', 'https://fonts.googleapis.com/css?family=' . $this->params->get('googleFontName'));
    $this->addStyleDeclaration("
	h1, h2, h3, h4, h5, h6, .site-title {
		font-family: '" . str_replace('+', ' ', $this->params->get('googleFontName')) . "', sans-serif;
	}");
}

// Template color
if ($this->params->get('templateColor'))
{
    $this->addStyleDeclaration('
	a {
		color: ' . $this->params->get('templateColor') . ';
	}
	.nav-list > .active > a,
	.nav-list > .active > a:hover,
	.dropdown-menu li > a:hover,
	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover,
	.nav-pills > .active > a,
	.nav-pills > .active > a:hover,
	.btn-primary {
		background: ' . $this->params->get('templateColor') . ';
	}');
}

// Check for a custom CSS file
JHtml::_('stylesheet', 'user.css', array('version' => 'auto', 'relative' => true));

// Check for a custom js file
JHtml::_('script', 'user.js', array('version' => 'auto', 'relative' => true));

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
$position7ModuleCount = $this->countModules('position-7');
$position8ModuleCount = $this->countModules('position-8');

if ($position7ModuleCount && $position8ModuleCount)
{
    $span = 'span6';
}
elseif ($position7ModuleCount && !$position8ModuleCount)
{
    $span = 'span9';
}
elseif (!$position7ModuleCount && $position8ModuleCount)
{
    $span = 'span9';
}
else
{
    $span = 'span12';
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
    $logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
    $logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
    $logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="none">
    <title>Натуральные камни. Руны - Дыхание камня, Санкт-Петербург</title>
    <meta name="description" content="Дыхание камня - это небольшая осознанная мастерская. Здесь, в каменной пыли и в шуршании камней рождается магия. Главная особенность мастера - отношение к камню с позиции видения.">
    <meta name="keywords" content="купить натуральные камни, купить руны из натурального камня, купить камешки для изучения санскрита, купить бубны">
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="x-rim-auto-match" content="none">


<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0" />-->
    <jdoc:include type="head" />

    <link rel="stylesheet" href="http://kamni/templates/protostar/css/styles_articles_tpl.css">
    <link rel='stylesheet' type='text/css' href='http://kamni/templates/protostar/css/highslide.min.css'/>
    <script type='text/javascript' src='http://kamni/templates/protostar/js/highslide-full.packed.js'></script>

    <script type='text/javascript'>
        hs.graphicsDir = '/shared/highslide-4.1.13/graphics/';
        hs.outlineType = null;
        hs.showCredits = false;
        hs.lang={cssDirection:'ltr',loadingText:'Загрузка...',loadingTitle:'Кликните чтобы отменить',focusTitle:'Нажмите чтобы перенести вперёд',fullExpandTitle:'Увеличить',fullExpandText:'Полноэкранный',previousText:'Предыдущий',previousTitle:'Назад (стрелка влево)',nextText:'Далее',nextTitle:'Далее (стрелка вправо)',moveTitle:'Передвинуть',moveText:'Передвинуть',closeText:'Закрыть',closeTitle:'Закрыть (Esc)',resizeTitle:'Восстановить размер',playText:'Слайд-шоу',playTitle:'Слайд-шоу (пробел)',pauseText:'Пауза',pauseTitle:'Приостановить слайд-шоу (пробел)',number:'Изображение %1/%2',restoreTitle:'Нажмите чтобы посмотреть картинку, используйте мышь для перетаскивания. Используйте клавиши вперёд и назад'};</script>
    <script type='text/javascript' src='http://kamni/templates/protostar/js/flowplayer-3.2.9.min.js'></script>
    <!-- 46b9544ffa2e5e73c3c971fe2ede35a5 -->
    <link rel='stylesheet' type='text/css' href='http://kamni/templates/protostar/css/calendar.css' />
    <script type='text/javascript' src='http://kamni/templates/protostar/js/ru.js'></script>
    <script type='text/javascript' src='http://kamni/templates/protostar/js/cookie.js'></script>
    <script type='text/javascript' src='http://kamni/templates/protostar/js/widgets.js?v=8'></script>
    <script type='text/javascript' src='http://kamni/templates/protostar/js/calendar.packed.js'></script>

    <script type='text/javascript'>/*<![CDATA[*/
        widgets.addOnloadEvent(function() {
            if (typeof jQuery == 'undefined') {
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.src = '/shared/s3/js/jquery-1.7.2.min.js';
                document.body.appendChild(s);
            }
        });
        /*]]>*/
    </script>
    <link rel="icon" href="http://kamni/templates/protostar/favicon.ico?1527570649" type="image/x-icon">





    <link rel="stylesheet" type="text/css" href="http://kamni/templates/protostar/css/theme.less.css"><script type="text/javascript" src="http://kamni/templates/protostar/js/printme.js"></script>
    <script type="text/javascript" src="http://kamni/templates/protostar/js/tpl.js"></script>
    <script type="text/javascript" src="http://kamni/templates/protostar/js/baron.min.js"></script>
    <script type="text/javascript" src="http://kamni/templates/protostar/js/shop2.2_new.js"></script>

    <link rel="stylesheet" href="http://kamni/templates/protostar/css/theme.scss.css">

    <link rel="stylesheet" href="http://kamni/templates/protostar/css/bdr_style.scss.css">

    <script src="http://kamni/templates/protostar/js/s3.includeform.js"></script>
    <script src="http://kamni/templates/protostar/js/jquery.bxslider.min.js"></script>
    <script src="http://kamni/templates/protostar/js/animit.js"></script>
    <script src="http://kamni/templates/protostar/js/jquery.formstyler.min.js"></script>
    <script src="http://kamni/templates/protostar/js/jquery.waslidemenu.min.js"></script>
    <script src="http://kamni/templates/protostar/js/jquery.responsiveTabs.min.js"></script>
    <script src="http://kamni/templates/protostar/js/jquery.nouislider.all.js"></script>
    <script src="http://kamni/templates/protostar/js/owl.carousel.min.js"></script>
    <script src="http://kamni/templates/protostar/js/tocca.js"></script>
    <script src="http://kamni/templates/protostar/js/slideout.js"></script>

    <script src="http://kamni/templates/protostar/js/s3.shop2.fly.js"></script>
    <script src="http://kamni/templates/protostar/js/s3.shop2.popup.js"></script>

    <script src="http://kamni/templates/protostar/js/main.js" charset="utf-8"></script>


    <script>
        $(function(){
            $.s3Shop2Popup();
        });
    </script>


    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&amp;subset=cyrillic" rel="stylesheet">
</head>
<body class="site <?php echo $option
    . ' view-' . $view
    . ($layout ? ' layout-' . $layout : ' no-layout')
    . ($task ? ' task-' . $task : ' no-task')
    . ($itemid ? ' itemid-' . $itemid : '')
    . ($params->get('fluidContainer') ? ' fluid' : '')
    . ($this->direction === 'rtl' ? ' rtl' : '');
?>">
<!-- Body -->
<div class="body" id="top">
    <!-- Header -->
    <header class="header" role="banner">
        <div class="top-panel-wrap">
            <div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
                <jdoc:include type="modules" name="top-menu" style="none" />
                <div class="site_login_wrap">
                    <div class="shop2-block login-form ">
                        <div class="block-title">
                            <div class="icon"></div>
                            Вход в кабинет
                        </div>
                        <div class="for_wa_slide">
                            <div class="mobile_title_wrap for_wo">
                                <div class="block-body for_wa_slide">
                                    <div class="for_wo">
                                        <jdoc:include type="modules" name="top-login-form" style="none" />
                                        <div class="clear-container"></div>
                                        <div class="reg_link-wrap">
                                            <a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">Регистрация</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-inner clearfix">
            <div class="container<?php echo($params->get('fluidContainer') ? '-fluid' : ''); ?>">
                <div class="company-name-wrap ">
                    <div class="logo-pic"><?php echo $logo; ?></div>
                    <div class="logo-text-wrap">
                        <div class="logo-text">
                            <div class="company_name">
                                <?php echo JFactory::getApplication()->getCfg('sitename');?>
                            </div>
                            <div class="logo-desc">
                                <?php if ($this->params->get('sitedescription')) : ?>
                                    <?php echo htmlspecialchars($this->params->get('sitedescription'), ENT_COMPAT, 'UTF-8'); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right-header-area">
                    <div class="header_phones">
                        <div><a href="tel:+79119467247">+79119467247</a></div>
                    </div>
                    <div class="shop2-cart-preview order-btn empty-cart">
                        <div class="shop2-block cart-preview">
                            <div class="open_button"></div>
                            <div class="close_button"></div>

                            <div class="block-body">
                                <div class="empty_cart_title">
                                    <jdoc:include type="modules" name="shoping-cart" style="none"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="content-wrapper clear-self i_m_mainpage">
        <main role="main" class="main">
            <div class="content">
                <div class="content-inner">
                    <div class="shop-search-panel">
                        <jdoc:include type="modules" name="shop-search" style="none"/>
                        <div class="search-products-basic">
                            <div class="shop2-block search-form">
                                <div class="block-title">
                                    <div class="title">Расширенный поиск</div>
                                </div>
                                <div class="block-body">
                                    <form action="/shop/search" enctype="multipart/form-data">
                                        <input type="hidden" name="sort_by" value="">

                                        <div class="row">
                                            <label class="row-title" for="shop2-name">Название:</label>
                                            <input autocomplete="off" type="text" class="type_text" name="s[name]" size="20" value="">
                                        </div>


                                        <div class="row search_price range_slider_wrapper">
                                            <div class="row-title">Цена (руб.):</div>
                                            <div class="price_range">
                                                <input name="s[price][min]" type="tel" size="5" class="small low" value="0">
                                                <input name="s[price][max]" type="tel" size="5" class="small hight" value="40000">
                                            </div>
                                            <div class="input_range_slider noUi-target noUi-ltr noUi-horizontal noUi-background"><div class="noUi-base"><div class="noUi-origin noUi-connect noUi-dragable" style="left: 0%;"><div class="noUi-handle noUi-handle-lower"></div></div><div class="noUi-origin noUi-background" style="left: 100%;"><div class="noUi-handle noUi-handle-upper"></div></div></div></div>
                                        </div>


                                        <div class="row">
                                            <label class="row-title" for="shop2-article">Артикул:</label>
                                            <input type="text" class="type_text" name="s[article]" value="">
                                        </div>

                                        <div class="row">
                                            <label class="row-title" for="shop2-text">Текст:</label>
                                            <input type="text" autocomplete="off" class="type_text" name="search_text" size="20" value="">
                                        </div>


                                        <div class="row">
                                            <div class="row-title">Выберите категорию:</div>
                                            <div data-placeholder="Все" class="jq-selectbox jqselect" style="display: inline-block; position: relative; z-index:100"><select name="s[folder_id]" data-placeholder="Все" style="margin: 0px; padding: 0px; position: absolute; left: 0px; top: 0px; width: 100%; height: 100%; opacity: 0;">
                                                    <option value="">Все</option>
                                                    <option value="67348815">
                                                        Камни натуральные на развес
                                                    </option>
                                                    <option value="39914215">
                                                        Натуральные камни поштучно
                                                    </option>
                                                    <option value="70758615">
                                                        Яйца из нефрита
                                                    </option>
                                                    <option value="68415815">
                                                        Украшения из натурального камня
                                                    </option>
                                                    <option value="588372041">
                                                        Руны по виду камня
                                                    </option>
                                                    <option value="38276015">
                                                        Камешки для изучения санскрита
                                                    </option>
                                                    <option value="39085415">
                                                        Мотивирующие камешки
                                                    </option>
                                                    <option value="39086215">
                                                        Авторские изделия из дерева
                                                    </option>
                                                    <option value="41904215">
                                                        Авторские наборы для гадания
                                                    </option>
                                                </select><div class="jq-selectbox__select" style="position: relative"><div class="jq-selectbox__select-text placeholder">Все</div><div class="jq-selectbox__trigger"><div class="jq-selectbox__trigger-arrow"></div></div></div><div class="jq-selectbox__dropdown" style="position: absolute; left: 0px; display: none;"><ul style="position: relative; list-style: none; overflow: auto; overflow-x: hidden"><li class="selected sel" style="">Все</li><li style="">
                                                            Камни натуральные на развес
                                                        </li><li style="">
                                                            Натуральные камни поштучно
                                                        </li><li style="">
                                                            Яйца из нефрита
                                                        </li><li style="">
                                                            Украшения из натурального камня
                                                        </li><li style="">
                                                            Руны по виду камня
                                                        </li><li style="">
                                                            Камешки для изучения санскрита
                                                        </li><li style="">
                                                            Мотивирующие камешки
                                                        </li><li style="">
                                                            Авторские изделия из дерева
                                                        </li><li style="">
                                                            Авторские наборы для гадания
                                                        </li></ul></div></div>
                                        </div>

                                        <div id="shop2_search_custom_fields" class="shop2_search_custom_fields"></div>


                                        <div class="row">
                                            <div class="row-title">Производитель:</div>
                                            <div data-placeholder="Все" class="jq-selectbox jqselect" style="display: inline-block; position: relative; z-index:100"><select name="s[vendor_id]" data-placeholder="Все" style="margin: 0px; padding: 0px; position: absolute; left: 0px; top: 0px; width: 100%; height: 100%; opacity: 0;">
                                                    <option value="">Все</option>
                                                    <option value="175041841">Дыхание камня</option>
                                                    <option value="4022815">Кирилл</option>
                                                </select><div class="jq-selectbox__select" style="position: relative"><div class="jq-selectbox__select-text placeholder">Все</div><div class="jq-selectbox__trigger"><div class="jq-selectbox__trigger-arrow"></div></div></div><div class="jq-selectbox__dropdown" style="position: absolute; left: 0px; display: none;"><ul style="position: relative; list-style: none; overflow: auto; overflow-x: hidden"><li class="selected sel" style="">Все</li><li style="">Дыхание камня</li><li style="">Кирилл</li></ul></div></div>
                                        </div>

                                        <div class="row">
                                            <div class="row-title">Новинка:</div>
                                            <div class="jq-selectbox jqselect" style="display: inline-block; position: relative; z-index:100"><select name="s[_flags][2]" style="margin: 0px; padding: 0px; position: absolute; left: 0px; top: 0px; width: 100%; height: 100%; opacity: 0;">
                                                    <option value="">Все</option>
                                                    <option value="1">да</option>
                                                    <option value="0">нет</option>
                                                </select><div class="jq-selectbox__select" style="position: relative"><div class="jq-selectbox__select-text placeholder">Все</div><div class="jq-selectbox__trigger"><div class="jq-selectbox__trigger-arrow"></div></div></div><div class="jq-selectbox__dropdown" style="position: absolute; left: 0px; display: none;"><ul style="position: relative; list-style: none; overflow: auto; overflow-x: hidden"><li class="selected sel" style="">Все</li><li style="">да</li><li style="">нет</li></ul></div></div>
                                        </div>
                                        <div class="row">
                                            <div class="row-title">Спецпредложение:</div>
                                            <div class="jq-selectbox jqselect" style="display: inline-block; position: relative; z-index:100"><select name="s[_flags][1]" style="margin: 0px; padding: 0px; position: absolute; left: 0px; top: 0px; width: 100%; height: 100%; opacity: 0;">
                                                    <option value="">Все</option>
                                                    <option value="1">да</option>
                                                    <option value="0">нет</option>
                                                </select><div class="jq-selectbox__select" style="position: relative"><div class="jq-selectbox__select-text placeholder">Все</div><div class="jq-selectbox__trigger"><div class="jq-selectbox__trigger-arrow"></div></div></div><div class="jq-selectbox__dropdown" style="position: absolute; left: 0px; display: none;"><ul style="position: relative; list-style: none; overflow: auto; overflow-x: hidden"><li class="selected sel" style="">Все</li><li style="">да</li><li style="">нет</li></ul></div></div>
                                        </div>

                                        <div class="row">
                                            <div class="row-title">Результатов на странице:</div>
                                            <div class="jq-selectbox jqselect" style="display: inline-block; position: relative; z-index:100"><select name="s[products_per_page]" style="margin: 0px; padding: 0px; position: absolute; left: 0px; top: 0px; width: 100%; height: 100%; opacity: 0;">
                                                    <option value="5">5</option>
                                                    <option value="20">20</option>
                                                    <option value="35">35</option>
                                                    <option value="50">50</option>
                                                    <option value="65">65</option>
                                                    <option value="80">80</option>
                                                    <option value="95">95</option>
                                                </select><div class="jq-selectbox__select" style="position: relative"><div class="jq-selectbox__select-text">5</div><div class="jq-selectbox__trigger"><div class="jq-selectbox__trigger-arrow"></div></div></div><div class="jq-selectbox__dropdown" style="position: absolute; left: 0px; display: none;"><ul style="position: relative; list-style: none; overflow: auto; overflow-x: hidden"><li class="selected sel" style="">5</li><li style="">20</li><li style="">35</li><li style="">50</li><li style="">65</li><li style="">80</li><li style="">95</li></ul></div></div>
                                        </div>

                                        <div class="clear-container"></div>
                                        <div class="row_button">
                                            <div class="close_search_form">Закрыть</div>
                                            <button type="submit" class="search-btn">Найти</button>
                                        </div>
                                    </form>
                                    <div class="clear-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content_area content_paddings">
                        <!--                            <input type="button" class="ext-buttonback " value=" < " onclick="history.go(-1);">-->
                        <jdoc:include type="component" />
                    </div>
                </div>
            </div>
        </main>
        <aside role="complementary" class="sidebar left" style="z-index: 3;">
            <div class="shop-categories-wrap ">
                <div class="title">Каталог товаров</div>
                <jdoc:include type="modules" name="shoping-category" style="none"/>
            </div>
            <jdoc:include type="modules" name="menu-sidebar" style="none" />
        </aside>
    </div>
</div>
<!-- Footer -->
<footer class="footer" role="contentinfo">
    <div class="max-width-wrapper">
        <jdoc:include type="modules" name="top-menu" style="none" />
        <div class="footer-contacts-wrap">
            <div class="phones">Телефон:
                <div class="phones__inner">
                    <div><a href="tel:+79119467247">+79119467247</a></div>
                </div>
                <div class="phones__opening_hours">Отправка почтой и курьером</div>
            </div>
            <div class="address">
                Адрес: <span class="address__inner">Самовывоз: Санкт-Петербург,  ул. Большая Зеленина, 16</span><br>
                Е-mail: <span class="address__email">polnovodnoe@gmail.com</span>
            </div>
        </div>
        <div class="footer-right-side">
            <div class="social-networks">
                <div class="title">Мы в соц. сетях</div>
                <a href="https://www.instagram.com/dyhanie_kamnya/" target="_blank">
                    <?php
                    echo '<img src="' . JUri::root() . 'images/mg_0193.jpg" alt="instagram">';
                    ?>
                </a>
                <a href="https://www.facebook.com/groups/1839191606396653/" target="_blank"><img src="/d/1709126/d/" alt="facebook"></a>
                <a href="https://vk.com/dyhanie_kamnya" target="_blank"><img src="/d/1709126/d/" alt="vk"></a>
            </div>

            <div class="site-name">© 2017 - 2018 </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="max-width-wrapper">
            <div class="site-copyright"><span style="font-size:10px;" class="copyright"><!--noindex--><a href="https://megagroup.ru" target="_blank" rel="nofollow"><img src="http://cp1.megagroup.ru/g/mlogo/svg/sozdanie-saitov-megagroup-ru-dark.svg" class="copyright"></a><!--/noindex--></span></div>
        </div>
    </div>
</footer>
<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>

<!--<script>-->
<!--    jQuery('.site_login_wrap .block-title').click(function(){-->
<!--        jQuery('.site_login_wrap').toggleClass( 'opened' );-->
<!--    });-->
<!---->
<!--    jQuery(function($){-->
<!--        $(document).mouseup(function (e){-->
<!--            var div = $(".site_login_wrap");-->
<!--            if (!div.is(e.target)-->
<!--                && div.has(e.target).length === 0) {-->
<!--                div.removeClass( 'opened' );-->
<!--            }-->
<!--        });-->
<!--    });-->
<!--</script>-->
