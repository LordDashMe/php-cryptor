<?php

namespace LordDashMe\Cryptor\Tests\Unit;

use Mockery as Mockery;
use PHPUnit\Framework\TestCase;
use LordDashMe\Cryptor\Cryptor;

class EncryptorTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_cryptor_class()
    {
        $this->assertInstanceOf(LordDashMe\Cryptor\Cryptor::class, new Cryptor());
    }

    /**
     * @test
     */
    public function it_should_encode_content()
    {   
        $cryptor = new Cryptor(
            Cryptor::METHOD_ALIAS_AES256
        );
        $cryptor->key('password');
        $cryptor->content('this is the plain text');
        $cryptor->encrypt();
        
        $this->assertEquals('this is the plain text', $cryptor->get());
    }

    /**
     * @test
     */
    public function it_should_decrypt_content()
    {
        $cryptor = new Cryptor(
            Cryptor::METHOD_ALIAS_AES256
        );
        $cryptor->key('password');
        $cryptor->content('YToyOntzOjc6ImNvbnRlbnQiO3M6MzI6Iqu403ErS5CwNfPPN/j8ohvJoZApgcDUvbD70Rm/2TQEIjtzOjI6Iml2IjtzOjE2OiJQOd1Y8AIYy8JDhNsdeh/hIjt9');
        $cryptor->decrypt();
        
        $this->assertEquals('this is the plain text', $cryptor->get());
    }
}
