<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Agency;

AdminSection::registerModel(Agency::class, function (ModelConfiguration $model) {

	$model->enableAccessCheck();

	$model->setTitle('Agencies');

	$model->onDisplay(function () {
		$display = AdminDisplay::datatables()->setColumns([
			AdminColumn::text('id')->setLabel('#'),
			AdminColumn::text('name')->setLabel('Name'),
			AdminColumn::text('address')->setLabel('Address'),
			AdminColumn::text('email')->setLabel('Email'),
		]);
		$display->paginate(10);
		return $display;
	});

	$model->onCreateAndEdit(function () {
		$form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');

		$tabs = AdminDisplay::tabbed([
			'Agency' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::text('name', 'Agency name')->required(),
				AdminFormElement::text('email', 'Email')->required(),
				AdminFormElement::text('address', 'Address')->required(),
				AdminFormElement::textarea('description', 'Description')->required(),

				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::text('latitude', 'Latitude')->required()
					], 4)
					->addColumn([
						AdminFormElement::text('longitude', 'Longitude')->required()
					], 4)
					->addColumn([
						AdminFormElement::text('instagram_id', 'Instagram user ID'),
					], 4),
				
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
				AdminFormElement::textarea('tripadvisor_code', 'Tripadvisor code')
			])
		]);

		$form->addElement($tabs);
		return $form;
	});

})
	->addMenuPage(Agency::class, 1)
	->setIcon('fa fa-university');