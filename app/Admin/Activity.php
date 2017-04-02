<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Activity;

AdminSection::registerModel(Activity::class, function (ModelConfiguration $model) {

	$model->enableAccessCheck();

	$model->setTitle('Activities');

	$model->onDisplay(function () {
		$display = AdminDisplay::datatables()->setColumns([
			AdminColumn::text('id')->setLabel('#'),
			AdminColumn::text('name')->setLabel('Name'),
//			AdminColumn::datetime('available_start')->setLabel('Start')->setFormat('d/m/y'),
//			AdminColumn::datetime('available_end')->setLabel('End')->setFormat('d/m/y'),
			AdminColumn::text('min_age')->setLabel('Min. age'),
			AdminColumn::custom()->setLabel('Available')->setCallback(function ($instance) {
				return $instance->availability ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
			}),
			AdminColumn::custom()->setLabel('Visible')->setCallback(function ($instance) {
				return $instance->visibility ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
			})
		]);
		$display->paginate(10);
		return $display;
	});

	$model->onCreateAndEdit(function () {
		$form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');

		$tabs = AdminDisplay::tabbed([
			'Activity' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::text('name', 'Name')->required(),
				AdminFormElement::text('subtitle', 'Subtitle')->required(),
				AdminFormElement::textarea('short_description', 'Short description')->required(),
				AdminFormElement::textarea('description', 'Description')->required(),

				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::text('latitude', 'Latitude')->required(),
						AdminFormElement::select('styles', 'Style')->required()->setOptions([
							'Trekking' => 'Trekking',
							'Rio' => 'Rio',
							'Aire' => 'Aire',
							'Relax' => 'Relax',
							'Familia' => 'Familia',
							'Nieve' => 'Nieve'
						]),
					], 4)
					->addColumn([
						AdminFormElement::text('longitude', 'Longitude')->required(),
						AdminFormElement::text('instagram_name', 'Instagram')
					], 4)
					->addColumn([
						AdminFormElement::number('min_age', 'Min age')->required()
					], 4),

				AdminFormElement::columns()
					->addColumn([
//						AdminFormElement::checkbox('availability', 'Available'),
						AdminFormElement::checkbox('visibility', 'Visible')
					], 4)
					->addColumn([
						AdminFormElement::checkbox('available_day', 'Available on day'),
						AdminFormElement::checkbox('available_night', 'Available on night'),
					], 4)
					->addColumn([
						AdminFormElement::checkbox('available_high', 'Available from March to November'),
						AdminFormElement::checkbox('available_low', 'Available from December to March'),
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
			'Carry' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('real_carries', 'Carry')->required()
			]),
			'Restrictions' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('real_restrictions', 'Restrictions')->required(),
			]),
			'Weather' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('weather_embed', 'Weather embed'),
			]),
			'Tripadvisor' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('real_tripadvisor_code', 'Tripadvisor code'),
			]),
			'Gallery' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::images('images', 'Images'),
			])
		]);

		$form->addElement($tabs);
		return $form;
	});

})
	->addMenuPage(Activity::class, 0)
	->setIcon('fa fa-tree');