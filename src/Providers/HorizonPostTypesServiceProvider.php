<?php

declare(strict_types=1);

namespace Adeliom\HorizonPostTypes\Providers;

use Adeliom\HorizonPostTypes\Console\Commands\ImportPostType;
use Roots\Acorn\Exceptions\SkipProviderException;
use Roots\Acorn\Sage\SageServiceProvider;

class HorizonPostTypesServiceProvider extends SageServiceProvider
{
    public function boot(): void
    {
        try {
            $this->commands([ImportPostType::class]);
        } catch (\Exception $e) {
            throw new SkipProviderException($e->getMessage());
        }
    }
}
