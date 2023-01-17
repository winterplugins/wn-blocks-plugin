<?php

return [
    'plugin' => [
        'name' => 'Blocks',
        'description' => 'Visual block plugin for WinterCMS',
    ],
    'components' => [
        'block' => [
            'name' => 'Blocks',
            'code' => 'Code',
            'id' => 'ID',
            'save' => 'Save',
            'close' => 'Close',
            'class' => 'CSS class'
        ]
    ],
    'models' => [
        'general' => [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ],
        'block' => [
            'label' => 'Block',
            'label_plural' => 'Blocks',
            'code' => 'Code'
        ],
        'category' => [
            'label' => 'Category',
            'label_plural' => 'Categories',
        ],
    ],
];
