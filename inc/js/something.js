(function($){
	wp.customize("show_reveal", function(value) {
		value.bind(function(newval) {
			$("#ads_box").html(newval);
		} );
	});
})(jQuery);