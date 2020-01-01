<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('admin_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 100)->unique();
            $table->string('password', 60);
            $table->string('name', 100);
            $table->string('avatar', 255)->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('admin_role', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->timestamps();
        });

        Schema::create('admin_permission', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->text('http_uri')->nullable();
            $table->timestamps();

        });

        Schema::create('admin_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->integer('sort')->default(0);
            $table->string('title', 50);
            $table->string('icon', 50);
            $table->string('uri', 255)->nullable();
            $table->integer('type')->default(0);
            $table->string('permission')->nullable();

            $table->timestamps();
        });

        Schema::create('admin_role_user', function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('user_id');
            $table->index(['role_id', 'user_id']);
            $table->timestamps();
        });

        Schema::create('admin_role_permission', function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('permission_id');
            $table->index(['role_id', 'permission_id']);
            $table->timestamps();
            $table->primary(['role_id', 'permission_id']);
        });

        Schema::create('admin_role_menu', function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('menu_id');
            $table->index(['role_id', 'menu_id']);
            $table->timestamps();
            $table->primary(['role_id', 'menu_id']);
        });

        Schema::create('admin_menu_permission', function (Blueprint $table) {
            $table->integer('menu_id');
            $table->integer('permission_id');
            $table->index(['menu_id', 'permission_id']);
            $table->timestamps();
            $table->primary(['menu_id', 'permission_id']);
        });

        Schema::create('admin_user_permission', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('permission_id');
            $table->index(['user_id', 'permission_id']);
            $table->timestamps();
            $table->primary(['user_id', 'permission_id']);
        });

        Schema::create('admin_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('path');
            $table->string('method', 10);
            $table->string('ip');
            $table->string('user_agent')->nullable();
            $table->text('input');
            $table->index('user_id');
            $table->timestamps();
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
        Schema::dropIfExists('admin_user');
        Schema::dropIfExists('admin_role');
        Schema::dropIfExists('admin_permission');
        Schema::dropIfExists('admin_menu');
        Schema::dropIfExists('admin_user_permission');
        Schema::dropIfExists('admin_role_user');
        Schema::dropIfExists('admin_role_permission');
        Schema::dropIfExists('admin_role_menu');
        Schema::dropIfExists('admin_menu_permission');
        Schema::dropIfExists('admin_log');
    }

    public function importData()
    {
        DB::table('admin_menu')->insert([
            ['id' => 1, 'parent_id' => 6, 'sort' => 11, 'title' => 'lang::admin.menu_titles.order_manager', 'icon' => 'fa-cart-arrow-down', 'uri' => '', 'type' => 0],
            ['id' => 2, 'parent_id' => 6, 'sort' => 12, 'title' => 'lang::admin.menu_titles.catalog_mamager', 'icon' => 'fa-folder-open', 'uri' => '', 'type' => 0],
            ['id' => 3, 'parent_id' => 6, 'sort' => 13, 'title' => 'lang::admin.menu_titles.customer_manager', 'icon' => 'fa-group', 'uri' => '', 'type' => 0],
            ['id' => 4, 'parent_id' => 8, 'sort' => 201, 'title' => 'lang::admin.menu_titles.template_layout', 'icon' => 'fa-object-ungroup', 'uri' => '', 'type' => 0],
            ['id' => 5, 'parent_id' => 9, 'sort' => 301, 'title' => 'lang::admin.menu_titles.config_manager', 'icon' => 'fa-cogs', 'uri' => '', 'type' => 0],
            ['id' => 6, 'parent_id' => 0, 'sort' => 10, 'title' => 'lang::ADMIN SHOP', 'icon' => 'fa-minus', 'uri' => '', 'type' => 0],
            ['id' => 7, 'parent_id' => 0, 'sort' => 100, 'title' => 'lang::ADMIN CONTENT', 'icon' => 'fa-minus', 'uri' => '', 'type' => 0],
            ['id' => 8, 'parent_id' => 0, 'sort' => 200, 'title' => 'lang::ADMIN EXTENSION', 'icon' => 'fa-minus', 'uri' => '', 'type' => 0],
            ['id' => 9, 'parent_id' => 0, 'sort' => 300, 'title' => 'lang::ADMIN SYSTEM', 'icon' => 'fa-minus', 'uri' => '', 'type' => 0],
            ['id' => 10, 'parent_id' => 7, 'sort' => 102, 'title' => 'lang::page.admin.title', 'icon' => 'fa-clone', 'uri' => 'admin::page', 'type' => 0],
            ['id' => 11, 'parent_id' => 1, 'sort' => 6, 'title' => 'lang::shipping_status.admin.title', 'icon' => 'fa-truck', 'uri' => 'admin::shipping_status', 'type' => 0],
            ['id' => 12, 'parent_id' => 1, 'sort' => 3, 'title' => 'lang::order.admin.title', 'icon' => 'fa-shopping-cart', 'uri' => 'admin::order', 'type' => 0],
            ['id' => 13, 'parent_id' => 1, 'sort' => 4, 'title' => 'lang::order_status.admin.title', 'icon' => 'fa-asterisk', 'uri' => 'admin::order_status', 'type' => 0],
            ['id' => 14, 'parent_id' => 1, 'sort' => 5, 'title' => 'lang::payment_status.admin.title', 'icon' => 'fa-recycle', 'uri' => 'admin::payment_status', 'type' => 0],
            ['id' => 15, 'parent_id' => 2, 'sort' => 0, 'title' => 'lang::category.admin.title', 'icon' => 'fa-folder-open-o', 'uri' => 'admin::category', 'type' => 0],
            ['id' => 16, 'parent_id' => 2, 'sort' => 0, 'title' => 'lang::product.admin.title', 'icon' => 'fa-file-photo-o', 'uri' => 'admin::product', 'type' => 0],
            ['id' => 17, 'parent_id' => 2, 'sort' => 0, 'title' => 'lang::vendor.admin.title', 'icon' => 'fa-user-secret', 'uri' => 'admin::vendor', 'type' => 0],
            ['id' => 18, 'parent_id' => 2, 'sort' => 0, 'title' => 'lang::brand.admin.title', 'icon' => 'fa-bank', 'uri' => 'admin::brand', 'type' => 0],
            ['id' => 19, 'parent_id' => 2, 'sort' => 0, 'title' => 'lang::attribute_group.admin.title', 'icon' => 'fa-bars', 'uri' => 'admin::attribute_group', 'type' => 0],
            ['id' => 20, 'parent_id' => 3, 'sort' => 0, 'title' => 'lang::customer.admin.title', 'icon' => 'fa-user', 'uri' => 'admin::customer', 'type' => 0],
            ['id' => 21, 'parent_id' => 3, 'sort' => 0, 'title' => 'lang::subscribe.admin.title', 'icon' => 'fa-user-circle-o', 'uri' => 'admin::subscribe', 'type' => 0],
            ['id' => 22, 'parent_id' => 4, 'sort' => 0, 'title' => 'lang::block_content.admin.title', 'icon' => 'fa-newspaper-o', 'uri' => 'admin::block_content', 'type' => 0],
            ['id' => 23, 'parent_id' => 4, 'sort' => 0, 'title' => 'lang::link.admin.title', 'icon' => 'fa-chrome', 'uri' => 'admin::link', 'type' => 0],
            ['id' => 24, 'parent_id' => 4, 'sort' => 0, 'title' => 'lang::template.admin.title', 'icon' => 'fa-columns', 'uri' => 'admin::template', 'type' => 0],
            ['id' => 25, 'parent_id' => 5, 'sort' => 2, 'title' => 'lang::store_value.admin.title', 'icon' => 'fa-code', 'uri' => 'admin::store_value', 'type' => 0],
            ['id' => 26, 'parent_id' => 5, 'sort' => 1, 'title' => 'lang::store_info.admin.title', 'icon' => 'fa-h-square', 'uri' => 'admin::store_info', 'type' => 0],
            ['id' => 27, 'parent_id' => 5, 'sort' => 4, 'title' => 'lang::admin.menu_titles.email_setting', 'icon' => 'fa-envelope', 'uri' => '', 'type' => 0],
            ['id' => 28, 'parent_id' => 27, 'sort' => 0, 'title' => 'lang::email.admin.title', 'icon' => 'fa-cog', 'uri' => 'admin::email', 'type' => 0],
            ['id' => 29, 'parent_id' => 27, 'sort' => 0, 'title' => 'lang::email_template.admin.title', 'icon' => 'fa-bars', 'uri' => 'admin::email_template', 'type' => 0],
            ['id' => 30, 'parent_id' => 5, 'sort' => 5, 'title' => 'lang::admin.menu_titles.localisation', 'icon' => 'fa-shirtsinbulk', 'uri' => '', 'type' => 0],
            ['id' => 31, 'parent_id' => 30, 'sort' => 0, 'title' => 'lang::language.admin.title', 'icon' => 'fa-pagelines', 'uri' => 'admin::language', 'type' => 0],
            ['id' => 32, 'parent_id' => 30, 'sort' => 0, 'title' => 'lang::currency.admin.title', 'icon' => 'fa-dollar', 'uri' => 'admin::currency', 'type' => 0],
            ['id' => 33, 'parent_id' => 7, 'sort' => 101, 'title' => 'lang::banner.admin.title', 'icon' => 'fa-image', 'uri' => 'admin::banner', 'type' => 0],
            ['id' => 34, 'parent_id' => 5, 'sort' => 5, 'title' => 'lang::backup.admin.title', 'icon' => 'fa-save', 'uri' => 'admin::backup', 'type' => 0],
            ['id' => 35, 'parent_id' => 8, 'sort' => 202, 'title' => 'lang::admin.menu_titles.extensions', 'icon' => 'fa-puzzle-piece', 'uri' => '', 'type' => 0],
            ['id' => 36, 'parent_id' => 8, 'sort' => 202, 'title' => 'lang::admin.menu_titles.modules', 'icon' => 'fa-codepen', 'uri' => '', 'type' => 0],
            ['id' => 37, 'parent_id' => 9, 'sort' => 302, 'title' => 'lang::admin.menu_titles.report_manager', 'icon' => 'fa-pie-chart', 'uri' => '', 'type' => 0],
            ['id' => 38, 'parent_id' => 9, 'sort' => 0, 'title' => 'lang::admin.menu_titles.admin', 'icon' => 'fa-sitemap', 'uri' => '', 'type' => 0],
            ['id' => 39, 'parent_id' => 35, 'sort' => 0, 'title' => 'admin.extension_manager.Payment', 'icon' => 'fa-money', 'uri' => 'admin::extension/payment', 'type' => 0],
            ['id' => 40, 'parent_id' => 35, 'sort' => 0, 'title' => 'admin.extension_manager.Shipping', 'icon' => 'fa-ambulance', 'uri' => 'admin::extension/shipping', 'type' => 0],
            ['id' => 41, 'parent_id' => 35, 'sort' => 0, 'title' => 'admin.extension_manager.Total', 'icon' => 'fa-cog', 'uri' => 'admin::extension/total', 'type' => 0],
            ['id' => 42, 'parent_id' => 35, 'sort' => 0, 'title' => 'admin.extension_manager.Other', 'icon' => 'fa-circle-thin', 'uri' => 'admin::extension/other', 'type' => 0],
            ['id' => 43, 'parent_id' => 36, 'sort' => 0, 'title' => 'admin.module_manager.Cms', 'icon' => 'fa-modx', 'uri' => 'admin::module/cms', 'type' => 0],
            ['id' => 44, 'parent_id' => 36, 'sort' => 0, 'title' => 'admin.module_manager.Block', 'icon' => 'fa-bars', 'uri' => 'admin::module/block', 'type' => 0],
            ['id' => 45, 'parent_id' => 36, 'sort' => 0, 'title' => 'admin.module_manager.Other', 'icon' => 'fa-bars', 'uri' => 'admin::module/other', 'type' => 0],
            ['id' => 46, 'parent_id' => 38, 'sort' => 0, 'title' => 'lang::admin.menu_titles.users', 'icon' => 'fa-users', 'uri' => 'admin::user', 'type' => 0],
            ['id' => 47, 'parent_id' => 38, 'sort' => 0, 'title' => 'lang::admin.menu_titles.roles', 'icon' => 'fa-user', 'uri' => 'admin::role', 'type' => 0],
            ['id' => 48, 'parent_id' => 38, 'sort' => 0, 'title' => 'lang::admin.menu_titles.permission', 'icon' => 'fa-ban', 'uri' => 'admin::permission', 'type' => 0],
            ['id' => 49, 'parent_id' => 38, 'sort' => 0, 'title' => 'lang::admin.menu_titles.menu', 'icon' => 'fa-bars', 'uri' => 'admin::menu', 'type' => 0],
            ['id' => 50, 'parent_id' => 38, 'sort' => 0, 'title' => 'lang::admin.menu_titles.operation_log', 'icon' => 'fa-history', 'uri' => 'admin::log', 'type' => 0],
            ['id' => 51, 'parent_id' => 9, 'sort' => 302, 'title' => 'lang::admin.menu_titles.api_manager', 'icon' => 'fa-plug', 'uri' => '', 'type' => 0],
            ['id' => 52, 'parent_id' => 7, 'sort' => 103, 'title' => 'lang::news.admin.title', 'icon' => 'fa-file-powerpoint-o', 'uri' => 'admin::news', 'type' => 0],
            ['id' => 53, 'parent_id' => 5, 'sort' => 3, 'title' => 'lang::env.title', 'icon' => 'fa-cog', 'uri' => 'admin::env', 'type' => 0],
            ['id' => 54, 'parent_id' => 37, 'sort' => 0, 'title' => 'lang::admin.menu_titles.report_product', 'icon' => 'fa-bars', 'uri' => 'admin::report/product', 'type' => 0],
            ['id' => 55, 'parent_id' => 5, 'sort' => 2, 'title' => 'lang::product.config_manager.title', 'icon' => 'fa-product-hunt', 'uri' => 'admin::product_config', 'type' => 0],
            ['id' => 56, 'parent_id' => 5, 'sort' => 2, 'title' => 'lang::customer.config_manager.title', 'icon' => 'fa-address-card-o', 'uri' => 'admin::customer_config', 'type' => 0],
            ['id' => 57, 'parent_id' => 5, 'sort' => 2, 'title' => 'lang::link.config_manager.title', 'icon' => 'fa-gg', 'uri' => 'admin::url_config', 'type' => 0],
        ]
        );

        DB::table('admin_permission')->insert([
            ['id' => '1', 'name' => 'Admin manager', 'slug' => 'admin.manager', 'http_uri' => 'GET::sc_admin/user,GET::sc_admin/role,GET::sc_admin/permission,ANY::sc_admin/log/*,ANY::sc_admin/menu/*', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '2', 'name' => 'Dashboard', 'slug' => 'dashboard', 'http_uri' => 'GET::sc_admin', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '3', 'name' => 'Auth manager', 'slug' => 'auth.full', 'http_uri' => 'ANY::sc_admin/auth/*', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '4', 'name' => 'Setting manager', 'slug' => 'setting.full', 'http_uri' => 'ANY::sc_admin/store_info/*,ANY::sc_admin/store_value/*,ANY::sc_admin/url_config/*,ANY::sc_admin/product_config/*, ANY::sc_admin/customer_config/*, ANY::sc_admin/env/*,ANY::sc_admin/email/*,ANY::sc_admin/email_template/*,ANY::sc_admin/language/*,ANY::sc_admin/currency/*,ANY::sc_admin/backup/*', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '5', 'name' => 'Upload management', 'slug' => 'upload.full', 'http_uri' => 'ANY::sc_admin/uploads/*', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '6', 'name' => 'Module manager', 'slug' => 'module.full', 'http_uri' => 'ANY::sc_admin/module/*', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '7', 'name' => 'Extension manager', 'slug' => 'extension.full', 'http_uri' => 'ANY::sc_admin/extension/*', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '8', 'name' => 'CMS manager', 'slug' => 'cms.full', 'http_uri' => 'ANY::sc_admin/page/*,ANY::sc_admin/banner/*,ANY::sc_admin/cms_category/*,ANY::sc_admin/cms_content/*,ANY::sc_admin/news/*', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '11', 'name' => 'Discount manager', 'slug' => 'discount.full', 'http_uri' => 'ANY::sc_admin/shop_discount/*', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '14', 'name' => 'Shipping status', 'slug' => 'shipping_status.full', 'http_uri' => 'ANY::sc_admin/shipping_status/*', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '15', 'name' => 'Payment  status', 'slug' => 'payment_status.full', 'http_uri' => 'ANY::sc_admin/payment_status/*', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '17', 'name' => 'Customer manager', 'slug' => 'customer.full', 'http_uri' => 'ANY::sc_admin/customer/*,ANY::sc_admin/subscribe/*', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '18', 'name' => 'Order status', 'slug' => 'order_status.full', 'http_uri' => 'ANY::sc_admin/order_status/*', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '19', 'name' => 'Product manager', 'slug' => 'product.full', 'http_uri' => 'ANY::sc_admin/category/*,ANY::sc_admin/vendor/*,ANY::sc_admin/brand/*,ANY::sc_admin/attribute_group/*,ANY::sc_admin/product/*', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '20', 'name' => 'Order Manager', 'slug' => 'order.full', 'http_uri' => 'ANY::sc_admin/order/*', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '21', 'name' => 'Report manager', 'slug' => 'report.full', 'http_uri' => 'ANY::sc_admin/report/*', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '22', 'name' => 'Template manager', 'slug' => 'template.full', 'http_uri' => 'ANY::sc_admin/block_content/*,ANY::sc_admin/link/*,ANY::sc_admin/template/*', 'created_at' => date('Y-m-d H:i:s')],
        ]
        );

        DB::table('admin_role')->insert([
            ['id' => '1', 'name' => 'Administrator', 'slug' => 'administrator', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '2', 'name' => 'Group only View', 'slug' => 'view.all', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '3', 'name' => 'Manager', 'slug' => 'manager', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '4', 'name' => 'Cms manager', 'slug' => 'cms', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '5', 'name' => 'Accountant', 'slug' => 'accountant', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '6', 'name' => 'Marketing', 'slug' => 'maketing', 'created_at' => date('Y-m-d H:i:s')]]
        );

        DB::table('admin_role_menu')->insert([
            ['menu_id' => '38', 'role_id' => '1', 'created_at' => date('Y-m-d H:i:s')],
            ['menu_id' => '38', 'role_id' => '2', 'created_at' => date('Y-m-d H:i:s')],
            ['menu_id' => '38', 'role_id' => '3', 'created_at' => date('Y-m-d H:i:s')],
        ]
        );

        DB::table('admin_role_permission')->insert([
            ['role_id' => 3, 'permission_id' => 5, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 3, 'permission_id' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 3, 'permission_id' => 3, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 3, 'permission_id' => 8, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 3, 'permission_id' => 17, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 3, 'permission_id' => 2, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 3, 'permission_id' => 11, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 3, 'permission_id' => 20, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 3, 'permission_id' => 18, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 3, 'permission_id' => 15, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 3, 'permission_id' => 19, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 3, 'permission_id' => 21, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 3, 'permission_id' => 4, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 3, 'permission_id' => 22, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 3, 'permission_id' => 14, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 4, 'permission_id' => 3, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 4, 'permission_id' => 8, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 5, 'permission_id' => 2, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 5, 'permission_id' => 20, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 5, 'permission_id' => 3, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 5, 'permission_id' => 21, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 6, 'permission_id' => 5, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 6, 'permission_id' => 3, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 6, 'permission_id' => 8, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 6, 'permission_id' => 17, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 6, 'permission_id' => 2, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 6, 'permission_id' => 11, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 6, 'permission_id' => 20, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 6, 'permission_id' => 15, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 6, 'permission_id' => 19, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 6, 'permission_id' => 21, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 6, 'permission_id' => 14, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 6, 'permission_id' => 18, 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => 4, 'permission_id' => 5, 'created_at' => date('Y-m-d H:i:s')],
        ]
        );

        DB::table('admin_role_user')->insert(
            ['role_id' => '1', 'user_id' => '1']
        );

        DB::table('admin_user')->insert(
            ['id' => '1', 'username' => 'admin', 'password' => '$2y$10$JcmAHe5eUZ2rS0jU1GWr/.xhwCnh2RU13qwjTPcqfmtZXjZxcryPO', 'name' => 'Administrator', 'avatar' => '/admin/avatar/user.jpg', 'created_at' => date('Y-m-d H:i:s')]
        );

    }
}
