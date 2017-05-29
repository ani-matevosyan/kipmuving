<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\User;

AdminSection::registerModel(User::class, function (ModelConfiguration $model) {
	
	$model->setTitle('Users');
	$model->disableDeleting();
	
	$model->onDisplay(function () {
		$display = AdminDisplay::datatables()->setColumns([
			$id = AdminColumn::text('id', '#')
				->setHtmlAttribute('class', 'text-center'),
			$sex = AdminColumn::custom('Sex')
				->setHtmlAttribute('class', 'text-center')
				->setCallback(function ($instance) {
					return $instance->gender == 'm'
						? '<i class="fa fa-male" style="color: #24B5A6;"></i>'
						: ($instance->gender == 'w'
							? '<i class="fa fa-female" style="color: #fa3242;"></i>'
							: '<i class="fa fa-minus"></i>');
				}),
			AdminColumn::text('first_name', 'Name'),
			AdminColumn::text('last_name', 'Surname'),
			AdminColumn::email('email', 'Email'),
			AdminColumn::text('phone', 'Phone'),
			$confirmed = AdminColumn::custom('Confirmed?')
				->setHtmlAttribute('class', 'text-center')
				->setCallback(function ($instance) {
					return $instance->confirmed
						? '<i class="fa fa-plus"></i>'
						: '<i class="fa fa-minus"></i>';
				}),
			$birthday = AdminColumn::datetime('birthday', 'Birthday')
				->setFormat('d.m.Y')
				->setHtmlAttribute('class', 'text-center'),
		]);
		
		$sex->getHeader()->setHtmlAttribute('class', 'text-center');
		$id->getHeader()->setHtmlAttribute('class', 'text-center');
		$birthday->getHeader()->setHtmlAttribute('class', 'text-center');
		
		$display->paginate(10);
		
		return $display;
	});
	
})
	->addMenuPage(User::class, 6)
	->setIcon('fa fa-users');