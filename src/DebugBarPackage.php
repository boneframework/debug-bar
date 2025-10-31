<?php

declare(strict_types=1);

namespace Bone\DebugBar;

use Barnacle\Container;
use Barnacle\RegistrationInterface;
use Bone\Contracts\Container\ContainerInterface;
use Bone\DebugBar\View\Extension\DebugBarExtension;
use Bone\View\ViewRegistrationInterface;
use DebugBar\DataCollector\PDO\PDOCollector;
use DebugBar\DataCollector\PDO\TraceablePDO;
use Del\Booty\AssetRegistrationInterface;
use Doctrine\ORM\EntityManagerInterface;
use PDO;
use Slam\DbalDebugstackMiddleware\DebugStack;
use Slam\DbalDebugstackMiddleware\Middleware;

class DebugBarPackage implements RegistrationInterface, ViewRegistrationInterface, AssetRegistrationInterface
{
    public function addToContainer(ContainerInterface $c): void
    {
        $debugStack = new DebugStack();
        $debugMiddleware = new Middleware($debugStack);
        $pdo = null;

        if ($c->has(EntityManagerInterface::class)) {
            $entityManager = $c->get(EntityManagerInterface::class);
            $entityManager->getConfiguration()->setMiddlewares([$debugMiddleware]);
            $connection = $entityManager->getConnection()->getNativeConnection();
            $pdo = new TraceablePDO($connection);
        } elseif ($c->has(PDO::class)) {
            $connection = $c->get(PDO::class);
            $pdo = new TraceablePDO($connection);
        }

        if ($pdo) {
            $debugBar = new DebugBar();
            $debugBar->addCollector(new PDOCollector($pdo));
        }

        $c[DebugBar::class] = $debugBar;
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
        return [
            'debug-bar' => __DIR__ . '/../../../maximebf/debugbar/src/DebugBar/Resources',
        ];
    }
}
