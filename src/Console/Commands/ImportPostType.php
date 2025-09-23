<?php

declare(strict_types=1);

namespace Adeliom\HorizonPostTypes\Console\Commands;

use Adeliom\HorizonPostTypes\Services\HorizonPostTypesService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use function Laravel\Prompts\search;

class ImportPostType extends Command
{
    protected $signature = 'import:posttype {quickImportSlug?}';

    public function handle(): void
    {
        $availablePostTypes = HorizonPostTypesService::getAvailablePostTypes();
        $classes = array_keys($availablePostTypes);
        $fullNames = [];
        $shortNames = [];

        foreach ($classes as $className) {
            $blockExtraData = $availablePostTypes[$className];

            $fullNames[$className] = str_replace('Adeliom\\HorizonPostTypes\\PostTypes\\', '', $className);
            $shortNames[$className] = $fullNames[$className];
        }

        if (empty($shortNames)) {
            $this->error('No post type available to import.');
            return;
        }

        $blockNames = collect(array_values($shortNames));

        $namespaceToImport = null;

        if (
            $index = search(
                label: 'Name of post-type to import',
                options: fn(string $value) => $blockNames
                    ->filter(fn($name) => Str::contains($name, $value, ignoreCase: true))
                    ->values()
                    ->all(),
                scroll: 10,
            )
        ) {
            $namespaceToImport = array_search($index, $shortNames);
        }

        dd($namespaceToImport);
    }
}
