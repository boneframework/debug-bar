<?php

declare(strict_types=1);

namespace Bone\DebugBar\View\Extension;

use Bone\DebugBar\DebugBar;
use League\Plates\Engine;

class DebugBarExtension implements ExtensionInterface
{
    public ?Template $template = null;

    public function __construct(
        private Engine $engine,
        private DebugBar $debugBar,
    ) {
    }

    public function register(Engine $engine)
    {
        $engine->registerFunction('debugBarJs', [$this, 'debugBarJs']);
        $engine->registerFunction('debugBarHtml', [$this, 'debugBarHtml']);
    }

    public function debugBarJs(array $message) : string
    {
        return $this->debugBar->;
    }

    public function debugBarHtml(array $message) : string
    {
        return 'xxxxxxx';
    }
}
