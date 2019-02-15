# PHP Image Squeezer

A simple PHP package for image compression powered by FFMPEG.

[![Latest Stable Version](https://img.shields.io/packagist/v/LordDashMe/php-image-squeezer.svg?style=flat-square)](https://packagist.org/packages/LordDashMe/php-image-squeezer) [![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.0-8892BF.svg?style=flat-square)](https://php.net/) [![Build Status](https://img.shields.io/travis/LordDashMe/php-image-squeezer/master.svg?style=flat-square)](https://travis-ci.org/LordDashMe/php-image-squeezer) [![Coverage Status](https://img.shields.io/coveralls/LordDashMe/php-image-squeezer/master.svg?style=flat-square)](https://coveralls.io/github/LordDashMe/php-image-squeezer?branch=master)

## Requirement(s)

- PHP version from 5.4.* up to latest.

## Install

### via Composer

- Use the command below to install the package via composer:

```txt
composer require lorddashme/php-image-squeezer
```

## Usage

- Below are the simple implementation of the package:

```php
<?php

include __DIR__  . '/vendor/autoload.php';

// Import the main class of the PHP Image Squeezer.
use LordDashMe\ImageSqueezer\ImageSqueezer;

// Initialize the main class.
$imageSqueezer = new ImageSqueezer();

// Load the necessary requirements and validate
// if the package fit for the current environment.
$imageSqueezer->load();

// Provide the source file path of the desire image
// that will be compress later on.
$imageSqueezer->setSourceFilePath('/source/path/filename');

// Provide the output file path of the compressed image.
$imageSqueezer->setOutputFilePath('/output/path/filename');

// Execute the image compression.
$imageSqueezer->compress();
```

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
