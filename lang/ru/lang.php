<?php

return [
    'plugin' => [
        'name' => 'Блоки',
        'description' => 'Визуальный редактор блоков для WinterCMS'
    ],
    'components' => [
        'block' => [
            'name' => 'Блоки'
        ]
    ],
    'models' => [
        'general' => [
            'id' => 'ID',
            'name' => 'Название',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ],
        'block' => [
            'label' => 'Блок',
            'label_plural' => 'Блоки',
            'code' => 'Код'
        ],
        'category' => [
            'label' => 'Категория',
            'label_plural' => 'Категории',
        ],
    ],
];
