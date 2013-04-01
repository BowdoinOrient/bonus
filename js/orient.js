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

// thanks Mark Seecof!
// http://www.php.net/manual/en/function.urlencode.php#85903
function urlencode(s) {
	s = encodeURIComponent(s);
	return s.replace(/~/g,'%7E').replace(/%20/g,'+');
}


//Via stackoverflow: http://stackoverflow.com/a/8897628/2178152
//Will reveal when an element is being placed off the screen
//Implemented like : if($('div').is(':offscreen')){}
jQuery.expr.filters.offscreen = function(el) {
  return (
              (el.offsetLeft + el.offsetWidth) < 0 
              || (el.offsetTop + el.offsetHeight) < 0
              || (el.offsetLeft > window.innerWidth || el.offsetTop > window.innerHeight)
         );
};
