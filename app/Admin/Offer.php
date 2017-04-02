<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Offer;

AdminSection::registerModel(Offer::class, function (ModelConfiguration $model) {
	
	$model->enableAccessCheck();
	
	$model->setTitle('Offers');
	
	$model->onDisplay(function () {
		$display = AdminDisplay::datatables()->setColumns([
			AdminColumn::text('id', '#'),
			AdminColumn::text('activity.name', 'Activity'),
			AdminColumn::text('agency.name', 'Agency'),
			AdminColumn::text('real_price', 'Price'),
//			AdminColumn::text('persons', 'Persons'),
//			AdminColumn::text('min_age', 'Min age'),
			AdminColumn::datetime('available_start', 'Start')
				->setFormat('d/m'),
			AdminColumn::datetime('available_end', 'End')
				->setFormat('d/m'),
			AdminColumn::custom()
				->setLabel('Available')
				->setHtmlAttribute('class', 'text-center')
				->setCallback(function ($instance) {
				return $instance->availability ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
			})
		]);
		$display->paginate(10);
		
		return $display;
	});
	
	$model->onCreateAndEdit(function () {
		$form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');
		
		$tabs = AdminDisplay::tabbed([
			'Offer'     => new \SleepingOwl\Admin\Form\FormElements([
				
				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::select('agency_id', 'Agency')
							->setModelForOptions('App\Agency')
							->setDisplay('name'),
					], 6)
					->addColumn([
						AdminFormElement::select('activity_id', 'Activity')
							->setModelForOptions('App\Activity')
							->setDisplay('name'),
					], 6),
				AdminFormElement::textarea('description', 'Description')
					->required(),
				AdminFormElement::text('cancellation_rules', 'Cancellation rules')
					->required(),
				
				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::date('available_start', 'Start date')
							->setPickerFormat('d.m')
							->required(),
						AdminFormElement::date('available_end', 'End date')
							->setPickerFormat('d.m')
							->required(),
//						AdminFormElement::time('start_time', 'Start time')
//							->required(),
					], 4)
					->addColumn([
						AdminFormElement::text('real_price', 'Price')
							->required(),
						AdminFormElement::text('real_price_offer', 'Offer price')
							->required()
//						AdminFormElement::time('end_time', 'End time')
//							->required()
					], 4)
					->addColumn([
						AdminFormElement::text('break_start', 'Break start')
							->required(),
						AdminFormElement::text('break_close', 'Break close')
							->required()
					], 4),
//					->addColumn([
//						AdminFormElement::number('persons', 'Persons')
//							->required()
//					], 3),
				AdminFormElement::checkbox('availability', 'Available'),
			]),
			'Time'  => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('real_available_time', 'Time')->required()
			]),
			'Includes'  => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('real_includes', 'Includes')->required()
			]),
			'Important' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('important', 'Important')->required()
			]),
		]);
		
		$form->addElement($tabs);
		
		return $form;
	});
	
})
	->addMenuPage(Offer::class, 2)
	->setIcon('fa fa-star');