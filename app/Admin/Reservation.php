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
			$id = AdminColumn::text('id', '#')
				->setHtmlAttribute('class', 'text-center'),
			$status = AdminColumn::custom('Status')
				->setHtmlAttribute('class', 'text-center')
				->setCallback(function ($instance) {
					return $instance->status
						? '<i class="fa fa-check" style="color: #79cc32;"></i>'
						: '<i class="fa fa-times" style="color: #fa3242;"></i>';
				}),
			$type = AdminColumn::text('type', 'Type')
				->setHtmlAttribute('class', 'text-center'),
			$status_code = AdminColumn::text('status_code', 'Code')
				->setHtmlAttribute('class', 'text-center'),
			$user = AdminColumn::text('name', 'User')
				->setHtmlAttribute('class', 'text-center'),
			$activity = AdminColumn::relatedLink('offer.activity.name', 'Activity')
				->setHtmlAttribute('class', 'text-center'),
			$agency = AdminColumn::relatedLink('offer.agency.name', 'Agency')
				->setHtmlAttribute('class', 'text-center'),
			$date = AdminColumn::datetime('reserve_date', 'Date')
				->setFormat('d.m.Y')
				->setHtmlAttribute('class', 'text-center'),
			$time = AdminColumn::text('time_range', 'Time')
				->setHtmlAttribute('class', 'text-center'),
			$persons = AdminColumn::text('persons', 'Persons')
				->setHtmlAttribute('class', 'text-center'),
			$price = AdminColumn::text('offer.real_price', 'Price')
				->setHtmlAttribute('class', 'text-center'),
			$sum = AdminColumn::text('sum', 'Sum')
				->setHtmlAttribute('class', 'text-center')
		]);
		
		$id->getHeader()->setHtmlAttribute('class', 'text-center');
		$status->getHeader()->setHtmlAttribute('class', 'text-center');
		$type->getHeader()->setHtmlAttribute('class', 'text-center');
		$status_code->getHeader()->setHtmlAttribute('class', 'text-center');
		$user->getHeader()->setHtmlAttribute('class', 'text-center');
		$activity->getHeader()->setHtmlAttribute('class', 'text-center');
		$agency->getHeader()->setHtmlAttribute('class', 'text-center');
		$date->getHeader()->setHtmlAttribute('class', 'text-center');
		$time->getHeader()->setHtmlAttribute('class', 'text-center');
		$persons->getHeader()->setHtmlAttribute('class', 'text-center');
		$price->getHeader()->setHtmlAttribute('class', 'text-center');
		$sum->getHeader()->setHtmlAttribute('class', 'text-center');
		
		$display->paginate(10);
		
		return $display;
	});
	
})
	->addMenuPage(Reservation::class, 3)
	->setIcon('fa fa-handshake-o');