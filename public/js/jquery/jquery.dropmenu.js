(function($) {
	$.fn.dropmenu = function(options) {
		return this.each(function() {

			var opts  = $.extend({}, $.fn.dropmenu.defaults, options),
				$menu = $(this),
				$topl = $menu.find('> li'),
				menuX = $menu.offset().left;

			if (opts.maxWidth == 0) {
				opts.maxWidth = $('body').width() - menuX;
			}

			//	UL itself and all LI's
			$menu
				.css({
					display		: 'block',
					listStyle	: 'none'
				})
				.find("li")
				.css({
					display		: 'block',
					listStyle	: 'none',
					position	: 'relative',
					margin		: 0,
					padding		: 0
				});
			
			
			var css = {
				display		: 'block',
				outline		: 'none'
			};
			if (opts.nbsp) css['whiteSpace'] = 'nowrap';
			
			//	all A's and SPANs
			$menu
				.find('li > a, li > span')
				.css(css);

			//	top-level LI's and top level A's and SPANs
			$topl
				.css({
					float		: 'left'
				})
				.find('> a, > span')
				.addClass('toplevel')
				.css({
					float		: 'left'
				});		


			$menu.find('a').click(function() {
				$('ul', $menu).hide();
				$('a, span', $menu).removeClass('hover');
			});

			$menu.find('li').hover(
				
				//	showing submenu
				function() {
					var listit = this,
						subnav = $.fn.dropmenu.getSubnav(listit),
						subcss = { zIndex: $.fn.dropmenu.zIndex++ };

					$(listit).find('> a, > span').addClass('hover');

					if (!subnav) return;
				//	hiding submenu
				}, function() {
					var listit = this,
						subnav = $.fn.dropmenu.getSubnav(listit);

					if (!subnav) {
						$(listit).find('> a, > span').removeClass('hover');
						return;
					}
				}
			);
		});
	};
	
	$.fn.dropmenu.getSubnav = function(ele) {
		if (ele.nodeName.toLowerCase() == 'li') {
			var subnav = $('> ul', ele);
			return subnav.length ? subnav[0] : null;
		} else {
			return ele;
		}
	}
	
	$.fn.dropmenu.zIndex 	= 1000;
	$.fn.dropmenu.defaults 	= {
		effect			: 'none',		//	'slide', 'fade', or 'none'
		speed			: 'normal',		//	'normal', 'fast', 'slow', 100, 1000, etc
		timeout			: 250,
		nbsp			: false,
		maxWidth		: 0
	};
})(jQuery);