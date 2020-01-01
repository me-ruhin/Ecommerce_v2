<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_banner', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image', 255)->nullable();
            $table->string('url', 100)->nullable();
            $table->string('target', 50)->nullable();
            $table->text('html')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('sort')->default(0);
            $table->tinyInteger('click')->default(0);
            $table->tinyInteger('type')->default(0);
            $table->timestamps();
        });

        Schema::create('admin_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group', 50)->nullable();
            $table->string('code', 50)->index();
            $table->string('key', 50)->unique();
            $table->string('value', 200)->nullable();
            $table->string('store_id', 200)->default(1);
            $table->tinyInteger('sort')->default(0);
            $table->string('detail', 300)->nullable();

        });

        Schema::create('admin_store', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo', 255)->nullable();
            $table->tinyInteger('site_status')->default(1);
            $table->string('phone', 20)->nullable();
            $table->string('long_phone', 100)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('time_active', 200);
            $table->string('address', 300);
            $table->string('template', 100)->nullable();
        });

        Schema::create('admin_store_description', function (Blueprint $table) {
            $table->integer('config_id');
            $table->string('lang', 10)->index();
            $table->string('title', 300)->nullable();
            $table->string('description', 300)->nullable();
            $table->string('keyword', 300)->nullable();
            $table->text('maintain_content')->nullable();
            $table->primary(['config_id', 'lang']);
        });

        Schema::create('shop_email_template', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('group', 50);
            $table->text('text');
            $table->tinyInteger('status')->default(0);
        });

        Schema::create('shop_language', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('code', 50)->unique();
            $table->string('icon', 100)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('sort')->default(0);
        });

        Schema::create('shop_block_content', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('position', 100);
            $table->string('page', 200)->nullable();
            $table->string('type', 200);
            $table->text('text')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('sort')->default(0);
        });

        Schema::create('shop_layout_page', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 100)->unique();
            $table->string('name', 100);
        });

        Schema::create('shop_layout_position', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 100)->unique();
            $table->string('name', 100);
        });

        Schema::create('shop_layout_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 100)->unique();
            $table->string('name', 100);
        });

        Schema::create('shop_link', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('url', 100);
            $table->string('target', 100);
            $table->string('group', 100);
            $table->string('module', 100)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('sort')->default(0);
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email', 150);
            $table->string('token', 255);
            $table->dateTime('created_at');
            $table->index('email');
        });

        Schema::create('shipping_standard', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fee');
            $table->integer('shipping_free');
        });

        Schema::create('shop_api', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->unique();
            $table->string('hidden_default', 255)->nullable();
            $table->string('type', 50);
        });
        Schema::create('shop_api_process', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('api_id');
            $table->string('secret_key', 100)->unique();
            $table->string('hidden_fileds', 255)->nullable();
            $table->string('ip_allow', 300)->nullable();
            $table->string('ip_deny', 300)->nullable();
            $table->dateTime('exp')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });

        Schema::create('shop_brand', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('alias', 120)->unique();
            $table->string('image', 255)->nullable();
            $table->string('url', 100)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('sort')->default(0);
        });

        Schema::create('shop_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image', 255)->nullable();
            $table->string('alias', 120)->unique();
            $table->integer('parent')->default(0);
            $table->integer('top')->nullable()->default(0);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('sort')->default(0);
        });

        Schema::create('shop_category_description', function (Blueprint $table) {
            $table->integer('category_id');
            $table->string('lang', 10)->index();
            $table->string('name', 100)->nullable();
            $table->string('keyword', 300)->nullable();
            $table->string('description', 500)->nullable();
            $table->primary(['category_id', 'lang']);
        });

        Schema::create('shop_currency', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('code', 10)->unique();
            $table->string('symbol', 10);
            $table->float('exchange_rate');
            $table->tinyInteger('precision')->default(2);
            $table->tinyInteger('symbol_first')->default(0);
            $table->string('thousands')->default(',');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('sort')->default(0);
        });

        Schema::create('shop_discount', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 50)->unique();
            $table->integer('reward')->default(2);
            $table->string('type', 10)->default('point')->comment('point - Point; percent - %');
            $table->string('data', 300)->nullable();
            $table->integer('limit')->default(1);
            $table->integer('used')->default(0);
            $table->integer('login')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->dateTime('expires_at')->nullable();
        });

        Schema::create('shop_discount_user', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('discount_id');
            $table->string('log', 300);
            $table->dateTime('used_at');
        });

        Schema::create('shop_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('subtotal')->nullable()->default(0);
            $table->integer('shipping')->nullable()->default(0);
            $table->integer('discount')->nullable()->default(0);
            $table->integer('payment_status')->default(1);
            $table->integer('shipping_status')->default(1);
            $table->integer('status')->default(0);
            $table->integer('tax')->nullable()->default(0);
            $table->integer('total')->nullable()->default(0);
            $table->string('currency', 10);
            $table->float('exchange_rate')->nullable();
            $table->integer('received')->nullable()->default(0);
            $table->integer('balance')->nullable()->default(0);
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('address1', 100);
            $table->string('address2', 100);
            $table->string('country', 10)->default('VN');
            $table->string('company', 100)->nullable();
            $table->string('postcode', 10)->nullable();
            $table->string('phone', 20);
            $table->string('email', 150);
            $table->string('comment', 300)->nullable();
            $table->string('payment_method', 100)->nullable();
            $table->string('shipping_method', 100)->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->string('ip', 100)->nullable();
            $table->string('transaction', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('shop_order_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->string('name', 100);
            $table->integer('price')->default(0);
            $table->integer('qty')->default(0);
            $table->integer('total_price')->default(0);
            $table->string('sku', 50);
            $table->string('currency', 10);
            $table->float('exchange_rate')->nullable();
            $table->string('attribute', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('shop_order_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->string('content', 300);
            $table->integer('admin_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->integer('order_status_id')->default(0);
            $table->dateTime('add_date');
        });

        Schema::create('shop_order_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);

        });

        Schema::create('shop_order_total', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->string('title', 100);
            $table->string('code', 100);
            $table->integer('value')->default(0);
            $table->string('text', 200)->nullable();
            $table->integer('sort')->default(1);
            $table->timestamps();
        });

        Schema::create('shop_page', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image', 255)->nullable();
            $table->string('alias', 120)->unique();
            $table->integer('status')->default(0);
        });

        Schema::create('shop_page_description', function (Blueprint $table) {
            $table->integer('page_id');
            $table->string('lang', 10)->index();
            $table->string('title', 200)->nullable();
            $table->string('keyword', 200)->nullable();
            $table->string('description', 200)->nullable();
            $table->text('content')->nullable();
            $table->primary(['page_id', 'lang']);
        });

        Schema::create('shop_news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image', 200)->nullable();
            $table->string('alias', 120)->unique();
            $table->tinyInteger('sort')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('shop_news_description', function (Blueprint $table) {
            $table->integer('shop_news_id');
            $table->string('lang', 10);
            $table->string('title', 200)->nullable();
            $table->string('keyword', 200)->nullable();
            $table->string('description', 200)->nullable();
            $table->text('content')->nullable();
            $table->primary(['shop_news_id', 'lang']);
        });

        Schema::create('shop_payment_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);

        });

        Schema::create('shop_product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku', 50)->unique();
            $table->string('image', 255)->nullable();
            $table->integer('brand_id')->nullable()->default(0)->index();
            $table->integer('vendor_id')->nullable()->default(0)->index();
            $table->integer('price')->nullable()->default(0);
            $table->integer('cost')->nullable()->nullable()->default(0);
            $table->integer('stock')->nullable()->default(0);
            $table->integer('sold')->nullable()->default(0);
            $table->tinyInteger('type')->nullable()->default(0)->index();
            $table->tinyInteger('kind')->nullable()->default(0)->comment('0:single, 1:bundle, 2:group')->index();
            $table->tinyInteger('virtual')->nullable()->default(0)->comment('0:physical, 1:download, 2:only view, 3: Service')->index();
            $table->tinyInteger('status')->default(0)->index();
            $table->tinyInteger('sort')->default(0);
            $table->integer('view')->default(0);
            $table->string('alias', 120)->unique();
            $table->dateTime('date_lastview')->nullable();
            $table->date('date_available')->nullable();
            $table->timestamps();
        });

        Schema::create('shop_product_description', function (Blueprint $table) {
            $table->integer('product_id');
            $table->string('lang', 10)->index();
            $table->string('name', 200)->nullable();
            $table->string('keyword', 200)->nullable();
            $table->string('description', 200)->nullable();
            $table->text('content')->nullable();
            $table->primary(['product_id', 'lang']);
        });

        Schema::create('shop_product_image', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image', 255);
            $table->integer('product_id')->default(0)->index();
        });

        Schema::create('shop_product_build', function (Blueprint $table) {
            $table->integer('build_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->primary(['build_id', 'product_id']);
        });

        Schema::create('shop_product_group', function (Blueprint $table) {
            $table->integer('group_id');
            $table->integer('product_id');
            $table->primary(['group_id', 'product_id']);
        });

        Schema::create('shop_product_category', function (Blueprint $table) {
            $table->integer('product_id');
            $table->integer('category_id');
            $table->primary(['product_id', 'category_id']);
        });

        Schema::create('shop_attribute_group', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('sort')->default(0);
            $table->string('type', 50)->comment('radio,select,checkbox');
        });

        Schema::create('shop_product_attribute', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('attribute_group_id');
            $table->integer('product_id');
            $table->tinyInteger('sort')->default(0);
            $table->index(['product_id', 'attribute_group_id']);
        });

        Schema::create('shop_shipping', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->default(0);
            $table->integer('value')->default(0);
            $table->integer('free')->default(0);
            $table->integer('status')->default(1);
        });

        Schema::create('shop_shipping_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);

        });

        Schema::create('shop_shoppingcart', function (Blueprint $table) {
            $table->string('identifier', 100);
            $table->string('instance', 100);
            $table->text('content');
            $table->timestamps();
            $table->index(['identifier', 'instance']);
        });

        Schema::create('shop_product_promotion', function (Blueprint $table) {
            $table->integer('product_id')->primary();
            $table->integer('price_promotion');
            $table->dateTime('date_start')->nullable();
            $table->dateTime('date_end')->nullable();
            $table->integer('status_promotion')->default(1);
            $table->timestamps();
        });

        Schema::create('shop_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 100);
            $table->string('last_name', 100)->nullable();
            $table->string('email', 150)->unique();
            $table->tinyInteger('sex')->default(0)->comment('0:women, 1:men');
            $table->date('birthday')->nullable();
            $table->string('password', 100);
            $table->string('postcode', 10)->nullable();
            $table->string('address1', 100)->nullable();
            $table->string('address2', 100)->nullable();
            $table->string('company', 100)->nullable();
            $table->string('country', 10)->default('VN');
            $table->string('phone', 20);
            $table->string('remember_token', 100)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('group')->default(1);
            $table->timestamps();
        });

        Schema::create('shop_vendor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('alias', 120)->unique();
            $table->string('email', 150)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('url', 100)->nullable();
            $table->tinyInteger('sort')->default(0);
        });

        Schema::create('shop_subscribe', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 150)->unique();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        Schema::create('shop_country', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 10)->unique();
            $table->string('name', 100);
        });

        $this->importData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_banner');
        Schema::dropIfExists('admin_config');
        Schema::dropIfExists('admin_store');
        Schema::dropIfExists('admin_store_description');
        Schema::dropIfExists('shop_email_template');
        Schema::dropIfExists('shop_language');
        Schema::dropIfExists('shop_block_content');
        Schema::dropIfExists('shop_layout_page');
        Schema::dropIfExists('shop_layout_position');
        Schema::dropIfExists('shop_layout_type');
        Schema::dropIfExists('shop_link');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('shipping_standard');
        Schema::dropIfExists('shop_api');
        Schema::dropIfExists('shop_api_process');
        Schema::dropIfExists('shop_brand');
        Schema::dropIfExists('shop_category');
        Schema::dropIfExists('shop_category_description');
        Schema::dropIfExists('shop_currency');
        Schema::dropIfExists('shop_discount');
        Schema::dropIfExists('shop_discount_user');
        Schema::dropIfExists('shop_order');
        Schema::dropIfExists('shop_order_detail');
        Schema::dropIfExists('shop_order_history');
        Schema::dropIfExists('shop_order_status');
        Schema::dropIfExists('shop_order_total');
        Schema::dropIfExists('shop_page');
        Schema::dropIfExists('shop_page_description');
        Schema::dropIfExists('shop_payment_status');
        Schema::dropIfExists('shop_product');
        Schema::dropIfExists('shop_product_description');
        Schema::dropIfExists('shop_product_image');
        Schema::dropIfExists('shop_product_build');
        Schema::dropIfExists('shop_product_attribute');
        Schema::dropIfExists('shop_attribute_group');
        Schema::dropIfExists('shop_product_group');
        Schema::dropIfExists('shop_product_category');
        Schema::dropIfExists('shop_shipping');
        Schema::dropIfExists('shop_shipping_status');
        Schema::dropIfExists('shop_shoppingcart');
        Schema::dropIfExists('shop_product_promotion');
        Schema::dropIfExists('shop_user');
        Schema::dropIfExists('shop_vendor');
        Schema::dropIfExists('shop_subscribe');
        Schema::dropIfExists('shop_country');
    }

    public function importData()
    {
        DB::table('shop_banner')->insert([
            ['image' => '/data/banner/Main-banner-1-1903x600.jpg', 'html' => '', 'target' => '_self',  'status' => 1, 'type' => 1],
            ['image' => '/data/banner/Main-banner-3-1903x600.jpg', 'html' => '', 'target' => '_self',  'status' => 1, 'type' => 1],
        ]
        );

        DB::table('admin_config')->insert([
            ['group' => '', 'code' => 'config', 'key' => 'shop_allow_guest', 'value' => '1', 'sort' => '11', 'detail' => 'lang::admin.shop_allow_guest', 'store_id' => '1'],
            ['group' => '', 'code' => 'config', 'key' => 'product_preorder', 'value' => '1', 'sort' => '18', 'detail' => 'lang::admin.product_preorder', 'store_id' => '1'],
            ['group' => '', 'code' => 'config', 'key' => 'product_display_out_of_stock', 'value' => '1', 'sort' => '19', 'detail' => 'lang::admin.product_display_out_of_stock', 'store_id' => '1'],
            ['group' => '', 'code' => 'config', 'key' => 'product_buy_out_of_stock', 'value' => '1', 'sort' => '20', 'detail' => 'lang::admin.product_buy_out_of_stock', 'store_id' => '1'],
            ['group' => '', 'code' => 'config', 'key' => 'show_date_available', 'value' => '1', 'sort' => '21', 'detail' => 'lang::admin.show_date_available', 'store_id' => '1'],
            ['group' => '', 'code' => 'display', 'key' => 'product_hot', 'value' => '6', 'sort' => '0', 'detail' => 'lang::admin.hot_product', 'store_id' => '1'],
            ['group' => '', 'code' => 'display', 'key' => 'product_new', 'value' => '6', 'sort' => '0', 'detail' => 'lang::admin.new_product', 'store_id' => '1'],
            ['group' => '', 'code' => 'display', 'key' => 'product_list', 'value' => '18', 'sort' => '0', 'detail' => 'lang::admin.list_product', 'store_id' => '1'],
            ['group' => '', 'code' => 'display', 'key' => 'product_relation', 'value' => '4', 'sort' => '0', 'detail' => 'lang::admin.relation_product', 'store_id' => '1'],
            ['group' => '', 'code' => 'display', 'key' => 'product_viewed', 'value' => '4', 'sort' => '0', 'detail' => 'lang::admin.viewed_product', 'store_id' => '1'],
            ['group' => '', 'code' => 'display', 'key' => 'item_list', 'value' => '12', 'sort' => '0', 'detail' => 'lang::admin.item_list', 'store_id' => '1'],
            ['group' => '', 'code' => 'email_action', 'key' => 'email_action_mode', 'value' => '1', 'sort' => '0', 'detail' => 'lang::email.email_action.email_action_mode', 'store_id' => '1'],
            ['group' => '', 'code' => 'email_action', 'key' => 'order_success_to_admin', 'value' => '0', 'sort' => '1', 'detail' => 'lang::email.email_action.order_success_to_admin', 'store_id' => '1'],
            ['group' => '', 'code' => 'email_action', 'key' => 'order_success_to_customer', 'value' => '0', 'sort' => '2', 'detail' => 'lang::email.email_action.order_success_to_cutomer', 'store_id' => '1'],
            ['group' => '', 'code' => 'email_action', 'key' => 'welcome_customer', 'value' => '0', 'sort' => '4', 'detail' => 'lang::email.email_action.welcome_customer', 'store_id' => '1'],
            ['group' => '', 'code' => 'email_action', 'key' => 'contact_to_admin', 'value' => '1', 'sort' => '6', 'detail' => 'lang::email.email_action.contact_to_admin', 'store_id' => '1'],
            ['group' => '', 'code' => 'email_action', 'key' => 'email_action_smtp_mode', 'value' => '0', 'sort' => '6', 'detail' => 'lang::email.email_action.email_action_smtp_mode', 'store_id' => '1'],
            ['group' => 'Modules', 'code' => 'Block', 'key' => 'LastViewProduct', 'value' => '1', 'sort' => '0', 'detail' => 'Modules/Block/LastViewProduct::.title', 'store_id' => '1'],
            ['group' => 'Extensions', 'code' => 'Payment', 'key' => 'Cash', 'value' => '1', 'sort' => '0', 'detail' => 'Extensions/Payment/Cash::Cash.title', 'store_id' => '1'],
            ['group' => 'Extensions', 'code' => 'Shipping', 'key' => 'ShippingStandard', 'value' => '1', 'sort' => '0', 'detail' => 'lang::Shipping Standard', 'store_id' => '1'],
            ['group' => '', 'code' => 'smtp', 'key' => 'smtp_host', 'value' => '', 'sort' => '8', 'detail' => 'lang::email.smtp_host', 'store_id' => '1'],
            ['group' => '', 'code' => 'smtp', 'key' => 'smtp_user', 'value' => '', 'sort' => '7', 'detail' => 'lang::email.smtp_user', 'store_id' => '1'],
            ['group' => '', 'code' => 'smtp', 'key' => 'smtp_password', 'value' => '', 'sort' => '6', 'detail' => 'lang::email.smtp_password', 'store_id' => '1'],
            ['group' => '', 'code' => 'smtp', 'key' => 'smtp_security', 'value' => '', 'sort' => '5', 'detail' => 'lang::email.smtp_security', 'store_id' => '1'],
            ['group' => '', 'code' => 'smtp', 'key' => 'smtp_port', 'value' => '', 'sort' => '4', 'detail' => 'lang::email.smtp_port', 'store_id' => '1'],
            ['group' => 'Extensions', 'code' => 'Total', 'key' => 'Discount', 'value' => '1', 'sort' => '0', 'detail' => 'Extensions/Total/Discount::Discount.title', 'store_id' => '1'],
            ['group' => '', 'code' => 'cache', 'key' => 'cache_status', 'value' => '0', 'sort' => '0', 'detail' => '', 'store_id' => '1'],
            ['group' => '', 'code' => 'cache', 'key' => 'cache_time', 'value' => '600', 'sort' => '0', 'detail' => '', 'store_id' => '1'],

            ['group' => '', 'code' => 'upload', 'key' => 'upload_image_size', 'value' => '2048', 'sort' => '0', 'detail' => '', 'store_id' => '1'],

            ['group' => '', 'code' => 'upload', 'key' => 'upload_image_thumb_width', 'value' => '250', 'sort' => '0', 'detail' => '', 'store_id' => '1'],
            ['group' => '', 'code' => 'upload', 'key' => 'upload_image_thumb_status', 'value' => '1', 'sort' => '0', 'detail' => '', 'store_id' => '1'],
            ['group' => '', 'code' => 'upload', 'key' => 'upload_watermark_status', 'value' => '1', 'sort' => '0', 'detail' => '', 'store_id' => '1'],
            ['group' => '', 'code' => 'upload', 'key' => 'upload_watermark_path', 'value' => 'images/watermark.png', 'sort' => '0', 'detail' => '', 'store_id' => '1'],

            ['group' => '', 'code' => 'env', 'key' => 'SITE_STATUS', 'value' => 'on', 'sort' => '0', 'detail' => 'lang::env.SITE_STATUS', 'store_id' => '1'],
            ['group' => '', 'code' => 'env', 'key' => 'SITE_TIMEZONE', 'value' => 'Asia/Ho_Chi_Minh', 'sort' => '0', 'detail' => 'lang::env.SITE_TIMEZONE', 'store_id' => '1'],
            ['group' => '', 'code' => 'env', 'key' => 'SITE_LANGUAGE', 'value' => 'en', 'sort' => '0', 'detail' => 'lang::env.SITE_LANGUAGE', 'store_id' => '1'],
            ['group' => '', 'code' => 'env', 'key' => 'SITE_CURRENCY', 'value' => 'USD', 'sort' => '0', 'detail' => 'lang::env.SITE_CURRENCY', 'store_id' => '1'],
            ['group' => '', 'code' => 'env', 'key' => 'APP_DEBUG', 'value' => 'off', 'sort' => '0', 'detail' => 'lang::env.APP_DEBUG', 'store_id' => '1'],
            ['group' => '', 'code' => 'env', 'key' => 'ADMIN_LOG', 'value' => 'on', 'sort' => '0', 'detail' => 'lang::env.ADMIN_LOG', 'store_id' => '1'],
            ['group' => '', 'code' => 'env', 'key' => 'ADMIN_LOG_EXP', 'value' => '', 'sort' => '0', 'detail' => 'lang::env.ADMIN_LOG_EXP', 'store_id' => '1'],
            ['group' => '', 'code' => 'env', 'key' => 'ADMIN_PREFIX', 'value' => '', 'sort' => '0', 'detail' => 'lang::env.ADMIN_PREFIX', 'store_id' => '1'],
            ['group' => '', 'code' => 'env', 'key' => 'ADMIN_NAME', 'value' => 'S-Cart System', 'sort' => '0', 'detail' => 'lang::env.ADMIN_NAME', 'store_id' => '1'],
            ['group' => '', 'code' => 'env', 'key' => 'ADMIN_TITLE', 'value' => 'S-Cart System', 'sort' => '0', 'detail' => 'lang::env.ADMIN_TITLE', 'store_id' => '1'],
            ['group' => '', 'code' => 'env', 'key' => 'ADMIN_LOGO', 'value' => 'S-Cart Admin', 'sort' => '0', 'detail' => 'lang::env.ADMIN_LOGO', 'store_id' => '1'],
            ['group' => '', 'code' => 'env', 'key' => 'ADMIN_LOGO_MINI', 'value' => '<i class="fa fa-map-o" aria-hidden="true"></i>', 'sort' => '0', 'detail' => 'lang::env.ADMIN_LOGO_MINI', 'store_id' => '1'],
            ['group' => '', 'code' => 'env', 'key' => 'LOG_SLACK_WEBHOOK_URL', 'value' => '', 'sort' => '0', 'detail' => 'lang::env.LOG_SLACK_WEBHOOK_URL', 'store_id' => '1'],

            ['group' => '', 'code' => 'url', 'key' => 'SUFFIX_URL', 'value' => '.html', 'sort' => '0', 'detail' => 'lang::url.SUFFIX_URL', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_BRAND', 'value' => 'brand', 'sort' => '0', 'detail' => 'lang::url.PREFIX_BRAND', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_VENDOR', 'value' => 'vendor', 'sort' => '0', 'detail' => 'lang::url.PREFIX_VENDOR', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_CATEGORY', 'value' => 'category', 'sort' => '0', 'detail' => 'lang::url.PREFIX_CATEGORY', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_PRODUCT', 'value' => 'product', 'sort' => '0', 'detail' => 'lang::url.PREFIX_PRODUCT', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_SEARCH', 'value' => 'search', 'sort' => '0', 'detail' => 'lang::url.PREFIX_SEARCH', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_CONTACT', 'value' => 'contact', 'sort' => '0', 'detail' => 'lang::url.PREFIX_CONTACT', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_NEWS', 'value' => 'news', 'sort' => '0', 'detail' => 'lang::url.PREFIX_NEWS', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_MEMBER', 'value' => 'member', 'sort' => '0', 'detail' => 'lang::url.PREFIX_MEMBER', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_MEMBER_ORDER_LIST', 'value' => 'order-list', 'sort' => '0', 'detail' => 'lang::url.PREFIX_MEMBER_ORDER_LIST', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_MEMBER_CHANGE_PWD', 'value' => 'change-password', 'sort' => '0', 'detail' => 'lang::url.PREFIX_MEMBER_CHANGE_PWD', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_MEMBER_CHANGE_INFO', 'value' => 'change-info', 'sort' => '0', 'detail' => 'lang::url.PREFIX_MEMBER_CHANGE_INFO', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_CMS_CATEGORY', 'value' => 'cms-category', 'sort' => '0', 'detail' => 'lang::url.PREFIX_CMS_CATEGORY', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_CMS_ENTRY', 'value' => 'entry', 'sort' => '0', 'detail' => 'lang::url.PREFIX_CMS_ENTRY', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_CART_WISHLIST', 'value' => 'wishlst', 'sort' => '0', 'detail' => 'lang::url.PREFIX_CART_WISHLIST', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_CART_COMPARE', 'value' => 'compare', 'sort' => '0', 'detail' => 'lang::url.PREFIX_CART_COMPARE', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_CART_DEFAULT', 'value' => 'cart', 'sort' => '0', 'detail' => 'lang::url.PREFIX_CART_DEFAULT', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_CART_CHECKOUT', 'value' => 'checkout', 'sort' => '0', 'detail' => 'lang::url.PREFIX_CART_CHECKOUT', 'store_id' => '1'],
            ['group' => '', 'code' => 'url', 'key' => 'PREFIX_ORDER_SUCCESS', 'value' => 'order-success', 'sort' => '0', 'detail' => 'lang::url.PREFIX_ORDER_SUCCESS', 'store_id' => '1'],


            ['group' => '', 'code' => 'product', 'key' => 'product_brand', 'value' => '1', 'sort' => '0', 'detail' => 'lang::product.config_manager.brand', 'store_id' => '1'],
            ['group' => '', 'code' => 'product', 'key' => 'product_vendor', 'value' => '1', 'sort' => '0', 'detail' => 'lang::product.config_manager.vendor', 'store_id' => '1'],
            ['group' => '', 'code' => 'product', 'key' => 'product_price', 'value' => '1', 'sort' => '0', 'detail' => 'lang::product.config_manager.price', 'store_id' => '1'],
            ['group' => '', 'code' => 'product', 'key' => 'product_cost', 'value' => '1', 'sort' => '0', 'detail' => 'lang::product.config_manager.cost', 'store_id' => '1'],
            ['group' => '', 'code' => 'product', 'key' => 'product_promotion', 'value' => '1', 'sort' => '0', 'detail' => 'lang::product.config_manager.promotion', 'store_id' => '1'],
            ['group' => '', 'code' => 'product', 'key' => 'product_stock', 'value' => '1', 'sort' => '0', 'detail' => 'lang::product.config_manager.stock', 'store_id' => '1'],
            ['group' => '', 'code' => 'product', 'key' => 'product_type', 'value' => '1', 'sort' => '0', 'detail' => 'lang::product.config_manager.type', 'store_id' => '1'],
            ['group' => '', 'code' => 'product', 'key' => 'product_kind', 'value' => '1', 'sort' => '0', 'detail' => 'lang::product.config_manager.kind', 'store_id' => '1'],
            ['group' => '', 'code' => 'product', 'key' => 'product_virtual', 'value' => '1', 'sort' => '0', 'detail' => 'lang::product.config_manager.virtual', 'store_id' => '1'],
            ['group' => '', 'code' => 'product', 'key' => 'product_attribute', 'value' => '1', 'sort' => '0', 'detail' => 'lang::product.config_manager.attribute', 'store_id' => '1'],
            ['group' => '', 'code' => 'product', 'key' => 'product_available', 'value' => '1', 'sort' => '0', 'detail' => 'lang::product.config_manager.available', 'store_id' => '1'],

            ['group' => '', 'code' => 'customer', 'key' => 'customer_lastname', 'value' => '1', 'sort' => '0', 'detail' => 'lang::customer.config_manager.lastname', 'store_id' => '1'],
            ['group' => '', 'code' => 'customer', 'key' => 'customer_address1', 'value' => '1', 'sort' => '0', 'detail' => 'lang::customer.config_manager.address1', 'store_id' => '1'],
            ['group' => '', 'code' => 'customer', 'key' => 'customer_address2', 'value' => '1', 'sort' => '0', 'detail' => 'lang::customer.config_manager.address2', 'store_id' => '1'],
            ['group' => '', 'code' => 'customer', 'key' => 'customer_company', 'value' => '0', 'sort' => '0', 'detail' => 'lang::customer.config_manager.company', 'store_id' => '1'],
            ['group' => '', 'code' => 'customer', 'key' => 'customer_postcode', 'value' => '0', 'sort' => '0', 'detail' => 'lang::customer.config_manager.postcode', 'store_id' => '1'],
            ['group' => '', 'code' => 'customer', 'key' => 'customer_country', 'value' => '1', 'sort' => '0', 'detail' => 'lang::customer.config_manager.country', 'store_id' => '1'],
            ['group' => '', 'code' => 'customer', 'key' => 'customer_group', 'value' => '0', 'sort' => '0', 'detail' => 'lang::customer.config_manager.group', 'store_id' => '1'],
            ['group' => '', 'code' => 'customer', 'key' => 'customer_birthday', 'value' => '0', 'sort' => '0', 'detail' => 'lang::customer.config_manager.birthday', 'store_id' => '1'],
            ['group' => '', 'code' => 'customer', 'key' => 'customer_sex', 'value' => '0', 'sort' => '0', 'detail' => 'lang::customer.config_manager.sex', 'store_id' => '1'],
            ['group' => '', 'code' => 'customer', 'key' => 'customer_phone', 'value' => '1', 'sort' => '1', 'detail' => 'lang::customer.config_manager.phone', 'store_id' => '1'],


        ]);
        DB::table('admin_store')->insert(
            ['logo' => '/data/logo/scart-mid.png', 'site_status' => 1, 'template' => 'default', 'phone' => '0123456789', 'long_phone' => 'Support: 0987654321', 'email' => 'admin-demo@s-cart.org', 'time_active' => '', 'address' => '123st - abc - xyz']
        );

        DB::table('admin_store_description')->insert([
            ['config_id' => '1', 'lang' => 'en', 'title' => 'Demo S-cart : Free Laravel eCommerce for Business', 'description' => 'Free website shopping cart for business', 'keyword' => '', 'maintain_content' => '<center><img src="/images/maintenance.png" />
<h3><span style="color:#e74c3c;"><strong>Sorry! We are currently doing site maintenance!</strong></span></h3>
</center>'],
            ['config_id' => '1', 'lang' => 'vi', 'title' => 'Demo S-cart: Mã nguồn website thương mại điện tử miễn phí cho doanh nghiệp', 'description' => 'Laravel shopping cart for business', 'keyword' => '', 'maintain_content' => '<center><img src="/images/maintenance.png" />
<h3><span style="color:#e74c3c;"><strong>Sorry! We are currently doing site maintenance!</strong></span></h3>
</center>'],
        ]);

        DB::table('shop_email_template')->insert([
            ['name' => 'Reset password', 'group' => 'forgot_password', 'text' => '<h1 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:19px;font-weight:bold;margin-top:0;text-align:left">{{$title}}</h1>
<p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">{{$reason_sendmail}}</p>
                    <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:30px auto;padding:0;text-align:center;width:100%">
                      <tbody><tr>
                        <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                          <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                            <tbody><tr>
                              <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                <table border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                  <tbody><tr>
                                    <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                      <a href="{{$reset_link}}" class="button button-primary" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;border-radius:3px;color:#fff;display:inline-block;text-decoration:none;background-color:#3097d1;border-top:10px solid #3097d1;border-right:18px solid #3097d1;border-bottom:10px solid #3097d1;border-left:18px solid #3097d1" target="_blank">{{$reset_button}}</a>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                    <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                      {{$note_sendmail}}
                    </p>
                    <table class="subcopy" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;border-top:1px solid #edeff2;margin-top:25px;padding-top:25px">
                    <tbody><tr>
                      <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                        <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;line-height:1.5em;margin-top:0;text-align:left;font-size:12px">{{$note_access_link}}: <a href="{{$reset_link}}" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#3869d4" target="_blank">{{$reset_link}}</a></p>
                          </td>
                        </tr>
                      </tbody>
                    </table>', 'status' => '1'],

            ['name' => 'Welcome new customer', 'group' => 'welcome_customer', 'text' => '<h1 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:19px;font-weight:bold;margin-top:0;text-align:center">{{$title}}</h1>
<p style="text-align:center;">Welcome to my site!</p>', 'status' => '1'],
            ['name' => 'Send form contact to admin', 'group' => 'contact_to_admin', 'text' => '<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <b>Name</b>: {{$name}}<br>
            <b>Email</b>: {{$email}}<br>
            <b>Phone</b>: {{$phone}}<br>
        </td>
    </tr>
</table>
<hr>
<p style="text-align: center;">Content:<br>
<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td>{{$content}}</td>
    </tr>
</table>', 'status' => '1'],

            ['name' => 'New order to admin', 'group' => 'order_success_to_admin', 'text' => '<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <b>Order ID</b>: {{$orderID}}<br>
                                <b>Customer name</b>: {{$toname}}<br>
                                <b>Email</b>: {{$email}}<br>
                                <b>Address</b>: {{$address}}<br>
                                <b>Phone</b>: {{$phone}}<br>
                                <b>Order note</b>: {{$comment}}
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <p style="text-align: center;">Order detail:<br>
                    ===================================<br></p>
                    <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" border="1">
                        {{$orderDetail}}
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" style="font-weight: bold;">Sub total</td>
                            <td colspan="2" align="right">{{$subtotal}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" style="font-weight: bold;">Shipping fee</td>
                            <td colspan="2" align="right">{{$shipping}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" style="font-weight: bold;">Discount</td>
                            <td colspan="2" align="right">{{$discount}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" style="font-weight: bold;">Total</td>
                            <td colspan="2" align="right">{{$total}}</td>
                        </tr>
                    </table>', 'status' => '1'],

            ['name' => 'New order to customr', 'group' => 'order_success_to_customer', 'text' => '<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <b>Order ID</b>: {{$orderID}}<br>
                                <b>Customer name</b>: {{$toname}}<br>
                                <b>Address</b>: {{$address}}<br>
                                <b>Phone</b>: {{$phone}}<br>
                                <b>Order note</b>: {{$comment}}
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <p style="text-align: center;">Order detail:<br>
                    ===================================<br></p>
                    <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" border="1">
                        {{$orderDetail}}
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" style="font-weight: bold;">Sub total</td>
                            <td colspan="2" align="right">{{$subtotal}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" style="font-weight: bold;">Shipping fee</td>
                            <td colspan="2" align="right">{{$shipping}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" style="font-weight: bold;">Discount</td>
                            <td colspan="2" align="right">{{$discount}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" style="font-weight: bold;">Total</td>
                            <td colspan="2" align="right">{{$total}}</td>
                        </tr>
                    </table>', 'status' => '1'],
        ]);

        DB::table('shop_language')->insert([
            ['id' => '1', 'name' => 'English', 'code' => 'en', 'icon' => '/data/language/flag_uk.png', 'status' => '1', 'sort' => '1'],
            ['id' => '2', 'name' => 'Tiếng Việt', 'code' => 'vi', 'icon' => '/data/language/flag_vn.png', 'status' => '1', 'sort' => '1'],
        ]);

        DB::table('shop_block_content')->insert([
            ['name' => 'Facebook code', 'position' => 'top', 'page' => '*', 'type' => 'html', 'text' => '<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = \'//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=934208239994473\';
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));
</script>', 'status' => '1', 'sort' => '0'],
            ['name' => 'Google Analytics', 'position' => 'header', 'page' => '*', 'type' => 'html', 'text' => '<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-128658138-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag(\'js\', new Date());
  gtag(\'config\', \'UA-128658138-1\');
</script>', 'status' => '1', 'sort' => '0'],

            ['name' => 'Product special', 'position' => 'left', 'page' => 'home,product_list', 'type' => 'view', 'text' => 'product_special', 'status' => '1', 'sort' => '1'],
            ['name' => 'Brands', 'position' => 'left', 'page' => 'home,item_list', 'type' => 'view', 'text' => 'brands_left', 'status' => '1', 'sort' => '3'],
            ['name' => 'Banner home', 'position' => 'banner_top', 'page' => 'home', 'type' => 'view', 'text' => 'banner_image', 'status' => '1', 'sort' => '0'],
            ['name' => 'Categories', 'position' => 'left', 'page' => 'home,product_list,product_detail,shop_wishlist', 'type' => 'view', 'text' => 'categories', 'status' => '1', 'sort' => '4'],
            ['name' => 'Product last view', 'position' => 'left', 'page' => '*', 'type' => 'module', 'text' => 'LastViewProduct', 'status' => '1', 'sort' => '0'],

        ]);

        DB::table('shop_layout_page')->insert([
            ['key' => 'home', 'name' => 'Home page'],
            ['key' => 'product_list', 'name' => 'Product list'],
            ['key' => 'product_detail', 'name' => 'Product detail'],
            ['key' => 'shop_cart', 'name' => 'Shop cart'],
            ['key' => 'shop_account', 'name' => 'Account'],
            ['key' => 'shop_profile', 'name' => 'Profile'],
            ['key' => 'shop_compare', 'name' => 'Compare page'],
            ['key' => 'shop_wishlist', 'name' => 'Wishlist page'],
            ['key' => 'item_list', 'name' => 'Item list'],
        ]);
        DB::table('shop_layout_position')->insert([
            ['key' => 'meta', 'name' => 'Meta'],
            ['key' => 'header', 'name' => 'Header'],
            ['key' => 'top', 'name' => 'Top'],
            ['key' => 'bottom', 'name' => 'Bottom'],
            ['key' => 'footer', 'name' => 'Footer'],
            ['key' => 'left', 'name' => 'Column left'],
            ['key' => 'right', 'name' => 'Column right'],
            ['key' => 'banner_top', 'name' => 'Banner top'],
        ]);
        DB::table('shop_layout_type')->insert([
            ['key' => 'html', 'name' => 'Html'],
            ['key' => 'view', 'name' => 'View'],
            ['key' => 'module', 'name' => 'Module'],
        ]);
        DB::table('shop_link')->insert([
            ['name' => 'lang::front.contact', 'url' => 'route::pages::contact', 'target' => '_self', 'module' => '', 'group' => 'menu', 'status' => '1', 'sort' => '3'],
            ['name' => 'lang::front.about', 'url' => 'route::pages::about', 'target' => '_self', 'module' => '', 'group' => 'menu', 'status' => '1', 'sort' => '4'],
            ['name' => 'S-Cart', 'url' => 'https://s-cart.org', 'target' => '_blank', 'module' => '', 'group' => 'menu', 'status' => '1', 'sort' => '0'],
            ['name' => 'lang::front.my_profile', 'url' => '/member/login.html', 'target' => '_self', 'module' => '', 'group' => 'footer', 'status' => '1', 'sort' => '5'],
            ['name' => 'lang::front.compare_page', 'url' => '/compare.html', 'target' => '_self', 'module' => '', 'group' => 'footer', 'status' => '1', 'sort' => '4'],
            ['name' => 'lang::front.wishlist_page', 'url' => 'route::wishlist', 'target' => '_self', 'module' => '', 'group' => 'footer', 'status' => '1', 'sort' => '3'],
        ]);
        DB::table('shipping_standard')->insert([
            ['fee' => 20000, 'shipping_free' => 100000],
        ]);

        DB::table('shop_api')->insert([
            ['name' => 'api_product_list', 'hidden_default' => '', 'type' => 'secret'],
            ['name' => 'api_product_detail', 'hidden_default' => 'cost,sold,stock,sort', 'type' => 'private'],
            ['name' => 'api_order_list', 'hidden_default' => '', 'type' => 'public'],
            ['name' => 'api_order_detail', 'hidden_default' => '', 'type' => 'secret'],
        ]);
        DB::table('shop_api_process')->insert([
            ['api_id' => '1', 'secret_key' => '!CVCBsd$6j9ds3%flh[^d', 'hidden_fileds' => 'descriptions,cost', 'ip_allow' => '', 'ip_deny' => '127.0.0.11,1233.2.2.3', 'exp' => '2019-12-14 ', 'status' => '1'],
            ['api_id' => '1', 'secret_key' => '%GSFf13gkLtP@d', 'hidden_fileds' => '', 'ip_allow' => '', 'ip_deny' => '', 'exp' => null, 'status' => '1'],
        ]);

        DB::table('shop_product')->insert([
            ['id' => 1, 'sku' => 'ABCZZ','alias' => 'demo-alias-name-product-1', 'image' => '/data/product/img-1.jpg', 'brand_id' => '1', 'vendor_id' => '1', 'price' => '15000', 'cost' => '10000', 'stock' => '99', 'type' => '2', 'status' => '1', 'kind' => 0, 'date_available' => '2020-02-03', 'sold' => '1'],
            ['id' => 2, 'sku' => 'LEDFAN1','alias' => 'demo-alias-name-product-2', 'image' => '/data/product/img-4.jpg', 'brand_id' => '1', 'vendor_id' => '1', 'price' => '15000', 'cost' => '10000', 'stock' => '100', 'type' => '1', 'status' => '1', 'kind' => 0, 'date_available' => null, 'sold' => '0'],
            ['id' => 3, 'sku' => 'CLOCKFAN1','alias' => 'demo-alias-name-product-3', 'image' => '/data/product/img-11.jpg', 'brand_id' => '2', 'vendor_id' => '1', 'price' => '15000', 'cost' => '10000', 'stock' => '100', 'type' => '0', 'status' => '1', 'kind' => 0, 'date_available' => null, 'sold' => '0'],
            ['id' => 4, 'sku' => 'CLOCKFAN2','alias' => 'demo-alias-name-product-4', 'image' => '/data/product/img-14.jpg', 'brand_id' => '3', 'vendor_id' => '1', 'price' => '15000', 'cost' => '10000', 'stock' => '100', 'type' => '0', 'status' => '1', 'kind' => 0, 'date_available' => null, 'sold' => '0'],
            ['id' => 5, 'sku' => 'CLOCKFAN3','alias' => 'demo-alias-name-product-5', 'image' => '/data/product/img-15.jpg', 'brand_id' => '1', 'vendor_id' => '1', 'price' => '15000', 'cost' => '10000', 'stock' => '100', 'type' => '0', 'status' => '1', 'kind' => 0, 'date_available' => null, 'sold' => '0'],
            ['id' => 6, 'sku' => 'TMC2208','alias' => 'demo-alias-name-product-6', 'image' => '/data/product/img-16.jpg', 'brand_id' => '1', 'vendor_id' => '1', 'price' => '15000', 'cost' => '10000', 'stock' => '100', 'type' => '1', 'status' => '1', 'kind' => 0, 'date_available' => null, 'sold' => '0'],
            ['id' => 7, 'sku' => 'FILAMENT','alias' => 'demo-alias-name-product-7', 'image' => '/data/product/img-17.jpg', 'brand_id' => '2', 'vendor_id' => '1', 'price' => '15000', 'cost' => '10000', 'stock' => '100', 'type' => '0', 'status' => '1', 'kind' => 0, 'date_available' => null, 'sold' => '0'],
            ['id' => 8, 'sku' => 'A4988','alias' => 'demo-alias-name-product-8', 'image' => '/data/product/img-18.jpg', 'brand_id' => '2', 'vendor_id' => '1', 'price' => '15000', 'cost' => '10000', 'stock' => '100', 'type' => '2', 'status' => '1', 'kind' => 0, 'date_available' => null, 'sold' => '0'],
            ['id' => 9, 'sku' => 'ANYCUBIC-P','alias' => 'demo-alias-name-product-9', 'image' => '/data/product/img-20.jpg', 'brand_id' => '2', 'vendor_id' => '1', 'price' => '15000', 'cost' => '10000', 'stock' => '100', 'type' => '2', 'status' => '1', 'kind' => 0, 'date_available' => null, 'sold' => '0'],
            ['id' => 10, 'sku' => '3DHLFD-P','alias' => 'demo-alias-name-product-10', 'image' => '/data/product/img-21.jpg', 'brand_id' => '4', 'vendor_id' => '1', 'price' => '15000', 'cost' => '10000', 'stock' => '100', 'type' => '2', 'status' => '1', 'kind' => 0, 'date_available' => null, 'sold' => '0'],
            ['id' => 11, 'sku' => 'SS495A','alias' => 'demo-alias-name-product-11', 'image' => '/data/product/img-22.jpg', 'brand_id' => '2', 'vendor_id' => '1', 'price' => '15000', 'cost' => '10000', 'stock' => '100', 'type' => '0', 'status' => '1', 'kind' => 0, 'date_available' => null, 'sold' => '0'],
            ['id' => 12, 'sku' => '3D-CARBON1.75','alias' => 'demo-alias-name-product-12', 'image' => '/data/product/img-23.jpg', 'brand_id' => '2', 'vendor_id' => '1', 'price' => '15000', 'cost' => '10000', 'stock' => '100', 'type' => '2', 'status' => '1', 'kind' => 0, 'date_available' => null, 'sold' => '0'],
            ['id' => 13, 'sku' => '3D-GOLD1.75','alias' => 'demo-alias-name-product-13', 'image' => '/data/product/img-34.jpg', 'brand_id' => '3', 'vendor_id' => '1', 'price' => '10000', 'cost' => '5000', 'stock' => '0', 'type' => '0', 'status' => '1', 'kind' => 0, 'date_available' => null, 'sold' => '0'],
            ['id' => 14, 'sku' => 'LCD12864-3D','alias' => 'demo-alias-name-product-14', 'image' => '/data/product/img-13.jpg', 'brand_id' => '3', 'vendor_id' => '1', 'price' => '15000', 'cost' => '10000', 'stock' => '100', 'type' => '0', 'status' => '1', 'kind' => 0, 'date_available' => null, 'sold' => '0'],
            ['id' => 15, 'sku' => 'LCD2004-3D','alias' => 'demo-alias-name-product-15', 'image' => '/data/product/img-41.jpg', 'brand_id' => '3', 'vendor_id' => '1', 'price' => '15000', 'cost' => '10000', 'stock' => '100', 'type' => '0', 'status' => '1', 'kind' => 1, 'date_available' => null, 'sold' => '0'],
            ['id' => 16, 'sku' => 'RAMPS1.5-3D','alias' => 'demo-alias-name-product-16', 'image' => '/data/product/img-42.jpg', 'brand_id' => '2', 'vendor_id' => '1', 'price' => '0', 'cost' => '0', 'stock' => '0', 'type' => '0', 'status' => '1', 'kind' => 2, 'date_available' => null, 'sold' => '0'],
            ['id' => 17, 'sku' => 'ALOKK1-AY','alias' => 'demo-alias-name-product-17', 'image' => '/data/product/img-26.jpg', 'brand_id' => '3', 'vendor_id' => '1', 'price' => '15000', 'cost' => '10000', 'stock' => '100', 'type' => '0', 'status' => '1', 'kind' => 0, 'date_available' => null, 'sold' => '0'],
        ]);

        DB::table('shop_product_description')->insert([
            ['product_id' => '1', 'lang' => 'en', 'name' => 'Easy Polo Black Edition 1', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '2', 'lang' => 'en', 'name' => 'Easy Polo Black Edition 2', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '3', 'lang' => 'en', 'name' => 'Easy Polo Black Edition 3', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '4', 'lang' => 'en', 'name' => 'Easy Polo Black Edition 4', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '5', 'lang' => 'en', 'name' => 'Easy Polo Black Edition 5', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '6', 'lang' => 'en', 'name' => 'Easy Polo Black Edition 6', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '7', 'lang' => 'en', 'name' => 'Easy Polo Black Edition 7', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '8', 'lang' => 'en', 'name' => 'Easy Polo Black Edition 8', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '9', 'lang' => 'en', 'name' => 'Easy Polo Black Edition 9', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '10', 'lang' => 'en', 'name' => 'Easy Polo Black Edition 10', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '11', 'lang' => 'en', 'name' => 'Easy Polo Black Edition 11', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '12', 'lang' => 'en', 'name' => 'Easy Polo Black Edition 12', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '13', 'lang' => 'en', 'name' => 'Easy Polo Black Edition 13', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '14', 'lang' => 'en', 'name' => 'Easy Polo Black Edition 14', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '15', 'lang' => 'en', 'name' => 'Easy Polo Black Edition 15', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '16', 'lang' => 'en', 'name' => 'Easy Polo Black Edition 16', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '17', 'lang' => 'en', 'name' => 'Easy Polo Black Edition 17', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '1', 'lang' => 'vi', 'name' => 'Easy Polo Black Edition 1', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '2', 'lang' => 'vi', 'name' => 'Easy Polo Black Edition 2', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '3', 'lang' => 'vi', 'name' => 'Easy Polo Black Edition 3', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '4', 'lang' => 'vi', 'name' => 'Easy Polo Black Edition 4', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '5', 'lang' => 'vi', 'name' => 'Easy Polo Black Edition 5', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '6', 'lang' => 'vi', 'name' => 'Easy Polo Black Edition 6', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '7', 'lang' => 'vi', 'name' => 'Easy Polo Black Edition 7', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '8', 'lang' => 'vi', 'name' => 'Easy Polo Black Edition 8', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '9', 'lang' => 'vi', 'name' => 'Easy Polo Black Edition 9', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '10', 'lang' => 'vi', 'name' => 'Easy Polo Black Edition 10', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '11', 'lang' => 'vi', 'name' => 'Easy Polo Black Edition 11', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '12', 'lang' => 'vi', 'name' => 'Easy Polo Black Edition 12', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '13', 'lang' => 'vi', 'name' => 'Easy Polo Black Edition 13', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '14', 'lang' => 'vi', 'name' => 'Easy Polo Black Edition 14', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '15', 'lang' => 'vi', 'name' => 'Easy Polo Black Edition 15', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '16', 'lang' => 'vi', 'name' => 'Easy Polo Black Edition 16', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
            ['product_id' => '17', 'lang' => 'vi', 'name' => 'Easy Polo Black Edition 17', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'],
        ]);

        DB::table('shop_product_category')->insert([
            ['product_id' => '1', 'category_id' => '13'],
            ['product_id' => '2', 'category_id' => '13'],
            ['product_id' => '3', 'category_id' => '11'],
            ['product_id' => '4', 'category_id' => '11'],
            ['product_id' => '5', 'category_id' => '11'],
            ['product_id' => '6', 'category_id' => '11'],
            ['product_id' => '7', 'category_id' => '12'],
            ['product_id' => '8', 'category_id' => '10'],
            ['product_id' => '9', 'category_id' => '6'],
            ['product_id' => '10', 'category_id' => '11'],
            ['product_id' => '11', 'category_id' => '10'],
            ['product_id' => '12', 'category_id' => '9'],
            ['product_id' => '13', 'category_id' => '5'],
            ['product_id' => '14', 'category_id' => '11'],
            ['product_id' => '15', 'category_id' => '6'],
            ['product_id' => '16', 'category_id' => '9'],
            ['product_id' => '17', 'category_id' => '9'],
        ]);

        DB::table('shop_product_image')->insert([
            ['image' => '/data/product/img-32.jpg', 'product_id' => '1'],
            ['image' => '/data/product/img-33.jpg', 'product_id' => '1'],
            ['image' => '/data/product/img-22.jpg', 'product_id' => '11'],
            ['image' => '/data/product/img-23.jpg', 'product_id' => '2'],
            ['image' => '/data/product/img-14.jpg', 'product_id' => '11'],
            ['image' => '/data/product/img-12.jpg', 'product_id' => '5'],
            ['image' => '/data/product/img-11.jpg', 'product_id' => '5'],
            ['image' => '/data/product/img-9.jpg', 'product_id' => '2'],
            ['image' => '/data/product/img-19.jpg', 'product_id' => '2'],
            ['image' => '/data/product/img-21.jpg', 'product_id' => '9'],
            ['image' => '/data/product/img-22.jpg', 'product_id' => '8'],
            ['image' => '/data/product/img-20.jpg', 'product_id' => '7'],
            ['image' => '/data/product/img-26.jpg', 'product_id' => '7'],
            ['image' => '/data/product/img-27.jpg', 'product_id' => '5'],
            ['image' => '/data/product/img-40.jpg', 'product_id' => '4'],
            ['image' => '/data/product/img-14.jpg', 'product_id' => '15'],
            ['image' => '/data/product/img-23.jpg', 'product_id' => '15'],
            ['image' => '/data/product/img-12.jpg', 'product_id' => '17'],
            ['image' => '/data/product/img-11.jpg', 'product_id' => '17'],
            ['image' => '/data/product/img-32.jpg', 'product_id' => '17'],
        ]);

        DB::table('shop_product_attribute')->insert([
            ['name' => 'Blue', 'attribute_group_id' => '1', 'product_id' => '17', 'sort' => '0'],
            ['name' => 'White', 'attribute_group_id' => '1', 'product_id' => '17', 'sort' => '0'],
            ['name' => 'S', 'attribute_group_id' => '2', 'product_id' => '17', 'sort' => '0'],
            ['name' => 'XL', 'attribute_group_id' => '2', 'product_id' => '17', 'sort' => '0'],
            ['name' => 'Blue', 'attribute_group_id' => '1', 'product_id' => '10', 'sort' => '0'],
            ['name' => 'Red', 'attribute_group_id' => '1', 'product_id' => '10', 'sort' => '0'],
            ['name' => 'S', 'attribute_group_id' => '2', 'product_id' => '10', 'sort' => '0'],
            ['name' => 'M', 'attribute_group_id' => '2', 'product_id' => '10', 'sort' => '0'],
        ]);
        DB::table('shop_product_build')->insert([
            ['build_id' => '15', 'product_id' => '6', 'quantity' => '1'],
            ['build_id' => '15', 'product_id' => '7', 'quantity' => '2'],
        ]);

        DB::table('shop_product_group')->insert([
            ['group_id' => '16', 'product_id' => '1'],
            ['group_id' => '16', 'product_id' => '2'],
        ]);

        DB::table('shop_product_promotion')->insert([
            ['product_id' => '11', 'price_promotion' => '5000'],
            ['product_id' => '1', 'price_promotion' => '5000'],
        ]);
        DB::table('shop_attribute_group')->insert([
            ['name' => 'Color', 'status' => '1', 'sort' => '1', 'type' => 'radio'],
            ['name' => 'Size', 'status' => '1', 'sort' => '2', 'type' => 'select'],
        ]);
        DB::table('shop_brand')->insert([
            ['name' => 'Husq',  'alias'=> 'husq', 'image' => '/data/brand/01-181x52.png', 'url' => '', 'status' => '1', 'sort' => '0'],
            ['name' => 'Ideal',  'alias'=> 'ideal', 'image' => '/data/brand/02-181x52.png', 'url' => '', 'status' => '1', 'sort' => '0'],
            ['name' => 'Apex',  'alias'=> 'apex', 'image' => '/data/brand/03-181x52.png', 'url' => '', 'status' => '1', 'sort' => '0'],
            ['name' => 'CST',  'alias'=> 'cst', 'image' => '/data/brand/04-181x52.png', 'url' => '', 'status' => '1', 'sort' => '0'],
            ['name' => 'Klein',  'alias'=> 'klein', 'image' => '/data/brand/05-181x52.png', 'url' => '', 'status' => '1', 'sort' => '0'],
            ['name' => 'Metabo',  'alias'=> 'metabo', 'image' => '/data/brand/06-181x52.png', 'url' => '', 'status' => '1', 'sort' => '0'],
            ['name' => 'Avatar',  'alias'=> 'avatar', 'image' => '/data/brand/07-181x52.png', 'url' => '', 'status' => '1', 'sort' => '0'],
            ['name' => 'Brand KA',  'alias'=> 'brand-ka', 'image' => '/data/brand/08-181x52.png', 'url' => '', 'status' => '1', 'sort' => '0'],
        ]);
        DB::table('shop_category')->insert([
            ['id' => '1', 'alias'=> 'electronics', 'image' => '/data/category/img-40.jpg', 'parent' => '0', 'top' => '1', 'sort' => '0', 'status' => '1'],
            ['id' => '2', 'alias'=> 'clothing-wears', 'image' => '/data/category/img-44.jpg', 'parent' => '0', 'top' => '1', 'sort' => '0', 'status' => '1'],
            ['id' => '3', 'alias'=> 'mobile', 'image' => '/data/category/img-42.jpg', 'parent' => '1', 'top' => '1', 'sort' => '0', 'status' => '1'],
            ['id' => '4', 'alias'=> 'accessaries-extras', 'image' => '/data/category/img-18.jpg', 'parent' => '0', 'top' => '1', 'sort' => '0', 'status' => '1'],
            ['id' => '5', 'alias'=> 'computers', 'image' => '/data/category/img-14.jpg', 'parent' => '1', 'top' => '1', 'sort' => '0', 'status' => '1'],
            ['id' => '6', 'alias'=> 'tablets', 'image' => '/data/category/img-14.jpg', 'parent' => '1', 'top' => '0', 'sort' => '0', 'status' => '1'],
            ['id' => '7', 'alias'=> 'appliances', 'image' => '/data/category/img-40.jpg', 'parent' => '1', 'top' => '0', 'sort' => '0', 'status' => '1'],
            ['id' => '8', 'alias'=> 'men-clothing', 'image' => '/data/category/img-14.jpg', 'parent' => '2', 'top' => '0', 'sort' => '0', 'status' => '1'],
            ['id' => '9', 'alias'=> 'women-clothing', 'image' => '/data/category/img-18.jpg', 'parent' => '2', 'top' => '1', 'sort' => '0', 'status' => '1'],
            ['id' => '10', 'alias'=> 'kid-wear', 'image' => '/data/category/img-14.jpg', 'parent' => '2', 'top' => '0', 'sort' => '0', 'status' => '1'],
            ['id' => '11', 'alias'=> 'mobile-accessaries', 'image' => '/data/category/img-40.jpg', 'parent' => '4', 'top' => '0', 'sort' => '0', 'status' => '1'],
            ['id' => '12', 'alias'=> 'women-accessaries', 'image' => '/data/category/img-42.jpg4', 'parent' => '4', 'top' => '0', 'sort' => '3', 'status' => '1'],
            ['id' => '13', 'alias'=> 'men-accessaries', 'image' => '/data/category/img-40.jpg', 'parent' => '4', 'top' => '0', 'sort' => '3', 'status' => '1'],
        ]);
        DB::table('shop_category_description')->insert([
            ['category_id' => '1', 'lang' => 'en', 'name' => 'Electronics', 'keyword' => '', 'description' => ''],
            ['category_id' => '2', 'lang' => 'en', 'name' => 'Clothing & Wears', 'keyword' => '', 'description' => ''],
            ['category_id' => '3', 'lang' => 'en', 'name' => 'Mobile', 'keyword' => '', 'description' => ''],
            ['category_id' => '4', 'lang' => 'en', 'name' => 'Accessaries & Extras', 'keyword' => '', 'description' => ''],
            ['category_id' => '5', 'lang' => 'en', 'name' => 'Computers', 'keyword' => '', 'description' => ''],
            ['category_id' => '6', 'lang' => 'en', 'name' => 'Tablets', 'keyword' => '', 'description' => ''],
            ['category_id' => '7', 'lang' => 'en', 'name' => 'Appliances', 'keyword' => '', 'description' => ''],
            ['category_id' => '8', 'lang' => 'en', 'name' => 'Men\'s Clothing', 'keyword' => '', 'description' => ''],
            ['category_id' => '9', 'lang' => 'en', 'name' => 'Women\'s Clothing', 'keyword' => '', 'description' => ''],
            ['category_id' => '10', 'lang' => 'en', 'name' => 'Kid\'s Wear', 'keyword' => '', 'description' => ''],
            ['category_id' => '11', 'lang' => 'en', 'name' => 'Mobile Accessaries', 'keyword' => '', 'description' => ''],
            ['category_id' => '12', 'lang' => 'en', 'name' => 'Women\'s Accessaries', 'keyword' => '', 'description' => ''],
            ['category_id' => '13', 'lang' => 'en', 'name' => 'Men\'s Accessaries', 'keyword' => '', 'description' => ''],

            ['category_id' => '1', 'lang' => 'vi', 'name' => 'Thiết bị điện tử', 'keyword' => '', 'description' => ''],
            ['category_id' => '2', 'lang' => 'vi', 'name' => 'Quần áo', 'keyword' => '', 'description' => ''],
            ['category_id' => '3', 'lang' => 'vi', 'name' => 'Điện thoại', 'keyword' => '', 'description' => ''],
            ['category_id' => '4', 'lang' => 'vi', 'name' => 'Phụ kiện ', 'keyword' => '', 'description' => ''],
            ['category_id' => '5', 'lang' => 'vi', 'name' => 'Máy tính', 'keyword' => '', 'description' => ''],
            ['category_id' => '6', 'lang' => 'vi', 'name' => 'Máy tính bảng', 'keyword' => '', 'description' => ''],
            ['category_id' => '7', 'lang' => 'vi', 'name' => 'Thiết bị', 'keyword' => '', 'description' => ''],
            ['category_id' => '8', 'lang' => 'vi', 'name' => 'Quần áo nam', 'keyword' => '', 'description' => ''],
            ['category_id' => '9', 'lang' => 'vi', 'name' => 'Quần áo nữ', 'keyword' => '', 'description' => ''],
            ['category_id' => '10', 'lang' => 'vi', 'name' => 'Đồ trẻ em', 'keyword' => '', 'description' => ''],
            ['category_id' => '11', 'lang' => 'vi', 'name' => 'Phụ kiện điện thoại', 'keyword' => '', 'description' => ''],
            ['category_id' => '12', 'lang' => 'vi', 'name' => 'Phụ kiện nam', 'keyword' => '', 'description' => ''],
            ['category_id' => '13', 'lang' => 'vi', 'name' => 'Phụ kiện nữ', 'keyword' => '', 'description' => ''],
        ]);

        DB::table('shop_currency')->insert([
            ['id' => '1', 'name' => 'USD Dola', 'code' => 'USD', 'symbol' => '$', 'exchange_rate' => '1', 'precision' => '0', 'symbol_first' => '1', 'thousands' => ',', 'status' => '1', 'sort' => '0'],
            ['id' => '2', 'name' => 'VietNam Dong', 'code' => 'VND', 'symbol' => '₫', 'exchange_rate' => '20', 'precision' => '0', 'symbol_first' => '0', 'thousands' => ',', 'status' => '1', 'sort' => '1'],
        ]);

        DB::table('shop_order_status')->insert([
            ['id' => '1', 'name' => 'New'],
            ['id' => '2', 'name' => 'Processing'],
            ['id' => '3', 'name' => 'Hold'],
            ['id' => '4', 'name' => 'Canceled'],
            ['id' => '5', 'name' => 'Done'],
            ['id' => '6', 'name' => 'Failed'],
        ]);
        DB::table('shop_page')->insert([
            ['id' => '1', 'image' => '', 'alias' => 'about', 'status' => '1'],
            ['id' => '2', 'image' => '', 'alias' => 'contact', 'status' => '1'],
        ]);
        DB::table('shop_page_description')->insert([
            ['page_id' => '1', 'lang' => 'en', 'title' => 'About', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
', ],
            ['page_id' => '1', 'lang' => 'vi', 'title' => 'Giới thiệu', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
', ],
            ['page_id' => '2', 'lang' => 'en', 'title' => 'Contact', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
', ],
            ['page_id' => '2', 'lang' => 'vi', 'title' => 'Liên hệ với chúng tôi', 'keyword' => '', 'description' => '', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt="" src="/data/product/img-21.jpg" style="width: 262px; height: 262px; float: right; margin: 10px;" /></p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
', ],
        ]);

        DB::table('shop_payment_status')->insert([
            ['id' => '1', 'name' => 'Unpaid'],
            ['id' => '2', 'name' => 'Partial payment'],
            ['id' => '3', 'name' => 'Paid'],
            ['id' => '4', 'name' => 'Refurn'],
        ]);

        DB::table('shop_shipping_status')->insert([
            ['id' => '1', 'name' => 'Not sent'],
            ['id' => '2', 'name' => 'Sending'],
            ['id' => '3', 'name' => 'Shipping done'],
        ]);

        DB::table('shop_shipping')->insert([
            ['type' => '0', 'value' => '20000', 'free' => '10000000', 'status' => '1'],
        ]);

        DB::table('shop_vendor')->insert([
            ['id' => '1', 'alias' => 'abc-distributor',  'name' => 'ABC distributor', 'email' => 'abc@abc.com', 'phone' => '012496657567', 'image' => '/data/vendor/vendor.png', 'address' => '', 'url' => '', 'sort' => '0'],
        ]);

        DB::table('shop_user')->insert([
            ['id' => '1', 'first_name' => 'Naruto', 'last_name' => 'Kun', 'email' => 'test@test.com', 'password' => bcrypt(123), 'address1' => 'HCM', 'address2' => 'HCM city', 'phone' => '0667151172', 'postcode' => 70000, 'company' => 'KTC', 'country' => 'VN', 'created_at' => date('Y-m-d H:i:s')],
        ]);

        DB::table('shop_order')->insert([
            ['id' => '1', 'user_id' => '1', 'subtotal' => '5000', 'shipping' => '2000', 'discount' => '0', 'payment_status' => '1', 'shipping_status' => '1', 'status' => '1', 'tax' => '0', 'total' => '7000', 'currency' => 'USD', 'exchange_rate' => '1', 'received' => '0', 'balance' => '7000', 'first_name' => 'Naruto', 'last_name' => 'Kun', 'address1' => 'ADDRESS 1', 'address2' => 'ADDRESS 2', 'country' => 'VN', 'phone' => '667151172', 'email' => 'test@test.com', 'comment' => 'ok', 'payment_method' => 'Cash', 'shipping_method' => 'ShippingStandard', 'created_at' => date('Y-m-d H:i:s')],
        ]);

        DB::table('shop_order_detail')->insert([
            ['id' => '1', 'order_id' => '1', 'product_id' => '1', 'name' => 'Easy Polo Black Edition 1', 'price' => '5000', 'qty' => '1', 'total_price' => '5000', 'sku' => 'ABCZZ', 'currency' => 'USD', 'exchange_rate' => '1.00', 'attribute' => '[]'],
        ]);

        DB::table('shop_order_history')->insert([
            ['id' => '1', 'order_id' => '1', 'content' => 'New order', 'admin_id' => '0', 'user_id' => '1', 'order_status_id' => '1', 'add_date' => date('Y-m-d H:i:s')],
        ]);

        DB::table('shop_order_total')->insert([
            ['order_id' => '1', 'code' => 'subtotal', 'title' => 'Subtotal', 'value' => '5000', 'sort' => '1'],
            ['order_id' => '1', 'code' => 'shipping', 'title' => 'Shipping', 'value' => '2000', 'sort' => '10'],
            ['order_id' => '1', 'code' => 'discount', 'title' => 'Discount', 'value' => '0', 'sort' => '20'],
            ['order_id' => '1', 'code' => 'total', 'title' => 'Total', 'value' => '7000', 'sort' => '100'],
            ['order_id' => '1', 'code' => 'received', 'title' => 'Received', 'value' => '0', 'sort' => '200'],
        ]);

        DB::table('shop_country')->insert([
            ['code' => 'AL', 'name' => 'Albania'],
            ['code' => 'DZ', 'name' => 'Algeria'],
            ['code' => 'DS', 'name' => 'American Samoa'],
            ['code' => 'AD', 'name' => 'Andorra'],
            ['code' => 'AO', 'name' => 'Angola'],
            ['code' => 'AI', 'name' => 'Anguilla'],
            ['code' => 'AQ', 'name' => 'Antarctica'],
            ['code' => 'AG', 'name' => 'Antigua and Barbuda'],
            ['code' => 'AR', 'name' => 'Argentina'],
            ['code' => 'AM', 'name' => 'Armenia'],
            ['code' => 'AW', 'name' => 'Aruba'],
            ['code' => 'AU', 'name' => 'Australia'],
            ['code' => 'AT', 'name' => 'Austria'],
            ['code' => 'AZ', 'name' => 'Azerbaijan'],
            ['code' => 'BS', 'name' => 'Bahamas'],
            ['code' => 'BH', 'name' => 'Bahrain'],
            ['code' => 'BD', 'name' => 'Bangladesh'],
            ['code' => 'BB', 'name' => 'Barbados'],
            ['code' => 'BY', 'name' => 'Belarus'],
            ['code' => 'BE', 'name' => 'Belgium'],
            ['code' => 'BZ', 'name' => 'Belize'],
            ['code' => 'BJ', 'name' => 'Benin'],
            ['code' => 'BM', 'name' => 'Bermuda'],
            ['code' => 'BT', 'name' => 'Bhutan'],
            ['code' => 'BO', 'name' => 'Bolivia'],
            ['code' => 'BA', 'name' => 'Bosnia and Herzegovina'],
            ['code' => 'BW', 'name' => 'Botswana'],
            ['code' => 'BV', 'name' => 'Bouvet Island'],
            ['code' => 'BR', 'name' => 'Brazil'],
            ['code' => 'IO', 'name' => 'British Indian Ocean Territory'],
            ['code' => 'BN', 'name' => 'Brunei Darussalam'],
            ['code' => 'BG', 'name' => 'Bulgaria'],
            ['code' => 'BF', 'name' => 'Burkina Faso'],
            ['code' => 'BI', 'name' => 'Burundi'],
            ['code' => 'KH', 'name' => 'Cambodia'],
            ['code' => 'CM', 'name' => 'Cameroon'],
            ['code' => 'CA', 'name' => 'Canada'],
            ['code' => 'CV', 'name' => 'Cape Verde'],
            ['code' => 'KY', 'name' => 'Cayman Islands'],
            ['code' => 'CF', 'name' => 'Central African Republic'],
            ['code' => 'TD', 'name' => 'Chad'],
            ['code' => 'CL', 'name' => 'Chile'],
            ['code' => 'CN', 'name' => 'China'],
            ['code' => 'CX', 'name' => 'Christmas Island'],
            ['code' => 'CC', 'name' => 'Cocos (Keeling) Islands'],
            ['code' => 'CO', 'name' => 'Colombia'],
            ['code' => 'KM', 'name' => 'Comoros'],
            ['code' => 'CG', 'name' => 'Congo'],
            ['code' => 'CK', 'name' => 'Cook Islands'],
            ['code' => 'CR', 'name' => 'Costa Rica'],
            ['code' => 'HR', 'name' => 'Croatia (Hrvatska)'],
            ['code' => 'CU', 'name' => 'Cuba'],
            ['code' => 'CY', 'name' => 'Cyprus'],
            ['code' => 'CZ', 'name' => 'Czech Republic'],
            ['code' => 'DK', 'name' => 'Denmark'],
            ['code' => 'DJ', 'name' => 'Djibouti'],
            ['code' => 'DM', 'name' => 'Dominica'],
            ['code' => 'DO', 'name' => 'Dominican Republic'],
            ['code' => 'TP', 'name' => 'East Timor'],
            ['code' => 'EC', 'name' => 'Ecuador'],
            ['code' => 'EG', 'name' => 'Egypt'],
            ['code' => 'SV', 'name' => 'El Salvador'],
            ['code' => 'GQ', 'name' => 'Equatorial Guinea'],
            ['code' => 'ER', 'name' => 'Eritrea'],
            ['code' => 'EE', 'name' => 'Estonia'],
            ['code' => 'ET', 'name' => 'Ethiopia'],
            ['code' => 'FK', 'name' => 'Falkland Islands (Malvinas)'],
            ['code' => 'FO', 'name' => 'Faroe Islands'],
            ['code' => 'FJ', 'name' => 'Fiji'],
            ['code' => 'FI', 'name' => 'Finland'],
            ['code' => 'FR', 'name' => 'France'],
            ['code' => 'FX', 'name' => 'France, Metropolitan'],
            ['code' => 'GF', 'name' => 'French Guiana'],
            ['code' => 'PF', 'name' => 'French Polynesia'],
            ['code' => 'TF', 'name' => 'French Southern Territories'],
            ['code' => 'GA', 'name' => 'Gabon'],
            ['code' => 'GM', 'name' => 'Gambia'],
            ['code' => 'GE', 'name' => 'Georgia'],
            ['code' => 'DE', 'name' => 'Germany'],
            ['code' => 'GH', 'name' => 'Ghana'],
            ['code' => 'GI', 'name' => 'Gibraltar'],
            ['code' => 'GK', 'name' => 'Guernsey'],
            ['code' => 'GR', 'name' => 'Greece'],
            ['code' => 'GL', 'name' => 'Greenland'],
            ['code' => 'GD', 'name' => 'Grenada'],
            ['code' => 'GP', 'name' => 'Guadeloupe'],
            ['code' => 'GU', 'name' => 'Guam'],
            ['code' => 'GT', 'name' => 'Guatemala'],
            ['code' => 'GN', 'name' => 'Guinea'],
            ['code' => 'GW', 'name' => 'Guinea-Bissau'],
            ['code' => 'GY', 'name' => 'Guyana'],
            ['code' => 'HT', 'name' => 'Haiti'],
            ['code' => 'HM', 'name' => 'Heard and Mc Donald Islands'],
            ['code' => 'HN', 'name' => 'Honduras'],
            ['code' => 'HK', 'name' => 'Hong Kong'],
            ['code' => 'HU', 'name' => 'Hungary'],
            ['code' => 'IS', 'name' => 'Iceland'],
            ['code' => 'IN', 'name' => 'India'],
            ['code' => 'IM', 'name' => 'Isle of Man'],
            ['code' => 'ID', 'name' => 'Indonesia'],
            ['code' => 'IR', 'name' => 'Iran (Islamic Republic of)'],
            ['code' => 'IQ', 'name' => 'Iraq'],
            ['code' => 'IE', 'name' => 'Ireland'],
            ['code' => 'IL', 'name' => 'Israel'],
            ['code' => 'IT', 'name' => 'Italy'],
            ['code' => 'CI', 'name' => 'Ivory Coast'],
            ['code' => 'JE', 'name' => 'Jersey'],
            ['code' => 'JM', 'name' => 'Jamaica'],
            ['code' => 'JP', 'name' => 'Japan'],
            ['code' => 'JO', 'name' => 'Jordan'],
            ['code' => 'KZ', 'name' => 'Kazakhstan'],
            ['code' => 'KE', 'name' => 'Kenya'],
            ['code' => 'KI', 'name' => 'Kiribati'],
            ['code' => 'KP', 'name' => 'Korea,Democratic People\'s Republic of'],
            ['code' => 'KR', 'name' => 'Korea, Republic of'],
            ['code' => 'XK', 'name' => 'Kosovo'],
            ['code' => 'KW', 'name' => 'Kuwait'],
            ['code' => 'KG', 'name' => 'Kyrgyzstan'],
            ['code' => 'LA', 'name' => 'Lao People\'s Democratic Republic'],
            ['code' => 'LV', 'name' => 'Latvia'],
            ['code' => 'LB', 'name' => 'Lebanon'],
            ['code' => 'LS', 'name' => 'Lesotho'],
            ['code' => 'LR', 'name' => 'Liberia'],
            ['code' => 'LY', 'name' => 'Libyan Arab Jamahiriya'],
            ['code' => 'LI', 'name' => 'Liechtenstein'],
            ['code' => 'LT', 'name' => 'Lithuania'],
            ['code' => 'LU', 'name' => 'Luxembourg'],
            ['code' => 'MO', 'name' => 'Macau'],
            ['code' => 'MK', 'name' => 'Macedonia'],
            ['code' => 'MG', 'name' => 'Madagascar'],
            ['code' => 'MW', 'name' => 'Malawi'],
            ['code' => 'MY', 'name' => 'Malaysia'],
            ['code' => 'MV', 'name' => 'Maldives'],
            ['code' => 'ML', 'name' => 'Mali'],
            ['code' => 'MT', 'name' => 'Malta'],
            ['code' => 'MH', 'name' => 'Marshall Islands'],
            ['code' => 'MQ', 'name' => 'Martinique'],
            ['code' => 'MR', 'name' => 'Mauritania'],
            ['code' => 'MU', 'name' => 'Mauritius'],
            ['code' => 'TY', 'name' => 'Mayotte'],
            ['code' => 'MX', 'name' => 'Mexico'],
            ['code' => 'FM', 'name' => 'Micronesia, Federated States of'],
            ['code' => 'MD', 'name' => 'Moldova, Republic of'],
            ['code' => 'MC', 'name' => 'Monaco'],
            ['code' => 'MN', 'name' => 'Mongolia'],
            ['code' => 'ME', 'name' => 'Montenegro'],
            ['code' => 'MS', 'name' => 'Montserrat'],
            ['code' => 'MA', 'name' => 'Morocco'],
            ['code' => 'MZ', 'name' => 'Mozambique'],
            ['code' => 'MM', 'name' => 'Myanmar'],
            ['code' => 'NA', 'name' => 'Namibia'],
            ['code' => 'NR', 'name' => 'Nauru'],
            ['code' => 'NP', 'name' => 'Nepal'],
            ['code' => 'NL', 'name' => 'Netherlands'],
            ['code' => 'AN', 'name' => 'Netherlands Antilles'],
            ['code' => 'NC', 'name' => 'New Caledonia'],
            ['code' => 'NZ', 'name' => 'New Zealand'],
            ['code' => 'NI', 'name' => 'Nicaragua'],
            ['code' => 'NE', 'name' => 'Niger'],
            ['code' => 'NG', 'name' => 'Nigeria'],
            ['code' => 'NU', 'name' => 'Niue'],
            ['code' => 'NF', 'name' => 'Norfolk Island'],
            ['code' => 'MP', 'name' => 'Northern Mariana Islands'],
            ['code' => 'NO', 'name' => 'Norway'],
            ['code' => 'OM', 'name' => 'Oman'],
            ['code' => 'PK', 'name' => 'Pakistan'],
            ['code' => 'PW', 'name' => 'Palau'],
            ['code' => 'PS', 'name' => 'Palestine'],
            ['code' => 'PA', 'name' => 'Panama'],
            ['code' => 'PG', 'name' => 'Papua New Guinea'],
            ['code' => 'PY', 'name' => 'Paraguay'],
            ['code' => 'PE', 'name' => 'Peru'],
            ['code' => 'PH', 'name' => 'Philippines'],
            ['code' => 'PN', 'name' => 'Pitcairn'],
            ['code' => 'PL', 'name' => 'Poland'],
            ['code' => 'PT', 'name' => 'Portugal'],
            ['code' => 'PR', 'name' => 'Puerto Rico'],
            ['code' => 'QA', 'name' => 'Qatar'],
            ['code' => 'RE', 'name' => 'Reunion'],
            ['code' => 'RO', 'name' => 'Romania'],
            ['code' => 'RU', 'name' => 'Russian Federation'],
            ['code' => 'RW', 'name' => 'Rwanda'],
            ['code' => 'KN', 'name' => 'Saint Kitts and Nevis'],
            ['code' => 'LC', 'name' => 'Saint Lucia'],
            ['code' => 'VC', 'name' => 'Saint Vincent and the Grenadines'],
            ['code' => 'WS', 'name' => 'Samoa'],
            ['code' => 'SM', 'name' => 'San Marino'],
            ['code' => 'ST', 'name' => 'Sao Tome and Principe'],
            ['code' => 'SA', 'name' => 'Saudi Arabia'],
            ['code' => 'SN', 'name' => 'Senegal'],
            ['code' => 'RS', 'name' => 'Serbia'],
            ['code' => 'SC', 'name' => 'Seychelles'],
            ['code' => 'SL', 'name' => 'Sierra Leone'],
            ['code' => 'SG', 'name' => 'Singapore'],
            ['code' => 'SK', 'name' => 'Slovakia'],
            ['code' => 'SI', 'name' => 'Slovenia'],
            ['code' => 'SB', 'name' => 'Solomon Islands'],
            ['code' => 'SO', 'name' => 'Somalia'],
            ['code' => 'ZA', 'name' => 'South Africa'],
            ['code' => 'GS', 'name' => 'South Georgia South Sandwich Islands'],
            ['code' => 'SS', 'name' => 'South Sudan'],
            ['code' => 'ES', 'name' => 'Spain'],
            ['code' => 'LK', 'name' => 'Sri Lanka'],
            ['code' => 'SH', 'name' => 'St. Helena'],
            ['code' => 'PM', 'name' => 'St. Pierre and Miquelon'],
            ['code' => 'SD', 'name' => 'Sudan'],
            ['code' => 'SR', 'name' => 'Suriname'],
            ['code' => 'SJ', 'name' => 'Svalbard and Jan Mayen Islands'],
            ['code' => 'SZ', 'name' => 'Swaziland'],
            ['code' => 'SE', 'name' => 'Sweden'],
            ['code' => 'CH', 'name' => 'Switzerland'],
            ['code' => 'SY', 'name' => 'Syrian Arab Republic'],
            ['code' => 'TW', 'name' => 'Taiwan'],
            ['code' => 'TJ', 'name' => 'Tajikistan'],
            ['code' => 'TZ', 'name' => 'Tanzania, United Republic of'],
            ['code' => 'TH', 'name' => 'Thailand'],
            ['code' => 'TG', 'name' => 'Togo'],
            ['code' => 'TK', 'name' => 'Tokelau'],
            ['code' => 'TO', 'name' => 'Tonga'],
            ['code' => 'TT', 'name' => 'Trinidad and Tobago'],
            ['code' => 'TN', 'name' => 'Tunisia'],
            ['code' => 'TR', 'name' => 'Turkey'],
            ['code' => 'TM', 'name' => 'Turkmenistan'],
            ['code' => 'TC', 'name' => 'Turks and Caicos Islands'],
            ['code' => 'TV', 'name' => 'Tuvalu'],
            ['code' => 'UG', 'name' => 'Uganda'],
            ['code' => 'UA', 'name' => 'Ukraine'],
            ['code' => 'AE', 'name' => 'United Arab Emirates'],
            ['code' => 'GB', 'name' => 'United Kingdom'],
            ['code' => 'US', 'name' => 'United States'],
            ['code' => 'UM', 'name' => 'United States minor outlying islands'],
            ['code' => 'UY', 'name' => 'Uruguay'],
            ['code' => 'UZ', 'name' => 'Uzbekistan'],
            ['code' => 'VU', 'name' => 'Vanuatu'],
            ['code' => 'VA', 'name' => 'Vatican City State'],
            ['code' => 'VE', 'name' => 'Venezuela'],
            ['code' => 'VN', 'name' => 'Vietnam'],
            ['code' => 'VG', 'name' => 'Virgin Islands (British)'],
            ['code' => 'VI', 'name' => 'Virgin Islands (U.S.)'],
            ['code' => 'WF', 'name' => 'Wallis and Futuna Islands'],
            ['code' => 'EH', 'name' => 'Western Sahara'],
            ['code' => 'YE', 'name' => 'Yemen'],
            ['code' => 'ZR', 'name' => 'Zaire'],
            ['code' => 'ZM', 'name' => 'Zambia'],
            ['code' => 'ZW', 'name' => 'Zimbabwe'],

        ]);

    }

}
