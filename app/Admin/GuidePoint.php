<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\GuidePoint;

AdminSection::registerModel(GuidePoint::class, function (ModelConfiguration $model) {

	$model->enableAccessCheck();

	$model->setTitle('Guide points');

	$model->onDisplay(function () {
		$display = AdminDisplay::datatables()->setColumns([
			AdminColumn::text('id')->setLabel('#'),
//			AdminColumn::text('name')->setLabel('Name'),
//			AdminColumn::text('address')->setLabel('Address'),
//			AdminColumn::text('email')->setLabel('Email'),
		]);
		$display->paginate(10);
		return $display;
	});

	$model->onCreateAndEdit(function () {
		$form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');

		$tabs = AdminDisplay::tabbed([
			'Guide Point' => new \SleepingOwl\Admin\Form\FormElements([
//				AdminFormElement::columns()
//					->addColumn([
//						AdminFormElement::text('name', 'Agency name')->required()
//					], 4)
//					->addColumn([
//						AdminFormElement::text('email', 'Email')->required()
//					], 4)
//					->addColumn([
//						AdminFormElement::text('address', 'Address')->required()
//					], 4),
				AdminFormElement::text('point_id', 'Point ID')->required(),
				AdminFormElement::textarea('tripadvisor_code', 'Tripadvisorrrr code')

//				AdminFormElement::columns()
//					->addColumn([
//						AdminFormElement::text('latitude', 'Latitude')->required(),
//						AdminFormElement::text('longitude', 'Longitude')->required()
//					], 6)
//					->addColumn([
//						AdminFormElement::text('instagram_id', 'Instagram user ID'),
//						AdminFormElement::text('instagram_name', 'Instagram user nickname'),
//					], 6),
//
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
//			'Tripadvisor' => new \SleepingOwl\Admin\Form\FormElements([
//				AdminFormElement::textarea('real_tripadvisor_code', 'Tripadvisor code')
//			])
		]);

		$form->addElement($tabs);
		return $form;
	});

})
	->addMenuPage(GuidePoint::class, 5)
	->setIcon('fa fa-university');