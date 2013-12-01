jQuery(document).ready(function($) {
   
	$( ".widget_somc_andreasonny_widget ul.asc" ).addClass( 'enabled' );

	// Prevent the action when user click on a dropdown menu element
	$( ".widget_somc_andreasonny_widget .children > a" ).click(function( event ) {
	  event.preventDefault();
	});

	// Toggle the subpages dropdown menu
	$('.widget_somc_andreasonny_widget .children').on('click', function() {
		$( this ).toggleClass( 'active' );
	});

	$( ".widget_somc_andreasonny_widget .sort_order" ).click(function( event ) {
	  event.preventDefault();

	  $( this ).parent().children( 'ul.desc' ).toggleClass( 'enabled' );
	  $( this ).parent().children( 'ul.asc' ).toggleClass( 'enabled' );
	
	});

});