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
            'label' => 'FAQ',
            'labels' => [
                'name' => 'FAQ',
                'singular_name' => 'FAQ',
                'menu_name' => 'FAQ',
                'add_new' => 'Ajouter une question',
                'add_new_item' => 'Ajouter une nouvelle question',
                'edit_item' => 'Modifier la question',
                'new_item' => 'Nouvelle question',
                'view_item' => 'Voir la question',
                'view_items' => 'Voir les questions',
                'search_items' => 'Rechercher une question',
                'not_found' => 'Aucune question trouvée',
                'not_found_in_trash' => 'Aucune question trouvée dans la corbeille',
                'all_items' => 'Toutes les questions',
                'archives' => 'Archives des questions',
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
        return __('Question');
    }

    public function getStyle(): string
    {
        return 'seamless';
    }

    public function getFields(): ?iterable
    {
        yield Text::make('Intitulé de la question', self::FIELD_QUESTION)->required();
        yield WysiwygField::minimal('Réponse de la question', self::FIELD_ANSWER)->required();
    }
}
