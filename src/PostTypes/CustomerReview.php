<?php

declare(strict_types=1);

namespace Adeliom\HorizonPostTypes\PostTypes;

use Adeliom\HorizonTools\Enum\FilterTypesEnum;
use Adeliom\HorizonTools\PostTypes\AbstractPostType;
use Extended\ACF\Fields\Group;
use Extended\ACF\Fields\Image;
use Extended\ACF\Fields\Number;
use Extended\ACF\Fields\Text;

class CustomerReview extends AbstractPostType
{
    public static ?string $slug = 'customer-review';

    // Blade component used to render the card in the listing
    public static ?string $card = 'cards.card-listing';

    // Set to true to allow post-type in automatic listing block
    public static bool $availableInListingBlock = true;

    public const string FIELD_REVIEW = 'review';
    public const string FIELD_REVIEWER = 'reviewer';
    public const string FIELD_RATING = 'rating';
    public const string FIELD_LASTNAME = 'lastname';
    public const string FIELD_FIRSTNAME = 'firstname';
    public const string FIELD_JOB = 'job';
    public const string FIELD_AVATAR = 'avatar';

    public function getConfig(array $config = []): array
    {
        $config['args'] = [
            'label' => __('Avis', 'horizon-posttypes'),
            'labels' => [
                'name' => __('Avis', 'horizon-posttypes'),
                'singular_name' => __('Avis', 'horizon-posttypes'),
                'menu_name' => __('Avis', 'horizon-posttypes'),
                'add_new' => __('Ajouter un avis', 'horizon-posttypes'),
                'add_new_item' => __('Ajouter un nouvel avis', 'horizon-posttypes'),
                'edit_item' => __('Modifier l’avis', 'horizon-posttypes'),
                'new_item' => __('Nouvel avis', 'horizon-posttypes'),
                'view_item' => __('Voir l’avis', 'horizon-posttypes'),
                'view_items' => __('Voir les avis', 'horizon-posttypes'),
                'search_items' => __('Rechercher un avis', 'horizon-posttypes'),
                'not_found' => __('Aucun avis trouvé', 'horizon-posttypes'),
                'not_found_in_trash' => __('Aucun avis trouvé dans la corbeille', 'horizon-posttypes'),
                'all_items' => __('Tous les avis', 'horizon-posttypes'),
                'archives' => __('Archives des avis', 'horizon-posttypes'),
            ],
            'menu_icon' => 'dashicons-star-filled',
            'supports' => ['title'],
            'publicly_queryable' => false,
            // 'rewrite'=> ['slug'=> 'custom'],
        ];

        return parent::getConfig($config);
    }

    public function getStyle(): string
    {
        return 'seamless';
    }

    public function getFields(): ?iterable
    {
        yield Group::make(__('Avis client', 'horizon-posttypes'), self::FIELD_REVIEW)->fields([
            Number::make(__('Note', 'horizon-posttypes'), self::FIELD_RATING)
                ->helperText(__("Note attribuée à l'avis entre 0 et 5, par pas de 0.5", 'horizon-posttypes'))
                ->min(0)
                ->max(5)
                ->step(0.5)
                ->required(),
            Text::make(__('Avis', 'horizon-posttypes'), self::FIELD_REVIEW)->required(),
        ]);

        yield Group::make(__('Information client', 'horizon-posttypes'), self::FIELD_REVIEWER)->fields([
            Text::make(__('Nom', 'horizon-posttypes'), self::FIELD_LASTNAME)->required(),
            Text::make(__('Prénom', 'horizon-posttypes'), self::FIELD_FIRSTNAME)->required(),
            Text::make(__('Fonction', 'horizon-posttypes'), self::FIELD_JOB)->required(),
            Image::make(__('Photo', 'horizon-posttypes'), self::FIELD_AVATAR)->helperText(
                __("Si aucune photo n'est renseignée, les initiales du nom et prénom seront affichées.", 'horizon-posttypes'),
            ),
        ]);
    }
}
