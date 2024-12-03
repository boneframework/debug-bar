<?php

namespace Tests\Bone\DebugBar;

use Bone\Contracts\Container\ContainerInterface;
use Bone\DebugBar\DebugBarPackage;
use Codeception\Test\Unit;

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

    public function testBlah()
    {
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())->method('addToContainer');
        $this->debugBarPackage->addToContainer();
    }
}
