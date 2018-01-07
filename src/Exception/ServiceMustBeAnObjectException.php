<?php
/**
 * This file is part of the Yep package.
 * Copyright (c) 2018 Martin Zeman (Zemistr) (http://www.zemistr.eu)
 */

namespace Yep\Container\Exception;

class ServiceMustBeAnObjectException extends ContainerException
{
    public static function create($service)
    {
        return new self(
          sprintf(
            'Service factory must return an object, got "%s"!',
            gettype($service)
          )
        );
    }
}
