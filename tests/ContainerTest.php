<?php
/**
 * This file is part of the Yep package.
 * Copyright (c) 2018 Martin Zeman (Zemistr) (http://www.zemistr.eu)
 */

use Yep\Container\Container;
use Yep\Container\ContainerInterface;
use Yep\Container\Exception\ServiceMustBeAnObjectException;
use Yep\Container\Exception\ServiceNotFoundException;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $container = new TestContainer(
          [
            'foo' => 'bar',
          ]
        );

        $this->assertInstanceOf(ContainerInterface::class, $container);

        $this->assertSame('bar', $container->getParameter('foo'));
        $this->assertNull($container->getParameter('baz'));

        $container->setParameter('baz', true);
        $this->assertTrue($container->getParameter('baz'));

        $service = $container->getService('someService');
        $this->assertInstanceOf(DateTime::class, $service);

        $serviceTest = $container->getService('someService');
        $this->assertSame($service, $serviceTest);
    }

    public function testGetServiceWithNotFoundException()
    {
        $container = new TestContainer();

        $this->expectException(ServiceNotFoundException::class);
        $container->getService('error');
    }

    public function testGetServiceWithWrongServiceException()
    {
        $container = new TestContainer();

        $this->expectException(ServiceMustBeAnObjectException::class);
        $container->getService('someWrongService');
    }

    public function testSetServiceWithWrongServiceException()
    {
        $container = new TestContainer();

        $this->expectException(ServiceMustBeAnObjectException::class);
        $container->setService('error', null);
    }
}

class TestContainer extends Container
{
    public function someServiceFactory()
    {
        return new DateTime();
    }

    public function someWrongServiceFactory()
    {
        return null;
    }
}
