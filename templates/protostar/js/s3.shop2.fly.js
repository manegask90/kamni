/* masalygin */
'use strict';

(function(factory) {

	if (typeof define === 'function' && define.amd) {

		define(['jquery'], factory);

	} else {

		factory(jQuery);

	}

})(function($) {

	$.s3Shop2Fly = function(options) {

		options = $.extend({
			button: '.shop2-product-btn',
			image: '.product-image',
			cart: '#shop2-cart-preview',
			animate: {
				opacity: 0
			}
		}, options);

		$(document).on('click', options.button, function() {
		
			try {

				var $this = $(this),
					form = $this.closest('form'),
					image = form.find(options.image).eq(0),
					position = image.position(),
					offset = image.offset(),
					clone = image.clone(),
					cart = $(options.cart),
					cartOffset = cart.offset(),
					animate = {};
					
				clone.css({
					left: position.left,
					top: position.top,
					position: 'absolute'
				});
				
				image.after(clone);
				
				animate.left = (offset.left - cartOffset.left - position.left) * -1;
				animate.top = (offset.top - cartOffset.top - position.top) * -1;

				$.extend(animate, options.animate)
				
				clone.animate(animate, 500, function() {
					clone.remove();
				});

			} catch(e) {}
			
		});

		return $;

	};

});