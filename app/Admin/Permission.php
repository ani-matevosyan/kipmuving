<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Permission;

AdminSection::registerModel(Permission::class, function (ModelConfiguration $model) {

    $model->enableAccessCheck();

    $model->setTitle('Permissions');

    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::text('name')->setLabel('Name'),
            AdminColumn::text('display_name')->setLabel('Display name'),
            AdminColumn::text('description')->setLabel('Description name'),
        ]);
        $display->paginate(10);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Name')->required(),
            AdminFormElement::text('display_name', 'Display name')->required(),
            AdminFormElement::textarea('description', 'Description name')
        );
        return $form;
    });

})
    ->addMenuPage(Permission::class, 1)
    ->setIcon('fa fa-key');