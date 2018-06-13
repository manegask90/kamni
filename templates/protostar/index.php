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
<html lang="ru">
<head><link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <meta charset="utf-8">
    <meta name="robots" content="none">
    <title>Натуральные камни. Руны - Дыхание камня, Санкт-Петербург</title>
    <meta name="description" content="Дыхание камня - это небольшая осознанная мастерская. Здесь, в каменной пыли и в шуршании камней рождается магия. Главная особенность мастера - отношение к камню с позиции видения.">
    <meta name="keywords" content="купить натуральные камни, купить руны из натурального камня, купить камешки для изучения санскрита, купить бубны">
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="x-rim-auto-match" content="none">
    <?php
    JHtml::_('stylesheet', 'styles_articles_tpl.css', array('version' => 'auto', 'relative' => true));
    JHtml::_('stylesheet', 'highslide.min.css', array('version' => 'auto', 'relative' => true));
    JHtml::_('stylesheet', 'calendar.css', array('version' => 'auto', 'relative' => true));
    JHtml::_('stylesheet', 'theme.less.css', array('version' => 'auto', 'relative' => true));
    JHtml::_('stylesheet', 'theme.scss.css', array('version' => 'auto', 'relative' => true));
    JHtml::_('stylesheet', 'bdr_style.scss.css', array('version' => 'auto', 'relative' => true));
//    JHtml::_('script', 'jquery.min.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'highslide-full.packed.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'flowplayer-3.2.9.min.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'ru.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'cookie.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'widgets.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'calendar.packed.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'printme.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'tpl.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'baron.min.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'shop2.2_new.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 's3.includeform.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'jquery.bxslider.min.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'animit.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'jquery.formstyler.min.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'jquery.waslidemenu.min.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'jquery.responsiveTabs.min.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'jquery.nouislider.all.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'owl.carousel.min.js', array('version' => 'auto', 'relative' => true));
//    JHtml::_('script', 'tocca.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'slideout.js', array('version' => 'auto', 'relative' => true));
//    JHtml::_('script', 's3.shop2.fly.js', array('version' => 'auto', 'relative' => true));
//    JHtml::_('script', 's3.shop2.popup.js', array('version' => 'auto', 'relative' => true));
    JHtml::_('script', 'main.js', array('version' => 'auto', 'relative' => true));
//    JHtml::_('script', 'splitwords.js', array('version' => 'auto', 'relative' => true));
//    JHtml::_('script', 'site.min.js', array('version' => 'auto', 'relative' => true));
    ?>
    <script src="https://cp.onicon.ru/loader/5953349b28668847218b45d5.js" type="text/javascript" data-auto async></script>
    <script type='text/javascript'>
        //hs.graphicsDir = '/shared/highslide-4.1.13/graphics/';
        //hs.outlineType = null;
        //hs.showCredits = false;
        //hs.lang={cssDirection:'ltr',loadingText:'Загрузка...',loadingTitle:'Кликните чтобы отменить',focusTitle:'Нажмите чтобы перенести вперёд',fullExpandTitle:'Увеличить',fullExpandText:'Полноэкранный',previousText:'Предыдущий',previousTitle:'Назад (стрелка влево)',nextText:'Далее',nextTitle:'Далее (стрелка вправо)',moveTitle:'Передвинуть',moveText:'Передвинуть',closeText:'Закрыть',closeTitle:'Закрыть (Esc)',resizeTitle:'Восстановить размер',playText:'Слайд-шоу',playTitle:'Слайд-шоу (пробел)',pauseText:'Пауза',pauseTitle:'Приостановить слайд-шоу (пробел)',number:'Изображение %1/%2',restoreTitle:'Нажмите чтобы посмотреть картинку, используйте мышь для перетаскивания. Используйте клавиши вперёд и назад'};</script>
    <!-- 46b9544ffa2e5e73c3c971fe2ede35a5 -->

    <script type='text/javascript'>/*<![CDATA[*/
        //     widgets.addOnloadEvent(function() {
        //     if (typeof jQuery == 'undefined') {
        //         var s = document.createElement('script');
        //         s.type = 'text/javascript';
        //         s.src = '/shared/s3/js/jquery-1.7.2.min.js';
        //         document.body.appendChild(s);
        //     }
        // });
        /*]]>*/
    </script>
    <link rel="icon" href="http://kamni/templates/protostar/favicon.ico?1527570649" type="image/x-icon">

    <script>
        /* $(function(){
            $.s3Shop2Popup();
        }); */
    </script>
    <jdoc:include type="head" />


