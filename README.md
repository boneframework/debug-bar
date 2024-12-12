# debug-bar
[![Latest Stable Version](https://poser.pugx.org/boneframework/skeleton/v/stable)](https://packagist.org/packages/delboy1978uk/boneframework) [![Total Downloads](https://poser.pugx.org/boneframework/skeleton/downloads)](https://packagist.org/packages/boneframework/skeleton) [![License](https://poser.pugx.org/delboy1978uk/boneframework/license)](https://packagist.org/packages/delboy1978uk/boneframework)<br />
![build status](https://github.com/boneframework/skeleton/actions/workflows/master.yml/badge.svg) [![Code Coverage](https://scrutinizer-ci.com/g/boneframework/skeleton/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/boneframework/skeleton/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/boneframework/skeleton/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/boneframework/skeleton/?branch=master)<br />
A PHP Debug Basr for Bone Framework
## installation
Install via composer
```
composer require --dev boneframework/debug-bar
```
And then enable the package in your `config/packages.php`
```php
<?php

// use statements here
use Bone\DebugBar\DebugBarPackage;

return [
    'packages' => [
        // packages here...,
       DebugBarPackage::class,
    ],
];
```
# usage
