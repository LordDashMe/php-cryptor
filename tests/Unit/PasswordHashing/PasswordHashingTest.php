<?php

namespace LordDashMe\Cryptor\Tests\Unit\PasswordHashing;

use PHPUnit\Framework\TestCase;
use LordDashMe\Cryptor\PasswordHashing\PasswordHashing;

class PasswordHashingTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_password_hashing_class()
    {
        $this->assertInstanceOf(PasswordHashing::class, new PasswordHashing());
    }

    /**
     * @test
     */
    public function it_should_hash_content()
    {
        $hashing = new PasswordHashing();
        $hashing->algorithm(PasswordHashing::ALGO_PASSWORD_DEFAULT);
        $hashing->hash('Need to be hash');

        $this->assertTrue(! empty($hashing->get()));
    }

    /**
     * @test
     */
    public function it_should_rehash_content()
    {
        $hashing = new PasswordHashing(['cost' => 6]);
        $hashing->algorithm(PasswordHashing::ALGO_PASSWORD_DEFAULT);
        $hashing->rehash('Need to be hash', '$2y$10$cwzwDA.wXJitJMPQt9ogDe5rf46dASXh8r5DPIyH1Up3HhhROcFti');

        $this->assertTrue(! empty($hashing->get()));
    }

    /**
     * @test
     */
    public function it_should_get_info_of_hashed_content()
    {
        $hashing = new PasswordHashing();

        $this->assertTrue(\is_array($hashing->getInfo('$2y$10$cwzwDA.wXJitJMPQt9ogDe5rf46dASXh8r5DPIyH1Up3HhhROcFti')));
    }

    /**
     * @test
     */
    public function it_should_verify_hash_content()
    {
        $hashing = new PasswordHashing();
        
        $this->assertTrue($hashing->verify('Need to be hash', '$2y$10$cwzwDA.wXJitJMPQt9ogDe5rf46dASXh8r5DPIyH1Up3HhhROcFti'));
    }
}
