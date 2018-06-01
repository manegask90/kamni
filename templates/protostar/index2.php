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
<!doctype html>
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
    <link rel="stylesheet" href="http://kamni/templates/protostar/css/styles_articles_tpl.css">
    <script src="http://kamni/templates/protostar/js/jquery.min.js"></script>
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
<!--    <link rel="icon" href="http://kamni/templates/protostar/favicon.ico?1527570649" type="image/x-icon">-->





    <link rel="stylesheet" type="text/css" href="http://kamni/templates/protostar/css/theme.less.css"><script type="text/javascript" src="js/printme.js"></script>
    <script type="text/javascript" src="http://kamni/templates/protostar/js/tpl.js"></script>
    <script type="text/javascript" src="http://kamni/templates/protostar/js/baron.min.js"></script>
    <script type="text/javascript" src="http://kamni/templates/protostar/js/shop2.2_new.js"></script>
    <!--<script type="text/javascript">shop2.init({"productRefs": [],"apiHash": {"getSearchMatches":"85d5c9343232203e2ed5ce113feb7d27","getFolderMeta":"96e19df790e3ff1b73fbe7c64872849d","getFolderCustomFields":"b3441b6cb523744488f8539f84edc386","getProductListItem":"9954a661d95374bc214b8477c50582af","cart":"afb92eb8b0d10db4c8a98fde3abbaf23","cartAddItem":"58781bbe8ecccebbd0f09907485b80a4","cartRemoveItem":"f98a1ec05e00356b3324cf829ba93f2c","cartUpdate":"9bdcfae7309568b976620ab7b4309a94","cartRemoveCoupon":"ccc59766f2dab886387638f4cba403e1","cartAddCoupon":"9e14b9e08074ab6632b8e89d3b5f457b","deliveryCalc":"3f168ff7d32a16fb3b77c6afa0a25972","print":"0199c36c91e31668546ef6547938440b","printOrder":"d048a13bec9d71dc3adde732e451d3a7","cancelOrder":"be20773229ed1eb6479389648d5f642f","repeatOrder":"a96f15e1e9b7ee3405a82eb4cb48c198","tags":"72a2c36c8a73c27a9e99339510e5defa","refs":"0a8376130b0225e404326076c15885da","compare":"c2a169b160433a94af413a7ffe4c4b7c","folderSearch":"f8af30df01291426f85f2bb172f47520","getFolderVendors":"6b6375eb6a11763003db51a6e6d27b9b"},"verId": 1709126,"mode": "main","step": "","uri": "/shop","IMAGES_DIR": "/d/1709126/d/","my": {"list_picture_enlarge":true,"accessory":"\u0410\u043a\u0441\u0441\u0435\u0441\u0441\u0443\u0430\u0440\u044b","kit":"\u041d\u0430\u0431\u043e\u0440","recommend":"\u0420\u0435\u043a\u043e\u043c\u0435\u043d\u0434\u0443\u0435\u043c\u044b\u0435","similar":"\u041f\u043e\u0445\u043e\u0436\u0438\u0435","modification":"\u041c\u043e\u0434\u0438\u0444\u0438\u043a\u0430\u0446\u0438\u0438","unique_values":true,"price_fa_rouble":true,"small_images_width":"120"}});</script>-->
    <!--<style type="text/css">.product-item-thumb {width: 180px;}.product-item-thumb .product-image, .product-item-simple .product-image {height: 160px;width: 180px;}.product-item-thumb .product-amount .amount-title {width: 84px;}.product-item-thumb .product-price {width: 130px;}.shop2-product .product-side-l {width: 180px;}.shop2-product .product-image {height: 160px;width: 180px;}.shop2-product .product-thumbnails li {width: 50px;height: 50px;}</style>-->

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

    <jdoc:include type="head" />
