<?php

use PHPUnit\Framework\TestCase;
use LordDashMe\Encryptor\Encryptor;

class EncryptorTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_load_concrete_class()
    {
        $this->assertInstanceOf(LordDashMe\Encryptor\Encryptor::class, $this->concreteClass());
    }

    /**
     * @test
     */
    public function it_can_encode_content()
    {   
        $constructor = [
            'password', 
            Encryptor::METHOD_ALIAS_AES256, 
            'this is the plain text'
        ];

        $cipherContent = ($this->concreteClass($constructor))
            ->encode()
            ->get();

        $this->assertTrue( ! empty($cipherContent) );
    }

    /**
     * @test
     */
    public function it_can_decode_content()
    {
        $constructor = [
            'password', 
            Encryptor::METHOD_ALIAS_AES256, 
            'YToyOntzOjc6ImNvbnRlbnQiO3M6MzI6Iqu403ErS5CwNfPPN/j8ohvJoZApgcDUvbD70Rm/2TQEIjtzOjI6Iml2IjtzOjE2OiJQOd1Y8AIYy8JDhNsdeh/hIjt9'
        ];

        $plainContent = ($this->concreteClass($constructor))
            ->decode()
            ->get();

        $this->assertEquals('this is the plain text', $plainContent);
    }

    protected function concreteClass($args = null)
    {
        if (is_array($args)) {
            return new Encryptor(...$args);
        }

        return new Encryptor(); 
    }
}