<?php

declare(strict_types=1);

namespace Bone\DebugBar;

use Barnacle\Container;
use Bone\Contracts\Container\ContainerInterface;
use Bone\Contracts\Container\RegistrationInterface;
use Bone\DebugBar\View\Extension\DebugBarExtension;
use Bone\View\ViewEngineInterface;
use Bone\View\ViewRegistrationInterface;

class DebugBarPackage implements RegistrationInterface, ViewRegistrationInterface
{
    public function addToContainer(ContainerInterface $c): void
    {
        $c[DebugBar::class] = new DebugBar();
    }

    public function addViews(): array
    {
        return [];
    }

    public function addViewExtensions(Container $c): array
    {
        $debugBar = $c->get(DebugBar::class);
        $viewEngine = $c->get(ViewEngineInterface::class);

        return [new DebugBarExtension($viewEngine, $debugBar)];
    }
}
