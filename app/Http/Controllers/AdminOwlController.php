<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Validation\ValidationException;
use SleepingOwl\Admin\Contracts\AdminInterface;
use SleepingOwl\Admin\Model\ModelConfiguration;
use Illuminate\Contracts\Foundation\Application;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\ModelConfigurationInterface;
use SleepingOwl\Admin\Contracts\Display\ColumnEditableInterface;

class AdminOwlController extends \SleepingOwl\Admin\Http\Controllers\AdminController
{


    /**
     * @param ModelConfigurationInterface $model
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function getCreate(ModelConfigurationInterface $model)
    {
        dd(10);
        if (! $model->isCreatable()) {
            abort(404);
        }

        $create = $model->fireCreate();

        return $this->render($model, $create, $model->getCreateTitle());
    }
    /**
     * @param ModelConfigurationInterface $model
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postStore(ModelConfigurationInterface $model, Request $request)
    {
        dd(11);
        if (! $model->isCreatable()) {
            abort(404);
        }

        $createForm = $model->fireCreate();
        $nextAction = $request->input('next_action');

        $backUrl = $this->getBackUrl($request);

        if ($createForm instanceof FormInterface) {
            try {
                $createForm->validateForm($request, $model);

                if ($createForm->saveForm($request, $model) === false) {
                    return redirect()->back()->with([
                        '_redirectBack' => $backUrl,
                    ]);
                }
            } catch (ValidationException $exception) {
                return redirect()->back()
                    ->withErrors($exception->validator)
                    ->withInput()
                    ->with([
                        '_redirectBack' => $backUrl,
                    ]);
            }
        }

        if ($nextAction == 'save_and_continue') {
            $newModel = $createForm->getModel();
            $primaryKey = $newModel->getKeyName();

            $redirectUrl = $model->getEditUrl($newModel->{$primaryKey});
            $redirectPolicy = $model->getRedirect();

            /* Make redirect when use in model config && Fix editable redirect */
            if ($redirectPolicy->get('create') == 'display' || ! $model->isEditable($newModel)) {
                $redirectUrl = $model->getDisplayUrl();
            }

            $response = redirect()->to(
                $redirectUrl
            )->with([
                '_redirectBack' => $backUrl,
            ]);
        } elseif ($nextAction == 'save_and_create') {
            $response = redirect()->to($model->getCreateUrl($request->except([
                '_redirectBack',
                '_token',
                'url',
                'next_action',
            ])))->with([
                '_redirectBack' => $backUrl,
            ]);
        } else {
            $response = redirect()->to($request->input('_redirectBack', $model->getDisplayUrl()));
        }

        return $response->with('success_message', $model->getMessageOnCreate());
    }


    /**
     * @param ModelConfigurationInterface $model
     * @param Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function postUpdate(ModelConfigurationInterface $model, Request $request, $id)
    {
        dd(222);
        /** @var FormInterface $editForm */
        $editForm = $model->fireEdit($id);
        $item = $editForm->getModel();

        if (is_null($item) || ! $model->isEditable($item)) {
            abort(404);
        }

        $nextAction = $request->input('next_action');

        $backUrl = $this->getBackUrl($request);

        if ($editForm instanceof FormInterface) {
            try {
                $editForm->validateForm($request, $model);

                if ($editForm->saveForm($request, $model) === false) {
                    return redirect()->back()->with([
                        '_redirectBack' => $backUrl,
                    ]);
                }
            } catch (ValidationException $exception) {
                return redirect()->back()
                    ->withErrors($exception->validator)
                    ->withInput()
                    ->with([
                        '_redirectBack' => $backUrl,
                    ]);
            }
        }

        $redirectPolicy = $model->getRedirect();

        if ($nextAction == 'save_and_continue') {
            $response = redirect()->back()->with([
                '_redirectBack' => $backUrl,
            ]);

            if ($redirectPolicy->get('edit') == 'display') {
                $response = redirect()->to(
                    $model->getDisplayUrl()
                )->with([
                    '_redirectBack' => $backUrl,
                ]);
            }
        } elseif ($nextAction == 'save_and_create') {
            $response = redirect()->to($model->getCreateUrl($request->except([
                '_redirectBack',
                '_token',
                'url',
                'next_action',
            ])))->with([
                '_redirectBack' => $backUrl,
            ]);
        } else {
            $response = redirect()->to($request->input('_redirectBack', $model->getDisplayUrl()));
        }

        return $response->with('success_message', $model->getMessageOnUpdate());
    }


}