</head>
<body class="site <?php echo $option
    . ' view-' . $view
    . ($layout ? ' layout-' . $layout : ' no-layout')
    . ($task ? ' task-' . $task : ' no-task')
    . ($itemid ? ' itemid-' . $itemid : '')
    . ($params->get('fluidContainer') ? ' fluid' : '')
    . ($this->direction === 'rtl' ? ' rtl' : '');
?>">
<div id="site_loader"></div>
<div class="close-left-panel"></div>
<div id="menu" class="mobile-left-panel">
    <div class="site_login_wrap_mobile">
        <div class="shop2-block login-form ">
            <div class="block-title">
                <div class="icon"></div>
                Вход в кабинет</div>
            <div class="for_wa_slide">
                <div class="mobile_title_wrap for_wo">
                    <a class="mobile_title">Вход в кабинет</a>
                    <div class="block-body for_wa_slide">
                        <div class="for_wo cab_title">Вход в кабинет</div>
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
        </div>    </div>
    <div class="categories-wrap_mobile">
        <jdoc:include type="modules" name="shoping-category" style="none"/>
    </div>
    <jdoc:include type="modules" name="top-menu-mob" style="none" />
    <jdoc:include type="modules" name="menu-sidebar-mob" style="none"/>
    <div class="mobile-panel-button--close"></div>
</div>
<div class="mobile-left-panel-filter">

</div>
<div class="mobile-right-panel">


    <div class="shop2-block search-form ">
        <div class="block-title">
            <div class="title">Расширенный поиск</div>
        </div>
        <div class="block-body">
            <form action="/shop/search" enctype="multipart/form-data">
                <input type="hidden" name="sort_by" value=""/>

                <div class="row">
                    <label class="row-title" for="shop2-name">Название:</label>
                    <input autocomplete="off" type="text" class="type_text" name="s[name]" size="20" value="" />
                </div>


                <div class="row search_price range_slider_wrapper">
                    <div class="row-title">Цена (руб.):</div>
                    <div class="price_range">
                        <input name="s[price][min]" type="tel" size="5" class="small low" value="0" />
                        <input name="s[price][max]" type="tel" size="5" class="small hight" value="40000" />
                    </div>
                    <div class="input_range_slider"></div>
                </div>


                <div class="row">
                    <label class="row-title" for="shop2-article">Артикул:</label>
                    <input type="text" class="type_text" name="s[article]" value="" />
                </div>

                <div class="row">
                    <label class="row-title" for="shop2-text">Текст:</label>
                    <input type="text" autocomplete="off" class="type_text" name="search_text" size="20" value="" />
                </div>


                <div class="row">
                    <div class="row-title">Выберите категорию:</div>
                    <select name="s[folder_id]" data-placeholder="Все">
                        <option value="">Все</option>
                        <option value="67348815" >
                            Камни натуральные на развес
                        </option>
                        <option value="39914215" >
                            Натуральные камни поштучно
                        </option>
                        <option value="70758615" >
                            Яйца из нефрита
                        </option>
                        <option value="68415815" >
                            Украшения из натурального камня
                        </option>
                        <option value="588372041" >
                            Руны по виду камня
                        </option>
                        <option value="38276015" >
                            Камешки для изучения санскрита
                        </option>
                        <option value="39085415" >
                            Мотивирующие камешки
                        </option>
                        <option value="39086215" >
                            Авторские изделия из дерева
                        </option>
                        <option value="41904215" >
                            Авторские наборы для гадания
                        </option>
                    </select>
                </div>

                <div id="shop2_search_custom_fields" class="shop2_search_custom_fields"></div>


                <div class="row">
                    <div class="row-title">Производитель:</div>
                    <select name="s[vendor_id]" data-placeholder="Все">
                        <option value="">Все</option>
                        <option value="175041841" >Дыхание камня</option>
                        <option value="4022815" >Кирилл</option>
                    </select>
                </div>

                <div class="row">
                    <div class="row-title">Новинка:</div>
                    <select name="s[_flags][2]">
                        <option value="">Все</option>
                        <option value="1">да</option>
                        <option value="0">нет</option>
                    </select>
                </div>
                <div class="row">
                    <div class="row-title">Спецпредложение:</div>
                    <select name="s[_flags][1]">
                        <option value="">Все</option>
                        <option value="1">да</option>
                        <option value="0">нет</option>
                    </select>
                </div>

                <div class="row">
                    <div class="row-title">Результатов на странице:</div>
                    <select name="s[products_per_page]">
                        <option value="5">5</option>
                        <option value="20">20</option>
                        <option value="35">35</option>
                        <option value="50">50</option>
                        <option value="65">65</option>
                        <option value="80">80</option>
                        <option value="95">95</option>
                    </select>
                </div>

                <div class="clear-container"></div>
                <div class="row_button">
                    <div class="close_search_form">Закрыть</div>
                    <button type="submit" class="search-btn">Найти</button>
                </div>
            </form>
            <div class="clear-container"></div>
        </div>
    </div><!-- Search Form --></div>
