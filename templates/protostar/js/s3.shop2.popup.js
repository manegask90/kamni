/* masalygin */
'use strict';

(function(factory) {

	if (typeof define === 'function' && define.amd) {

		define(['jquery'], factory);

	} else {

		factory(jQuery);

	}

})(function($) {

	function compile(tpl, data) {

		$.each(data, function(key, value) {
			var regex = new RegExp('{{' + key + '}}', 'g');
			tpl = tpl.replace(regex, value);
		});

		return tpl;
	}

	$.s3Shop2Popup = function(options) {
	
		if ( window._s3Lang.code == 'en' || window._s3Lang.code == 'de') {
			var langCheckout = 'Checkout',
				langShopContinue = 'Continue shopping';
		} else {
			var langCheckout = 'Оформить заказ',
				langShopContinue = 'Продолжить покупки';
		}

		options = $.extend({
			tpl:
				'<div class="shop2-alert-header">' + window._s3Lang['JS_SHOP2_PRODUCT_ADDED_TO_CART'] + '</div>' +
				'<div class="shop2-alert-buttons">' +
					'<a class="shop2-btn" href="{{uri}}/cart">'+ langCheckout +'</a>' +
					'<a class="shop2-alert-close" onclick="{{hideCommand}}; return false;" href="#">'+ langShopContinue +'</a>' +
				'</div>',
			tpl0:
				'<div class="shop2-alert-header">' + window._s3Lang['JS_SHOP2_PRODUCT_ADDED_TO_CART'] +
				'<div class="shop2-alert-buttons">' +
					'<a class="shop2-button" href="{{uri}}/cart">' +
						'<span class="shop2-button-left">' + langCheckout + '</span>' +
						'<span class="shop2-button-right"></span>' +
					'</a>' +
					'<a class="shop2-alert-close" onclick="{{hideCommand}}; return false;" href="#">'+ langShopContinue +'</a>' +
				'</div>'
		}, options);

		var data = {
			hideCommand: '',
			uri: ''
		};

		var html = '';

		var alert = $.noop;

		function msg(d) {

			if (d && !d.errstr) {

				alert(html, '', 'shop2-alert-cart');

			}

		}

		if (typeof shopClient === 'object') {

			alert = shopClient.alert;
			data.hideCommand = 'shopClient.alert.hide()';
			data.uri = shopClient.uri;
			html = compile(options.tpl0, data);

			var _post = $.post;

			$.post = function() {
				var arg = [].slice.call(arguments),
					callback = arg[2];

				if (arg[0] === '/my/s3/api/shop2/?cmd=cartAddItem') {

					arg[2] = function() {
						var arg = [].slice.call(arguments);
						callback.apply(this, arg);
						msg.apply(this, arg);
					};

				}

				_post.apply(this, arg);
			};


		} else {

			alert = shop2.alert;
			data.hideCommand = 'shop2.alert.hide()';
			data.uri = shop2.uri;
			html = compile(options.tpl, data);

			shop2.on('afterCartAddItem', msg);

		}

	};

});