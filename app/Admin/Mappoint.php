<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Mappoint;

AdminSection::registerModel(Mappoint::class, function (ModelConfiguration $model) {

//	$model->enableAccessCheck();

	$model->setTitle('Guide points');

	$model->onDisplay(function () {
		$display = AdminDisplay::datatables()->setColumns([
			AdminColumn::text('id')->setLabel('#'),
			AdminColumn::text('point_id')->setLabel('Point ID'),
//			AdminColumn::text('address')->setLabel('Address'),
//			AdminColumn::text('email')->setLabel('Email'),
		]);
		$display->paginate(10);
		return $display;
	});

	$model->onCreateAndEdit(function () {
		$form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');

		$tabs = AdminDisplay::tabbed([
			'Guide point' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::text('point_id', 'Point ID')->required(),
				AdminFormElement::textarea('description', 'Description')->required(),
				AdminFormElement::textarea('real_tripadvisor_code', 'Tripadvisor'),
				AdminFormElement::textarea('bus_description', 'Description (bus)'),
//
				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::number('bus_est_time', 'Bus estimated time (minutes)'),
					], 4)
					->addColumn([
						AdminFormElement::number('bus_est_expenditure', 'Bus estimated expenditure'),
					], 4)
					->addColumn([
						AdminFormElement::number('bus_est_service', 'Bus estimated service'),
					], 4)
			])
		]);

		$form->addElement($tabs);
		return $form;
	});

})
	->addMenuPage(Mappoint::class, 50)
	->setIcon('fa fa-map-marker');