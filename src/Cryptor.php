<?php

/*
 * This file is part of the Cryptor.
 *
 * (c) Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LordDashMe\Cryptor;

/**
 * Crpytor Class.
 * 
 * A package wrapper for PHP cryptography functions.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class Cryptor
{
    const METHOD_ALIAS_AES128   = 'AES128';
    const METHOD_ALIAS_AES192   = 'AES192';
    const METHOD_ALIAS_AES256   = 'AES256';
    const METHOD_ALIAS_BLOWFISH = 'BF';
    const METHOD_ALIAS_CAST     = 'CAST';
    const METHOD_ALIAS_CAST_CBC = 'CAST-cbc';
    const METHOD_ALIAS_IDEA     = 'IDEA';

    private $options;
    private $method = '';
    private $key = '';
    private $content = '';
    private $processedContent = '';

    public function __construct($method = Cryptor::METHOD_ALIAS_AES256)
    {
        $this->options = OPENSSL_RAW_DATA;
        
        $this->cipherMethod($method);
    }

    protected function cipherMethod($method)
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
        $ivLength = openssl_cipher_iv_length($this->method);
        $iv = openssl_random_pseudo_bytes($ivLength);

        $cipherContent = openssl_encrypt(
            $this->content, $this->method, $this->key, $this->options, $iv
        );

        $data = array(
            'content' => $cipherContent, 'iv' => $iv
        );

        $this->processedContent = base64_encode(serialize($data));
    }

    public function decrypt()
    {
        $data = unserialize(base64_decode($this->content));

        $this->processedContent = openssl_decrypt(
            $data['content'], $this->method, $this->key, $this->options, $data['iv']
        );
    }

    public function get()
    {
        return $this->processedContent;
    }
}
