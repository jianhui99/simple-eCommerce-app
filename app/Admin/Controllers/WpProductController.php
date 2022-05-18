<?php

namespace App\Admin\Controllers;

use App\Models\WpProduct;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Extensions\Tools\SyncWpProducts;

class WpProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WpProduct());

        $grid->column('id', __('Id'));
        $grid->column('wp_product_id', __('Product Id'));
        $grid->column('product_name', __('Product name'));
        $grid->column('images', __('Image'))->display(function ($imgs){
            return $imgs;
        });
        $grid->column('sku', __('Sku'))->display(function ($sku){
            return empty($sku) ? '-' : $sku;
        });
        $grid->column('regular_price', __('Regular price'));
        $grid->column('in_stock', __('In stock'))->using([1=>'In stock', 0=>'Out of stock']);
        $grid->column('status', __('Status'))->using([1=>'Active', 0=>'Inactive']);
        $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));

        $grid->disableFilter();
        // $grid->disableActions();
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->disableExport();

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
            $actions->disableDelete();
        });

        $grid->tools(function ($tools) {
            $tools->append(new SyncWpProducts());
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
        $show = new Show(WpProduct::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('wp_product_id', __('Wp product id'));
        $show->field('product_name', __('Product name'));
        $show->field('sku', __('Sku'));
        $show->field('regular_price', __('Regular price'));
        $show->field('in_stock', __('In stock'));
        $show->field('status', __('Status'))->using([1=>'Active', 0=>'Inactive']);
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
        $form = new Form(new WpProduct());

        $form->display('wp_product_id', __('Wp product id'));
        $form->text('product_name', __('Product name'));
        $form->textarea('description', __('Description'));
        $form->text('sku', __('Sku'));
        $form->decimal('regular_price', __('Regular price'));
        $form->switch('in_stock', __('In stock'));
        $form->switch('status', __('Status'))->default(1);

        return $form;
    }

    public function sync_wp_products(){
        $wpProducts = new WpProduct();

        $url = config('admin.wordpress.products.url');

        $rs = ['status' => 1, 'msg' => ''];

        try{
            $list = $wpProducts::call_wp_products($url);
            $wpProducts->insert_wp_products_record($list);

            /* WpPosts has set exec time and memory limit for retrieve WP stuff. */
            ini_set('max_execution_time', 60); 
            ini_set('memory_limit', '512M');
        }catch(\Exception $e){
            $rs['status'] = 0;
            $rs['msg'] = $e->getMessage();
        }

        return $rs;
    }
}
