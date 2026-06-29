<?php

declare(strict_types=1);

namespace Adeliom\HorizonPostTypes\PostTypes;

use Adeliom\HorizonTools\Fields\Buttons\ButtonField;
use Adeliom\HorizonTools\PostTypes\AbstractPostType;

class LandingPage extends AbstractPostType
{
    public static ?string $slug = 'landing-page';

    // Blade component used to render the card in the listing
    public static ?string $card = 'cards.card-listing';

    public const string BTN_HIGHLIGHT = 'btn-highlight';

    public function getConfig(array $config = []): array
    {
        $config['args'] = [
            'label' => __('LandingPage', 'horizon-posttypes'),
            'labels' => [
                'name' => __('Landing page', 'horizon-posttypes'),
                'singular_name' => __('Landing page', 'horizon-posttypes'),
                'menu_name' => __('Landing page', 'horizon-posttypes'),
                'add_new' => __('Ajouter un élément', 'horizon-posttypes'),
                'add_new_item' => __('Ajouter un nouvel élément', 'horizon-posttypes'),
                'edit_item' => __('Modifier l’élément', 'horizon-posttypes'),
                'new_item' => __('Nouvel élément', 'horizon-posttypes'),
                'view_item' => __('Voir l’élément', 'horizon-posttypes'),
                'view_items' => __('Voir les éléments', 'horizon-posttypes'),
                'search_items' => __('Rechercher un élément', 'horizon-posttypes'),
                'not_found' => __('Aucun élément trouvé', 'horizon-posttypes'),
                'not_found_in_trash' => __('Aucun élément trouvé dans la corbeille', 'horizon-posttypes'),
                'all_items' => __('Tous les éléments', 'horizon-posttypes'),
                'archives' => __('Archives des éléments', 'horizon-posttypes'),
            ],
            'menu_icon' => 'dashicons-admin-post',
            'supports' => ['title', 'editor'],
            // 'rewrite'=> ['slug'=> 'custom'],
        ];

        return parent::getConfig($config);
    }

    public function getFields(): ?iterable
    {
        yield ButtonField::make(__('Bouton principal', 'horizon-posttypes'), self::BTN_HIGHLIGHT);
    }

    public function getPosition(): string
    {
        return 'side';
    }
}
