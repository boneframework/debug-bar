<?php

declare(strict_types=1);

namespace Bone\DebugBar\View\Extension;

use Bone\DebugBar\DebugBar;
use Bone\DevTools\ReflectionInvoker;
use DebugBar\JavascriptRenderer;
use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;
use League\Plates\Template\Template;
use function getenv;

class DebugBarExtension implements ExtensionInterface
{
    use ReflectionInvoker;

    public ?Template $template = null;
    public JavascriptRenderer $renderer;
    public bool $isEnabled;

    public function __construct(
        private DebugBar $debugBar,
    ) {
        $isEnabled = \getenv('DEBUG_BAR');
        $isEnabled = $isEnabled === 'true';
        $this->isEnabled = $isEnabled ?? false;

        if ($this->isEnabled) {
            $baseUrl = 'https://' . getenv('DOMAIN_NAME');
            $renderer = $this->renderer = $this->debugBar->getJavascriptRenderer($baseUrl . '/debug-bar');
            $css = file_get_contents(__DIR__ . '/../../../assets/css/debugbar.css');
            $renderer->addInlineAssets([$css],null, null);
        }
    }

    public function register(Engine $engine)
    {
        $engine->registerFunction('debugBarJs', [$this, 'debugBarJs']);
        $engine->registerFunction('debugBarHtml', [$this, 'debugBarHtml']);
    }

    public function debugBarJs() : string
    {
        return $this->isEnabled ? $this->renderer->renderHead() : '';
    }

    public function debugBarHtml() : string
    {
        return $this->isEnabled ? $this->renderer->render() : '';
    }
}
