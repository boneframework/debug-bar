<?php

namespace Tests\Bone\DebugBar;

use Bone\DebugBar\DebugBarPackage;
use Codeception\Test\Unit;

class BlankTest extends Unit
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
        $this->assertEquals('Ready to start building tests', $this->debugBarPackage->blah());
    }
}
