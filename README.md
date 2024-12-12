# debug-bar
[![Latest Stable Version](https://poser.pugx.org/boneframework/debug-bar/v/stable)](https://packagist.org/packages/delboy1978uk/boneframework) [![Total Downloads](https://poser.pugx.org/boneframework/debug-bar/downloads)](https://packagist.org/packages/boneframework/debug-bar) [![License](https://poser.pugx.org/delboy1978uk/boneframework/license)](https://packagist.org/packages/delboy1978uk/boneframework)<br />
![build status](https://github.com/boneframework/debug-bar/actions/workflows/master.yml/badge.svg) [![Code Coverage](https://scrutinizer-ci.com/g/boneframework/debug-bar/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/boneframework/debug-bar/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/boneframework/debug-bar/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/boneframework/debug-bar/?branch=master)<br />
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
