<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Offer;

AdminSection::registerModel(Offer::class, function (ModelConfiguration $model) {
	
	$model->enableAccessCheck();
	
	$model->setTitle('Offers');
	
	$model->onDisplay(function () {
		$display = AdminDisplay::datatables()->setColumns([
			$id = AdminColumn::text('id', '#')
				->setHtmlAttribute('class', 'text-center'),
			$activity_name = AdminColumn::relatedLink('activity.name', 'Activity')
				->setHtmlAttribute('class', 'text-center'),
			$agency_name = AdminColumn::relatedLink('agency.name', 'Agency')
				->setHtmlAttribute('class', 'text-center'),
			$price = AdminColumn::text('real_price', 'Price')
				->setHtmlAttribute('class', 'text-center'),
			$date_start = AdminColumn::datetime('available_start', 'Start')
				->setFormat('d/m')
				->setHtmlAttribute('class', 'text-center'),
			$date_end = AdminColumn::datetime('available_end', 'End')
				->setFormat('d/m')
				->setHtmlAttribute('class', 'text-center'),
			$availability = AdminColumn::custom('Available')
				->setHtmlAttribute('class', 'text-center')
				->setCallback(function ($instance) {
					return $instance->availability ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
				})
		]);
		
		$id->getHeader()->setHtmlAttribute('class', 'text-center');
		$activity_name->getHeader()->setHtmlAttribute('class', 'text-center');
		$agency_name->getHeader()->setHtmlAttribute('class', 'text-center');
		$price->getHeader()->setHtmlAttribute('class', 'text-center');
		$date_start->getHeader()->setHtmlAttribute('class', 'text-center');
		$date_end->getHeader()->setHtmlAttribute('class', 'text-center');
		$availability->getHeader()->setHtmlAttribute('class', 'text-center');
		
		$display->paginate(10);
		
		return $display;
	});
	
	$model->onCreate(function () {
		$warning_time = '<div class="alert bg-warning text-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><small><strong>For example:</strong><br>09:00-14:00;<br>10:00-15:00<br><strong>In the last element you don\'t need ";"</strong></small></div>';
		$warning_includes = '<div class="alert bg-warning text-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><small><strong>For example:</strong><br>Transporte ida y vuelta;<br>Guieda Profesional;<br><strong>In the last element you don\'t need ";"</strong></small></div>';

        $maxId = Offer::max('id');
        $data = [
            'offerMaxId' => $maxId,
        ];
		$form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');
		
		$tabs = AdminDisplay::tabbed([
			'Offer'     => new \SleepingOwl\Admin\Form\FormElements([
				
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
				AdminFormElement::textarea('description', 'Description'),
				AdminFormElement::text('cancellation_rules', 'Cancellation rules')
					->required(),
				
				AdminFormElement::columns()
					->addColumn([
                        AdminFormElement::text('real_price', 'Standard Price')
                            ->required(),
					], 3)
                    ->addColumn([
                        AdminFormElement::html('<h4 class="offer-days">Offer days</h4>')
                    ], 12)
                    ->addColumn([
                        AdminFormElement::view('site.admin.offer_days', $data)
                    ], 10)
					->addColumn([
                        AdminFormElement::text('break_start', 'Break start')
                            ->required(),
                        AdminFormElement::text('break_close', 'Break close')
                            ->required()
					], 2)
                    ->addColumn([
                        AdminFormElement::html('<br>'),
                        AdminFormElement::checkbox('availability', 'Available'),
                    ], 12),
			]),
			'Time'      => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::html($warning_time),
				AdminFormElement::textarea('real_available_time', 'Time')->required()
			]),
			'Includes'  => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::html($warning_includes),
				AdminFormElement::textarea('real_includes', 'Includes')->required()
			]),
			'Important' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('important', 'Important')->required()
			]),
		]);
		
		$form->addElement($tabs);
		
		return $form;
	});

    $model->onEdit(function ($id) {
        $warning_time = '<div class="alert bg-warning text-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><small><strong>For example:</strong><br>09:00-14:00;<br>10:00-15:00<br><strong>In the last element you don\'t need ";"</strong></small></div>';
        $warning_includes = '<div class="alert bg-warning text-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><small><strong>For example:</strong><br>Transporte ida y vuelta;<br>Guieda Profesional;<br><strong>In the last element you don\'t need ";"</strong></small></div>';


        $offer = Offer::find($id);
        $form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');

        $days = AdminSection::getModel(\App\OfferDay::class)->fireDisplay();
        $days->getScopes()->push(['withOffer', $id]);
        $days->setParameter('offer_id', $id);

        $tabs = AdminDisplay::tabbed([
            'Offer'     => new \SleepingOwl\Admin\Form\FormElements([

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
                AdminFormElement::textarea('description', 'Description'),
                AdminFormElement::text('cancellation_rules', 'Cancellation rules')
                    ->required(),
                AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::text('real_price', 'Standard Price')
                            ->required(),
                    ], 3)
                    ->addColumn([
                        AdminFormElement::text('break_start', 'Break start')
                            ->required(),
                    ], 3)
                    ->addColumn([
                        AdminFormElement::text('break_close', 'Break close')
                            ->required()
                    ], 3)
                    ->addColumn([
                        AdminFormElement::html('<br>'),
                        AdminFormElement::checkbox('availability', 'Available'),
                    ], 3),
                AdminFormElement::html('<h4>Offer days</h4>'),
                $days
            ]),
            'Time'      => new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::html($warning_time),
                AdminFormElement::textarea('real_available_time', 'Time')->required()
            ]),
            'Includes'  => new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::html($warning_includes),
                AdminFormElement::textarea('real_includes', 'Includes')->required()
            ]),
            'Important' => new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::textarea('important', 'Important')->required()
            ]),
        ]);

        $form->addElement($tabs);

        return $form;
    });


});