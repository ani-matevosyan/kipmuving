<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\SuggestionDayActivity;

AdminSection::registerModel(SuggestionDayActivity::class, function (ModelConfiguration $model) {
	$model->setTitle('Suggestion day activities');

	$model->onDisplay(function () {
		$display = AdminDisplay::datatables();

		$display->setColumns([
			AdminColumn::text('order_', 'Order')
				->setWidth(100)
				->setOrderable(false),
			AdminColumn::text('activity_type', 'Type')
				->setWidth(100)
				->setOrderable(false),
			AdminColumn::text('activity.name', 'Name'),
		]);

		$display->setOrder([[0, 'asc']]);

		return $display;
	});

	$model->onCreate(function () {
		$form = AdminForm::panel();

		$tabs = AdminDisplay::tabbed([
			'Suggestion Day Activity' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::text('order_', 'Order')->required(),
					], 3)
					->addColumn([
						AdminFormElement::select('activity_type', 'Activity type')
							->required()
							->setOptions([
								'paid' => 'Paid',
								'free' => 'Free',
							]),
						AdminFormElement::hidden('suggestion_day_id')
							->setDefaultValue(request()['suggestion_day_id'])
					], 3)
			]),
		]);

		$form->addElement($tabs);

		return $form;
	});

	$model->onEdit(function ($id) {
		$form = AdminForm::panel();

		$suggestion_day_activity = SuggestionDayActivity::find($id);

		if ($suggestion_day_activity) {
			if ($suggestion_day_activity->activity_type == 'paid') {
				$select = AdminFormElement::select('activity_id', 'Paid activity')
					->setModelForOptions('App\Activity')
                    ->setLoadOptionsQueryPreparer(function($element, $query) use($suggestion_day_activity) {
                        return $query->where('region', $suggestion_day_activity->suggestionDay->suggestion->region);
                     })
					->setDisplay('name');
			} elseif ($suggestion_day_activity->activity_type == 'free') {
				$select = AdminFormElement::select('activity_id', 'Free activity')
					->setModelForOptions('App\FreeActivity')
                    ->setLoadOptionsQueryPreparer(function($element, $query) use ($suggestion_day_activity) {
                        return $query->where('region', $suggestion_day_activity->suggestionDay->suggestion->region);
                    })
					->setDisplay('name');
			}
		}

		$tabs = AdminDisplay::tabbed([
			'Suggestion Day Activity' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::text('order_', 'Order')->required(),
					], 3)
					->addColumn([
						AdminFormElement::select('activity_type', 'Activity type')
							->required()
							->setOptions([
								'paid' => 'Paid',
								'free' => 'Free',
							]),
					], 3)
					->addColumn([
						$select,
					], 6),
			]),
		]);

		$form->addElement($tabs);

		return $form;
	});

});