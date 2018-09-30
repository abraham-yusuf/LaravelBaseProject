<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ' :attribute tiene que ser confirmado.',
    'active_url' => ' :attribute no es un URL valido.',
    'after' => ' :attribute tiene que ser una fecha posterior que :date.',
    'after_or_equal' => ':attribute tiene que ser una fecha posterior o igual que :date.',
    'alpha' => ' :attribute puede solo contener letras.',
    'alpha_dash' => ' :attribute puede solo contener letras, numeros y guiones.',
    'alpha_num' => ' :attribute puede solo contener letras y numeros.',
    'array' => " :attribute tiene que ser un array.",
    'before' => ' :attribute tiene que ser una fecha inferior que :date.',
    'before_or_equal' => ':attribute tiene que ser una fecha inferior o igual que :date.',
    'between' => [
        'numeric' => ':attribute tiene que ser incluido entre :min y :max.',
        'file' => ':attribute tiene que ser incluido entre :min y :max kilobytes.',
        'string' => ':attribute tiene que ser incluido entre :min y :max caracteres.',
        'array' => ':attribute deve avere elementi compresi tra :min y :max .',
    ],
    'boolean' => 'El campo :attribute tiene que ser verdadero o falso.',
    'confirmed' => 'El campo :attribute confirmaci&oacute; no corresponde.',
    'date' => ':attribute no es una fecha valida.',
    'date_format' => ':attribute no corresponde al formato :format.',
    'different' => ':attribute y :other tienen que ser diferentes.',
    'digits' => ':attribute tiene que ser de :digits numeros.',
    'digits_between' => ':attribute tiene que ser incluido entre :min y :max numeros.',
    'dimensions' => ':attribute es una imagen de dimensiones no validas.',
    'distinct' => ':attribute tiene un valor duplicado.',
    'email' => ':attribute no es un correo electronico valido.',
    'exists' => "el :attribute selecionado no es valido.",
    'filled' => ':attribute es obligatorio.',
    'gt' => [
        'numeric' => ':attribute tiene que tener un valor mas alto que :value.',
        'file' => ':attribute tiene que tener un valor mas alto que :value kilobytes.',
        'string' => ':attribute tiene que tener un valor mas alto que :value characteres.',
        'array' => ':attribute tiene que tener mas de :value valores.',
    ],
    'gte' => [
        'numeric' => ':attribute tiene que tener un valor igual o mas alto que :value.',
        'file' => ':attribute tiene que tener un valor igual o mas alto que :value kilobytes.',
        'string' => ':attribute tiene que tener un valor igual o mas alto que :value characteres.',
        'array' => ':attribute tiene que tener un numero de valore igual o mas alto que :value.',
    ],
    'image' => ':attribute tiene que ser una imagen.',
    'in' => "el campo selecionado :attribute no es valido.",
    'in_array' => ':attribute no existe en :other.',
    'integer' => ':attribute tiene que ser entero.',
    'ip' => ':attribute tiene que ser ua valida direcci&oacute; IP.',
    'ipv4' => ':attribute tiene que ser ua valida direcci&oacute; IPv4.',
    'ipv6' => ':attribute tiene que ser ua valida direcci&oacute; IPv6.',
    'json' => ':attribute tiene que ser una valida estringa JSON.',
    'lt' => [
        'numeric' => ':attribute tiene que tener un valor mas bajo que :value.',
        'file' => ':attribute tiene que tener un valor mas bajo que :value kilobytes.',
        'string' => ':attribute tiene que tener un valor mas bajo que :value caratteri.',
        'array' => ':attribute tiene que tener menos de :value valores.',
    ],
    'lte' => [
        'numeric' => ':attribute tiene que tener un valor igual o mas bajo que :value.',
        'file' => ':attribute tiene que tener un valor igual o mas bajo que :value kilobytes.',
        'string' => ':attribute tiene que tener un valor igual o mas bajo que :value caratteri.',
        'array' => ':attribute tiene que tener un numero de valores igual o mas bajo que :value.',
    ],
    'max' => [
        'numeric' => ':attribute no puede ser mas grande de :max.',
        'file' => ':attribute no puede ser mas grande de :max kilobytes.',
        'string' => ':attribute no puede ser mas grande de :max caracteres.',
        'array' => ':attribute no puede ser aver mas de :max elementos.',
    ],
    'mimes' => ':attribute tiene que ser un fichero de tipo :values.',
    'mimetypes' => ':attribute tiene que ser un fichero de tipo :values.',
    'min' => [
        'numeric' => ':attribute tiene que ser almeno de :min.',
        'file' => ':attribute tiene que ser almeno de :min kilobytes.',
        'string' => ':attribute tiene que ser almeno de :min caracteres.',
        'array' => ':attribute tiene que tener almeno :min elementos.',
    ],
    'not_in' => "El campo seleccionado :attribute no es valido.",
    'not_regex' => 'El formato del campo seleccionado :attribute non es valido.',
    'numeric' => ':attribute tiene que ser un numero.',
    'present' => 'El campo :attribute tiene que ser presente.',
    'regex' => ':attribute el formato no es valido.',
    'required' => 'El campo :attribute es requerido.',
    'required_if' => 'El campo :attribute es requerido cuando :other vale :value.',
    'required_unless' => 'El campo :attribute es requerido hasta que :other vale :value.',
    'required_with' => 'El campo :attribute es requerido cuando :values est&aacute; presente.',
    'required_with_all' => 'El campo :attribute es requerido cuando :values est&aacute; presente.',
    'required_without' => 'El campo :attribute es requerido cuando :values no est&aacute; presente.',
    'required_without_all' => 'El campo :attribute es requerido cuando nunguno de estos :values est&aacute; presente.',
    'same' => ':attribute and :other must match.',
    'size' => [
        'numeric' => ':attribute tiene que ser :size.',
        'file' => ':attribute tiene que ser :size kilobytes.',
        'string' => ':attribute tiene que ser :size caracteres.',
        'array' => ':attribute tiene que contener :size elementos.',
    ],
    'string' => ':attribute tiene que ser una estringa.',
    'timezone' => ':attribute tiene que ser una timezone valida.',
    'unique' => ':attribute ya ha sido elegido.',
    'uploaded' => ':attribute ha fallido el upload.',
    'url' => 'El formato :attribute no es valido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
//        'images.*' => [
//            'max' => 'la imagen no puede ser mas grande que :max KB',
//        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
//        'project_name'=> 'nombre del proyecto',
    ],

];
