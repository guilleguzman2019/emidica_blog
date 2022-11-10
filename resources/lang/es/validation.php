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

    'accepted'             => 'El campo :attribute debe ser aceptado.',
    'active_url'           => 'El campo :attribute no es una URL válida.',
    'after'                => 'El campo :attribute debe ser una fecha posterior a :date.',
    'after_or_equal'       => 'El campo :attribute debe ser una fecha posterior o igual a :date.',
    'alpha'                => 'El campo :attribute solo puede contener letras.',
    'alpha_dash'           => 'El campo :attribute solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num'            => 'El campo :attribute solo puede contener letras y números.',
    'array'                => 'El campo :attribute debe ser un array.',
    'before'               => 'El campo :attribute debe ser una fecha anterior a :date.',
    'before_or_equal'      => 'El campo :attribute debe ser una fecha anterior o igual a :date.',
    'between'              => [
        'numeric' => 'El campo :attribute debe ser un valor entre :min y :max.',
        'file'    => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
        'string'  => 'El campo :attribute debe contener entre :min y :max caracteres.',
        'array'   => 'El campo :attribute debe contener entre :min y :max elementos.',
    ],
    'boolean'              => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed'            => 'El campo confirmación de :attribute no coincide.',
    'date'                 => 'El campo :attribute no corresponde con una fecha válida.',
    'date_equals'          => 'El campo :attribute debe ser una fecha igual a :date.',
    'date_format'          => 'El campo :attribute no corresponde con el formato de fecha :format.',
    'different'            => 'Los campos :attribute y :other deben ser diferentes.',
    'digits'               => 'El campo :attribute debe ser un número de :digits dígitos.',
    'digits_between'       => 'El campo :attribute debe contener entre :min y :max dígitos.',
    'dimensions'           => 'El campo :attribute tiene dimensiones de imagen inválidas.',
    'distinct'             => 'El campo :attribute tiene un valor duplicado.',
    'email'                => 'El campo :attribute debe ser una dirección de correo válida.',
    'ends_with'            => 'El campo :attribute debe finalizar con alguno de los siguientes valores: :values',
    'exists'               => 'El campo :attribute seleccionado no existe.',
    'file'                 => 'El campo :attribute debe ser un archivo.',
    'filled'               => 'El campo :attribute debe tener un valor.',
    'gt'                   => [
        'numeric' => 'El campo :attribute debe ser mayor a :value.',
        'file'    => 'El archivo :attribute debe pesar más de :value kilobytes.',
        'string'  => 'El campo :attribute debe contener más de :value caracteres.',
        'array'   => 'El campo :attribute debe contener más de :value elementos.',
    ],
    'gte'                  => [
        'numeric' => 'El campo :attribute debe ser mayor o igual a :value.',
        'file'    => 'El archivo :attribute debe pesar :value o más kilobytes.',
        'string'  => 'El campo :attribute debe contener :value o más caracteres.',
        'array'   => 'El campo :attribute debe contener :value o más elementos.',
    ],
    'image'                => 'El campo :attribute debe ser una imagen.',
    'in'                   => 'El campo :attribute es inválido.',
    'in_array'             => 'El campo :attribute no existe en :other.',
    'integer'              => 'El campo :attribute debe ser un número entero.',
    'ip'                   => 'El campo :attribute debe ser una dirección IP válida.',
    'ipv4'                 => 'El campo :attribute debe ser una dirección IPv4 válida.',
    'ipv6'                 => 'El campo :attribute debe ser una dirección IPv6 válida.',
    'json'                 => 'El campo :attribute debe ser una cadena de texto JSON válida.',
    'lt'                   => [
        'numeric' => 'El campo :attribute debe ser menor a :value.',
        'file'    => 'El archivo :attribute debe pesar menos de :value kilobytes.',
        'string'  => 'El campo :attribute debe contener menos de :value caracteres.',
        'array'   => 'El campo :attribute debe contener menos de :value elementos.',
    ],
    'lte'                  => [
        'numeric' => 'El campo :attribute debe ser menor o igual a :value.',
        'file'    => 'El archivo :attribute debe pesar :value o menos kilobytes.',
        'string'  => 'El campo :attribute debe contener :value o menos caracteres.',
        'array'   => 'El campo :attribute debe contener :value o menos elementos.',
    ],
    'max'                  => [
        'numeric' => 'El campo :attribute no debe ser mayor a :max.',
        'file'    => 'El archivo :attribute no debe pesar más de :max kilobytes.',
        'string'  => 'El campo :attribute no debe contener más de :max caracteres.',
        'array'   => 'El campo :attribute no debe contener más de :max elementos.',
    ],
    'mimes'                => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'mimetypes'            => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'min'                  => [
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'file'    => 'El archivo :attribute debe pesar al menos :min kilobytes.',
        'string'  => 'El campo :attribute debe contener al menos :min caracteres.',
        'array'   => 'El campo :attribute debe contener al menos :min elementos.',
    ],
    'not_in'               => 'El campo :attribute seleccionado es inválido.',
    'not_regex'            => 'El formato del campo :attribute es inválido.',
    'numeric'              => 'El campo :attribute debe ser un número.',
    'password'             => 'La contraseña es incorrecta.',
    'present'              => 'El campo :attribute debe estar presente.',
    'regex'                => 'El formato del campo :attribute es inválido.',
    'required'             => 'El campo :attribute es obligatorio.',
    'required_if'          => 'El campo :attribute es obligatorio cuando el campo :other es :value.',
    'required_unless'      => 'El campo :attribute es requerido a menos que :other se encuentre en :values.',
    'required_with'        => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El campo :attribute es obligatorio cuando :values están presentes.',
    'required_without'     => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de los campos :values están presentes.',
    'same'                 => 'Los campos :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El campo :attribute debe ser :size.',
        'file'    => 'El archivo :attribute debe pesar :size kilobytes.',
        'string'  => 'El campo :attribute debe contener :size caracteres.',
        'array'   => 'El campo :attribute debe contener :size elementos.',
    ],
    'starts_with'          => 'El campo :attribute debe comenzar con uno de los siguientes valores: :values',
    'string'               => 'El campo :attribute debe ser una cadena de caracteres.',
    'timezone'             => 'El campo :attribute debe ser una zona horaria válida.',
    'unique'               => 'El valor del campo :attribute ya está en uso.',
    'uploaded'             => 'El campo :attribute no se pudo subir.',
    'url'                  => 'El formato del campo :attribute es inválido.',
    'uuid'                 => 'El campo :attribute debe ser un UUID válido.',

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
        'image_desktop' => [
            'required' => 'Debes cargar una Imagen para PC.'
        ],
        'image_mobile' => [
            'required' => 'Debes cargar una Imagen para Móvil.'
        ],
        'image_desktopEdit' => [
            'required' => 'Debes cargar una Imagen para PC.'
        ],
        'image_mobileEdit' => [
            'required' => 'Debes cargar una Imagen para Móvil.'
        ],
        'plan' => [
            'required' => 'Debes elegir un plan.'
        ],
        'categoriesShop' => [
            'required' => 'Debes elegir al menos una categoría.'
        ],
        'method_selected' => [
            'required' => 'Debes elegir al menos un método de pago.'
        ],
        'createArray.shipping_type' => [
            'required' => 'Debes elegir un método de envío.'
        ],
        'createArray.payment_method' => [
            'required' => 'Debes elegir un método de pago.'
        ],
        'selected' => [
            'required' => 'Debes elegir al menos un pedido para generar la solicitud.'
        ],
        'domain_result_status' => [
            'required' => 'Antes de solicitar el dominio debés validar su disponibilidad.',
            'accepted' => 'El dominio que intentas solicitar no se encuentra disponible. Por favor, busca otro que esté disponible.'
        ],
        'delivery_selected' => [
            'required' => 'Debes elegir un método de envío.'
        ],
        'categoriesShopSelected' => [
            'required' => 'Debes elegir al menos una categoría.'
        ],
        'shop_mail' => [
            'required' => 'Debes colocar un email. Aquí se enviarán los mensajes de contacto de tu tienda. Puedes utilizar el mismo que elegiste al momento de registrarte.'
        ],
        'shop.shop_mail' => [
            'required' => 'Debes colocar un email. Aquí se enviarán los mensajes de contacto de tu tienda. Puedes utilizar el mismo que elegiste al momento de registrarte.'
        ]
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
        'createArray.name' => 'Nombre',
        'createArray.slug' => 'Slug',
        'createArray.sku' => 'SKU',
        'image' => 'Imagen',
        'createArray.description' => 'Descripción',
        'createArray.price_regular' => 'Precio regular',
        'createArray.price_cost' => 'Precio de costo',
        'createArray.variation' => 'Variación',
        'createArray.category_id' => 'Categoría',
        'cta_title' => 'Título',
        'cta_description' => 'Descripción',
        'cta_button_text' => 'Botón',
        'cta_button_link' => 'Enlace',
        'createArray.location' => 'Ubicación',
        'createArray.order' => 'Orden',
        'createArray.url' => 'URL',
        'createArray.category_id' => 'Categoría',
        'editArray.location' => 'Ubicación',
        'editArray.order' => 'Orden',
        'editArray.url' => 'URL',
        'editArray.category_id' => 'Categoría',
        'image_desktop' => 'Imagen para PC',
        'image_mobile' => 'Imagen para Móvil',
        'image_desktopEdit' => 'Imagen para PC',
        'image_mobileEdit' => 'Imagen para Móvil',
        'createArray.quantity' => 'Cantidad',
        'quantity' => 'Cantidad',
        'bank_name' => 'Nombre del Banco',
        'bank_titular' => 'Titular de la cuenta',
        'bank_titular_cuit' => 'CUIT',
        'bank_alias' => 'Alias',
        'bank_cbu' => 'CBU',
        'mp_public_key' => 'Public Key',
        'mp_access_token' => 'Access Token',
        'createArray.customer_name' => 'Nombre',
        'createArray.customer_phone' => 'Teléfono',
        'createArray.customer_email' => 'Email',
        'createArray.customer_address' => 'Dirección',
        'createArray.customer_city' => 'Ciudad',
        'createArray.customer_province' => 'Provincia',
        'shop_name' => 'Nombre de la tienda',
        'name' => 'Nombre',
        'current_password' => 'Contraseña actual',
        'password' => 'Contraseña',
        'password_confirmation' => 'Confirmar contraseña',
        'voucher' => 'Comprobante',
        'shop.bank_name' => 'Nombre del banco',
        'shop.bank_titular' => 'Titular de la cuenta',
        'shop.bank_cuit' => 'CUIT',
        'shop.bank_cbu' => 'CBU/CVU',
        'shop.bank_alias' => 'Alias',
        'shop.mp_public_key' => 'Public Key',
        'shop.mp_access_token' => 'Access Token',
        'terms' => 'Términos y Condiciones',
        'createArray.customer_doc' => 'Documento',
        'createArray.customer_zip' => 'Código Postal',
        'shop_mail' => 'Email',
        'shop.shop_mail' => 'Email',
        'status_shop' => 'Estado',
        'motive_status' => 'Motivo'
    ],

];
