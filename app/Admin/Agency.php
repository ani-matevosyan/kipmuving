<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Agency;

AdminSection::registerModel(Agency::class, function (ModelConfiguration $model) {

//	$model->enableAccessCheck();

	$model->setTitle('Agencies');

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
	// Create And Edit
//	$model->onCreateAndEdit(function () {
//		$form = AdminForm::panel()->addBody(
//			AdminFormElement::text('name', 'Name')->required(),
//			AdminFormElement::text('subtitle', 'Subtitle')->required(),
//			AdminFormElement::textarea('short_description', 'Short description')->required(),
//			AdminFormElement::textarea('description', 'Description')->required(),
//			AdminFormElement::multiselect('styles', 'Styles')->setModelForOptions('App\ActivityStyle')->setDisplay('name'),
////			AdminFormElement::multiselect('images', 'Images')->setModelForOptions('App\ActivityImage')->setDisplay('image_url'),
//
//			AdminFormElement::columns()
//				->addColumn([
//					AdminFormElement::date('available_start', 'Start date')->required(),
//					AdminFormElement::date('available_end', 'End date')->required()
//				], 4)
//				->addColumn([
//					AdminFormElement::text('latitude', 'Latitude')->required(),
//					AdminFormElement::text('longitude', 'Longitude')->required()
//				], 4)
//				->addColumn([
//					AdminFormElement::number('min_age', 'Min age')->required()
//				], 4),
//
//			AdminFormElement::checkbox('availability', 'Available'),
//			AdminFormElement::checkbox('visibility', 'Visible'),
//
//			AdminFormElement::columns()
//				->addColumn([
//					AdminFormElement::image('image', 'Image')->required(),
//					AdminFormElement::upload('image', 'Image')
//				], 4)
//				->addColumn([
//					AdminFormElement::image('image_thumb', 'Image thumb')->required(),
//					AdminFormElement::upload('image_thumb', 'Image thumb')
//				], 4)
//				->addColumn([
//					AdminFormElement::image('image_icon', 'Image icon'),
//					AdminFormElement::upload('image_icon', 'Image icon')
//				], 4)
//		)->setHtmlAttribute('enctype', 'multipart/form-data');
//		return $form;
//	});

	$model->onCreateAndEdit(function () {
		$form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');

		$tabs = AdminDisplay::tabbed([
			'Activity' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::text('name', 'Agency name')->required(),
				AdminFormElement::text('email', 'Email')->required(),
				AdminFormElement::text('address', 'Address')->required(),
				AdminFormElement::textarea('description', 'Description')->required(),

				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::text('latitude', 'Latitude')->required()
					], 6)
					->addColumn([
						AdminFormElement::text('longitude', 'Longitude')->required()
					], 6),

				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::image('image', 'Image'),
					], 4)
					->addColumn([
						AdminFormElement::image('image_thumb', 'Image thumb'),
					], 4)
					->addColumn([
						AdminFormElement::image('image_icon', 'Image icon'),
					], 4)
			]),
			'Tripadvisor' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('tripadvisor_code', 'Tripadvisor code')->required()
			])
		]);

		$form->addElement($tabs);
		return $form;
	});

})
	->addMenuPage(Agency::class, 0)
	->setIcon('fa fa-university');