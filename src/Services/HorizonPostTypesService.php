<?php

declare(strict_types=1);

namespace Adeliom\HorizonPostTypes\Services;

use Adeliom\HorizonPostTypes\PostTypes\CustomerReview;

class HorizonPostTypesService
{
    public static function getAvailablePostTypes(): array
    {
        return [CustomerReview::class => []];
    }
}
