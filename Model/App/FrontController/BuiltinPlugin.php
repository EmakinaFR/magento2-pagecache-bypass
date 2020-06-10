<?php

declare(strict_types=1);

namespace Emakina\PageCacheBypass\Model\App\FrontController;

use Closure;
use Emakina\PageCacheBypass\Helper\Data;
use Magento\Framework\App\FrontControllerInterface;
use Magento\Framework\App\PageCache\Kernel;
use Magento\Framework\App\PageCache\Version;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Response\Http as ResponseHttp;
use Magento\Framework\App\State;
use Magento\PageCache\Model\App\FrontController\BuiltinPlugin as BaseBuiltinPlugin;
use Magento\PageCache\Model\Config;

class BuiltinPlugin extends BaseBuiltinPlugin
{
    private $helper;

    /**
     * BuiltinPlugin constructor.
     */
    public function __construct(Config $config, Version $version, Kernel $kernel, State $state, Data $helper)
    {
        parent::__construct($config, $version, $kernel, $state);
        $this->helper = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function aroundDispatch(FrontControllerInterface $subject, Closure $proceed, RequestInterface $request)
    {
        $this->version->process();
        if (!$this->config->isEnabled() || (int) $this->config->getType() !== Config::BUILT_IN
            || $this->shouldBypassPageCache($request)
        ) {
            return $proceed($request);
        }

        $result = $this->kernel->load();

        if ($result === false) {
            $result = $proceed($request);
            if ($result instanceof ResponseHttp) {
                $this->addDebugHeaders($result);
                $this->kernel->process($result);
            }
        } else {
            $this->addDebugHeader($result, 'X-Magento-Cache-Debug', 'HIT', true);
        }

        return $result;
    }

    /**
     * Checks whether the bypass parameter has been passed with the given request.
     */
    protected function shouldBypassPageCache(RequestInterface $request): bool
    {
        return array_key_exists($this->helper->getParameterName(), $request->getParams());
    }
}
