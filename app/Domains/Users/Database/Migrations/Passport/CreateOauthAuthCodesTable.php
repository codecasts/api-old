<?php

namespace Codecasts\Domains\Users\Database\Migrations\Passport;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauthAuthCodesTable extends Migration
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
        $this->schema->create('oauth_auth_codes', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->integer('user_id');
            $table->integer('client_id');
            $table->text('scopes')->nullable();
            $table->boolean('revoked');
            $table->dateTime('expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->schema->drop('oauth_auth_codes');
    }
}
