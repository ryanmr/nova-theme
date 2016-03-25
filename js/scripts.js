



(function($){

	function theme_toggle_setup() {

		var target = '.theme-toggle';
		var button = $(target);
		var body = $(document.body);

		button.on('click', theme_toggle);

		var state = $.cookie('theme-toggle');

		if ( state == undefined ) {
			body.removeClass('dark');
			button.html('light');
			$.cookie('theme-toggle', 'light', {expires: 30});
		} else if ( state == 'light' ) {
			body.removeClass('dark');
			button.html('light');
		} else if ( state == 'dark' ) {
			body.addClass('dark');
			button.html('dark');
		}

	}

	function theme_toggle(event) {

		var target = '.theme-toggle';
		var button = $(target);
		var body = $(document.body);
		var state = $.cookie('theme-toggle');

		if ( state == undefined ) {
			state = 'light';
			body.removeClass('dark');
			button.html('light');
		} else if ( state == 'light' ) {
			state = 'dark';
			body.addClass('dark');
			button.html('dark');
		} else if ( state == 'dark' ) {
			state = 'light';
			body.removeClass('dark');
			button.html('light');
		}

		$.cookie('theme-toggle', state, {expires: 30});

		event.stopPropagation();
		event.preventDefault();

	}

	function foot_notes_setup() {

		var target = 'a[rel="footnote"]';
		var element = $(target);

		element.attr('title', 'Jump to this foot note...');

	}

	$(document).ready(function(){
		foot_notes_setup();
		theme_toggle_setup();
		$(document).foundation();

	});

})(jQuery);
