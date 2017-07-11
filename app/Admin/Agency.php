<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Agency;

AdminSection::registerModel(Agency::class, function (ModelConfiguration $model) {
	
	$model->enableAccessCheck();
	
	$model->setTitle('Agencies');
	
	$model->onDisplay(function () {
		$display = AdminDisplay::datatables()->setColumns([
			$icon = AdminColumn::image('image_icon', 'Icon')
				->setHtmlAttribute('class', 'hidden-sm hidden-xs')
				->setWidth('50px')
				->setOrderable(false),
			AdminColumn::text('region', 'Region')
				->setHtmlAttribute('class', 'text-center')
				->append(
					AdminColumn::filter('region')
				),
			$id = AdminColumn::text('id', '#')
				->setHtmlAttribute('class', 'text-center'),
			$name = AdminColumn::text('name', 'Name')
				->setHtmlAttribute('class', 'text-center'),
			$address = AdminColumn::text('address', 'Address')
				->setHtmlAttribute('class', 'text-center'),
			$email = AdminColumn::email('email', 'Email')
				->setHtmlAttribute('class', 'text-center'),
		]);
		
		$icon->getHeader()->setHtmlAttribute('class', 'text-center');
		$id->getHeader()->setHtmlAttribute('class', 'text-center');
		$name->getHeader()->setHtmlAttribute('class', 'text-center');
		$address->getHeader()->setHtmlAttribute('class', 'text-center');
		$email->getHeader()->setHtmlAttribute('class', 'text-center');
		
		$display->setOrder([[1, 'asc']]);
		
		$display->setFilters(
			AdminDisplayFilter::related('region')
		);
		
		$display->paginate(10);
		
		return $display;
	});
	
	$model->onCreateAndEdit(function () {
		$form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');
		
		$tabs = AdminDisplay::tabbed([
			'Agency'      => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::text('name', 'Agency name')->required(),
						AdminFormElement::text('email', 'Email')->required()
					], 4)
					->addColumn([
						AdminFormElement::text('contact', 'Contact')->required(),
						AdminFormElement::text('address', 'Address')->required()
					], 4)
					->addColumn([
						AdminFormElement::text('whatsapp', 'Whatsapp')->required(),
						AdminFormElement::select('region', 'REGION')->setOptions([
							'pucon' => 'Pucon',
							'atacama' => 'Atacama'
						])->required()
					], 4),
				AdminFormElement::textarea('description', 'Description')->required(),
				
				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::text('latitude', 'Latitude')->required(),
						AdminFormElement::text('longitude', 'Longitude')->required()
					], 6)
					->addColumn([
						AdminFormElement::text('instagram_id', 'Instagram user ID'),
						AdminFormElement::text('instagram_name', 'Instagram user nickname'),
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
				AdminFormElement::textarea('real_tripadvisor_code', 'Tripadvisor code')
			])
		]);
		
		$form->addElement($tabs);
		
		return $form;
	});
	
});