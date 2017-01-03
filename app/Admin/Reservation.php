<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Reservation;

AdminSection::registerModel(Reservation::class, function (ModelConfiguration $model) {

	$model->enableAccessCheck();
	$model->disableDeleting();

	$model->setTitle('Reservations');

	$model->onDisplay(function () {
		$display = AdminDisplay::table()->setColumns([
			AdminColumn::text('id')->setLabel('#'),
			AdminColumn::text('user')->setLabel('User'),
			AdminColumn::text('activity')->setLabel('Activity'),
			AdminColumn::text('agency')->setLabel('Agency'),
			AdminColumn::datetime('reserve_date')->setLabel('Date')->setFormat('d.m.Y'),
			AdminColumn::text('persons')->setLabel('Persons'),
			AdminColumn::text('price')->setLabel('Price'),
			AdminColumn::text('sum')->setLabel('Sum')
		]);
		$display->paginate(10);
		return $display;
	});

})
	->addMenuPage(Reservation::class, 3)
	->setIcon('fa fa-handshake-o');