<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\HomeMail;

AdminSection::registerModel(HomeMail::class, function (ModelConfiguration $model) {

	$model->enableAccessCheck();

	$model->setTitle('Emails');

	$model->onDisplay(function () {
		$display = AdminDisplay::table()->setColumns([
			AdminColumn::text('id')->setLabel('#'),
			AdminColumn::text('name')->setLabel('Name'),
			AdminColumn::text('email')->setLabel('Email'),
			AdminColumn::text('message')->setLabel('Message'),
		]);
		$display->paginate(10);
		return $display;
	});

})
	->addMenuPage(HomeMail::class, 4)
	->setIcon('fa fa-envelope-o');