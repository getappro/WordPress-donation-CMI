<?php

// media button inserter - change button text

function cmiedon_change_button_text( $translation, $text, $domain )
{
    if ( 'default' == $domain and 'Insert into Post' == $text )
    {
        remove_filter( 'gettext', 'cmiedon_change_button_text' );
        return 'Use this image';
    }
    return $translation;
}
add_filter( 'gettext', 'cmiedon_change_button_text', 10, 3 );


// currency validation

function cmiedon_sanitize_currency_meta( $value ) {

	if (!empty($value)) {
		$value = (float) preg_replace('/[^0-9.]*/','',$value);
		return number_format((float)$value, 2, '.', '');
	}
}
add_filter( 'sanitize_post_meta_currency_cmiedon', 'cmiedon_sanitize_currency_meta' );