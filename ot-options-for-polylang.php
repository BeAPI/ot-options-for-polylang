<?php class BEA_Translation {

	function __construct() {
		// Option Tree - Polylang
		add_filter( 'ot_options_id', array( __CLASS__, 'change_ot_key_with_polylang' ) );
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
	public static function change_ot_key_with_polylang( $key ) {
		$lang = pll_current_language();

		if ( is_admin() ) {
			$lang = get_user_meta( get_current_user_id(), 'pll_filter_content', true );
			$selected_lang = filter_input( INPUT_GET, 'lang', FILTER_SANITIZE_STRING );
			if ( ! empty( $selected_lang ) ) {
				$lang = $selected_lang;
			}
		}

		return empty( $lang ) || $lang === 'all' || $lang === pll_default_language() ? $key : $key . '_' . $lang;
	}

}
new BEA_Translation();