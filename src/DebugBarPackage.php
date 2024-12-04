<?php

declare(strict_types=1);

namespace Bone\DebugBar;

use Barnacle\Container;
use Barnacle\RegistrationInterface;
use Bone\Contracts\Container\ContainerInterface;
use Bone\DebugBar\View\Extension\DebugBarExtension;
use Bone\View\ViewEngineInterface;
use Bone\View\ViewRegistrationInterface;
use Del\Booty\AssetRegistrationInterface;

class DebugBarPackage implements RegistrationInterface, ViewRegistrationInterface, AssetRegistrationInterface
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

    public function getAssetFolders(): array
    {
        return ['debug-bar' => __DIR__ . '/../../../maximebf/debugbar/src/DebugBar/Resources'];
    }
}
