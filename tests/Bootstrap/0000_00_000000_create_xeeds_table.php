<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('xeeds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('big_integer');
            $table->binary('binary');
            $table->boolean('boolean');
            $table->char('char', 100);
            $table->dateTimeTz('date_time_tz');
            $table->dateTime('date_time');
            $table->date('date');
            $table->decimal('decimal', 8, 2);
            $table->double('double');
            $table->enum('enum', ['easy', 'hard']);
            $table->float('float');
            $table->foreignId('foreign_id');
            $table->foreignUlid('foreign_ulid');
            $table->foreignUuid('foreign_uuid');
            $table->geometry('geometry');
            $table->integer('integer');
            $table->ipAddress('ip_address');
            $table->json('json');
            $table->json('jsonb');
            $table->longText('long_text');
            $table->macAddress('mac_address');
            $table->mediumInteger('medium_integer');
            $table->mediumText('medium_text');
            $table->string('morphs_type', 255);
            $table->foreignId('morphs_id');
            $table->string('nullable_morphs_type', 255)->nullable();
            $table->foreignId('nullable_morphs_id')->nullable();
            $table->string('nullable_ulid_morphs_type', 255)->nullable();
            $table->ulid('nullable_ulid_morphs_id')->nullable();
            $table->string('nullable_uuid_morphs_type', 255)->nullable();
            $table->uuid('nullable_uuid_morphs_id')->nullable();
            $table->rememberToken();
            $table->smallInteger('small_integer');
            $table->timestamp('deleted_at_tz', 0)->nullable();
            $table->softDeletes('deleted_at')->nullable();
            $table->string('string', 100);
            $table->text('text');
            $table->time('time_tz', 0);
            $table->time('time', 0);
            $table->timestamp('timestamp_tz', 0);
            $table->timestamp('timestamp', 0);
            $table->timestamp('created_at', 0)->nullable();
            $table->timestamp('updated_at', 0)->nullable();
            $table->tinyInteger('tiny_integer');
            $table->tinyText('tiny_text');
            $table->unsignedBigInteger('unsigned_big_integer');
            $table->unsignedInteger('unsigned_integer');
            $table->unsignedMediumInteger('unsigned_medium_integer');
            $table->unsignedSmallInteger('unsigned_small_integer');
            $table->unsignedTinyInteger('unsigned_tiny_integer');
            $table->string('ulid_morphs_type', 255);
            $table->ulid('ulid_morphs_id');
            $table->string('uuid_morphs_type', 255);
            $table->uuid('uuid_morphs_id');
            $table->ulid('ulid');
            $table->uuid('uuid');
            $table->year('year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xeeds');
    }
};
