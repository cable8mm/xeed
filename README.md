# Xeed - Resources Generator for Laravel & Nova

[![code-style](https://github.com/cable8mm/xeed/actions/workflows/code-style.yml/badge.svg)](https://github.com/cable8mm/xeed/actions/workflows/code-style.yml)
[![run-tests](https://github.com/cable8mm/xeed/actions/workflows/run-tests.yml/badge.svg)](https://github.com/cable8mm/xeed/actions/workflows/run-tests.yml)
[![pages-build-deployment](https://github.com/cable8mm/xeed/actions/workflows/pages/pages-build-deployment/badge.svg)](https://github.com/cable8mm/xeed/actions/workflows/pages/pages-build-deployment)
[![Packagist Version](https://img.shields.io/packagist/v/cable8mm/xeed)](https://packagist.org/packages/cable8mm/xeed)
[![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/cable8mm/xeed/php?logo=PHP&logoColor=white&color=777BB4
)](https://packagist.org/packages/cable8mm/xeed)
![Laravel Version](https://img.shields.io/badge/Laravel-8.0%2B-FF2D20?logo=laravel&labelColor=white)
![Static Badge](https://img.shields.io/badge/Laravel%20Nova-4.0%2B-4BA2E4?logo=laravel%20nova&logoColor=00E9F0&labelColor=white)
![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/cable8mm/xeed/symfony%2Fconsole)
[![Packagist Downloads](https://img.shields.io/packagist/dt/cable8mm/xeed)](https://packagist.org/packages/cable8mm/xeed/stats)
[![Packagist Stars](https://img.shields.io/packagist/stars/cable8mm/xeed)](https://github.com/cable8mm/xeed/stargazers)
[![Packagist License](https://img.shields.io/packagist/l/cable8mm/xeed)](https://github.com/cable8mm/xeed/blob/main/LICENSE.md)

The Xeed is to generate new model, seed, Nova resources, database seed, factory and migration files for Laravel & Nova based on data from the existing database table.

> [!TIP]
> It can function as both `php artisan xeed:*` commands for Laravel & Nova providing 100% identical functionality. Therefore, you can use it within your own Laravel & Nova project.

We have provided the API Documentation on the web. For more information, please visit <https://www.palgle.com/xeed/> ❤️

## Features

- [x] Database testing is supported
- [x] Generate models for Laravel
- [x] Generate seed files for Laravel
- [x] Generate Nova resources files for Laravel Nova
- [x] Generate database seed files for Laravel
- [x] Generate factories for Laravel
- [x] Generate migrations for Laravel
- [x] Generate belongsTo and hasMany relationships functions for Laravel
- [x] Laravel multi & reserved columns supported
- [x] Laravel integration
- [x] MySQL, SQLite and PostgreSQL supported

### Support & Tested

![MySQL Supported](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)
![SQLite Supported](https://img.shields.io/badge/SQLite-07405e?logo=sqlite&logoColor=white)
![PostgreSQL Supported](https://img.shields.io/badge/PostgreSQL-Beta-316192?&logo=postgresql&logoColor=white)
![PHP 8.1.0+ Supported](https://img.shields.io/badge/PHP-8.1.0%2B-777BB4?logo=php&logoColor=white)
![PHP 8.2.0+ Supported](https://img.shields.io/badge/PHP-8.2.0%2B-777BB4?logo=php&logoColor=white)
![PHP 8.3.0+ Supported](https://img.shields.io/badge/PHP-8.3.0%2B-777BB4?logo=php&logoColor=white)

### Preview

![Preview](https://github.com/cable8mm/cabinet/blob/main/xeed-laravel-preview.gif?raw=true)

## Installation

```shell
composer require cable8mm/xeed --dev
```

## Usage

`-f` option make it forced, and `xeeds` is the table make.

```shell
# Generate all models from database in `app/Models` folder
php artisan xeed:model

# Force to generate a model from `xeeds` table in `app/Models` folder
php artisan xeed:model xeeds -f

# Generate all factories from database in `database/factories' folder
php artisan xeed:factory

# Force to generate a factory from `xeeds` table in `database/factories' folder
php artisan xeed:factory xeeds -f

# Generate all seeds from database in `database/seeders` folder
php artisan xeed:seeder

# Force to generate a seeder from `xeeds` table in `database/seeders` folder
php artisan xeed:seeder xeeds -f

# Generate all seeds from database in `database/seeders` folder
php artisan xeed:faker-seeder

# Force to generate a seeder from `xeeds` table in `database/seeders` folder
php artisan xeed:faker-seeder xeeds -f

# Generate a database seed from database in `database/seeders` folder
php artisan xeed:database

# Generate all migrations from database in `database/migrations' folder
php artisan xeed:migration

# Force to generate a migration from `xeeds` table in `database/migrations' folder
php artisan xeed:migration xeeds -f

# Add the relation function to all models from database in `app/Models` folder
php artisan xeed:relation

# Runs xeed:models before running xeed:relations. Add -f to force to generate
php artisan xeed:relation -f

# Add the Laravel Nova resources to all tables in `app/Nova` folder
php artisan xeed:nova

# Clean generated files, seeders, models, factories and migration files.
php artisan xeed:wipe
```

### Formatting

```shell
# Modify all files to comply with the PSR-12.
composer lint

# Inspect all files to ensure compliance with PSR-12.
composer inspect
```

### Testing

It uses the built-in SQLite database, not your own database. It will never cause harm to your data. You don't need to worry about that.

```shell tab=Laravel
# Run `vendor/bin/testbench package:test tests`
composer testpack
```

```shell tab=Standalone
# Run `vendor/bin/phpunit tests`
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

The below can help you contribute.

The Xeed has a built-in SQLite database, allowing you to contribute easily without needing your own database. Simply create a new file for testing purposes and utilize it.

```shell
# Create a new empty file for SQLite database
touch database/database.sqlite
```

And then,

```shell
# Run tests
composer test
```

### Database seeds

For migrations and factories, when you need to execute tests for all database field types, utilize the following command.

```shell
# Import an 'xeeds' Table into the Database
php artisan xeed

# Drop the 'xeeds' Table from the Database
php artisan xeed drop
```

Utilize migration files for all database field types by referring to the following location `database/*.sql` these files are saved in the specified folder.

### Use `testorchestral/testbench`

You can utilize `testorchestral/testbench` to execute tests. When running Laravel commands, the generated files are saved in the `vendor/orchestra/testbench-core/laravel/database` folder.

## Resources

Laravel columns **description** for mysql:

| Available Column Types                           | Field                    | Type                        | Null | Key | Default | Extra          |
| ------------------------------------------------ | ------------------------ | --------------------------- | ---- | --- | ------- | -------------- |
| id()                                             | id                       | bigint unsigned             | NO   | PRI |         | auto_increment |
| bigInteger('big_integer')                        | big_integer              | bigint                      | NO   |     |         |                |
| binary('binary')                                 | binary                   | blob                        | NO   |     |         |                |
| boolean('boolean')                               | boolean                  | tinyint(1)                  | NO   |     |         |                |
| char('char', length: 100)                        | char                     | char(100)                   | NO   |     |         |                |
| dateTimeTz('date_time_tz', precision: 0)         | date_time_tz             | datetime                    | NO   |     |         |                |
| dateTime('date_time', precision: 0)              | date_time                | datetime                    | NO   |     |         |                |
| date('date')                                     | date                     | date                        | NO   |     |         |                |
| decimal('decimal', total: 8, places: 2)          | decimal                  | decimal(8,2)                | NO   |     |         |                |
| double('double')                                 | double                   | double                      | NO   |     |         |                |
| enum('enum', \['easy', 'hard'\])                 | enum                     | enum('easy','hard')         | NO   |     |         |                |
| float('float', precision: 53)                    | float                    | double                      | NO   |     |         |                |
| foreignId('foreign_id')                          | foreign_id               | bigint unsigned             | NO   |     |         |                |
| foreignUlid('foreign_ulid')                      | foreign_ulid             | char(26)                    | NO   |     |         |                |
| foreignUuid('foreign_uuid')                      | foreign_uuid             | char(36)                    | NO   |     |         |                |
| geometry('geometry', subtype: 'point', srid: 0)  | geometry                 | point                       | NO   |     |         |                |
| integer('integer')                               | integer                  | int                         | NO   |     |         |                |
| ipAddress('ip_address')                          | ip_address               | varchar(45)                 | NO   |     |         |                |
| json('json')                                     | json                     | json                        | NO   |     |         |                |
| jsonb('jsonb')                                   | jsonb                    | json                        | NO   |     |         |                |
| longText('long_text')                            | long_text                | longtext                    | NO   |     |         |                |
| macAddress('mac_address')                        | mac_address              | varchar(17)                 | NO   |     |         |                |
| mediumInteger('medium_integer')                  | medium_integer           | mediumint                   | NO   |     |         |                |
| mediumText('medium_text')                        | medium_text              | mediumtext                  | NO   |     |         |                |
| morphs('morph')                                  | morph_type               | varchar(255)                | NO   | MUL |         |                |
| _Ditto make 2 fields_                            | morph_id                 | bigint unsigned             | NO   |     |         |                |
| nullableTimestamps(precision: 0)                 | created_at               | timestamp                   | YES  |     |         |                |
| _Ditto make 2 fields_                            | updated_at               | timestamp                   | YES  |     |         |                |
| nullableMorphs('nullable_morph')                 | nullable_morph_type      | varchar(255)                | YES  | MUL |         |                |
| _Ditto make 2 fields_                            | nullable_morph_id        | bigint unsigned             | YES  |     |         |                |
| nullableUlidMorphs('nullable_ulid_morph')        | nullable_ulid_morph_type | varchar(255)                | YES  | MUL |         |                |
| _Ditto make 2 fields_                            | nullable_ulid_morph_id   | char(26)                    | YES  |     |         |                |
| nullableUuidMorphs('nullable_uuid_morph')        | nullable_uuid_morph_type | varchar(255)                | YES  | MUL |         |                |
| _Ditto make 2 fields_                            | nullable_uuid_morph_id   | char(36)                    | YES  |     |         |                |
| rememberToken()                                  | remember_token           | varchar(100)                | YES  |     |         |                |
| set('set', \['strawberry', 'vanilla'\])          | set                      | set('strawberry','vanilla') | NO   |     |         |                |
| smallInteger('small_integer')                    | small_integer            | smallint                    | NO   |     |         |                |
| softDeletesTz('soft_delete_tz', precision: 0)    | soft_delete_tz           | timestamp                   | YES  |     |         |                |
| softDeletes('soft_delete', precision: 0)         | soft_delete              | timestamp                   | YES  |     |         |                |
| string('string', length: 100)                    | string                   | varchar(100)                | NO   |     |         |                |
| text('text')                                     | text                     | text                        | NO   |     |         |                |
| time('time_tz', 0)                               | time_tz                  | time                        | NO   |     |         |                |
| time('time', 0)                                  | time                     | time                        | NO   |     |         |                |
| timestampTz('timestamp_tz', precision: 0)        | timestamp_tz             | timestamp                   | NO   |     |         |                |
| timestamp('timestamp', precision: 0)             | timestamp                | timestamp                   | NO   |     |         |                |
| tinyInteger('tiny_integer')                      | tiny_integer             | tinyint                     | NO   |     |         |                |
| tinyText('tiny_text')                            | tiny_text                | tinytext                    | NO   |     |         |                |
| unsignedBigInteger('unsigned_big_integer')       | unsigned_big_integer     | bigint unsigned             | NO   |     |         |                |
| unsignedInteger('unsigned_integer')              | unsigned_integer         | int unsigned                | NO   |     |         |                |
| unsignedMediumInteger('unsigned_medium_integer') | unsigned_medium_integer  | mediumint unsigned          | NO   |     |         |                |
| unsignedSmallInteger('unsigned_small_integer')   | unsigned_small_integer   | smallint unsigned           | NO   |     |         |                |
| unsignedTinyInteger('unsigned_tiny_integer')     | unsigned_tiny_integer    | tinyint unsigned            | NO   |     |         |                |
| ulidMorphs('ulid_morph')                         | ulid_morph_type          | varchar(255)                | NO   | MUL |         |                |
| _Ditto make 2 fields_                            | ulid_morph_id            | char(26)                    | NO   |     |         |                |
| uuidMorphs('uuid_morph')                         | uuid_morph_type          | varchar(255)                | NO   | MUL |         |                |
| _Ditto make 2 fields_                            | uuid_morph_id            | char(36)                    | NO   |     |         |                |
| ulid('ulid')                                     | ulid                     | char(26)                    | NO   |     |         |                |
| uuid('uuid')                                     | uuid                     | char(36)                    | NO   |     |         |                |
| year('year')                                     | year                     | year                        | NO   |     |         |                |

## Code of Conduct

In order to ensure that the community is welcoming to all, please review and abide by the [CODE OF CONDUCT](CODE_OF_CONDUCT.md).

## Credits

- [Samgu Lee](https://github.com/cable8mm)

## License

The Xeed project is open-sourced software licensed under the [MIT license](LICENSE.md).
