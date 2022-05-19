<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->column('id', __('Order ID'));
        $grid->column('user_id', __('Customer'))->display(function ($uid){
            return User::where('id', $uid)->pluck('name')->first();
        });
        $grid->column('order_status', __('Status'))->display(function ($status){
            return Order::$code_to_status[$status];
        });
        $grid->column('total', __('Total'))->display(function ($t){
            $items = Order::where('id', $this->id)->get();
            $totalPrice = 0;
            foreach($items as $item){
                foreach($item->order_product_list as $list){
                    $totalPrice += $list['product_info']->regular_price * $list['qty'];
                }
            }

            return 'RM'.$totalPrice;
        });
        $grid->column('created_at', __('Created at'));

        $grid->filter(function($filter){
            $filter->like('user_id', 'Customer ID');
            $filter->equal('order_status', 'Order Status')->select(Order::$code_to_status);
            $filter->between('created_at', 'Created at')->date();
        });

        $grid->disableCreateButton();

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
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('order_status', __('Order status'));
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
        $form = new Form(new Order());
        $user = User::pluck('name', 'id');
        $url = url()->current();
        $temp = explode("/", $url);
        $pos = count($temp)-2;
        $id = $temp[$pos];
        $items = Order::where('id', $id)->get();
        $totalPrice = 0;
        foreach($items as $item){
            foreach($item->order_product_list as $list){
                $totalPrice += $list['product_info']->regular_price * $list['qty'];
            }
        }
        $form->display('id', __('Order ID'));
        $form->display('user_id', __('Customer'))->with(function ($uid) {
            return User::where('id', $uid)->pluck('name')->first();
        });
        $form->display('total', __('Total(RM)'))->default($totalPrice);
        $form->select('order_status', __('Order status'))->options(Order::$code_to_status);

        return $form;
    }
}
