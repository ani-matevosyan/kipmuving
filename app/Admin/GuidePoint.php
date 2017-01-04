<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\GuidePoint;

AdminSection::registerModel(GuidePoint::class, function (ModelConfiguration $model) {

//	$model->enableAccessCheck();
	
	$model->setTitle('Guide points');
	
	$model->onDisplay(function () {
		$display = AdminDisplay::table()->setColumns([
			AdminColumn::text('id')->setLabel('#'),
			AdminColumn::text('point_id')->setLabel('Point ID'),
		]);
		$display->paginate(10);
		
		return $display;
	});
	
	$model->onCreateAndEdit(function () {
		$form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');
		
		$tabs = AdminDisplay::tabbed([
			'Point' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::text('point_id', 'Point ID')
					->required(),
				AdminFormElement::textarea('description', 'Description')->required(),
				AdminFormElement::textarea('real_tripadvisor_code', 'Tripadvisor code')->required(),

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
		]);
		
		$form->addElement($tabs);
		
		return $form;
	});
	
})
	->addMenuPage(GuidePoint::class, 5)
	->setIcon('fa fa-map-marker');