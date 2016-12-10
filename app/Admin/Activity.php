<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Activity;

AdminSection::registerModel(Activity::class, function (ModelConfiguration $model) {

	$model->enableAccessCheck();

	$model->setTitle('Activities');

	$model->onDisplay(function () {
		$display = AdminDisplay::table()->setColumns([
			AdminColumn::text('id')->setLabel('#'),
			AdminColumn::text('name')->setLabel('Name'),
			AdminColumn::datetime('available_start')->setLabel('Start')->setFormat('d.m.Y'),
			AdminColumn::datetime('available_end')->setLabel('End')->setFormat('d.m.Y'),
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
						AdminFormElement::date('available_start', 'Start date')->required(),
						AdminFormElement::date('available_end', 'End date')->required()
					], 4)
					->addColumn([
						AdminFormElement::text('latitude', 'Latitude')->required(),
						AdminFormElement::text('longitude', 'Longitude')->required()
					], 4)
					->addColumn([
						AdminFormElement::select('styles', 'Style')->required()->setOptions([
							'Trekking' => 'Trekking',
							'Rio' => 'Rio',
							'Aire' => 'Aire',
							'Relax' => 'Relax',
							'Familia' => 'Familia',
							'Nieve' => 'Nieve'
						]),
						AdminFormElement::number('min_age', 'Min age')->required()
					], 4),

				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::checkbox('availability', 'Available'),
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
				AdminFormElement::textarea('carry', 'Carry')->required()
			]),
			'Restrictions' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('restrictions', 'Restrictions')->required(),
			]),
			'Weather' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('weather_embed', 'Weather embed'),
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