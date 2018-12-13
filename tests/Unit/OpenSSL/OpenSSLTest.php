<?php

namespace LordDashMe\Cryptor\Tests\Unit\OpenSSL;

use PHPUnit\Framework\TestCase;
use LordDashMe\Cryptor\OpenSSL\OpenSSL;

class OpenSSLTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_openssl_class()
    {
        $this->assertInstanceOf(OpenSSL::class, new OpenSSL());
    }

    /**
     * @test
     */
    public function it_should_encrypt_content()
    {   
        $openssl = new OpenSSL();
        $openssl->cipherMethod(OpenSSL::CIPHER_METHOD_AES256);
        $openssl->key('password');
        $openssl->content('this is the plain text');
        $openssl->encrypt();
        
        $this->assertTrue(! empty($openssl->get()));
    }

    /**
     * @test
     */
    public function it_should_decrypt_content()
    {
        $openssl = new OpenSSL();
        $openssl->cipherMethod(OpenSSL::CIPHER_METHOD_AES256);
        $openssl->key('password');
        $openssl->content('YToyOntzOjc6ImNvbnRlbnQiO3M6MzI6Iqu403ErS5CwNfPPN/j8ohvJoZApgcDUvbD70Rm/2TQEIjtzOjI6Iml2IjtzOjE2OiJQOd1Y8AIYy8JDhNsdeh/hIjt9');
        $openssl->decrypt();
        
        $this->assertEquals('this is the plain text', $openssl->get());
    }
}
