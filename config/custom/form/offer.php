<?php

return [
    'id' => 'offer_form',
    'fields' => [
        'category' => [
            'type' => 10,
            'name' => 'category',
            'textKey' => 'validation.attributes.category',
            'zeroValueKey' =>'validation.attributes.zeroValueKey',
            'errorTextKey' => '{"id": "validation-js.required", "params": {}}',
            'validations' => ['required'],
        ],
        'title' => [
            'type' => 1,
            'name' => 'title',
            'textKey' => 'validation.attributes.title',
            'errorTextKey' => '{"id": "validation-js.min.string", "params": {"min": 3}}',
            'validations' => ['required', 'min:3'],
        ],
        'description' => [
            'type' => 2,
            'name' => 'description',
            'textKey' => 'validation.attributes.description',
            'errorTextKey' => '{"id": "validation-js.min.string", "params": {"min": 3}}',
            'validations' => ['required', 'min:3'],
        ],
        'price' => [
            'type' => 8,
            'name' => 'price',
            'textKey' => 'validation.attributes.price',
            'errorTextKey' => '{"id": "validation-js.price", "params": {}}',
            'validations' => ['required', 'c_price', 'min:1'],
        ],
        'offer-price' => [
            'type' => 8,
            'name' => 'offer-price',
            'textKey' => 'validation.attributes.offer-price',
            'errorTextKey' => '{"id": "validation-js.price", "params": {}}',
            'validations' => ['required', 'c_price', 'min:1'],
        ],
        'expiration-date' => [
            'type' => 9,
            'name' => 'expiration-date',
            'textKey' => 'validation.attributes.expiration-date',
            'errorTextKey' => '{"id": "validation-js.date", "params": {}}',
            'validations' => ['required', 'date', 'after:'. date("Y-m-d")],
        ],
        'show-in-home' => [
            'type' => 6,
            'name' => 'show-in-home',
            'textKey' => 'validation.attributes.show-in-home',
            'errorTextKey' => '{"id": "validation-js.required", "params": {}}',
            'validations' => ['required'],
        ],
        'show' => [
            'type' => 6,
            'name' => 'show',
            'default' => true,
            'textKey' => 'validation.attributes.show',
            'errorTextKey' => '{"id": "validation-js.required", "params": {}}',
            'validations' => ['required'],
        ]
    ]
];
