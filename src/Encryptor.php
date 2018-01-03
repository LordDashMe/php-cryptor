<?php

namespace LordDashMe\Encryptor;

class Encryptor
{
    const METHOD_ALIAS_AES128 = 'AES128';
    const METHOD_ALIAS_AES192 = 'AES192';
    const METHOD_ALIAS_AES256 = 'AES256';
    const METHOD_ALIAS_BLOWFISH = 'BF';
    const METHOD_ALIAS_CAST = 'CAST';
    const METHOD_ALIAS_CAST_CBC = 'CAST-cbc';
    const METHOD_ALIAS_IDEA = 'IDEA';

    protected $key;
    protected $method;
    protected $content;
    protected $options;

    protected $encodedData;

    public function __construct($key = '', $method = '', $content = '')
    {
        $this->key = $key;
        $this->method = $method;
        $this->content = $content;
        $this->options = OPENSSL_RAW_DATA;
    }

    public function encode()
    {
        $ivLength = openssl_cipher_iv_length($this->method);
        $iv = openssl_random_pseudo_bytes($ivLength);

        $cipherContent = openssl_encrypt($this->content, $this->method, $this->key, $this->options, $iv);

        $data = [
            'content' => $cipherContent,
            'iv' => $iv,
        ];

        $this->encodedData = base64_encode(serialize($data));

        return $this;
    }

    public function decode()
    {
        $data = unserialize(base64_decode($this->content));

        $originalContent = openssl_decrypt($data['content'], $this->method, $this->key, $this->options, $data['iv']);

        $this->encodedData = $originalContent;

        return $this;
    }

    public function get()
    {
        return $this->encodedData;
    }
}