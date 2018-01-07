<?php
/**
 * This file is part of the Yep package.
 * Copyright (c) 2018 Martin Zeman (Zemistr) (http://www.zemistr.eu)
 */

namespace Yep\Container;

interface ContainerInterface
{
    public function getService($name);

    public function getParameter($key, $default = null);
}
