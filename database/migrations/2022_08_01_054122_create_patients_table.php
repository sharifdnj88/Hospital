<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name') -> nullable();
            $table->string('mobile') ->unique() ->nullable();
            $table->string('email') ->unique() ->nullable();
            $table->string('password') -> nullable();
            $table->string('fname') -> nullable();
            $table->string('lname') -> nullable();
            $table->string('photo') ->nullable();
            $table->string('blood_group') ->nullable();
            $table->string('date_of_birth') ->nullable();
            $table->integer('age') ->nullable();
            $table->text('address') ->nullable();
            $table->string('city') ->nullable();
            $table->string('division') ->nullable();
            $table->string('country') ->nullable();
            $table->string('access_token') ->nullable();
            $table->string('facebook_id') ->nullable();
            $table->string('google_id') ->nullable();
            $table->string('github_id') ->nullable();
            $table->boolean('status') ->default(true);
            $table->boolean('trash') ->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
