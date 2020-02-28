<?php

namespace App\Admin\Controllers;

use App\Models\Status;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StatusController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Status';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Status());

        $grid->column('id', __('Id')) -> sortable();
        // 设置动态内容宽度
        $grid->column('contents', '动态') -> width(300);
        $grid->column('user_id', '发布者名称') -> display(function(){
            return $this -> user() -> first() -> name;
        });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        // 禁止创建
        $grid -> disableCreateButton();
        // 筛选
        $grid -> filter(function($filter){
            $filter -> where(function($query){
                $query -> whereHas('User',function($query){
                    $query -> where('name','like',"%{$this -> input}%");
                });
            },'用户名称');
            $filter -> between('created_at', '发布时期') -> datetime();
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $status = Status::findOrFail($id);
        $status -> name = $status -> user() -> first() -> name;
        $show = new Show($status);

        $show->field('id', __('Id'));
        $show->field('contents', '动态');
        $show->field('name', '用户');
        $show->field('user_id', __('User id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Status());
        $form -> display('id', 'ID');
        $form->textarea('contents', '动态') -> required();
        // 分割线
        $form -> divider();
        // 接收参数
        $id = request() -> route('status');
        // 创建
        // 更新
        if($id){
            $form -> text('user.name', '用户') -> disable();
            $form-> text ('user_id', __('User id')) -> disable();
            $form -> text('created_at', '发布时间') -> disable();
        }

        return $form;
    }
}
