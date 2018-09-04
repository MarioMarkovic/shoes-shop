jQuery(document).ready(function($) {
	$('#display-routes').on('click', function() {
		$('.display-user-routes').animate({
			"margin-right": 0,
			opacity: 1
		}, 500).show();
		$('.overlay').show();
	});
	$('#close-routes').on('click', function() {
		$('.display-user-routes').animate({
			"margin-right": "-300px",
			opacity: 0,
			display: "none"
		}, 500);
		$('.overlay').hide();
	});
});	

window.sr = ScrollReveal({ reset: false });

sr.reveal('.fade', { 
  origin: 'bottom',
  delay: '500',
  distance: '350px', 
  duration: 1500 
});