<?php
/**
 * This file is part of the Yep package.
 * Copyright (c) 2018 Martin Zeman (Zemistr) (http://www.zemistr.eu)
 */

namespace Yep\Container;

use Yep\Container\Exception\ServiceMustBeAnObjectException;
use Yep\Container\Exception\ServiceNotFoundException;

trait ContainerTrait
{
    protected $parameters = [];
    protected $services = [];

    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getParameter($key, $default = null)
    {
        if (isset($this->parameters[$key])) {
            return $this->parameters[$key];
        }

        return $default;
    }

    /**
     * @param string $name
     * @param object $service
     * @return mixed
     * @throws ServiceMustBeAnObjectException
     */
    public function setService($name, $service)
    {
        if (!is_object($service)) {
            throw ServiceMustBeAnObjectException::create($service);
        }

        return $this->services[$name] = $service;
    }

    /**
     * @param string $name
     * @return mixed
     * @throws ServiceMustBeAnObjectException
     * @throws ServiceNotFoundException
     */
    public function getService($name)
    {
        if (isset($this->services[$name])) {
            return $this->services[$name];
        }

        if (!method_exists($this, $name.'Factory')) {
            throw ServiceNotFoundException::create($name);
        }

        $service = $this->{$name.'Factory'}();

        return $this->setService($name, $service);
    }
}
