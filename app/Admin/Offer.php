<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Offer;

AdminSection::registerModel(Offer::class, function (ModelConfiguration $model) {

//	$model->enableAccessCheck();

	$model->setTitle('Offers');

	$model->onDisplay(function () {
		$display = AdminDisplay::table()->setColumns([
			AdminColumn::text('id')->setLabel('#'),
			AdminColumn::text('name')->setLabel('Name'),
//			AdminColumn::datetime('available_start')->setLabel('Start')->setFormat('d.m.Y'),
//			AdminColumn::datetime('available_end')->setLabel('End')->setFormat('d.m.Y'),
//			AdminColumn::text('min_age')->setLabel('Min. age'),
//			AdminColumn::custom()->setLabel('Available')->setCallback(function ($instance) {
//				return $instance->availability ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
//			}),
//			AdminColumn::custom()->setLabel('Visible')->setCallback(function ($instance) {
//				return $instance->visibility ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
//			})
//            AdminColumn::text('short_description')->setLabel('Short description'),
//            AdminColumn::text('description')->setLabel('Description name'),
		]);
		$display->paginate(10);
		return $display;
	});

	$model->onCreateAndEdit(function () {
		$form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');

		$tabs = AdminDisplay::tabbed([
			'Activity' => new \SleepingOwl\Admin\Form\FormElements([
//				AdminFormElement::text('email', 'Email')->required(),
//				AdminFormElement::text('address', 'Address')->required(),
//				AdminFormElement::textarea('description', 'Description')->required(),

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
						AdminFormElement::timestamp('available_start', 'Start date')
							->setFormat('Y-m-d H:i:s')
							->required(),
						AdminFormElement::timestamp('available_end', 'End date')
							->setFormat('Y-m-d H:i:s')
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
					], 3)
					->addColumn([
						AdminFormElement::number('min_age', 'Min age')
							->required(),
						AdminFormElement::number('persons', 'Persons')
							->required()
					], 3),
				AdminFormElement::checkbox('availability', 'Available'),
//				AdminFormElement::columns()
//					->addColumn([
//						AdminFormElement::image('image', 'Image'),
//					], 4)
//					->addColumn([
//						AdminFormElement::image('image_thumb', 'Image thumb'),
//					], 4)
//					->addColumn([
//						AdminFormElement::image('image_icon', 'Image icon'),
//					], 4)
			]),
			'Includes' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('includes', 'Includes')->required()
			]),
			'Restrictions' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('restrictions', 'Restrictions')->required()
			]),
			'Important' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('important', 'Important')->required()
			]),
			'Carry' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('carry', 'Carry')->required()
			])
		]);

		$form->addElement($tabs);
		return $form;
	});

})
	->addMenuPage(Offer::class, 0)
	->setIcon('fa fa-star');