<?php

declare(strict_types=1);

namespace Bone\DebugBar\View\Extension;

use Bone\DebugBar\DebugBar;
use DebugBar\JavascriptRenderer;
use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;
use League\Plates\Template\Template;
use function getenv;

class DebugBarExtension implements ExtensionInterface
{
    public ?Template $template = null;
    public JavascriptRenderer $renderer;

    public function __construct(
        private Engine $engine,
        private DebugBar $debugBar,
    ) {
        $this->renderer = $this->debugBar->getJavascriptRenderer('https://' . getenv('DOMAIN_NAME') . '/debug-bar');
    }

    public function register(Engine $engine)
    {
        $engine->registerFunction('debugBarJs', [$this, 'debugBarJs']);
        $engine->registerFunction('debugBarHtml', [$this, 'debugBarHtml']);
    }

    public function debugBarJs() : string
    {
        $this->debugBar["messages"]->addMessage("hello world!");
        return $this->renderer->renderHead();
    }

    public function debugBarHtml() : string
    {
        return $this->renderer->render();
    }
}
