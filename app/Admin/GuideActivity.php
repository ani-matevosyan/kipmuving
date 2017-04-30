<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\GuideActivity;

AdminSection::registerModel(GuideActivity::class, function (ModelConfiguration $model) {

//	$model->enableAccessCheck();
	
	$model->setTitle('Guide activities');
	
	$model->onDisplay(function () {
		$display = AdminDisplay::datatables()->setColumns([
			AdminColumn::text('id', '#'),
			AdminColumn::text('name', 'Name'),
		]);
		$display->paginate(10);
		
		return $display;
	});
	
	$model->onCreateAndEdit(function () {
		$form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');
		
		$tabs = AdminDisplay::tabbed([
			'Guide activity' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::text('name', 'Name')->required()
					], 6)
					->addColumn([
						AdminFormElement::select('category', 'Category')->required()->setOptions([
							'Visual'    => 'Visual',
							'Caminatas' => 'Caminatas',
							'Termas'    => 'Termas'
						])
					], 6),
				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::text('instagram_id', 'Instagram')->required()
					], 4)
					->addColumn([
						AdminFormElement::text('latitude', 'Latitude')->required()
					], 4)
					->addColumn([
						AdminFormElement::text('longitude', 'Longitude')->required()
					], 4),
				AdminFormElement::text('short_description', 'Short description')->required(),
				AdminFormElement::textarea('description', 'Description')->required(),
				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::textarea('real_time_ranges', 'Time')->required(),
					], 8)
					->addColumn([
						AdminFormElement::image('image', 'Image'),
					], 4),
			]),
			'Tripadvisor'    => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('tripadvisor_code', 'Tripadvisor code')->required(),
			]),
			'Bus data'       => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::text('real_bus_est_time', 'Est. time (in minutes)'),
					], 4)
					->addColumn([
						AdminFormElement::text('bus_est_expenditure', 'Est. expenditure (per person)'),
					], 4)
					->addColumn([
						AdminFormElement::text('bus_est_service', 'Est. service (per person)'),
					], 4),
				AdminFormElement::textarea('bus_description', 'Description'),
			])
		]);
		
		$form->addElement($tabs);
		
		return $form;
	});
	
})
	->addMenuPage(GuideActivity::class, 5)
	->setIcon('fa fa-map-marker');