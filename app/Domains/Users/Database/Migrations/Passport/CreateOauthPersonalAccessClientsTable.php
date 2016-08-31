<?php

namespace Codecasts\Domains\Users\Database\Migrations\Passport;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauthPersonalAccessClientsTable extends Migration
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
        $this->schema->create('oauth_personal_access_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->schema->drop('oauth_personal_access_clients');
    }
}
