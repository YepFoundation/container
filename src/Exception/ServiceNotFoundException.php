<?php
/**
 * This file is part of the Yep package.
 * Copyright (c) 2018 Martin Zeman (Zemistr) (http://www.zemistr.eu)
 */

namespace Yep\Container\Exception;

class ServiceNotFoundException extends ContainerException
{
    public static function create($name)
    {
        return new self(sprintf('Service "%s" not found!', $name));
    }
}
