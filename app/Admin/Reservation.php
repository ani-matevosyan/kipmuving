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
			AdminColumn::text('id', '#')
				->setHtmlAttribute('class', 'text-center'),
			AdminColumn::custom()
				->setLabel('Status')
				->setHtmlAttribute('class', 'text-center')
				->setCallback(function ($instance) {
				return $instance->status
					? '<i class="fa fa-check" style="color: #79cc32;"></i>'
					: '<i class="fa fa-times" style="color: #fa3242;"></i>';
			}),
			AdminColumn::text('type', 'Type')
				->setHtmlAttribute('class', 'text-center'),
			AdminColumn::text('status_code', 'Code')
				->setHtmlAttribute('class', 'text-center'),
			AdminColumn::text('user', 'User'),
			AdminColumn::text('activity', 'Activity'),
			AdminColumn::text('agency', 'Agency'),
			AdminColumn::datetime('reserve_date', 'Date')
				->setFormat('d.m.Y')
				->setHtmlAttribute('class', 'text-center'),
			AdminColumn::text('persons', 'Persons')
				->setHtmlAttribute('class', 'text-center'),
//			AdminColumn::text('price', 'Price')
//				->setHtmlAttribute('class', 'text-center'),
			AdminColumn::text('sum', 'Sum')
				->setHtmlAttribute('class', 'text-center'),
			AdminColumn::text('payment_uid', 'Payment UID')
				->setWidth(50)
		]);
		$display->paginate(10);
		return $display;
	});

})
	->addMenuPage(Reservation::class, 3)
	->setIcon('fa fa-handshake-o');