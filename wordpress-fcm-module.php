<?php
/**
 * Geriarte FCM module for WordPress theme.
 * Paste/require this in the theme, or merge into inc/notifications.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_ajax_geriarte_save_fcm_token', 'geriarte_save_fcm_token' );
function geriarte_save_fcm_token() {
    if ( ! is_user_logged_in() ) wp_send_json_error();
    $token = sanitize_text_field( wp_unslash( $_POST['token'] ?? '' ) );
    if ( strlen( $token ) < 40 ) wp_send_json_error();
    update_user_meta( get_current_user_id(), 'geriarte_fcm_token', $token );
    wp_send_json_success();
}

function geriarte_send_fcm_to_user( $user_id, $title, $body, $url = '' ) {
    $token = get_user_meta( (int) $user_id, 'geriarte_fcm_token', true );
    $server_key = get_option( 'geriarte_fcm_server_key', '' );
    if ( ! $token || ! $server_key ) return false;

    $payload = array(
        'to' => $token,
        'data' => array(
            'title' => wp_strip_all_tags( $title ),
            'body'  => wp_strip_all_tags( $body ),
            'url'   => esc_url_raw( $url ?: home_url( '/notificaciones/' ) ),
        ),
        'priority' => 'high',
    );

    $res = wp_remote_post( 'https://fcm.googleapis.com/fcm/send', array(
        'timeout' => 12,
        'headers' => array(
            'Authorization' => 'key=' . $server_key,
            'Content-Type'  => 'application/json',
        ),
        'body' => wp_json_encode( $payload ),
    ) );

    return ! is_wp_error( $res ) && wp_remote_retrieve_response_code( $res ) < 300;
}
