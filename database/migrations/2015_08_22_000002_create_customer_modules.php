<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_customer_type_group', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('module_customer_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('group_id')->nullable()->unsigned();

            $table->foreign('group_id')
                ->references('id')
                ->on('module_customer_type_group');
        });

        Schema::create('module_customer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('phone');
            $table->string('is');
            $table->integer('type_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('type_id')
                ->references('id')
                ->on('module_customer_type');
        });

        Schema::create('module_customer_person', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('cpf')->nullable();
            $table->integer('customer_id')->unsigned();
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('module_customer');
        });

        Schema::create('module_customer_company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('trading_name');
            $table->string('cnpj');
            $table->integer('customer_id')->unsigned();
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('module_customer');
        });

        Schema::create('module_customer_address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->string('street');
            $table->string('street_number');
            $table->string('city');
            $table->string('state_province');
            $table->string('country');
            $table->string('postcode');
            $table->integer('main')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('module_customer')
                ->onDelte('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('module_customer_address');
        Schema::drop('module_customer_company');
        Schema::drop('module_customer_person');
        Schema::drop('module_customer');
        Schema::drop('module_customer_type');
        Schema::drop('module_customer_type_group');
    }
}
