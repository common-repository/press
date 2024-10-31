var press_information_input	= jQuery('#press_information input');
var press_sms						= jQuery('#press_sms');
var press_telephone					= jQuery('#press_telephone');
var press_hashtag					= jQuery('#press_hashtag');
var press_twitter					= jQuery('#press_twitter');


press_information_input.bind('blur', function(){

	if( press_sms.length && press_sms.val() != '' )
	{
		press_sms.val( jQuery.trim( press_sms.val().replace(/[^0-9\s]/g,'') ).replace( /\s\s+/g, ' ' ) );
	}

	if( press_telephone.length && press_telephone.val() != '' )
	{
		press_telephone.val( jQuery.trim( press_telephone.val().replace(/[^0-9\s]/g,'') ).replace( /\s\s+/g, ' ' ) );
	}

	if( press_hashtag.length && press_hashtag.val() != '' )
	{
		press_hashtag.val( press_hashtag.val().toUpperCase().replace(/[^0-9A-Z]/g,'') );
	}

	if( press_twitter.length && press_twitter.val() != '' )
	{
		press_twitter.val( press_twitter.val().replace(/[^0-9a-zA-Z_]/g,'') );
	}

});