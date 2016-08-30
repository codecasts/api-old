<?php

namespace Codecasts\Domains\Users\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * @var \Illuminate\Database\Schema\Builder
     */
    protected $schema;

     /**
      * Migration constructor.
      */
     public function __construct()
     {
         $this->schema = app('db')->connection()->getSchemaBuilder();
     }

    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->schema->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique()->index();
            $table->string('name');
            $table->string('email');
            $table->string('avatar')->nullable();
            $table->string('url')->nullable();
            $table->string('location')->nullable();
            $table->date('expires_at')->nullable()->default(null);
            $table->string('customer_id')->nullable()->default(null);
            $table->string('subscription_id')->nullable()->default(null);
            $table->string('subscription_plan')->nullable()->default(null);
            $table->boolean('subscription_active')->nullable()->default(null);
            $table->boolean('subscription_suspended')->nullable()->default(null);
            $table->boolean('admin')->default(false);
            $table->boolean('guest')->default(false);
            $table->text('link')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->schema->drop('users');
    }
}
