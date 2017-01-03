<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Offer;

AdminSection::registerModel(Offer::class, function (ModelConfiguration $model) {
	
	$model->enableAccessCheck();
	
	$model->setTitle('Offers');
	
	$model->onDisplay(function () {
		$display = AdminDisplay::datatables()->setColumns([
			AdminColumn::text('id')->setLabel('#'),
			AdminColumn::text('activity')->setLabel('Activity'),
			AdminColumn::text('agency')->setLabel('Agency'),
			AdminColumn::text('price')->setLabel('Price'),
			AdminColumn::text('persons')->setLabel('Persons'),
//			AdminColumn::text('min_age')->setLabel('Min age'),
			AdminColumn::datetime('available_start')->setLabel('Start')->setFormat('d/m/y'),
			AdminColumn::datetime('available_end')->setLabel('End')->setFormat('d/m/y'),
			AdminColumn::custom()->setLabel('Available')->setCallback(function ($instance) {
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
						AdminFormElement::time('start_time', 'Start time')
							->required(),
					], 3)
					->addColumn([
						AdminFormElement::date('available_end', 'End date')
							->setPickerFormat('d.m')
							->required(),
						AdminFormElement::time('end_time', 'End time')
							->required()
					], 3)
					->addColumn([
						AdminFormElement::text('price', 'Price')
							->required(),
						AdminFormElement::text('price_offer', 'Offer price')
							->required()
					], 3)
					->addColumn([
						AdminFormElement::text('break_start', 'Break start')
							->required(),
						AdminFormElement::text('break_close', 'Break close')
							->required()
					], 3),
				
				AdminFormElement::columns()
//					->addColumn([
//						AdminFormElement::number('min_age', 'Min age')
//							->required()
//					], 3)
					->addColumn([
						AdminFormElement::number('persons', 'Persons')
							->required()
					], 3),
//					->addColumn([
//						AdminFormElement::number('includes_count', 'Includes count')
//							->required()
//					], 3),
				AdminFormElement::checkbox('availability', 'Available'),
			]),
			'Includes'  => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('includes', 'Includes')->required()
			]),
//			'Restrictions' => new \SleepingOwl\Admin\Form\FormElements([
//				AdminFormElement::textarea('restrictions', 'Restrictions')
//			]),
			'Important' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('important', 'Important')->required()
			]),
//			'Carry'        => new \SleepingOwl\Admin\Form\FormElements([
//				AdminFormElement::textarea('carry', 'Carry')
//			])
		]);
		
		$form->addElement($tabs);
		
		return $form;
	});
	
})
	->addMenuPage(Offer::class, 2)
	->setIcon('fa fa-star');