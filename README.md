[![Build Status](https://travis-ci.org/YepFoundation/container.svg?branch=master)](https://travis-ci.org/YepFoundation/container)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/YepFoundation/container/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/YepFoundation/container/?branch=master)
[![Scrutinizer Code Coverage](https://scrutinizer-ci.com/g/YepFoundation/container/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/YepFoundation/container/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/yep/container/v/stable)](https://packagist.org/packages/yep/container)
[![Total Downloads](https://poser.pugx.org/yep/container/downloads)](https://packagist.org/packages/yep/container)
[![License](https://poser.pugx.org/yep/container/license)](https://github.com/YepFoundation/container/blob/master/LICENSE.md)

# Dsn

## Packagist
Dsn is available on [Packagist.org](https://packagist.org/packages/yep/container),
just add the dependency to your composer.json.

```json
{
  "require" : {
    "yep/container": "dev-master"
  }
}
```

## Usage
```php
<?php
use Yep\Container\ContainerInterface;
use Yep\Container\ContainerTrait;

class Container implements ContainerInterface
{
    use ContainerTrait;

    public function someServiceFactory()
    {
        return new SomeService($this->getParameter('someParameter'));
    }
}

$container = new Container(['someParameter' => 'foo']);
$someService = $container->getService('someService');
```

or

```php
<?php
class Container extends Yep\Container\Container
{
    public function someServiceFactory()
    {
        return new SomeService($this->getParameter('someParameter'));
    }
}

$container = new Container(['someParameter' => 'foo']);
$someService = $container->getService('someService');
```
