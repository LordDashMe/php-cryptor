<?php

/*
 * This file is part of the Cryptor.
 *
 * (c) Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LordDashMe\Cryptor\PasswordHashing;

/**
 * Password Hashing Class.
 * 
 * A class wrapper for the Password Hashing extension functions.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class PasswordHashing
{
    const ALGO_PASSWORD_DEFAULT = PASSWORD_DEFAULT;
    const ALGO_PASSWORD_BCRYPT = PASSWORD_BCRYPT;

    private $algorithm;
    private $options;
    private $payload;

    public function __construct($options = array())
    {
        $this->options = $options;
    }

    public function algorithm($algorithm = PASSWORD_DEFAULT)
    {
        $this->algorithm = $algorithm;    
    }

    public function hash($content)
    {
        $this->payload = \password_hash($content, $this->algorithm, $this->options);

        return $this;
    }

    public function rehash($content, $hashedContent)
    {
        if (\password_needs_rehash($hashedContent, $this->algorithm, $this->options)) {
            $this->hash($content);
        }

        return $this;
    }

    public function get()
    {
        return $this->payload;
    }

    public function verify($content, $hashedContent)
    {
        return \password_verify($content, $hashedContent);
    }

    public function getInfo($hashedContent)
    {
        return \password_get_info($hashedContent);
    }
}
