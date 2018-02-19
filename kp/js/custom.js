/**
 * Custom js functions for theme
 *
 * @package compact-one
 */

jQuery( document ).ready(
	function($){

		// header.
		$( window ).scroll(
			function()  {
				if ($( this ).scrollTop() > 0) {
					$( '.compact_one_header' ).addClass( "sticky-header2" );
				} else {
					$( '.compact_one_header' ).removeClass( "sticky-header2" );
				}
			}
		);
		$( '.navbar-nav li' ).click(
			function(event){
				$( this ).addClass( 'active' ).siblings().removeClass( 'active' );
			}
		);

		/* toggle panel */
		$( '#accordion' )
		.on(
			'show.bs.collapse', function(e) {
				$( e.target ).prev( '.panel-heading' ).addClass( 'active' );
			}
		)
		.on(
			'hide.bs.collapse', function(e) {
				$( e.target ).prev( '.panel-heading' ).removeClass( 'active' );
			}
		);
		function toggleIcon(e) {
			jQuery( e.target )
			.prev( '.panel-heading' )
			.find( ".more-less" )
			.toggleClass( 'glyphicon-plus glyphicon-minus' );

		}
		jQuery( '.panel-group' ).on( 'hidden.bs.collapse', toggleIcon );
		jQuery( '.panel-group' ).on( 'shown.bs.collapse', toggleIcon );

		/* animation */
		wow = new WOW(
			{
				animateClass: 'animated',
				offset:       100
			}
		);
		wow.init();

		// about us section-progressbar.
		jQuery( '.progress .progress-bar' ).css(
			"width",
			function() {
						return jQuery( this ).attr( "aria-valuenow" ) + "%";
			}
		)

		/* work-isotope tabs */
		// init Isotope.
		var $grid = jQuery( '.grid' ).isotope(
			{
				itemSelector: '.element-item',
				layoutMode: 'masonry'
			}
		);

		// bind filter button click.
		jQuery( '.filters-button-group' ).on(
			'click', 'button', function() {
				var filterValue = jQuery( this ).attr( 'data-filter' );
				$grid.isotope( { filter: filterValue } );
			}
		);
		// change is-checked class on buttons.
		jQuery( '.button-group' ).each(
			function( i, buttonGroup ) {
				var $buttonGroup = jQuery( buttonGroup );
				$buttonGroup.on(
					'click', 'button', function() {
						$buttonGroup.find( '.is-checked' ).removeClass( 'is-checked' );
						jQuery( this ).addClass( 'is-checked' );
					}
				);
			}
		);

		// count section.
		jQuery( '.counter' ).counterUp(
			{
				delay: 10,
				time: 1000
			}
		);

		animationHover( ".imghvr-push-up", "slideInUp" );
		function animationHover(element, animation){
			element = $( element );
			element.hover(
				function() {
					$( this ).children( "figcaption" ).addClass( 'animated ' + animation );
				},
				function(){
					$( this ).children( "figcaption" ).removeClass( 'animated ' + animation );
				}
			);
		};
	}
);

jQuery( window ).load( function(){jQuery( '.grid' ).isotope( 'layout' );} );
