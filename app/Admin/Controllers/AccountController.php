<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Account;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class AccountController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Account(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('username');
            // $grid->column('password');
            $grid->column('status')->display(function($status) {
                if($status){
                    return '正常';
                }else{
                    return '冻结';
                }
            });
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Account(), function (Show $show) {
            $show->field('id');
            $show->field('username');
            $show->field('password');
            $show->field('status')->as(function ($status) {
                if($status){
                    return '正常';
                }else{
                    return '冻结';
                }
            });
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Account(), function (Form $form) {
            $form->display('id');
            $form->text('username');

            if ($form->isCreating()) {
                $form->text('password');
            }

            $status = [
                0 => '冻结',
                1 => '正常',
            ];

            $form->select('status', '状态')->options($status)->default(1);
        
            $form->display('created_at');
            $form->display('updated_at');

            if ($form->isCreating()) {
                $form->password = md5($form->password);
            }
        });
    }
}
