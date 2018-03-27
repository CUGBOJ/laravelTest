<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', 1);
            $table->string('nickname');
            $table->string('username', 50)->unique();
            $table->string('email');
            $table->string('password');
            $table->string('school');
            $table->timestamp('last_login_time');
            $table->timestamp('register_time')->nullable();
            $table->ipAddress('last_login_ip')->default('1.1.1.1');
            $table->integer('submit')->default(0);
            $table->integer('solved')->default(0);
            $table->integer('role_id')->unsigned()->default(4);
            $table->foreign('role_id')->references('id')->on('roles');
            $table->rememberToken();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
