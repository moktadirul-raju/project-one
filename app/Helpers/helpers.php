<?php

/**
 * Fetch base url
 */
if(! function_exists('baseUrl')) {
    function baseUrl() {
        return url('/');
    }
}

/**
 * Make a string encrypt/decrypt
 * @returns string
 */
if (! function_exists('encryptDecrypt')) {
    function encryptDecrypt($key, $type){
        $str_rand = "XxOx*4e!hQqG5b~9a";
        if( !$key ){ return false; }
        if($type=='decrypt'){
            $en_slash_added1 = trim(str_replace(array('id'), '/', $key));
            $en_slash_added = trim(str_replace(array('id'), '%', $en_slash_added1));
            $key_value = openssl_decrypt($en_slash_added,"AES-128-ECB",$str_rand);
            return $key_value;
        }elseif($type=='encrypt'){
            $key_value = openssl_encrypt($key,"AES-128-ECB",$str_rand);
            $en_slash_remove1 = trim(str_replace(array('/'), 'id', $key_value));
            $en_slash_remove = trim(str_replace(array('%'), 'id', $en_slash_remove1));
            return $en_slash_remove;
        }
        return FALSE;	# if function is not used properly
    }
}

/**
 * return alert message
 */
if(! function_exists('alertMessage')) {
    function alertMessage($type,$message) {
        return [
            'type' => $type ?? 'info',
            'message' => $message
        ];
    }
}
