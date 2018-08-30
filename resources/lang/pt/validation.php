<?php

return [
	"accepted"         => "O :attribute deve ser aceito.",
	"active_url"       => "O :attribute não é uma URL válida.",
	"after"            => "O :attribute deve ser uma data após :date.",
	"alpha"            => "O :attribute só pode conter letras.",
	"alpha_dash"       => "O :attribute só pode conter letras, números e traços.",
	"alpha_num"        => "O :attribute só pode conter letras e números.",
	"before"           => "O :attribute deve ser uma data anterior a :date.",
	"between"          => [
		"numeric" => "O :attribute deve estar entre :min - :max.",
		"file"    => "O :attribute deve estar entre :min - :max kilobytes.",
		"string"  => "O campo :attribute deve estar entre :min - :max caracteres.",
	],
	"confirmed"        => "O :attribute confirmação não coincide.",
	"date"             => "O :attribute não é uma data válida.",
	"date_format"      => "O :attribute não corresponde ao formato :format.",
	"different"        => "O :attribute e :other deve ser diferente.",
	"digits"           => "O :attribute deve ter :digits dígitos.",
	"digits_between"   => "O :attribute deve ter entre :min e :max dígitos.",
	"email"            => "O :attribute não é um e-mail válido.",
	"exists"           => "O :attribute seleção inválida.",
	"image"            => "O :attribute deve ser uma imagem.",
	"in"               => "O :attribute seleção inválida.",
	"integer"          => "O :attribute deve ser inteiro.",
	"ip"               => "O :attribute deve ser um endereço IP válido.",
	"max"              => [
		"numeric" => "O :attribute deve ser inferior a :max.",
		"file"    => "O :attribute deve ser inferior a :max kilobytes.",
		"string"  => "O campo :attribute deve ser inferior a :max caracteres.",
	],
	"mimes"            => "O :attribute deve ser um arquivo do tipo: :values.",
	"min"              => [
		"numeric" => "O :attribute deve conter pelo menos :min.",
		"file"    => "O :attribute deve conter pelo menos :min kilobytes.",
		"string"  => "O campo :attribute deve conter pelo menos :min caracteres.",
	],
	"not_in"           => "O :attribute seleção inválida.",
	"numeric"          => "O :attribute deve ser um número.",
	"regex"            => "O :attribute não é válido.",
	"required"         => "O campo :attribute deve ser preenchido.",
	"required_if"      => "O campo :attribute deve ser preenchido quando :other é :value.",
	"required_with"    => "O campo :attribute deve ser preenchido quando :values está presente.",
	"required_without" => "O campo :attribute deve ser preenchido quando :values não está presente.",
	"same"             => "O :attribute e :other devem ser iguais.",
	"size"             => [
		"numeric" => "O :attribute deve ser :size.",
		"file"    => "O :attribute deve ter :size kilobyte.",
		"string"  => "O campo :attribute deve ter :size caracteres.",
	],
	"unique"           => "Este :attribute já existe.",
	"url"              => "O formato :attribute é inválido.",
	
	
	#Custom Validation Language Lines
	'custom'           => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],
	
	
	#Custom Validation Attributes
	'attributes'       => [
        'start_time.*' => 'hora de inicio',
        'end_time.*' => 'hora de finalización',
        'name' => 'nombre',
        'price' => 'valor',
        'min_persons' => 'minimo',
        'prices.0' => 'valor',
        'prices.*' => 'valor',
    ],
];
