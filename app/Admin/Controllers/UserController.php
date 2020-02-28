<?php

namespace App\Admin\Controllers;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use Encore\Admin\Widgets\Table;
use App\Models\Status;
use Encore\Admin\Layout\Content;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id')) -> sortable();
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('email_verified_at', __('Email verified at'));
        // $grid->column('password', __('Password')); # 不显示密码
        // $grid->column('remember_token', __('Remember token')); # 不显示 token
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        // ZJY 增加按钮 查看关注、查看粉丝、查看动态 2020年2月27日13:47:39 开始
        $grid -> column('user_data', '用户数据') -> display(function(){
            $fans_count = $this -> fans() -> count();
            $focus_count = $this -> focus() -> count();
            $status_count = $this -> statuses() -> count();
            $fans_url = url("admin/users/fans/{$this -> id}");
            $focus_url = url("admin/users/focus/{$this -> id}");
            $status_url = url("admin/users/statuses/{$this -> id}");
            return <<<EOF
                <div>粉丝：<a href='{$fans_url}'>{$fans_count}</a></div>
                <div>关注：<a href='{$focus_url}'>{$focus_count}</a></div>
                <div>动态：<a href='{$status_url}'>{$status_count}</a></div>
EOF;
        });
        // ZJY 增加按钮 查看关注、查看粉丝、查看动态 2020年2月27日13:47:39 结束
        // 禁用删除 单个删除、批量删除 都要禁用 开始
        $grid -> actions(function($actions){
            $actions -> disableDelete();
        });
        $grid -> tools(function($tools){
            $tools -> batch(function($batch){
                $batch -> disableDelete();
            });
        });
        // 禁用删除 结束
        // 添加查询 开始
        $grid -> filter(function($filter){
            $filter -> like('name', '用户名称');
            $filter -> between('created_at','注册日期') -> datetime();
        });
        // 添加查询 结束
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        // $show->field('remember_token', __('Remember token'));
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
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'));
        // $form->text('remember_token', __('Remember token'));

        return $form;
    }
    // 当前用户动态
    public function statuses(Content $content,$user_id)
    {
        $user = User::find($user_id);
        // 页面标题
        $content -> header("{$user -> name} 的动态");
        // 添加面包屑
        $content -> breadcrumb(
            ['text' => '用户管理', 'url' => '/users'],
            ['text' => '用户粉丝']
        );
        $statuses = $user -> statuses()  -> orderBy('id','desc') -> paginate(15);
        $content -> view('admin/user/statuses',['data' => $statuses]);
        return $content;
    }
    // 当前用户关注
    public function focus(Content $content,$user_id)
    {
        $user = User::find($user_id);
        $content -> header("{$user -> name} 的关注");
        $content -> breadcrumb(
            ['text' => '用户管理','url' => '/users'],
            ['text' => '用户关注']
        );
        $data = $user -> focus() -> orderBy('id','desc') -> paginate(15);
        $content -> view('admin/user/follower',compact('data'));
        return $content;
    }
    // 当前用户粉丝
    public function fans(Content $content, $user_id)
    {
        $user = User::find($user_id);
        $content -> header("{$user -> name} 的粉丝");
        $content -> breadcrumb(
            ['text' => '用户管理', 'url' => '/users'],
            ['text' => '用户粉丝']
        );
        $data = $user -> fans() -> orderBy('id', 'desc') -> paginate(15);
        $content -> view('admin/user/follower',compact('data'));
        return $content;
    }
}
