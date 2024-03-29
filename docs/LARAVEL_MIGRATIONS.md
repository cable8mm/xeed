# Laravel Migrations Compatibility

## Sample migration

```php
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
            $table->dateTimeTz('date_time_tz', $precision = 0);
            $table->dateTime('date_time', $precision = 0);
            $table->date('date');
            $table->decimal('decimal', $precision = 8, $scale = 2);
            $table->double('double', 8, 2);
            $table->enum('enum', ['easy', 'hard']);
            $table->float('float', 8, 2);
            $table->foreignId('foreign_id');
            $table->foreignUlid('foreign_ulid');
            $table->foreignUuid('foreign_uuid');
            $table->geometry('geometry');
            $table->integer('integer');
            $table->ipAddress('ip_address');
            $table->json('json');
            $table->jsonb('jsonb');
            $table->longText('long_text');
            $table->macAddress('mac_address');
            $table->mediumInteger('medium_integer');
            $table->mediumText('medium_text');
            $table->morphs('morphs');
            $table->nullableMorphs('nullable_morphs');
            $table->nullableUlidMorphs('nullable_ulid_morphs');
            $table->nullableUuidMorphs('nullable_uuid_morphs');
            $table->rememberToken();
            $table->smallInteger('small_integer');
            $table->softDeletesTz($column = 'soft_deletes_tz', $precision = 0);
            $table->softDeletes($column = 'soft_deletes', $precision = 0);
            $table->string('string', 100);
            $table->text('text');
            $table->timeTz('time_tz', $precision = 0);
            $table->time('time', $precision = 0);
            $table->timestampTz('timestamp_tz', $precision = 0);
            $table->timestamp('timestamp', $precision = 0);
            $table->timestamps($precision = 0);
            $table->tinyInteger('tiny_integer');
            $table->tinyText('tiny_text');
            $table->unsignedBigInteger('unsigned_big_integer');
            $table->unsignedInteger('unsigned_integer');
            $table->unsignedMediumInteger('unsigned_medium_integer');
            $table->unsignedSmallInteger('unsigned_small_integer');
            $table->unsignedTinyInteger('unsigned_tiny_integer');
            $table->ulidMorphs('ulid_morphs');
            $table->uuidMorphs('uuid_morphs');
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
```
