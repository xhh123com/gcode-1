<?php

namespace App\Components\Common;

class AES
{
    public static function pkcs7_pad($str)
    {
        $len = mb_strlen($str, '8bit');
        $c = 16 - ($len % 16);
        $str .= str_repeat(chr($c), $c);
        return $str;
    }

    //    PHP7.1以上使用   加密
    public static function encryptData($data, $key)
    {
        $str_padded = AES::pkcs7_pad($data);
        $encrypted = openssl_encrypt($str_padded, 'aes-128-cbc', $key, OPENSSL_NO_PADDING, env('AES_IV', ''));
        $encrypted = base64_encode($encrypted);
//        return str_replace("+", "%2B", $encrypted);
        return $encrypted;
    }


    //    PHP7.1以上使用    解密
    public static function decryptData($data, $key)
    {
        $charlist = " \t\n\r\0\x00\x01\x02\x03\x04\x05\x06\x07\x08\x09\x0A\x0B\x0C\x0D\x0E\x0F";
        $decrypted = openssl_decrypt(base64_decode($data), 'aes-128-cbc', $key, OPENSSL_NO_PADDING, env('AES_IV', ''));
        $decrypted = rtrim($decrypted, $charlist);
        return $decrypted;
    }
}