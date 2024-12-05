<?php

declare(strict_types=1);

namespace Bone\DebugBar;

use Barnacle\Container;
use Barnacle\RegistrationInterface;
use Bone\Contracts\Container\ContainerInterface;
use Bone\DebugBar\View\Extension\DebugBarExtension;
use Bone\View\ViewRegistrationInterface;
use Del\Booty\AssetRegistrationInterface;
use Doctrine\ORM\EntityManagerInterface;
use Slam\DbalDebugstackMiddleware\DebugStack;
use Slam\DbalDebugstackMiddleware\Middleware;

class DebugBarPackage implements RegistrationInterface, ViewRegistrationInterface, AssetRegistrationInterface
{
    public function addToContainer(ContainerInterface $c): void
    {
        $debugStack = new DebugStack();
        $debugMiddleware = new Middleware($debugStack);
        /** @var EntityManagerInterface $entityManager */
        $entityManager = $c->get(EntityManagerInterface::class);
        $entityManager->getConfiguration()->setMiddlewares([$debugMiddleware]);
        $c[DebugBar::class] = new DebugBar();
    }

    public function addViews(): array
    {
        return [];
    }

    public function addViewExtensions(Container $c): array
    {
        $debugBar = $c->get(DebugBar::class);

        return [new DebugBarExtension($debugBar)];
    }

    public function getAssetFolders(): array
    {
        return ['debug-bar' => __DIR__ . '/../../../maximebf/debugbar/src/DebugBar/Resources'];
    }
}
