<?php

declare(strict_types=1);

namespace Adeliom\HorizonPostTypes\PostTypes;

use Adeliom\HorizonTools\Fields\Text\WysiwygField;
use Adeliom\HorizonTools\PostTypes\AbstractPostType;
use Extended\ACF\Fields\Text;

class FAQ extends AbstractPostType
{
    public static ?string $slug = 'faq';

    public const string FIELD_QUESTION = 'question';
    public const string FIELD_ANSWER = 'answer';

    // Blade component used to render the card in the listing
    public static ?string $card = 'cards.card-listing';

    public function getConfig(array $config = []): array
    {
        $config['args'] = [
            'label' => __('FAQ', 'horizon-posttypes'),
            'labels' => [
                'name' => __('FAQ', 'horizon-posttypes'),
                'singular_name' => __('FAQ', 'horizon-posttypes'),
                'menu_name' => __('FAQ', 'horizon-posttypes'),
                'add_new' => __('Ajouter une question', 'horizon-posttypes'),
                'add_new_item' => __('Ajouter une nouvelle question', 'horizon-posttypes'),
                'edit_item' => __('Modifier la question', 'horizon-posttypes'),
                'new_item' => __('Nouvelle question', 'horizon-posttypes'),
                'view_item' => __('Voir la question', 'horizon-posttypes'),
                'view_items' => __('Voir les questions', 'horizon-posttypes'),
                'search_items' => __('Rechercher une question', 'horizon-posttypes'),
                'not_found' => __('Aucune question trouvée', 'horizon-posttypes'),
                'not_found_in_trash' => __('Aucune question trouvée dans la corbeille', 'horizon-posttypes'),
                'all_items' => __('Toutes les questions', 'horizon-posttypes'),
                'archives' => __('Archives des questions', 'horizon-posttypes'),
            ],
            'menu_icon' => 'dashicons-format-status',
            'supports' => ['title'],
            'publicly_queryable' => false,
            // 'rewrite'=> ['slug'=> 'custom'],
        ];

        return parent::getConfig($config);
    }

    public function getFieldsTitle(): string
    {
        return __('Question', 'horizon-posttypes');
    }

    public function getStyle(): string
    {
        return 'seamless';
    }

    public function getFields(): ?iterable
    {
        yield Text::make(__('Intitulé de la question', 'horizon-posttypes'), self::FIELD_QUESTION)->required();
        yield WysiwygField::minimal(__('Réponse de la question', 'horizon-posttypes'), self::FIELD_ANSWER)->required();
    }
}
