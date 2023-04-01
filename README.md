# PHP Cryptor

A package wrapper for PHP cryptography functions.

[![Latest Stable Version](https://img.shields.io/packagist/v/lorddashme/php-cryptor.svg?style=flat-square)](https://packagist.org/packages/lorddashme/php-cryptor) [![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg?style=flat-square)](https://php.net/) [![Coverage Status](https://img.shields.io/coveralls/LordDashMe/php-cryptor/master.svg?style=flat-square)](https://coveralls.io/github/LordDashMe/php-cryptor?branch=master)

## Requirement(s)

- PHP version from 5.6.* up to latest.

## Install

- It is advice to install the package via Composer. Use the command below to install the package:

```txt
composer require lorddashme/php-cryptor
```

## Usage

### List of Wrapped Class Extensions

| Class | Description |
| ----- | ----------- |
| <img width="200" /> | <img width="800" /> |
| [OpenSSL](#openssl-class) | Use this extension to encrypt or decrypt a content. |
| [PasswordHashing](#password-hashing-class) | Use this extension to hash a password content. |

#### OpenSSL Class

- To encrypt plain text.

```php
<?php

include __DIR__  . '/vendor/autoload.php';

use LordDashMe\Cryptor\OpenSSL\OpenSSL;

// Initialize the OpenSSL class.
$openssl = new OpenSSL();

// Provide the cipher method that will be using.
$openssl->cipherMethod(
  OpenSSL::CIPHER_METHOD_AES256
);

// Provide the key that will be using to encrypt the given content.
$openssl->key('password');

// The plain text that will be process to encrypt.
$openssl->content('this is the plain text');

// Execute the encryption process.
$openssl->encrypt();

// Output the processed content.
$openssl->get(); // echo "YToyOntzOjc6ImNvbnRlbnQiO3M6MzI6..."
```

- To decrypt encrypted content.

```php
<?php

include __DIR__  . '/vendor/autoload.php';

use LordDashMe\Cryptor\OpenSSL\OpenSSL;

// Initialize the OpenSSL class.
$openssl = new OpenSSL();

// Provide the cipher method that will be using.
$openssl->cipherMethod(
  OpenSSL::CIPHER_METHOD_AES256
);

// Provide the key that will be using to encrypt the given content.
$openssl->key('password');

// The encrypted content that will be process to decrypt.
$openssl->content('YToyOntzOjc6ImNvbnRlbnQiO3M6MzI6...');

// Execute the decryption process.
$openssl->decrypt();

// Output the processed content.
$openssl->get(); // echo "this is the plain text"
```

#### Password Hashing Class

- To hash the content.

```php
<?php

include __DIR__  . '/vendor/autoload.php';

use LordDashMe\Cryptor\PasswordHashing\PasswordHashing;

// Initialize the Password Hashing class.
$hashing = new PasswordHashing();

// Provide the algorithm to be use for hashing.
$hashing->algorithm(
  PasswordHashing::ALGO_PASSWORD_DEFAULT
);

// Execute the hashing process.
$hashing->hash('Need to be hash');

// Output the processed content.
$hashing->get(); // echo "$2y$10$cwzwDA.wXJitJMPQt9ogDe5rf46dASXh8r5DPIyH1Up3HhhROcFti"
```

- To re-hash the content.

```php
<?php

include __DIR__  . '/vendor/autoload.php';

use LordDashMe\Cryptor\PasswordHashing\PasswordHashing;

// Initialize the Password Hashing class.
$hashing = new PasswordHashing();

// Provide the algorithm to be use for hashing.
$hashing->algorithm(
  PasswordHashing::ALGO_PASSWORD_DEFAULT
);

// Execute the re-hashing process.
$hashing->rehash('Need to be hash', '$2y$10$cwzwDA.wXJitJMPQt9ogDe5rf46dASXh8r5DPIyH1Up3HhhROcFti');

// Output the processed content.
$hashing->get(); // echo "$2y$10$cwzwDA.wXJitJMPQt9ogDe5rf..."
```

- To get the info of the hashed content.

```php
<?php

include __DIR__  . '/vendor/autoload.php';

use LordDashMe\Cryptor\PasswordHashing\PasswordHashing;

// Initialize the Password Hashing class.
$hashing = new PasswordHashing();

// Execute the get info function.
$hashing->getInfo('$2y$10$cwzwDA.wXJitJMPQt9ogDe5rf46dASXh8r5DPIyH1Up3HhhROcFti'); // return array(...)
```

- To verify the hashed content.

```php
<?php

include __DIR__  . '/vendor/autoload.php';

use LordDashMe\Cryptor\PasswordHashing\PasswordHashing;

// Initialize the Password Hashing class.
$hashing = new PasswordHashing();

// Execute the verify function.
$hashing->verify('Need to be hash', '$2y$10$cwzwDA.wXJitJMPQt9ogDe5rf46dASXh8r5DPIyH1Up3HhhROcFti'); // return boolean
```

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
