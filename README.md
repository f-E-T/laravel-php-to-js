# Introduction

The `fet/laravel-php-to-js` package provides a simple way to pass PHP variables to JavaScript in your Laravel applications.

# Installation

1. `composer require fet/laravel-php-to-js`
2. `php artisan vendor:publish --provider="Dmr\PhpToJs\PhpToJsServiceProvider" --tag="config"`

# Configuration

```php
// config/phptojs.php

return [
    'namespace' => 'phpToJs',
];
```

# Usage
You can use the `\Dmr\PhpToJs\PhpToJsFacade` facade to add variables that are then transformed to JavaScript.

```php
use Dmr\PhpToJs\PhpToJsFacade;

PhpToJsFacade::add(['foo' => 'bar']);

PhpToJsFacade::namespace('test');
PhpToJsFacade::add(['bat' => 'baz']);
```

The variables can be accessed in JavaScript as follows:

```javascript
window.phpToJs.foo // Outputs: bar
window.test.bat // Outputs: baz
```

> The default namespace is `phpToJs`.

# Tests
Run the tests with:

```bash
composer test
```
