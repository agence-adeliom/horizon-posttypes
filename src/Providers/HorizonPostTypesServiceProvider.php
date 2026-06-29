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
            $this->loadHorizonTextdomain('horizon-posttypes', dirname(__DIR__, 2) . '/languages');
            $this->commands([ImportPostType::class]);
        } catch (\Exception $e) {
            throw new SkipProviderException($e->getMessage());
        }
    }

    protected function loadHorizonTextdomain(string $domain, string $packageLangDir): void
    {
        $locale = determine_locale();

        $override = trailingslashit(WP_LANG_DIR) . 'horizon/' . $domain . '-' . $locale . '.mo';
        $mofile = is_readable($override)
            ? $override
            : rtrim($packageLangDir, '/') . '/' . $domain . '-' . $locale . '.mo';

        if (is_readable($mofile)) {
            load_textdomain($domain, $mofile);
        }
    }
}
