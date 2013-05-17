<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ss
 * Date: 10/2/12
 * Time: 11:26 AM
 * To change this template use File | Settings | File Templates.
 */

class FacebookApp
{
    public static function parse_signed_request($signed_request)
    {
        $secret = sfConfig::get('app_facebook_secret');

        list($encoded_sig, $payload) = explode('.', $signed_request, 2);

        // decode the data
        $sig = self::base64_url_decode($encoded_sig);
        $data = json_decode(self::base64_url_decode($payload), true);

        if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
            error_log('Unknown algorithm. Expected HMAC-SHA256');
            return null;
        }

        // check sig
        $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
        if ($sig !== $expected_sig) {
            error_log('Bad Signed JSON signature!');
            return null;
        }

        return $data;
    }

    private static function base64_url_decode($input)
    {
        return base64_decode(strtr($input, '-_', '+/'));
    }
}