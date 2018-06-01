(function($) {
	
	$(window).load(function() {
		$(document.body).removeClass('overflow_hidden');
		$('#site_loader').hide();
	})
	
	$(document).ready(function() {
		
		

		var $tabs = $('#product_tabs'),
			$win = $(window),
			$doc = $(document),
			isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
			click = 'click',
			srchIsOpen = false;

		$tabs.responsiveTabs({
			rotate: false,
			startCollapsed: 'accordion',
			collapsible: 'accordion',
			animation: 'slide',
			setHash: true
		 });
		 
		 $(document.body).addClass('overflow_hidden');
		 setTimeout(function(){
	 		$(document.body).removeClass('overflow_hidden');
			$('#site_loader').hide();
		 }, 7000)
		 
		 $('.r-tabs-accordion-title').on(click, function() {
			var my_scrollHeight = $('#product_tabs').offset().top,
				my_index = $(this).index() ? $(this).index() / 2 : 0,
				my_height = $(this).outerHeight(),
				my_scrollTop = my_index ? my_scrollHeight + my_height * my_index : my_scrollHeight;
				
			$('html, body').animate({
				scrollTop: my_scrollTop
			}, 500);
		}); 
		
		
		if (shop2.mode=='cart' && document.referrer !== location.href) {
			createCookie('location', document.referrer, 90)
		} 
		
		$('.cart_back_link').click(function(){
			document.location = decodeURIComponent(readCookie('location'));
			return false;
		})
		
		
		if (window.matchMedia( "(max-width: 767px)" ).matches) {
			$('.shop-order-options .option-label').on(click, function() {
				var my_scrollHeight = $('.shop-order-options').offset().top
				
				$('html, body').animate({
					scrollTop: my_scrollHeight
				}, 200);
			});
		}
		 
		$('table').wrap('<div class="table-wrapper"></div>');

		// SLIDER-WRAP

		var slider = $('.slider').bxSlider({
			mode: 'horizontal',
			speed: 300,
			auto: true,
			pause: 5000,
			controls: true,
			pager: true,
			useCSS: true,
			onSlideAfter: function () {
				if (this.auto) {
					slider.startAuto();
				}
			}
		});

		(function() {
			var $productItem = $('.shop-pricelist .shop-product-item.tr'),
				winWidth = $win.width(),
				mobMinSize, mobMaxSize, tablMinSize, tabMaxSize;

			$win.resize(function(event) {
				winWidth = $win.width();

				if (winWidth <= 693 && typeof tablMinSize == 'undefined') {
					tablMinSize = true;
					tabMaxSize = undefined;

					$productItem.each(function() {
						var $this = $(this),
							$colName = $this.find('.td.column-name'),
							$anonce = $this.find('.product-anonce'),
							$option = $this.find('.shop-product-options');

						$colName.append($anonce, $option);
					});
				} else if (winWidth >= 694 && typeof tabMaxSize == 'undefined') {
					tablMinSize = undefined;
					tabMaxSize = true;

					$productItem.each(function() {
						var $this = $(this),
							$colOption = $this.find('.td.column-options'),
							$anonce = $this.find('.product-anonce'),
							$option = $this.find('.shop-product-options');

						$colOption.append($anonce, $option);
					});
				}

				if (winWidth <= 693 && typeof mobMinSize == 'undefined') {
					mobMinSize = true;
					mobMaxSize = undefined;

					$productItem.each(function() {
						var $this = $(this),
							$colPrice = $this.find('.td.column-price'),
							$colAmount = $this.find('.shop-product-amount'),
							$colAdd = $this.find('.shop-btn');

						$colPrice.append($colAmount, $colAdd)
					});

				} else if (winWidth >= 694 && typeof mobMaxSize == 'undefined') {
					mobMinSize = undefined;
					mobMaxSize = true;

					$productItem.each(function() {
						var $this = $(this),
							$colAmount = $this.find('.td.column-amount'),
							$colAdd = $this.find('.td.column-add'),
							$amount = $this.find('.shop-product-amount'),
							$add = $this.find('.shop-btn');

						$colAmount.append($amount);
						$colAdd.append($add);
					});
				}		
			}).trigger('resize');
		}())

		// CATEGORIES

		$('.shop-categories a').on(click, function() {
			var $this = $(this);
			var ul = $this.parents('li:first').find('ul:first');
			if (ul.get(0)) {
					ul.slideToggle();
					$this.toggleClass('openned_level');
					return false;
			}
			return true;
		});

		$('.shop-categories a').on(click, function() {
			var $this = $(this),
				ul = $this.parents('ul'),
				childs = $this.next('ul'),
				parents = [],
				text = '';
		});

		// SELECT-STYLER
		$('.checkbox_type input[type=checkbox]').styler();
		
		if (window.matchMedia( "(min-width: 960px)" ).matches) {
			$('.option_row.type-select select, .search-form select, .shop-filter-params .select_elements select, .additional-cart-params').styler({
				selectPlaceholder: 'Все'
			});
		}

		// SEARCH-INPUTS

		(function() {
			var $typeSearch = $('.search-form .type_text'),
				$typeWrap = $('.search-form .row'),
				className = 'focused';

				$my_checkbox = $('.checkbox_type .jq-checkbox'),
				$wrap_checkbox = $('.checkbox_type label'),
				className1 = 'active';

			$typeSearch.on({
				'focus': function(event) {
					var $this = $(this),
						$parrent = $this.closest('div');
					$parrent.addClass(className);
				},
				'blur': function(event) {
					$typeWrap.removeClass(className)
				}
			});
		})()


		// SLIDER-RANGE

		$('.input_range_slider').each(function(index, el) {

			var $this = $(this),
				$lower = $this.closest('.range_slider_wrapper').find('.low'),
				$upper = $this.closest('.range_slider_wrapper').find('.hight'),
				priceMin = 999999999,
				priceMax = 0,
				arr = [0,40000];
				
			/*if ($this.closest('.range_slider_wrapper').hasClass('price')){
		
				for (var product in shop2products) {
					var price = shop2products[product]['price'];
					
					if (price > priceMax) {
						priceMax = price;
					}
					
					if (price < priceMin) {
						priceMin = price;
					}
				}
				if (priceMin != priceMax) {
					arr.push(priceMin, priceMax);
				} else {
					arr.push(priceMin, priceMax + 1)
				}
			} else if ($this.closest('.range_slider_wrapper').hasClass('range')) {
				var input = $this.closest('.range_slider_wrapper').find('input')[0],
					name = $(input).data('name');

				for (var product in shop2products) {
					var param;
					
					if (typeof shop2products[product].meta != 'undefined') {
						
						param = shop2products[product].meta[name];
						
						if (param > priceMax) {
							priceMax = param;
						}
						
						if (param < priceMin) {
							priceMin = param;
						}
					}
				}
				
				if (priceMin != priceMax) {
					arr.push(Number(priceMin), Number(priceMax));
				} else {
					arr.push(Number(priceMin), Number(priceMax) + 1);
				}
				
			} else {
				arr.push(0,40000);
			}*/

			var slider = $this.noUiSlider({
				start: [$lower.attr('value'), $upper.attr('value')],
				connect: true,
				behaviour: 'drag-tap',
				range: {
					'min': [ arr[0] ],
					'max': [ arr[1] ]
				}
			});

			slider.Link('lower').to($lower);
			slider.Link('upper').to($upper);
		});
		
		// SLIDEOUT-LEFT

		slideoutFunc('#menu', '.mobile-panel-button--open', '.mobile-panel-button--close', 'left', function(slideout) {

			$('.mobile-panel-button--open').on('click', function() {
				$('.mobile-left-panel').show();
			});

			slideout.on('open', function() {
				//$('.mobile-panel-button--close').css('top', $win.scrollTop());
				$('.panel-shadow1').addClass('visible');
				$('.mobile-panel-button').addClass('show_me');
			});

			slideout.on('close', function() {
				$('.panel-shadow1').removeClass('visible');
				$('.mobile-panel-button').removeClass('show_me');
				$('.mobile-left-panel').hide();
			});
			
			$doc.on(isMobile ? 'touchstart' : click, function(event) {
				if (slideout.isOpen()){
					if ($(event.target).closest('#menu, .top-panel-wrap').length) return;
					$('.panel-shadow').removeClass('visible');
					$('.mobile-panel-button').removeClass('show_me');
					slideout.close();
				}
			});
		});

		slideoutFunc('.mobile-left-panel-filter', '.push_to_open_filter, .push_to_open_filter_outside', '.mobile-left-panel-filter #shop-filter-wrap .title', 'left', function(slideout) {
			$('.push_to_open_filter, .push_to_open_filter_outside').on(click, function() {
				$('.mobile-left-panel-filter').show();
			});
			slideout.on('open', function() {
				$('.panel-shadow1').addClass('visible');
				$('.mobile-panel-button').hide();
			});
			slideout.on('close', function() {
				$('.panel-shadow1').removeClass('visible');
				$('.mobile-panel-button').show();
				$('.mobile-left-panel-filter').hide();
			});	
			$doc.on(isMobile ? 'touchstart' : click, function(event) {
				if (slideout.isOpen()){
					if ($(event.target).closest('.mobile-left-panel-filter, .push_to_open_filter, .push_to_open_filter_outside').length) return;
					$('.panel-shadow').removeClass('visible');
					$('.mobile-panel-button').show();
					slideout.close();
				}
			});
		});

		slideoutFunc('.mobile-right-panel', '.search-open-button, .mobile-right-panel .block-title', '.search-form .block-title, .close_search_form', 'right', function(slideout) {
			$('.search-open-button').on('click', function() {
				$('.mobile-right-panel').show();
				$('.top-panel-wrap').css('z-index','98');
			});

			slideout.on('close', function() {
				$('.mobile-right-panel').hide();
				$('.panel-shadow2').removeClass('visible');
				$('.top-panel-wrap').css('z-index', 100);
			});	
			
			$doc.on(isMobile ? 'touchstart' : click, function(event) {
				srchIsOpen = slideout.isOpen();
				if (slideout.isOpen()){
					if ($(event.target).closest('.mobile-right-panel, .top-panel-wrap, #shop2-color-ext-select').length) return;
					$('.panel-shadow2').removeClass('visible');
					slideout.close();
				}
			});
		});
		
		// Has adp panel
		
		if ($('.s3-solution-adpt-panel').length) {
			var adpPanelHeight = $('.s3-solution-adpt-panel').height();
			
			$win.resize(function() {
				adpPanelHeight = $('.s3-solution-adpt-panel').height();
			});
			
			$win.scroll(function() {
				var scrollTop = $win.scrollTop(),
					$fixedSidePanel = $('.mobile-left-panel, .mobile-right-panel .search-form, .mobile-left-panel-filter');

				if (scrollTop > adpPanelHeight) {
					$fixedSidePanel.css('margin-top', 0);
				} else {
					$fixedSidePanel.css({
						marginTop: adpPanelHeight - scrollTop
					});
				}
				
			}).trigger('scroll');
		}

		// STICKY-TOP-PANEL-WRAP

		var stiky_panel = function() {
			if (window.matchMedia('(max-width: 960px)').matches) {
				var to_top = $doc.scrollTop(),
					fixed_panel = $('.top-panel-wrap').outerHeight();
					
				if (document.querySelector('.s3-solution-adpt-panel')) {
					var $topPanelWrap = $('.top-panel-wrap'),
						fixedpanel = $('.s3-solution-adpt-panel').height();

					$topPanelWrap.css({position: 'absolute'});

				    var topPanelFixed = function() { 
				    	if (window.matchMedia('(max-width: 960px)').matches) {
					        var scrollTop = $win.scrollTop();  
	
					        if (scrollTop > fixedpanel) {   
					            $topPanelWrap.removeAttr('style');
					        } else {
					            $topPanelWrap.css({position: 'absolute'});
					        }
				    	}
				    };

				    $win.scroll(topPanelFixed).trigger('scroll');
				      
				} else {

					$win.scroll(function() {
						var pew_pew = $doc.scrollTop();
	
						if (pew_pew > fixed_panel) {
							$('.top-panel-wrap, .mobile-panel-button').addClass('un_slick');
						} else {
							$('.top-panel-wrap, .mobile-panel-button').removeClass('un_slick');
						}
						if (pew_pew > to_top) {
							$('.top-panel-wrap').removeClass('slick');
						} else {
							$('.top-panel-wrap, .mobile-panel-button').addClass('slick');
						}
	
						to_top = $doc.scrollTop();	
					});
				}
			} else {
				$('.top-panel-wrap').removeAttr('style');
			}
		}
		
		stiky_panel();

		var mini_pic_prod = function() {
			if (window.matchMedia('(max-width: 599px)').matches)
				
			{
				var mini_picWdth = $('.product-image').width() + 10,
					mini_picL = $('.product-thumbnails li').length,
					thumb_ul = $('.product-thumbnails ul'),
					thumb_ul = mini_picWdth * mini_picL;
				$('.product-thumbnails ul').width(thumb_ul);

				
				var full_weight_path=0;
			    	$(".page-path a").each(function(){
						full_weight_path+=$(this).width()+30;
			    	});
			   
			    $('.page-path .long_path').width(full_weight_path);
				
				
			} else {
				$('.product-thumbnails ul').removeAttr('style')
				$('.page-path .long_path').removeAttr('style');
			}
			
		}
		mini_pic_prod();

		$win.resize(function () {
			stiky_panel();
			mini_pic_prod();
		});

		// SEARCH_AREA_MOBILE

		$('.push-to-search').on(click, function(event) {
			$('.search-area_mobile').addClass('opened');
			$('.panel-shadow2').addClass('visible');
		});
		
		$doc.on(isMobile ? 'touchstart' : click, function(event) {
			if ($(event.target).closest('.top-panel-wrap, .mobile-right-panel .search-form, #shop2-color-ext-select').length) return;
			$('.search-area_mobile').removeClass('opened');
			$('.panel-shadow2').removeClass('visible');
		});

		$('.clear_type-form').on(click, function(){
			if ( $('.with_clear_type').val() ) {
				$('.with_clear_type').val('')
			} else {
				$('.search-area_mobile').removeClass('opened');
				$('.panel-shadow2').removeClass('visible');
			}
		});

		// TOGGLE-SHOP-ELEMENTS

		$('.shop-search-panel .search-products-basic .title').on(click, function(){
			$('.search-form').toggleClass('opened');
		});

		$doc.on(isMobile ? 'touchstart' : click, function(event) {
			if ($(event.target).closest('.search-products-basic, #shop2-color-ext-select').length) return;
			$('.search-form').removeClass('opened');
		});

		$('.search-more-button .search-open-button').on('click', function(event) {
			$('.search-area_mobile').removeClass('opened');
		});

		$('.site_login_wrap .block-title').on(click, function(){
			$('.site_login_wrap ').toggleClass('opened');
		});

		$doc.on('touchstart click', function(event) {
			if ($(event.target).closest('.site_login_wrap').length) return;
			$('.site_login_wrap').removeClass('opened');
		});
		
		function cartButton(){
			var tabletScreen = window.matchMedia('(max-width: 768px)');
			if (tabletScreen.matches) {
				$('.shop2-cart-preview .open_button').on('click', function(event) {
					$('.shop2-cart-preview_mobile ').addClass('opened');
					$('.panel-shadow2').addClass('visible');
				});
				$doc.on(isMobile ? 'touchstart' : click, function(event) {
					if ($(event.target).closest('.shop2-cart-preview_mobile').length) return;
					$('.shop2-cart-preview_mobile').removeClass('opened');
					$('.panel-shadow3').removeClass('visible');
				});
				$('.shop2-cart-preview_mobile .close_button').on('click', function(event) {
					$('.shop2-cart-preview_mobile').removeClass('opened');
					$('.panel-shadow2').removeClass('visible');
				});
			}
		}

		cartButton();

		shop2.on('afterCartAddItem', cartButton);

		if ( isMobile ) {
			$('.shop-categories-wrap').on(click, function() {
				var isOpened = $('.shop-categories').hasClass('show_categories');
				
				if (isOpened) {
					$('.shop-categories').removeClass('show_categories');
					$('.sidebar.left').css('z-index', '3');
				} else {
					$('.shop-categories').addClass('show_categories');
					$('.sidebar.left').css('z-index', '5');
				}
			})
		} else {
			$('.shop-categories-wrap').hover(
				function () {
					$('.shop-categories').addClass('show_categories');
					$('.sidebar.left').css('z-index', '5');
				},
				function () {
					$('.shop-categories').removeClass('show_categories')
					$('.sidebar.left').css('z-index', '3');
				}
			)
		};

		$('aside.left #shop-filter-wrap .title').on(click, function(){
			$('aside.left #shop-filter-wrap').toggleClass('opened');
		});

		$('.sorting .title_sort').on('click', function() {
			$('.sorting').toggleClass('opened');
		});

		$doc.on(isMobile ? 'tap' : click, function(event) {
			if ($(event.target).closest('.sorting').length) return;
			$('.sorting').removeClass('opened');
		});

		$('.shop-sorting-panel .active_view').on('click', function(){
			$('.view-sorting-dropdown').toggleClass('opened');
		});
		$doc.on(isMobile ? 'touchstart' : click, function(event) {
			if ($(event.target).closest('.view-sorting-dropdown, .shop-sorting-panel .active_view').length) return;
			$('.view-sorting-dropdown').removeClass('opened');
		});

		$('.open_coupon, .close_coupon').on(click, function(){
			var $coupon = $('.shop-coupon'),
				isOpened = $coupon.hasClass('opened'),
				posTop = $('.shop-coupon').closest('.tr').position().top;
				
			if (isOpened) {
				$coupon.removeClass('opened');
				eraseCookie('coupon');
				
			} else {
				$coupon.addClass('opened').css('top', posTop);
				createCookie('coupon', 1, 90);
			}
		});
		
		if ( parseInt(readCookie('coupon')) ) {
			$('.shop-coupon').addClass('opened').css('top', $('.shop-coupon').closest('.tr').position().top);
		}
		
		$('.tpl-form-wrap .tpl-title input[type="checkbox"]').on('click', function() {
			if($(this).is(':checked')) {
				$('.log_in_remember .tpl-title').addClass('checked');
			} else {
				$('.log_in_remember .tpl-title').removeClass('checked');
			}
		});
		
		$('.product-compare input[type="checkbox"]').on('click', function() {
			if($(this).is(':checked')) {
				$('.product-compare').addClass('checked');
			} else {
				$('.product-compare').removeClass('checked');
			}
		});

		 $('.my_frame').owlCarousel({
			items : 3,
			itemsCustom : false,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [960,4],
			itemsTablet: [768,4],
			itemsTabletSmall: [694, 3],
			itemsMobile : [479,2]
		 });

		// WA-SLIDE

		$('.categories-wrap_mobile').waSlideMenu({
			autoHeightMenu: true,
			backOnTop: true,
			scrollToTopSpeed: 200,
			slideSpeed: 250,
			backLinkContent: 'Назад',
			
			onSlideForward : function(){
				$("#menu").animate({ scrollTop: "0" });
				
			}
		});

		$('.site_login_wrap_mobile .login-form').waSlideMenu({
			menuSelector : '.for_wa_slide',
			itemSelector : '.for_wo',
			autoHeightMenu: false,
			backOnTop: true,
			scrollToTopSpeed: 200,
			slideSpeed: 250,
			backLinkContent: 'Назад',

			onSlideForward : function(){
				var LeftPanelHeight = $('#menu').height();
				var ScrollPanelHeight = $('#menu').prop('scrollHeight');
				$('.site_login_wrap_mobile .waSlideMenu-menu .waSlideMenu-inheritedmenu').height(ScrollPanelHeight);
			}
		});
		
		$('.mobile_title').on(click, function() {
			$(this).closest('.site_login_wrap_mobile').css('z-index', 10);
		});
		
		$('.categories_mobile a').on(click, function() {
			$('.site_login_wrap_mobile').removeAttr('style');
		});
		
		// callbackForm
		
		(function() {
			var $body = $(document.body),
				$html = $(document.documentElement),
				$callBackForm = $('<div class="callback-form--table">' +
                                      '<div class="callback-form--cell">' + 
                                           '<div class="callback-form--inner">' + 
                                                '<div class="callback-form">' + 
                                                    '<div class="callback-form--close">Закрыть</div>' +
                                                	'<div class="callback-form--form"></div>' +
                                                '</div>' +
                                            '</div>' + 
                                       '</div>' +
                                   '</div>');

			$body.append($callBackForm);
				
			var getFormHtml = function() {
				$('.callback-form--form').s3IncludeForm('/buy-one-click?form', function() {
					var $this = $(this);
						$form = $('.shop-product'),
						name = $form.find('input[name=product_name]').val(),
						link = $form.find('input[name=product_link]').val();
	
					$this.find('input[name="d[2]"]').val(name);
					$this.find('input[name="d[3]"]').val(link);
				});
			}

			getFormHtml();

			var $cfWrap = $('.callback-form--table'),
				$cf = $('.callback-form'),
				$cfIn = $('.callback-form--inner'),
				$cfBtn = $('.buy-one-click, .callback-form--close'),
				cfIsOpened = $cfWrap.hasClass('opened');

			$win.on('resize', function() {
				var cfHeight = $cf.outerHeight(true);

				winHeight = $win.height();

				if (cfHeight > winHeight) {
					$cfIn.height(winHeight);
				} else {
					$cfIn.removeAttr('style');
				};
			}).trigger('resize');
	
			var showHideForm = function(event) {
				event.preventDefault();
				$cfWrap.toggleClass('opened');
				cfIsOpened = $cfWrap.hasClass('opened');
	
				if (cfIsOpened) {
					$cfWrap.one(whichTransitionEvent(), transitionEnd);
					$html.addClass('overflowHidden');
					$body.addClass('overflowHidden');
				} else {
					$('input, textarea').blur();
					$html.removeClass('overflowHidden');
					$body.removeClass('overflowHidden');
					
					getFormHtml();
				};
	
				function transitionEnd() {
					var $this = $(this);
					$this.find('input:first').focus();
				};
			};

			$cfBtn.on('click', showHideForm);

			$doc.keyup(function(event) {
				if (event.keyCode == 27 && cfIsOpened) {
					$cfWrap.removeClass('opened');
					$('input, textarea').blur();
					cfIsOpened = false;
				};
			}); // callback form end
		})();

		function whichTransitionEvent() {
			var el = document.createElement('fakeelement'),
				transitions = {
					'WebkitTransition': 'webkitTransitionEnd',
					'MozTransition': 'transitionend',
					'MSTransition': 'msTransitionEnd',
					'OTransition': 'oTransitionEnd',
					'transition': 'transitionEnd'
				}, t;
	
			for (t in transitions) {
				if (el.style[t] !== undefined) {
					return transitions[t];
				};
			};
		};

		function slideoutFunc(elem, btnOpn, btnCls, side, func) {
			var slideout = new Slideout({
				'panel': document.querySelector('#panel'),
				'menu': document.querySelector(elem),
				'padding': 288,
				'side': side,
				'tolerance': 70
			});

			slideout.disableTouch();

			$(btnOpn).on('click', function() {
				slideout.open();
			});

			$(btnCls).on('click', function() {
				slideout.close();
			});

			if ($.isFunction(func)) {
				setTimeout(func(slideout), 200);
			}
		};
	});
	if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
		var msViewportStyle = document.createElement('style')
		msViewportStyle.appendChild(
		document.createTextNode(
		'@-ms-viewport{width:auto!important}'
		)
		)
		document.querySelector('head').appendChild(msViewportStyle)
	}

	if(navigator.userAgent.match(/iemobile/i)){
	    $(document.documentElement).addClass('ie_fix')
	}
	
}(jQuery));