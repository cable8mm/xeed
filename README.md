# Xeed

[![code-style](https://github.com/cable8mm/xeed/actions/workflows/code-style.yml/badge.svg)](https://github.com/cable8mm/xeed/actions/workflows/code-style.yml)
[![run-tests](https://github.com/cable8mm/xeed/actions/workflows/run-tests.yml/badge.svg)](https://github.com/cable8mm/xeed/actions/workflows/run-tests.yml)
[![Packagist Version](https://img.shields.io/packagist/v/cable8mm/xeed)](https://packagist.org/packages/cable8mm/xeed)
[![Packagist Downloads](https://img.shields.io/packagist/dt/cable8mm/xeed)](https://packagist.org/packages/cable8mm/xeed/stats)
[![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/cable8mm/xeed/php)](https://packagist.org/packages/cable8mm/xeed)
![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/cable8mm/xeed/symfony%2Fconsole)
[![Packagist Stars](https://img.shields.io/packagist/stars/cable8mm/xeed)](https://github.com/cable8mm/xeed/stargazers)
[![Packagist License](https://img.shields.io/packagist/l/cable8mm/xeed)](https://github.com/cable8mm/xeed/blob/main/LICENSE.md)

The Xeed is to generate new model, seed, database seed, factory and migration files for Laravel based on data from the existing database table.

We have provided the API Documentation on the web. For more information, please visit https://www.palgle.com/xeed/ ❤️

## Features

- [x] Database testing is supported
- [x] Generate models for Laravel
- [x] Generate seed files for Laravel
- [x] Generate database seed files for Laravel
- [ ] Generate factories for Laravel
- [ ] Generate migrations for Laravel

## Support & Tested

| Database  | MySQL | SQLite |
| :-------: | :---: | :----: |
| Available |  ✅   |   ✅   |

| PHP Versions | 8.0.2+ | 8.1.0+ | 8.2.0+ | 8.3.0+ |
| :----------: | :----: | :----: | :----: | :----: |
|  Available   |   ✅   |   ✅   |   ✅   |   ✅   |

## Installation

```sh
composer create-project cable8mm/xeed
```

And edit the `.env` file to configure your own database. You can manually copy `.env.example` to `.env` whenever you need to.

## Usage

### Generate `Model`s

```sh
bin/console models
# Generate all models from database in `dist/app/Models` folder
```

### Generate `Seeder`s

```sh
bin/console seeders
# Generate all seeds from database in `dist/database/seeders` folder
```

### Generate `DatabaseSeeder`

```sh
bin/console database
# Generate database seed from database in `dist/database/seeders` folder
```

### Generate `Factory`s

\[TODO]

### Generate `migration`

\[TODO]

## How to contribute

### Development

The Xeed has a built-in SQLite database, allowing you to contribute easily without needing your own database. Simply create a new file for testing purposes and utilize it.

```sh
touch database/database.sqlite
# Create a new empty file for SQLite database
```

And then,

```sh
composer test
# Run tests
```

### Database

For migrations and factories, when you need to execute tests for all database field types, utilize the following command.

```sh
bin/console xeed
# Import an 'xeeds' Table into the Database

bin/console xeed drop
# Drop the 'xeeds' Table from the Database
```

Utilize migration files for all database field types by referring to the following location `resources/tests` these files are saved in the specified folder.

🔥 SQLite does not yet support the `SET` and `ENUM` field types, so the corresponding lines are commented out. If you are using MySQL, you will need to uncomment the following line.

```php
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
    // $table->enum('enum', ['easy', 'hard']);
    //-> SQLite unsupported
    $table->float('float', 8, 2);
    $table->foreignId('foreign_id');
    $table->foreignUlid('foreign_ulid');
    $table->foreignUuid('foreign_uuid');
    $table->geometryCollection('geometry_collection');
    $table->geometry('geometry');
    $table->integer('integer');
    $table->ipAddress('ip_address');
    $table->json('json');
    $table->jsonb('jsonb');
    $table->lineString('line_string');
    $table->longText('long_text');
    $table->macAddress('mac_address');
    $table->mediumInteger('medium_integer');
    $table->mediumText('medium_text');
    $table->morphs('morphs');
    $table->multiPoint('multi_point');
    $table->multiPolygon('multi_polygon');
    $table->nullableMorphs('nullable_morphs');
    $table->nullableUlidMorphs('nullable_ulid_morphs');
    $table->nullableUuidMorphs('nullable_uuid_morphs');
    $table->point('point');
    $table->polygon('polygon');
    $table->rememberToken();
    // $table->set('set', ['strawberry', 'vanilla']);
    //-> SQLite unsupported
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
    $table->unsignedDecimal('unsigned_decimal', $precision = 8, $scale = 2);
    $table->unsignedInteger('unsigned_integer');
    $table->unsignedMediumInteger('unsigned_medium_integer');
    $table->unsignedSmallInteger('unsigned_small_integer');
    $table->unsignedTinyInteger('unsigned_tiny_integer');
    $table->ulidMorphs('ulid_morphs');
    $table->uuidMorphs('uuid_morphs');
    $table->ulid('ulid');
    $table->uuid('uuid');
    $table->year('birth_year');
}
```

### Helpful commands

If you are going to test this package yourself, then you would use the following commands to clean up generated files.

```sh
bin/console clean
# Clean generated files, seeders, models, factories and migration files.
#=> Refer the below
Please select directory for you to want to clean.
  [0] seeder
  [1] model
  [2] factory
  [3] migration
  [4] all
  [5] exit
```

### Issue a bug report and Pull Request

The opportunity for you to create issues and pull requests makes me happy. Feel free to contribute and submit pull requests whenever you need.

## Formatting

```bash
composer lint
# Modify all files to comply with the PSR-12.

composer inspect
# Inspect all files to ensure compliance with PSR-12.
```

## Test

It uses the built-in SQLite database, not your own database. It will never cause harm to your data. You don't need to worry about that.

```sh
composer test
# All tests

composer testgen
# All generator tests
```

## License

The Xeed project is open-sourced software licensed under the [MIT license](LICENSE.md).
