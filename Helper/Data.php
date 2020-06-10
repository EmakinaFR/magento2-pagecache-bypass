<?php

declare(strict_types=1);

namespace Emakina\PageCacheBypass\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    private const XML_PATH_PARAMETER_NAME_VALUE = 'dev/emakina_pagecache_bypass/parameter_name';

    /**
     * Retrieves the name of the HTTP parameter used to bypass the built-in page cache system
     */
    public function getParameterName(): string
    {
        return (string)$this->scopeConfig->getValue(self::XML_PATH_PARAMETER_NAME_VALUE);
    }
}
