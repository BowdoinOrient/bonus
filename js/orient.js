// When the document is loaded...
$(document).ready(function()
{
    
    // Set up localScroll smooth scroller to scroll the whole document
	$('#mainnav').localScroll({
	   target:'body',
	   duration: '1000' //uh, not sure this is working!
	});
    
	// click nav bar to scroll to top
	$( '#mainhead' ).click( function( e ) {
		//e.preventDefault();
		if (!$(e.target).is('#mainhead') && !$(e.target).is('#head-content')) return;
		$( 'body' ).animate( { scrollTop: 0 }, 'fast' );
	} );

} );