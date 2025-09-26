<?php

declare(strict_types=1);

namespace Adeliom\HorizonPostTypes\Console\Commands;

use Adeliom\HorizonPostTypes\Services\HorizonPostTypesService;
use Adeliom\HorizonTools\PostTypes\AbstractPostType;
use Adeliom\HorizonTools\Services\ClassService;
use Adeliom\HorizonTools\Services\CommandService;
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
            $postTypeExtraData = $availablePostTypes[$className];

            $fullNames[$className] = str_replace('Adeliom\\HorizonPostTypes\\PostTypes\\', '', $className);
            $shortNames[$className] = $fullNames[$className];
        }

        if (empty($shortNames)) {
            $this->error('No post type available to import.');
            return;
        }

        $postTypeNames = collect(array_values($shortNames));

        $namespaceToImport = null;

        if (
            $index = search(
                label: 'Name of post-type to import',
                options: fn(string $value) => $postTypeNames
                    ->filter(fn($name) => Str::contains($name, $value, ignoreCase: true))
                    ->values()
                    ->all(),
                scroll: 10,
            )
        ) {
            $namespaceToImport = array_search($index, $shortNames);
        }

        if (null !== $namespaceToImport) {
            $postTypeExtraData = $availablePostTypes[$namespaceToImport];

            $pathToPostTypeControllerFile = ClassService::getFilePathFromClassName($namespaceToImport);

            if (file_exists($pathToPostTypeControllerFile)) {
                $shortName = $fullNames[$namespaceToImport];

                $structure = CommandService::getFolderStructure(str_replace('\\', '/', $shortName));
                $folders = $structure['folders'];
                $className = $structure['class'];

                $this->createPostTypeControllerFile(
                    className: $className,
                    folders: $folders,
                    pathToPostTypeControllerFile: $pathToPostTypeControllerFile,
                    structure: $structure,
                );
            }
        }
    }

    public function createPostTypeControllerFile(
        string $className,
        array $folders,
        string $pathToPostTypeControllerFile,
        array $structure,
        ?Command $instance = null,
    ): void {
        if (null === $instance) {
            $instance = $this;
        }

        $instance->newLine();
        $instance->info('Handling post-type controller...');

        $postTypeClassContent = file_get_contents($pathToPostTypeControllerFile);
        $postTypeClassContent = str_replace('Adeliom\\HorizonPostTypes\\PostTypes\\', 'App\\PostTypes\\', $postTypeClassContent);
        $postTypeClassContent = str_replace(
            'namespace Adeliom\\HorizonPostTypes\\PostTypes',
            'namespace App\\PostTypes',
            $postTypeClassContent,
        );

        $path = $instance->getTemplatePath() . '/app/PostTypes/';
        $filepath = $path . $structure['path'];

        $result = CommandService::handleClassCreation(
            type: AbstractPostType::class,
            filepath: $filepath,
            path: $path,
            folders: $folders,
            className: $className,
            template: $postTypeClassContent,
        );

        if ($result === 'already_exists') {
            $instance->error(sprintf('Post-type controller already exists at %s', $filepath));
        }
    }

    private function getTemplatePath(): ?string
    {
        if (function_exists('get_template_directory')) {
            return get_template_directory();
        }

        return null;
    }
}
