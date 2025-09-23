<?php

declare(strict_types=1);

namespace Adeliom\HorizonPostTypes\Services;

use Adeliom\HorizonPostTypes\PostTypes\CustomerReview;
use Adeliom\HorizonPostTypes\PostTypes\FAQ;
use Adeliom\HorizonPostTypes\PostTypes\LandingPage;

class HorizonPostTypesService
{
    public static function getAvailablePostTypes(): array
    {
        return [CustomerReview::class => [], FAQ::class => [], LandingPage::class => []];
    }
}