</head>
<body>
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
                            <form method="post" action="/user">
                                <input type="hidden" name="mode" value="login" />
                                <div class="row">
                                    <label class="row_title" for="login">Логин или e-mail:</label>
                                    <label class="field text"><input type="text" name="login" tabindex="1" value="" /></label>
                                </div>
                                <div class="row">
                                    <label class="row_title" for="password">Пароль:</label>
                                    <label class="field password"><input type="password" name="password" tabindex="2" value="" /></label>
                                </div>
                                <a href="/user/forgot_password">Забыли пароль?</a>
                                <div class="row_button">
                                    <button type="submit" class="signin-btn" tabindex="3">Войти</button>
                                </div>
                            </form>
                            <div class="clear-container"></div>
                            <div class="reg_link-wrap">
                                <a href="/user/register" class="register">Регистрация</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="categories-wrap_mobile">
        <ul class="categories_mobile">
            <li class="categories_title">Каталог товаров</li>
            <li ><a href="/shop/folder/kamni-naturalnyye">Камни натуральные на развес</a>
            </li>
            <li ><a href="/shop/folder/naturalnyye-kamni-poshtuchno">Натуральные камни поштучно</a>
            </li>
            <li ><a href="/shop/folder/yaytsa-iz-nefrita">Яйца из нефрита</a>
            </li>
            <li ><a href="/shop/folder/ukrasheniya-iz-naturalnogo-kamnya">Украшения из натурального камня</a>
            </li>
            <li ><a href="/shop/folder/runy">Руны по виду камня</a>
            </li>
            <li ><a href="/shop/folder/kameshki-dlya-izucheniya-sanskrita">Камешки для изучения санскрита</a>
            </li>
            <li ><a href="/shop/folder/motiviruyushchiye-kameshki">Мотивирующие камешки</a>
            </li>
            <li ><a href="/shop/folder/avtorskiye-izdeliya-iz-dereva">Авторские изделия из дерева</a>
            </li>
            <li ><a href="/shop/folder/avtorskiye-nabory-dlya-gadaniya">Авторские наборы для гадания</a>
            </li>
        </ul>
    </div>
    <ul class="top-menu_mobile">
        <li><a href="/" >Главная</a></li>
        <li><a href="/novosti" >Новости</a></li>
        <li><a href="/dostavka" >Контакты и доставка</a></li>
        <li><a href="/karta-sayta" >Карта сайта</a></li>
        <li><a href="/search" >Поиск по сайту</a></li>
        <li><a href="/user" >Регистрация</a></li>
        <li><a href="/otziv" >Отзывы</a></li>
        <li><a href="/sotrudnichestvo" >Сотрудничество</a></li>
    </ul>
    <ul class="left-menu_mobile">
        <li><a href="/stati" >Статьи</a></li>
        <li><a href="/uslugi" >Услуги</a></li>
        <li><a href="/master-klassy" >Мастер-классы</a></li>
    </ul>
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
                            <div class="empty_cart_title">Корзина пуста</div>
                            <a href="/shop/cart" class="link_to_cart">Оформить заказ</a>
                            <a href="/shop/cart" class="link_to_cart_mobile"></a>
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
                <ul class="top-menu">
                    <li><a href="/" >Главная</a></li>
                    <li><a href="/novosti" >Новости</a></li>
                    <li><a href="/dostavka" >Контакты и доставка</a></li>
                    <li><a href="/karta-sayta" >Карта сайта</a></li>
                    <li><a href="/search" >Поиск по сайту</a></li>
                    <li><a href="/user" >Регистрация</a></li>
                    <li><a href="/otziv" >Отзывы</a></li>
                    <li><a href="/sotrudnichestvo" >Сотрудничество</a></li>
                </ul>

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
                                        <form method="post" action="/user">
                                            <input type="hidden" name="mode" value="login" />
                                            <div class="row">
                                                <label class="row_title" for="login">Логин или e-mail:</label>
                                                <label class="field text"><input type="text" name="login" tabindex="1" value="" /></label>
                                            </div>
                                            <div class="row">
                                                <label class="row_title" for="password">Пароль:</label>
                                                <label class="field password"><input type="password" name="password" tabindex="2" value="" /></label>
                                            </div>
                                            <a href="/user/forgot_password">Забыли пароль?</a>
                                            <div class="row_button">
                                                <button type="submit" class="signin-btn" tabindex="3">Войти</button>
                                            </div>
                                        </form>
                                        <div class="clear-container"></div>
                                        <div class="reg_link-wrap">
                                            <a href="/user/register" class="register">Регистрация</a>
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
                <div class="logo-pic"><img src="/d/1709126/d/logo_0.png" alt="Дыхание камня"></div>
                <div class="logo-text-wrap">
                    <div class="logo-text">
                        <div class="company_name">Дыхание камня</div>
                        <div class="logo-desc">Натуральные камни. Руны</div>                	</div>
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
                            <div class="empty_cart_title">Корзина пуста</div>
                            <a href="/shop/cart" class="link_to_cart">Оформить заказ</a>
                            <a href="/shop/cart" class="link_to_cart_mobile"></a>
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
                        <form class="search-products-lite" action="/shop/search" enctype="multipart/form-data">
                            <input type="text" placeholder="Поиск товаров" autocomplete="off" name="s[name]" value="">
                            <button class="push_to_search" type="submit"></button>
                        </form>
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
                            </div><!-- Search Form -->                        </div>
                    </div>
                    <div class="slider-wrap">
                        <ul class="slider">
                            <li><a href="http://dyhanie-kamnya.ru/shop/product/runy-iz-rozovogo-kvartsa-svetlyye"><img src="/thumb/MY6frZqcviIxciVOC-k7vw/676c357/1709126/img_9451.jpg" alt="руны из розового кварца"></a></li>
                            <li><a href="http://dyhanie-kamnya.ru/shop/product/galtovka-assorti-100-gramm"><img src="/thumb/LEMgmFXK9iL7hgjiHrFaWA/676c357/1709126/sl2.jpg" alt="галтовка ассорти 100 грамм"></a></li>
                            <li><a href="http://dyhanie-kamnya.ru/shop/product/runy-iz-khrustalya-okrasheny-krasnym"><img src="/thumb/MuuCIeV_G9iZVIqNgSC6SQ/676c357/1709126/mg_0639.jpg" alt="руны из хрусталя"></a></li>
                            <li><a href="http://dyhanie-kamnya.ru/shop/product/runy-iz-kakholonga-2-3-2-8-sm"><img src="/thumb/-q_YfUWIj3Eh04o_ult_TQ/676c357/1709126/img_9471.jpg" alt="руны из кахалонга"></a></li>
                            <li><a href="http://dyhanie-kamnya.ru/shop/product/krupnyye-runy-iz-zheltogo-oniksa-2-5-2-8-sm"><img src="/thumb/3Vhg4iFf0WE3vP5NSJjZ9g/676c357/1709126/mg_0139.jpg" alt="руны из оникса"></a></li>
                            <li><a href="http://dyhanie-kamnya.ru/shop/product/runy-iz-chernogo-obsidiana-1-1-5-sm-v-zolotom-variante"><img src="/thumb/-WJTjYXUn3SAkBqEioWbdQ/676c357/1709126/img_9468.jpg" alt="руны из черного обсидиана"></a></li>
                        </ul>
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
                                font-family: 'roboto-r';
                                border: none;
                                border-bottom: 1px solid #b2b2b2;
                                margin: 0 6px;
                                padding: 0;
                                text-align: center;
                            }
                        </style>






                        <div class="shop-main-before">
                            <p>Дыхание камня - это мой маленький мир в котором живут прекрасные маленькие каменные тролли. В котором камни - это самые медленные домашние питомцы, каждый из которых имеет свой характер и предпочтения.&nbsp;</p>
                            <p>И я очень хочу чтобы вы нашли здесь кусочек волшебства для себя, чтобы стали более сильными, нежными, проявленными... любящими.</p>
                            <p>&nbsp;</p>
                            <p><a href="/shop/folder/ukrasheniya-iz-naturalnogo-kamnya"><img class="mce-s3-button" src="/d/1709126/d/buttons/2383015.png" /></a>&nbsp;</p>
                            <p>&nbsp;<a href="/shop/folder/runy"><img class="mce-s3-button" src="/d/1709126/d/buttons/2383215.png" /></a>&nbsp;</p>
                            <p>&nbsp;<a href="/shop/folder/yaytsa-iz-nefrita"><img class="mce-s3-button" src="/d/1709126/d/buttons/2382615.png" /></a></p>
                            <p><a href="/shop/folder/kamni-naturalnyye"><img class="mce-s3-button" src="/d/1709126/d/buttons/2382815.png" /></a></p>
                            <p>&nbsp;</p>
                        </div>









                    </div>
                </div> <!-- .content-inner -->
            </div> <!-- .content -->
        </main> <!-- .main -->
        <aside role="complementary" class="sidebar left">
            <div class="shop-categories-wrap ">
                <div class="title">Каталог товаров</div>
                <ul class="shop-categories">
                    <li ><a href="/shop/folder/kamni-naturalnyye">Камни натуральные на развес</a>
                    </li>
                    <li ><a href="/shop/folder/naturalnyye-kamni-poshtuchno">Натуральные камни поштучно</a>
                    </li>
                    <li ><a href="/shop/folder/yaytsa-iz-nefrita">Яйца из нефрита</a>
                    </li>
                    <li ><a href="/shop/folder/ukrasheniya-iz-naturalnogo-kamnya">Украшения из натурального камня</a>
                    </li>
                    <li ><a href="/shop/folder/runy">Руны по виду камня</a>
                    </li>
                    <li ><a href="/shop/folder/kameshki-dlya-izucheniya-sanskrita">Камешки для изучения санскрита</a>
                    </li>
                    <li ><a href="/shop/folder/motiviruyushchiye-kameshki">Мотивирующие камешки</a>
                    </li>
                    <li ><a href="/shop/folder/avtorskiye-izdeliya-iz-dereva">Авторские изделия из дерева</a>
                    </li>
                    <li ><a href="/shop/folder/avtorskiye-nabory-dlya-gadaniya">Авторские наборы для гадания</a>
                    </li></ul>
                </ul>
            </div>
            <ul class="left-menu"><li><a href="/stati" >Статьи</a></li><li><a href="/uslugi" >Услуги</a></li><li><a href="/master-klassy" >Мастер-классы</a></li></ul>                    </aside> <!-- .sidebar-left -->
    </div> <!-- .content-wrapper -->
    <footer role="contentinfo" class="footer">
        <div class="max-width-wrapper">
            <ul class="footer-menu">
                <li><a href="/" >Главная</a></li>
                <li><a href="/novosti" >Новости</a></li>
                <li><a href="/dostavka" >Контакты и доставка</a></li>
                <li><a href="/karta-sayta" >Карта сайта</a></li>
                <li><a href="/search" >Поиск по сайту</a></li>
                <li><a href="/user" >Регистрация</a></li>
                <li><a href="/otziv" >Отзывы</a></li>
                <li><a href="/sotrudnichestvo" >Сотрудничество</a></li>
            </ul>
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
                    <a href="https://www.instagram.com/dyhanie_kamnya/" target="_blank"><img src="/d/1709126/d/mg_0193.jpg" alt="instagram"></a>
                    <a href="https://www.facebook.com/groups/1839191606396653/" target="_blank"><img src="/d/1709126/d/" alt="facebook"></a>
                    <a href="https://vk.com/dyhanie_kamnya" target="_blank"><img src="/d/1709126/d/" alt="vk"></a>
                </div>

                <div class="site-name">&copy; 2017 - 2018 </div>
            </div>
        </div>
        <div class="footer-bottom-area">
            <div class="max-width-wrapper">
                <div class="site-copyright"><span style='font-size:10px;' class='copyright'><!--noindex--><a href="https://megagroup.ru" target="_blank" rel="nofollow"><img src="http://cp1.megagroup.ru/g/mlogo/svg/sozdanie-saitov-megagroup-ru-dark.svg" class="copyright"></a><!--/noindex--></span></div>
                <div class="counters"><!-- Yandex.Metrika counter -->
                    <script type="text/javascript">
                        (function (d, w, c) {
                            (w[c] = w[c] || []).push(function() {
                                try {
                                    w.yaCounter45207837 = new Ya.Metrika({
                                        id:45207837,
                                        clickmap:true,
                                        trackLinks:true,
                                        accurateTrackBounce:true,
                                        webvisor:true
                                    });
                                } catch(e) { }
                            });

                            var n = d.getElementsByTagName("script")[0],
                                s = d.createElement("script"),
                                f = function () { n.parentNode.insertBefore(s, n); };
                            s.type = "text/javascript";
                            s.async = true;
                            s.src = "https://mc.yandex.ru/metrika/watch.js";

                            if (w.opera == "[object Opera]") {
                                d.addEventListener("DOMContentLoaded", f, false);
                            } else { f(); }
                        })(document, window, "yandex_metrika_callbacks");
                    </script>
                    <noscript><div><img src="https://mc.yandex.ru/watch/45207837" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
                    <!-- /Yandex.Metrika counter -->

                    <script>
                        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                        ga('create', 'UA-102050547-1', 'auto');
                        ga('send', 'pageview');

                    </script>

                    <!--LiveInternet counter--><script type="text/javascript">
                        document.write("<a href='//www.liveinternet.ru/click' "+
                            "target=_blank><img src='//counter.yadro.ru/hit?t12.4;r"+
                            escape(document.referrer)+((typeof(screen)=="undefined")?"":
                                ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                                screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
                            ";"+Math.random()+
                            "' alt='' title='LiveInternet: показано число просмотров за 24"+
                            " часа, посетителей за 24 часа и за сегодня' "+
                            "border='0' width='88' height='31'><\/a>")
                    </script><!--/LiveInternet--><!--cms statistics-->
                    <script type="text/javascript"><!--
                        var megacounter_key="c415392a7ca2ab24515f282b533029b9";
                        (function(d){
                            var s = d.createElement("script");
                            s.src = "//counter.megagroup.ru/loader.js?"+new Date().getTime();
                            s.async = true;
                            d.getElementsByTagName("head")[0].appendChild(s);
                        })(document);
                        //--></script>
                    <!--/cms statistics-->
                    <!--__INFO2018-05-29 10:10:49INFO__-->
                </div>            </div>
        </div>
    </footer><!-- .footer -->
</div>
<script src="http://kamni/templates/protostar/js/splitwords.js"></script>

<!-- assets.bottom -->
<script src="http://kamni/templates/protostar/js/site.min.js?1526302737" type="text/javascript" ></script>
<script src="https://cp.onicon.ru/loader/5953349b28668847218b45d5.js" type="text/javascript" data-auto async></script>
<script type="text/javascript" >/*<![CDATA[*/
    $ite.start({"sid":1699368,"vid":1709126,"aid":2015843,"cp":15,"active":"0","domain":"dyhanie-kamnya.ru","lang":"ru","trusted":false,"debug":false});
    /*]]>*/</script>
<!-- /assets.bottom -->

</body>
<!-- ID -->
</html>
