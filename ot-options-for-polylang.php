<?php function __construct() {
	// Option Tree - Polylang
	add_filter( 'ot_options_id', 'bea_change_ot_key_with_polylang' );
}

/**
 * Change the key depending on the current lang
 *
 * @author Maxime CULEA
 *
 * @param $key
 *
 * @return mixed|string|void
 */
function bea_change_ot_key_with_polylang( $key ) {
	// Get Plylang current lang
	$lang = pll_current_language();

	if ( is_admin() ) {
		// Get user lang meta
		$lang = get_user_meta( get_current_user_id(), 'pll_filter_content', true );

		// Get the Polylang selected lang from admin
		$selected_lang = filter_input( INPUT_GET, 'lang', FILTER_SANITIZE_STRING );
		if ( ! empty( $selected_lang ) ) {
			$lang = $selected_lang;
		}
	}

	/**
	 * Depending on if lang is empty or it is the default one
	 * - return default wanted key
	 * - change it to take the current lang : {$key}_{$lang}
	 */
	return empty( $lang ) || $lang === 'all' || $lang === pll_default_language() ? $key : $key . '_' . $lang;
}
