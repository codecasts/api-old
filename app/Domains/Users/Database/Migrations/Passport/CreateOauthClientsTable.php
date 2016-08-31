<?php

namespace Codecasts\Domains\Users\Database\Migrations\Passport;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauthClientsTable extends Migration
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
        $this->schema->create('oauth_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->nullable();
            $table->string('name');
            $table->string('secret', 100);
            $table->text('redirect');
            $table->boolean('personal_access_client');
            $table->boolean('password_client');
            $table->boolean('revoked');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->schema->drop('oauth_clients');
    }
}
