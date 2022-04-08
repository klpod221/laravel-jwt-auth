<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->morphs('notifiable');
            $table->unsignedBigInteger('target_id')->nullable()->comment('ID target tương ứng với loại thông báo (userId,...)');
            $table->tinyInteger('type')->nullable()->comment('Loại thông báo'); // config('option.notification_type')
            $table->text('data')->nullable();
            $table->timestamp('read_at')->nullable()->comment('Unread is null');
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
        Schema::dropIfExists('notifications');
    }
}
