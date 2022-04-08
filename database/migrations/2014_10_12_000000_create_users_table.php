<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->unique()->nullable();
            $table->date('birthday')->nullable();
            $table->enum('gender', array_keys(config('option.gender')))->nullable();
            $table->enum('marital', array_keys(config('option.marital')))->nullable();
            $table->enum('type', [User::TYPE_ADMIN, User::TYPE_CANDIDATE])->nullable();
            $table->json('address')->nullable()->comment("['province_id' => 1, 'district_id' => 2, 'ward_id' => 3, 'street_id' => 4, 'detail' => 'Dia chi chi tiet']");
            $table->json('id_card')->nullable()->comment('Thông tin thẻ CMND/CCCD/PASSPORT');
            $table->string('avatar')->nullable();
            $table->enum('status', [User::STATUS_WAIT_ACTIVATION, User::STATUS_ACTIVATED, User::STATUS_DEACTIVATED, User::STATUS_LOCKED])->default(User::STATUS_WAIT_ACTIVATION);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        // DB::statement('ALTER SEQUENCE users_id_seq RESTART WITH 3;');
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
