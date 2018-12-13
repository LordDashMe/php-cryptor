<?php

/*
 * This file is part of the Cryptor.
 *
 * (c) Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LordDashMe\Cryptor\OpenSSL;

/**
 * OpenSSL Class.
 * 
 * A class wrapper for the OpenSSL extension functions.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class OpenSSL
{
    const CIPHER_METHOD_AES128 = 'AES128';
    const CIPHER_METHOD_AES192 = 'AES192';
    const CIPHER_METHOD_AES256 = 'AES256';
    const CIPHER_METHOD_BLOWFISH = 'BF';
    const CIPHER_METHOD_CAST = 'CAST';
    const CIPHER_METHOD_CAST_CBC = 'CAST-cbc';
    const CIPHER_METHOD_IDEA = 'IDEA';

    private $options;
    private $method = '';
    private $key = '';
    private $content = '';
    private $payload = '';

    public function __construct($method = OpenSSL::CIPHER_METHOD_AES256, $options = OPENSSL_RAW_DATA) 
    {
        $this->cipherMethod($method);

        $this->options = $options;
    }

    public function cipherMethod($method)
    {
        $this->method = $method;
    }

    public function key($key)
    {
        $this->key = $key;
    }

    public function content($content)
    {
        $this->content = $content;   
    }

    public function encrypt()
    {
        $iv = $this->generateRandomPseudoBytes();

        $content = \openssl_encrypt(
            $this->content, 
            $this->method, 
            $this->key, 
            $this->options, 
            $iv
        );

        $serializedPayload = \base64_encode(\serialize([
            'iv' => $iv,
            'content' => $content
        ]));

        $this->payload = $serializedPayload;
    }

    private function generateRandomPseudoBytes()
    {
        return \openssl_random_pseudo_bytes(
            \openssl_cipher_iv_length($this->method)
        );
    }

    public function decrypt()
    {
        $unserializedPayload = \unserialize(\base64_decode($this->content));

        $this->payload = \openssl_decrypt(
            $unserializedPayload['content'], 
            $this->method, 
            $this->key, 
            $this->options, 
            $unserializedPayload['iv']
        );
    }

    public function get()
    {
        return $this->payload;
    }
}
