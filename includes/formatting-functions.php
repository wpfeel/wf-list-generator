<?php
defined('ABSPATH')|| exit();

/**
 * Sanitizes a string key
 *
 * Keys are used as internal identifiers. Alphanumeric characters, dashes, underscores, stops, colons and slashes are allowed
 * since 1.0.0
 *
 * @param $key
 *
 * @return string
 */
function wflg_sanitize_key( $key ) {

    return preg_replace( '/[^a-zA-Z0-9_\-\.\:\/]/', '', $key );
}

/**
 * Convert a string to array
 *
 * @param        $string
 * @param string $separator
 * @param array $callbacks
 *
 * @return array
 * @since 1.0.0
 *
 */
function wflg_string_to_array( $string, $separator = ',', $callbacks = array() ) {
    $default   = array(
        'trim',
    );
    $callbacks = wp_parse_args( $callbacks, $default );
    $parts     = explode( $separator, $string );

    if ( ! empty( $callbacks ) ) {
        foreach ( $callbacks as $callback ) {
            $parts = array_map( $callback, $parts );
        }
    }

    return $parts;
}

/**
 * Get host url after removing 'https::www'
 *
 * @param $url
 *
 * @return mixed
 */
function wflg_get_host( $url, $base_domain = false ) {
    $parseUrl = parse_url( trim( esc_url_raw( $url ) ) );

    if ( $base_domain ) {
        $host = trim( $parseUrl['host'] ? $parseUrl['host'] : array_shift( explode( '/', $parseUrl['path'], 2 ) ) );
    } else {
        $scheme = ! isset( $parseUrl['scheme'] ) ? 'http' : $parseUrl['scheme'];

        return $scheme . "://" . $parseUrl['host'];
    }

    return $host;
}

/**
 * Array to string separator
 *
 * @param string $separator - the separator to separate array items
 * @param array $array - array to slice and make string with separator
 *
 * @return string|boolean
 */
function wflg_array_separator( string $separator, array $array ) {

    return is_array( $array ) ? implode( $separator, $array ) : false;

}
