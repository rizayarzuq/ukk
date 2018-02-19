/**
 * Page scrolling feature
 *
 * @package compact-one
 */

jQuery( document ).ready(
	function(){
		jQuery( '#navigation a[href*="#"]:not([href="#"])' ).bind(
			'click',function () {
				var navheight;
				var hash    = this.hash;
				var sectionId  = hash.substring( 1 );
				var mainlink   = this;

				jQuery( mainlink ).parent( 'li' ).addClass( 'active-link' ).siblings().removeClass( 'active-link' );

				if ( jQuery('section [id*=' + sectionId + ']').length > 0 && jQuery(window).width() >= 751 ){
					jQuery( '#navigation .current' ).removeClass( 'current' );
					jQuery( mainlink ).parent( 'li' ).addClass( 'current' );
				} else {
					jQuery( '#navigation .current' ).removeClass( 'current' );
				}
				if ( jQuery( window ).width() >= 751 ) {
					navheight = jQuery( '.navbar-default' ).height();
				} else {
					navheight = 0;
				}
				if (location.pathname.replace( /^\//,'' ) == this.pathname.replace( /^\//,'' ) && location.hostname == this.hostname) {
					var target = jQuery( this.hash );
					target = target.length ? target : jQuery( '[name=' + this.hash.slice( 1 ) + ']' );
					if (target.length) {
						jQuery( 'html,body' ).animate(
							{
								scrollTop: target.offset().top - navheight + 10
							}, 1500, 'easeInOutExpo'
						);
						return false;
					}
				}
			}
		);
	}
);
