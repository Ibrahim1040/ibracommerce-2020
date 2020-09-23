<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Lignes de langue de validation
    |--------------------------------------------------------------------------
    |
    | Les lignes de langue suivantes contiennent les messages d'erreur par défaut utilisés par
    | la classe de validateur. Certaines de ces règles ont plusieurs versions telles que
    | comme règles de taille. N'hésitez pas à modifier chacun de ces messages ici.
    |
    */

    'accepted'             => 'le :attribute doit etre accepté.',
    'active_url'           => 'le :attribute n\'est pas une URL valide.',
    'after'                => 'le :attribute doit être une date après :date.',
    'after_or_equal'       => 'le :attribute doit être une date postérieure ou égale à :date.',
    'alpha'                => 'le :attribute ne peut contenir que des lettres.',
    'alpha_dash'           => 'le :attribute ne peut contenir que des lettres, des chiffres et des tirets.',
    'alpha_num'            => 'le :attribute ne peut contenir que des lettres et des chiffres.',
    'array'                => 'le :attribute doit être un tableau.',
    'before'               => 'le :attribute doit être une date antérieure à :date.',
    'before_or_equal'      => 'le :attribute doit être une date antérieure ou égale à :date.',
    'between'              => [
        'numeric' => 'le :attribute doit être entre :min and :max.',
        'file'    => 'le :attribute doit être entre :min and :max kilo-octets.',
        'string'  => 'le :attribute doit être entre :min and :max caractères.',
        'array'   => 'le :attribute doit avoir entre :min and :max articles.',
    ],
    'boolean'              => 'le :attribute le champ doit être vrai ou faux.',
    'confirmed'            => 'le :attribute la confirmation ne correspond pas.',
    'date'                 => 'le :attribute Ce n\'est pas une date valide.',
    'date_format'          => 'le :attribute ne correspond pas au format :format.',
    'different'            => 'le :attribute et :other doit être différent.',
    'digits'               => 'le :attribute doit être :digits chiffres.',
    'digits_between'       => 'le :attribute doit être entre :min et :max chiffres.',
    'dimensions'           => 'le :attribute a des dimensions d\'image non valides.',
    'distinct'             => 'le :attribute le champ a une valeur en double.',
    'email'                => 'le :attribute Doit être une adresse e-mail valide.',
    'exists'               => 'le choix :attribute est invalide.',
    'file'                 => 'le :attribute doit être un fichier.',
    'filled'               => 'le :attribute Le champ doit avoir une valeur.',
    'image'                => 'le :attribute doit être une image.',
    'in'                   => 'le choix :attribute est invalide.',
    'in_array'             => 'le :attribute champ n\'existe pas dans :other.',
    'integer'              => 'le :attribute doit être un entier.',
    'ip'                   => 'le :attribute doit être une adresse IP valide.',
    'ipv4'                 => 'le :attribute doit être une adresse IPv4 valide.',
    'ipv6'                 => 'le :attribute doit être une adresse IPv6 valide.',
    'json'                 => 'le :attribute doit être une chaîne JSON valide.',
    'max'                  => [
        'numeric' => 'le :attribute ne peut pas être supérieur à :max.',
        'file'    => 'le :attribute ne peut pas être supérieur à :max kilo-octets.',
        'string'  => 'le :attribute may not be greater than :max caractères.',
        'array'   => 'le :attribute ne peut pas avoir plus de :max articles.',
    ],
    'mimes'                => 'le :attribute doit être un fichier de type: :values.',
    'mimetypes'            => 'le :attribute doit être un fichier de type: :values.',
    'min'                  => [
        'numeric' => 'le :attribute doit être au moins :min.',
        'file'    => 'le :attribute doit être au moins :min kilo-octets.',
        'string'  => 'le :attribute doit être au moins :min caractères.',
        'array'   => 'le :attribute must have at least :min articles.',
    ],
    'not_in'               => 'le choix :attribute est invalide.',
    'numeric'              => 'le :attribute doit être un nombre.',
    'present'              => 'le :attribute doit être présent.',
    'regex'                => 'le :attribute le format n\'est pas valide.',
    'required'             => 'le :attribute Champ requis.',
    'required_if'          => 'le :attribute Champ requis quand :other est :value.',
    'required_unless'      => 'le :attribute est obligatoire sauf si :other est dans :values.',
    'required_with'        => 'le :attribute est obligatoire lorsque :values sont présentes.',
    'required_with_all'    => 'le :attribute est obligatoire lorsque :values sont présentes.',
    'required_without'     => 'le :attribute est obligatoire lorsque :values n\'est pas présent.',
    'required_without_all' => 'le :attribute est obligatoire lorsqu\'aucune des :values sont présents.',
    'same'                 => 'le :attribute et :other doit correspondre.',
    'size'                 => [
        'numeric' => 'le :attribute doit être :size.',
        'file'    => 'le :attribute doit être :size kilo-octets.',
        'string'  => 'le :attribute doit être :size caractères.',
        'array'   => 'le :attribute doit contenir :size articles.',
    ],
    'string'               => 'le :attribute doit être une chaîne de caractères.',
    'timezone'             => 'le :attribute doit être une zone valide.',
    'unique'               => 'le :attribute a déjà été pris.',
    'uploaded'             => 'le :attribute échec du téléchargement.',
    'url'                  => 'le :attribute le format n\'est pas valide.',

    /*
    |--------------------------------------------------------------------------
    | Lignes de langue de validation personnalisées
    |--------------------------------------------------------------------------
    |
    |Ici, vous pouvez spécifier des messages de validation personnalisés pour les attributs à l'aide de la
    | convention "attribute.rule" pour nommer les lignes. Cela permet de
    | spécifiez une ligne de langue personnalisée spécifique pour une règle d'attribut donnée.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Attributs de validation personnalisés
    |--------------------------------------------------------------------------
    |
    | Les lignes de langage suivantes sont utilisées pour permuter les espaces réservés d'attribut
    | avec quelque chose de plus convivial pour les lecteurs, comme l'adresse e-mail à la place
    | de "courriel". Cela nous aide simplement à rendre les messages un peu plus propres.
    |
    */

    'attributes' => [],

];
