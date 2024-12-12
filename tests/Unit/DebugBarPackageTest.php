<?php

namespace Tests\Bone\DebugBar;

use Barnacle\Container;
use Bone\Contracts\Container\ContainerInterface;
use Bone\DebugBar\DebugBar;
use Bone\DebugBar\DebugBarPackage;
use Bone\DebugBar\View\Extension\DebugBarExtension;
use Codeception\Test\Unit;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManagerInterface;
use League\Plates\Engine;
use PDO;

class DebugBarPackageTest extends Unit
{
    protected DebugBarPackage $debugBarPackage;

    protected function _before()
    {
        $this->debugBarPackage = new DebugBarPackage();
    }

    protected function _after()
    {
        unset($this->debugBarPackage);
    }

    public function testEverything()
    {
        putenv('DEBUG_BAR=true');
        $pdo = $this->createMock(PDO::class);
        $config = $this->createMock(Configuration::class);
        $connection = $this->createMock(Connection::class);
        $em = $this->createMock(EntityManagerInterface::class);
        $engine = $this->createMock(Engine::class);
        $engine->expects($this->exactly(2))->method('registerFunction');
        $container = new Container();
        $container[EntityManagerInterface::class] = $em;
        $em->expects($this->once())->method('getConfiguration')->willReturn($config);
        $em->expects($this->once())->method('getConnection')->willReturn($connection);
        $config->expects($this->once())->method('setMiddlewares');
        $connection->expects($this->once())->method('getNativeConnection')->willReturn($pdo);
        $this->debugBarPackage->addToContainer($container);
        $this->assertIsArray($this->debugBarPackage->addViews());
        $this->assertIsArray($this->debugBarPackage->addViewExtensions($container));
        $this->assertIsArray($this->debugBarPackage->getAssetFolders());
        $debugBar = $container->get(DebugBar::class);
        $extension = new DebugBarExtension($debugBar);
        $extension->register($engine);
        $this->assertIsString($extension->debugBarJs());
        $this->assertIsString($extension->debugBarHtml());
    }
}
