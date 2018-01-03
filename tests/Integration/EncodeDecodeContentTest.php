<?php

use PHPUnit\Framework\TestCase;
use LordDashMe\Encryptor\Encryptor;

class EncodeDecodeContentTest extends TestCase
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
    public function it_can_encode_and_decode_actual_text()
    {
        $constructorEncrypt = ['password', Encryptor::METHOD_ALIAS_AES256, "this is the plain text _ _ _ _ _ 123 \n 1"];

        $cipherContent = ($this->concreteClass($constructorEncrypt))
            ->encode()
            ->get();

        $constructorDecrypt = ['password', Encryptor::METHOD_ALIAS_AES256, $cipherContent];

        $plainContent = ($this->concreteClass($constructorDecrypt))
            ->decode()
            ->get();

        $this->assertEquals("this is the plain text _ _ _ _ _ 123 \n 1", $plainContent); 
    }

    protected function concreteClass($args = null)
    {
        if (is_array($args)) {
            return new Encryptor(...$args);
        }

        return new Encryptor(); 
    }
}