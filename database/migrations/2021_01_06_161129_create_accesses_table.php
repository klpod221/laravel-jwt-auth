<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Access;

class CreateAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('device_token', 255)->nullable()->comment('Firebase device token');
            $table->string('provider')->nullable()->comment('Social type');
            $table->string('provider_id')->nullable()->comment('Social ID');
            $table->string('confirmation_code')->nullable()->comment('Mã xác nhận');
            $table->timestamp('verified_at')->nullable();
            $table->enum('verify_type', [Access::VERIFY_TYPE_EMAIL, Access::VERIFY_TYPE_SMS])->nullable()->comment('1. Email, 2. SMS');
            $table->timestamp('last_login_at')->nullable()->comment('Thời gian login gần nhất');
            $table->integer('fail_count')->nullable()->comment('Số lần login fail');
            $table->timestamp('lock_expired_at')->nullable()->comment('Thời gian hiệu lực khóa tài khoản');
        });

        // DB::statement('ALTER SEQUENCE accesses_id_seq RESTART WITH 3;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesses');
    }
}
