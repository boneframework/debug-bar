<?php

declare(strict_types=1);

namespace Bone\DebugBar;

use Bone\Contracts\Container\ContainerInterface;
use Bone\Contracts\Container\RegistrationInterface;

class DebugBarPackage implements RegistrationInterface
{
    public function addToContainer(ContainerInterface $c): void
    {
        $c[DebugBar::class] = new DebugBar();
    }
}
