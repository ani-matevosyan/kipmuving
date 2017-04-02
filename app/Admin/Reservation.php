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
			AdminColumn::text('name', 'User')
				->setHtmlAttribute('class', 'text-center'),
			AdminColumn::text('offer.activity.name', 'Activity')
				->setHtmlAttribute('class', 'text-center'),
			AdminColumn::text('offer.agency.name', 'Agency')
				->setHtmlAttribute('class', 'text-center'),
			AdminColumn::datetime('reserve_date', 'Date')
				->setFormat('d.m.Y')
				->setHtmlAttribute('class', 'text-center'),
			AdminColumn::text('time_range', 'Time')
				->setHtmlAttribute('class', 'text-center'),
			AdminColumn::text('persons', 'Persons')
				->setHtmlAttribute('class', 'text-center'),
			AdminColumn::text('offer.real_price', 'Price')
				->setHtmlAttribute('class', 'text-center'),
			AdminColumn::text('sum', 'Sum')
				->setHtmlAttribute('class', 'text-center')
		]);
		$display->paginate(10);
		return $display;
	});

})
	->addMenuPage(Reservation::class, 3)
	->setIcon('fa fa-handshake-o');