<div id="panel" class="site-wrapper ">
    <div class="panel-shadow1"></div>
    <div class="panel-shadow2"></div>
    <div class="panel-shadow3"></div>
    <header role="banner" class="header">
        <div class="empty-block" style="height: 72px;"></div>
        <div class="top-panel-wrap">
            <div class="mobile-panel-button">
                <div class="mobile-panel-button--open"></div>
            </div>
            <div class="shop2-cart-preview_mobile">
                <div class="shop2-cart-preview order-btn empty-cart"> <!-- empty-cart -->
                    <div class="shop2-block cart-preview">
                        <div class="open_button"></div>
                        <div class="close_button"></div>

                        <div class="block-body">
                            <div class="empty_cart_title">
                                <jdoc:include type="modules" name="shoping-cart" style="none"/>
                            </div>
                        </div>

                    </div>
                </div><!-- Cart Preview -->
            </div>
            <div class="search-panel-wrap_mobile">
                <div class="push-to-search"></div>
            </div>
            <div class="search-area_mobile">
                <div class="text_input-wrap">
                    <form action="/shop/search" enctype="multipart/form-data" class="text_input-wrap_in">
                        <input class="with_clear_type" type="search" placeholder="Название товара" name="s[name]" size="20" id="shop2-name" value="">
                        <div class="clear_type-form"></div>
                    </form>
                </div>
                <div class="search-more-button">
                    <div class="search-open-button">
                        <div class="icon">
                            <div class="first-line"></div>
                            <div class="second-line"></div>
                            <div class="third-line"></div>
                        </div>
                        <div class="title">Расширенный поиск</div>
                    </div>
                </div>
            </div>
            <div class="max-width-wrapper">
                <jdoc:include type="modules" name="top-menu" style="none" />

                <div class="site_login_wrap">
                    <div class="shop2-block login-form ">
                        <div class="block-title">
                            <div class="icon"></div>
                            Вход в кабинет</div>
                        <div class="for_wa_slide">
                            <div class="mobile_title_wrap for_wo">
                                <a class="mobile_title">Вход в кабинет</a>
                                <div class="block-body for_wa_slide">
                                    <div class="for_wo cab_title">Вход в кабинет</div>
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
                    </div>                </div>
            </div>
        </div>
        <div class="max-width-wrapper">
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
                <div class="shop2-cart-preview order-btn empty-cart"> <!-- empty-cart -->
                    <div class="shop2-block cart-preview">
                        <div class="open_button"></div>
                        <div class="close_button"></div>

                        <div class="block-body">
                            <div class="empty_cart_title">
                                <jdoc:include type="modules" name="shoping-cart" style="none"/>
                            </div>
                        </div>

                    </div>
                </div><!-- Cart Preview -->
            </div>
        </div>
    </header><!-- .header-->
    <div class="content-wrapper clear-self i_m_mainpage">
        <main role="main" class="main">
            <div class="content">
                <div class="content-inner">
                    <div class="shop-search-panel">
                        <jdoc:include type="modules" name="shop-search" style="none"/>
                        <div class="search-products-basic">
                            <div class="shop2-block search-form ">
                                <div class="block-title">
                                    <div class="title">Расширенный поиск</div>
                                </div>
                                <div class="block-body">
                                    <form action="/shop/search" enctype="multipart/form-data">
                                        <input type="hidden" name="sort_by" value=""/>

                                        <div class="row">
                                            <label class="row-title" for="shop2-name">Название:</label>
                                            <input autocomplete="off" type="text" class="type_text" name="s[name]" size="20" value="" />
                                        </div>


                                        <div class="row search_price range_slider_wrapper">
                                            <div class="row-title">Цена (руб.):</div>
                                            <div class="price_range">
                                                <input name="s[price][min]" type="tel" size="5" class="small low" value="0" />
                                                <input name="s[price][max]" type="tel" size="5" class="small hight" value="40000" />
                                            </div>
                                            <div class="input_range_slider"></div>
                                        </div>


                                        <div class="row">
                                            <label class="row-title" for="shop2-article">Артикул:</label>
                                            <input type="text" class="type_text" name="s[article]" value="" />
                                        </div>

                                        <div class="row">
                                            <label class="row-title" for="shop2-text">Текст:</label>
                                            <input type="text" autocomplete="off" class="type_text" name="search_text" size="20" value="" />
                                        </div>


                                        <div class="row">
                                            <div class="row-title">Выберите категорию:</div>
                                            <select name="s[folder_id]" data-placeholder="Все">
                                                <option value="">Все</option>
                                                <option value="67348815" >
                                                    Камни натуральные на развес
                                                </option>
                                                <option value="39914215" >
                                                    Натуральные камни поштучно
                                                </option>
                                                <option value="70758615" >
                                                    Яйца из нефрита
                                                </option>
                                                <option value="68415815" >
                                                    Украшения из натурального камня
                                                </option>
                                                <option value="588372041" >
                                                    Руны по виду камня
                                                </option>
                                                <option value="38276015" >
                                                    Камешки для изучения санскрита
                                                </option>
                                                <option value="39085415" >
                                                    Мотивирующие камешки
                                                </option>
                                                <option value="39086215" >
                                                    Авторские изделия из дерева
                                                </option>
                                                <option value="41904215" >
                                                    Авторские наборы для гадания
                                                </option>
                                            </select>
                                        </div>

                                        <div id="shop2_search_custom_fields" class="shop2_search_custom_fields"></div>


                                        <div class="row">
                                            <div class="row-title">Производитель:</div>
                                            <select name="s[vendor_id]" data-placeholder="Все">
                                                <option value="">Все</option>
                                                <option value="175041841" >Дыхание камня</option>
                                                <option value="4022815" >Кирилл</option>
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="row-title">Новинка:</div>
                                            <select name="s[_flags][2]">
                                                <option value="">Все</option>
                                                <option value="1">да</option>
                                                <option value="0">нет</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="row-title">Спецпредложение:</div>
                                            <select name="s[_flags][1]">
                                                <option value="">Все</option>
                                                <option value="1">да</option>
                                                <option value="0">нет</option>
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="row-title">Результатов на странице:</div>
                                            <select name="s[products_per_page]">
                                                <option value="5">5</option>
                                                <option value="20">20</option>
                                                <option value="35">35</option>
                                                <option value="50">50</option>
                                                <option value="65">65</option>
                                                <option value="80">80</option>
                                                <option value="95">95</option>
                                            </select>
                                        </div>

                                        <div class="clear-container"></div>
                                        <div class="row_button">
                                            <div class="close_search_form">Закрыть</div>
                                            <button type="submit" class="search-btn">Найти</button>
                                        </div>
                                    </form>
                                    <div class="clear-container"></div>
                                </div>
                            </div><!-- Search Form -->
                        </div>
                    </div>
                    <div class="slider-wrap">
                        <jdoc:include type="modules" name="slider" style="none"/>
                    </div>
                    <div class="content_area  " >
                        <style>
                            .shop-pricelist .shop-product-amount input[type=text], .product-amount .shop-product-amount input[type=text] {
                                display: inline-block;
                                vertical-align: middle;
                                width: 24px;
                                height: 23px;
                                font-size: 14px;
                                color: #484848;
                                background: none;
                                border: none;
                                border-bottom: 1px solid #b2b2b2;
                                margin: 0 6px;
                                padding: 0;
                                text-align: center;
                            }
                        </style>
                        <jdoc:include type="component" />
                    </div>
                </div> <!-- .content-inner -->
            </div> <!-- .content -->
        </main> <!-- .main -->
        <aside role="complementary" class="sidebar left">
            <div class="shop-categories-wrap ">
                <div class="title">Каталог товаров</div>
                <jdoc:include type="modules" name="shoping-category" style="none"/>
            </div>
            <jdoc:include type="modules" name="menu-sidebar" style="none" />
        </aside> <!-- .sidebar-left -->
    </div> <!-- .content-wrapper -->
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
                        <?php echo '<img src="' . JUri::root() . 'images/mg_0193.jpg" alt="instagram">'; ?>
                    </a>
                    <a href="https://www.facebook.com/groups/1839191606396653/" target="_blank"><img src="/d/1709126/d/" alt="facebook"></a>
                    <a href="https://vk.com/dyhanie_kamnya" target="_blank"><img src="/d/1709126/d/" alt="vk"></a>
                </div>

                <div class="site-name">© 2017 - 2018 </div>
            </div>
        </div>
        <div class="footer-bottom-area">
            <div class="max-width-wrapper">
            </div>
        </div>
    </footer>
</div> <!-- .site-wrapper -->

</body>
<!-- ID -->
</html>
