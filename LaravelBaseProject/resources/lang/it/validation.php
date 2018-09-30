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

    'accepted' => ':attribute deve essere accettato.',
    'active_url' => ':attribute non &egrave; un URL valido.',
    'after' => ':attribute deve essere una data successiva a :date.',
    'after_or_equal' => ':attribute deve essere una data successiva o uguale a :date.',
    'alpha' => ':attribute pu&ograve; solo contenere lettere.',
    'alpha_dash' => ':attribute pu&ograve; solo contenere lettere, numeri, e trattini.',
    'alpha_num' => ':attribute &ograve; solo contenere lettere e numeri.',
    'array' => ":attribute deve essere un array.",
    'before' => ':attribute deve essere una data inferiore a :date.',
    'before_or_equal' => ':attribute deve essere una data inferiore o uguale a :date.',
    'between' => [
        'numeric' => ':attribute deve essere compreso tra :min e :max.',
        'file' => ':attribute deve essere compreso tra :min e :max kilobytes.',
        'string' => ':attribute deve essere compreso tra :min e :max caratteri.',
        'array' => ':attribute deve avere elementi compresi tra :min e :max .',
    ],
    'boolean' => 'Il campo :attribute deve essere vero o falso.',
    'confirmed' => 'Il campo :attribute conferma non corrisponde.',
    'date' => ':attribute non &egrave; una data valida.',
    'date_format' => ':attribute non corrisponde al formato :format.',
    'different' => ':attribute e :other devono essere differenti.',
    'digits' => ':attribute deve essere di :digits numeri.',
    'digits_between' => ':attribute deve essere compreso tra :min e :max numeri.',
    'dimensions' => ':attribute &egrave; un\'immagine di dimensioni invalide.',
    'distinct' => ':attribute ha un valore duplicato.',
    'email' => ':attribute deve essere un indirizzo email valido.',
    'exists' => ':attribute non &egrave; valido.',
    'file' => ':attribute deve essere un file.',
    'filled' => ':attribute deve avere un valore.',
    'gt' => [
        'numeric' => ':attribute deve avere un valore pi&ugrave; alto di :value.',
        'file' => ':attribute deve avere un valore pi&ugrave; alto di :value kilobytes.',
        'string' => ':attribute deve avere un valore pi&ugrave; alto di :value caratteri.',
        'array' => ':attribute deve avere pi&ugrave; di :value valori.',
    ],
    'gte' => [
        'numeric' => ':attribute deve avere un valore uguale o pi&ugrave; alto di :value.',
        'file' => ':attribute deve avere un valore uguale o pi&ugrave; alto di :value kilobytes.',
        'string' => ':attribute deve avere un valore uguale o pi&ugrave; alto di :value caratteri.',
        'array' => ':attribute deve avere un numero di valori uguali o superiori a :value.',
    ],
    'image' => ':attribute deve essere una immagine.',
    'in' => "l'attributo selezionato :attribute non &egrave; valido.",
    'in_array' => ':attribute non esiste in :other.',
    'integer' => ':attribute deve essere un intero.',
    'ip' => ':attribute deve essere  un valido indirizzo IP.',
    'ipv4' => ':attribute deve essere  un valido indirizzo IPv4.',
    'ipv6' => ':attribute deve essere  un valido indirizzo IPv6.',
    'json' => ':attribute deve essere  una valida stringa JSON.',
    'lt' => [
        'numeric' => ':attribute deve avere un valore pi&ugrave; basso di :value.',
        'file' => ':attribute deve avere un valore pi&ugrave; basso di :value kilobytes.',
        'string' => ':attribute deve avere un valore pi&ugrave; basso di :value caratteri.',
        'array' => ':attribute deve avere meno di :value valori.',
    ],
    'lte' => [
        'numeric' => ':attribute deve avere un valore uguale o pi&ugrave; basso di :value.',
        'file' => ':attribute deve avere un valore uguale o pi&ugrave; basso di :value kilobytes.',
        'string' => ':attribute deve avere un valore uguale o pi&ugrave; basso di :value caratteri.',
        'array' => ':attribute deve avere un numero di valori uguali o inferiori a :value.',
    ],
    'max' => [
        'numeric' => ':attribute non pu&ograve; essere pi&ugrave; grande di :max.',
        'file' => ':attribute non pu&ograve; essere pi&ugrave; grande di :max kilobytes.',
        'string' => ':attribute non pu&ograve; essere pi&ugrave; grande di :max caratteri.',
        'array' => ':attribute non pu&ograve; avere pi&ugrave; di :max elementi.',
    ],
    'mimes' => ':attribute deve essere un file di tipo: :values.',
    'mimetypes' => ':attribute deve essere un file di tipo: :values.',
    'min' => [
        'numeric' => ':attribute deve essere almeno :min.',
        'file' => ':attribute deve essere almeno :min kilobytes.',
        'string' => ':attribute deve essere almeno :min caratteri.',
        'array' => ':attribute deve avere almeno :min elementi.',
    ],
    'not_in' => "L'attributo selezionato :attribute non &egrave; valido.",
    'not_regex' => 'il formato del campo :attribute non &egrave; valido.',
    'numeric' => ':attribute deve essere un numero.',
    'present' => 'Il campo :attribute deve essere presente.',
    'regex' => ':attribute il formato non &egrave; valido.',
    'required' => 'Il campo :attribute &egrave; richiesto.',
    'required_if' => 'Il campo :attribute &egrave; richiesto quando :other &egrave; :value.',
    'required_unless' => 'Il campo :attribute &egrave; richiesto finch&egrave; :other &egrave :value.',
    'required_with' => 'Il campo :attribute &egrave; richiesto quando :values &egrave; presente.',
    'required_with_all' => 'Il campo :attribute &egrave; richiesto quando :values &egrave; presente.',
    'required_without' => 'Il campo :attribute &egrave; richiesto quando :values non &egrave; presente.',
    'required_without_all' => 'Il campo :attribute &egrave; richiesto quando nessuno di questi :values &egrave; presente.',
    'same' => ':attribute and :other must match.',
    'size' => [
        'numeric' => ':attribute deve essere di :size.',
        'file' => ':attribute deve essere di :size kilobytes.',
        'string' => ':attribute deve essere di :size caratteri.',
        'array' => ':attribute deve contenere :size elementi.',
    ],
    'string' => ':attribute deve essere una stringa.',
    'timezone' => ':attribute deve essere una timezone valido.',
    'unique' => ':attribute &egrave; gi&agrave; stato scelto.',
    'uploaded' => ':attribute ha fallito l\'upload.',
    'url' => 'il formato del campo :attribute non &egrave; valido.',

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
//            'max' => 'l\'immagine non puo essere pi&ugrave; grande di :max KB',
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
//        'project_name'=> 'nome del progetto',
    ],

];
