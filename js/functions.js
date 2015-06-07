// News System
var $j = jQuery.noConflict();

function toggle_news(newsID) {
	$j('#newstext_' + newsID).slideToggle('slow');
}
