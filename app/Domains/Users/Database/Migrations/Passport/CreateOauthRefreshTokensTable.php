<?php

namespace Codecasts\Domains\Users\Database\Migrations\Passport;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauthRefreshTokensTable extends Migration
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
        $this->schema->create('oauth_refresh_tokens', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('access_token_id', 100)->index();
            $table->boolean('revoked');
            $table->dateTime('expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->schema->drop('oauth_refresh_tokens');
    }
}
