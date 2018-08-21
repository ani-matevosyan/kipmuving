<?php

return [
	"accepted"         => "El campo :attribute debe ser aceptado.",
	"active_url"       => "El campo :attribute no es una URL válida.",
	"after"            => "El campo :attribute debe ser una fecha posterior a :date.",
	"alpha"            => "El campo :attribute sólo puede contener letras.",
	"alpha_dash"       => "El campo :attribute sólo puede contener letras, números y guiones.",
	"alpha_num"        => "El campo :attribute sólo puede contener letras y números.",
	"before"           => "El campo :attribute debe ser una fecha anterior a :date.",
	"between"          => [
		"numeric" => "El campo :attribute debe estar comprendido entre :min - :max.",
		"file"    => "El campo :attribute debe tener entre :min - :max kilobytes.",
		"string"  => "El campo :attribute debe tener entre :min - :max caracteres.",
	],
	"confirmed"        => "El campo :attribute confirmación no coincide.",
	"date"             => "El campo :attribute no es una fecha válida.",
	"date_format"      => "El campo :attribute no coincide con el formato :format.",
	"different"        => "El campo :attribute y :other deben ser diferentes.",
	"digits"           => "El campo :attribute debe tener :digits dígitos.",
	"digits_between"   => "El campo :attribute debe tener entre :min and :max digits.",
	"email"            => "El campo :attribute formato no es válido.",
	"exists"           => "El campo :attribute seleccionado es inválido.",
	"image"            => "El campo :attribute debe ser una imagen.",
	"in"               => "El campo :attribute seleccionado es inválido.",
	"integer"          => "El campo :attribute debe ser entero.",
	"ip"               => "El campo :attribute debe ser una dirección IP válida.",
	"max"              => [
		"numeric" => "El campo :attribute no debe ser mayor a :max.",
		"file"    => "El campo :attribute no debe ser mayor a :max kilobytes.",
		"string"  => "El campo :attribute no debe ser mayor a :max caracteres.",
	],
	"mimes"            => "El campo :attribute debe ser un archivo de tipo :values.",
	"min"              => [
		"numeric" => "El campo :attribute debe ser mínimo de :min.",
		"file"    => "El campo :attribute debe tener al menos :min kilobytes.",
		"string"  => "El campo :attribute debe tener al menos :min characters.",
	],
	"not_in"           => "El campo :attribute es inválido.",
	"numeric"          => "El campo :attribute debe ser numérico.",
	"regex"            => "El formato del campo :attribute es inválido.",
	"required"         => "El campo :attribute es requerido.",
	"required_if"      => "El campo :attribute es requerido cuando :other es :value.",
	"required_with"    => "El campo :attribute es requerido cuando :values está presente.",
	"required_without" => "El campo :attribute es requerido cuando :values no está presente.",
	"same"             => "El campo :attribute y :other no coinciden.",
	"size"             => [
		"numeric" => "El campo :attribute debe ser :size.",
		"file"    => "El campo :attribute debe ser de :size kilobytes.",
		"string"  => "El campo :attribute debe ser de :size caracteres.",
	],
	"unique"           => "El campo :attribute ya ha sido tomado.",
	"url"              => "El formato del campo :attribute es inválido.",
	
	
	#Custom Validation Language Lines
	'custom'           => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],
	
	
	#Custom Validation Attributes
	'attributes'       => [
        'start_time.0' => 'hora de inicio',
        'end_time.0' => 'hora de finalización',
        'name' => 'nombre',
        'price' => 'valor',
        'min_persons' => 'minimo',
    ],
];
