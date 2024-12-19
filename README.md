# Xeed - Resources Generator for Laravel

[![code-style](https://github.com/cable8mm/xeed/actions/workflows/code-style.yml/badge.svg)](https://github.com/cable8mm/xeed/actions/workflows/code-style.yml)
[![run-tests](https://github.com/cable8mm/xeed/actions/workflows/run-tests.yml/badge.svg)](https://github.com/cable8mm/xeed/actions/workflows/run-tests.yml)
[![Packagist Version](https://img.shields.io/packagist/v/cable8mm/xeed)](https://packagist.org/packages/cable8mm/xeed)
[![Packagist Downloads](https://img.shields.io/packagist/dt/cable8mm/xeed)](https://packagist.org/packages/cable8mm/xeed/stats)
[![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/cable8mm/xeed/php)](https://packagist.org/packages/cable8mm/xeed)
![Laravel Version](https://img.shields.io/badge/Laravel-8.0%2B-FF2D20?logo=laravel&labelColor=white)
![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/cable8mm/xeed/symfony%2Fconsole)
[![Packagist Stars](https://img.shields.io/packagist/stars/cable8mm/xeed)](https://github.com/cable8mm/xeed/stargazers)
[![Packagist License](https://img.shields.io/packagist/l/cable8mm/xeed)](https://github.com/cable8mm/xeed/blob/main/LICENSE.md)

The Xeed is to generate new model, seed, database seed, factory and migration files for Laravel based on data from the existing database table.

> [!TIP]
> It can function as both `php artisan xeed:*` commands for Laravel and `bin/console *` commands for Standalone, providing 100% identical functionality. Therefore, you can use it within your own Laravel project or as a standalone application.

We have provided the API Documentation on the web. For more information, please visit <https://www.palgle.com/xeed/> ❤️

## Features

- [x] Database testing is supported
- [x] Generate models for Laravel
- [x] Generate seed files for Laravel
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
![PHP 8.0.2+ Supported](https://img.shields.io/badge/PHP-8.0.2%2B-777BB4?logo=php&logoColor=white)
![PHP 8.1.0+ Supported](https://img.shields.io/badge/PHP-8.1.0%2B-777BB4?logo=php&logoColor=white)
![PHP 8.2.0+ Supported](https://img.shields.io/badge/PHP-8.2.0%2B-777BB4?logo=php&logoColor=white)
![PHP 8.3.0+ Supported](https://img.shields.io/badge/PHP-8.3.0%2B-777BB4?logo=php&logoColor=white)

> [!CAUTION]
> PostgreSQL support is in beta. If you encounter any issues, please report them via GitHub issues.

### Preview

**Laravel:**

![Preview](https://github.com/cable8mm/cabinet/blob/main/xeed-laravel-preview.gif?raw=true)

**Standalone:**

![Preview](https://github.com/cable8mm/cabinet/blob/main/xeed-preview.gif?raw=true)

## Installation

```shell tab=Laravel
composer require cable8mm/xeed --dev
# For Laravel
```

```shell tab=Standalone
composer create-project cable8mm/xeed
# For Standalone
```

> [!IMPORTANT]
> Edit the `.env` file to configure your own database. You can manually copy `.env.example` to `.env` whenever you need to.

## Usage

### Generate `Models`

```shell tab=Laravel
php artisan xeed:models
# Generate all models from database in `app/Models` folder

php artisan xeed:models -f -t xeeds
# Force to generate a model from `xeeds` table in `app/Models` folder
```

```shell tab=Standalone
bin/console models
# Generate all models from database in `dist/app/Models` folder

bin/console models -f -t xeeds
# Force to generate a model from `xeeds` table in `app/Models` folder
```

### Generate `Seeders`

```shell tab=Laravel
php artisan xeed:seeders
# Generate all seeds from database in `database/seeders` folder

php artisan xeed:seeders -f -t xeeds
# Force to generate a seeder from `xeeds` table in `database/seeders` folder
```

```shell tab=Standalone
bin/console seeders
# Generate all seeds from database in `dist/database/seeders` folder

bin/console seeders -f -t xeeds
# Force to generate a seeder from `xeeds` table in `dist/database/seeders` folder
```

### Generate `Faker Seeders`

The Faker seeders are utilized without the `factory()` method to generate seeds. This command was created to address the [issue #61](https://github.com/cable8mm/xeed/issues/61), providing insight into its purpose.

```shell tab=Laravel
php artisan xeed:faker-seeders
# Generate all seeds from database in `database/seeders` folder

php artisan xeed:faker-seeders -f -t xeeds
# Force to generate a seeder from `xeeds` table in `database/seeders` folder
```

```shell tab=Standalone
bin/console faker-seeders
# Generate all seeds from database in `dist/database/seeders` folder

bin/console faker-seeders -f -t xeeds
# Force to generate a seeder from `xeeds` table in `dist/database/seeders` folder
```

### Generate `DatabaseSeeder`

```shell tab=Laravel
php artisan xeed:database
# Generate a database seed from database in `database/seeders` folder
```

```shell tab=Standalone
bin/console database
# Generate a database seed from database in `dist/database/seeders` folder
```

### Generate `Factories`

```shell tab=Laravel
php artisan xeed:factories
# Generate all factories from database in `database/factories' folder

php artisan xeed:factories -f -t xeeds
# Force to generate a factory from `xeeds` table in `database/factories' folder
```

```shell tab=Standalone
bin/console factories
# Generate all factories from database in `dist/database/factories' folder

bin/console factories -f -t xeeds
# Force to generate a factory from `xeeds` table in `database/factories' folder
```

### Generate `Migrations`

```shell tab=Laravel
php artisan xeed:migrations
# Generate all migrations from database in `database/migrations' folder

php artisan xeed:migrations -f -t xeeds
# Force to generate a migration from `xeeds` table in `database/migrations' folder
```

```shell tab=Standalone
bin/console migrations
# Generate all migrations from database in `dist/database/migrations' folder

bin/console migrations -f -t xeeds
# Force to generate a migration from `xeeds` table in `database/migrations' folder
```

The generated files are stored in the same folder as your Laravel project. Please check the `dist` folder.

### Generate `Relations`

This command can only be used in Models where `use HasFactory;` exists, all relations will be placed after it.

```shell tab=Laravel
php artisan xeed:relations
# Add the relation function to all models from database in `app/Models` folder

php artisan xeed:relations -m
# Runs xeed:models before running xeed:relations. Add -f to force to generate
```

```shell tab=Standalone
bin/console relations
# Add the relation function to all models from database in `dist/app/Models` folder

bin/console relations -m
# Runs xeed:models before running xeed:relations. Add -f to force to generate
```

The generated relations are named using laravels convention. Some names may be duplicated

### Helpful commands

If you are going to test this package yourself, then you would use the following commands to clean up generated files.

```shell tab=Laravel
php artisan xeed:clean
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

```shell tab=Standalone
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

### Formatting

```shell
composer lint
# Modify all files to comply with the PSR-12.

composer inspect
# Inspect all files to ensure compliance with PSR-12.
```

### Testing

It uses the built-in SQLite database, not your own database. It will never cause harm to your data. You don't need to worry about that.

```shell tab=Laravel
composer testpack
# All tests with Laravel artisan commands
```

```shell tab=Standalone
composer test
# All tests without Laravel artisan commands
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

The below can help you contribute.

The Xeed has a built-in SQLite database, allowing you to contribute easily without needing your own database. Simply create a new file for testing purposes and utilize it.

```shell
touch database/database.sqlite
# Create a new empty file for SQLite database
```

And then,

```shell
composer test
# Run tests
```

### Database seeds

For migrations and factories, when you need to execute tests for all database field types, utilize the following command.

```shell tab=Laravel
php artisan xeed
# Import an 'xeeds' Table into the Database

php artisan xeed drop
# Drop the 'xeeds' Table from the Database
```

```shell tab=Standalone
bin/console xeed
# Import an 'xeeds' Table into the Database

bin/console xeed drop
# Drop the 'xeeds' Table from the Database
```

Utilize migration files for all database field types by referring to the following location `database/*.sql` these files are saved in the specified folder.

### Use `testorchestral/testbench`

You can utilize `testorchestral/testbench` to execute tests. When running Laravel commands, the generated files are saved in the `vendor/orchestra/testbench-core/laravel/database` folder.

## Resources

Laravel columns **description** for mysql:

|Available Column Types                                  |Field                   |Type                       |Null|Key|Default|Extra         |
|--------------------------------------------------------|------------------------|---------------------------|----|---|-------|--------------|
|id()                                            |id                      |bigint unsigned            |NO  |PRI|       |auto_increment|
|bigInteger('big_integer')                       |big_integer             |bigint                     |NO  |   |       |              |
|binary('binary')                                |binary                  |blob                       |NO  |   |       |              |
|boolean('boolean')                              |boolean                 |tinyint(1)                 |NO  |   |       |              |
|char('char', length: 100)                       |char                    |char(100)                  |NO  |   |       |              |
|dateTimeTz('date_time_tz', precision: 0)        |date_time_tz            |datetime                   |NO  |   |       |              |
|dateTime('date_time', precision: 0)             |date_time               |datetime                   |NO  |   |       |              |
|date('date')                                    |date                    |date                       |NO  |   |       |              |
|decimal('decimal', total: 8, places: 2)         |decimal                 |decimal(8,2)               |NO  |   |       |              |
|double('double')                                |double                  |double                     |NO  |   |       |              |
|enum('enum', \['easy', 'hard'\])                  |enum                    |enum('easy','hard')        |NO  |   |       |              |
|float('float', precision: 53)                   |float                   |double                     |NO  |   |       |              |
|foreignId('foreign_id')                         |foreign_id              |bigint unsigned            |NO  |   |       |              |
|foreignUlid('foreign_ulid')                     |foreign_ulid            |char(26)                   |NO  |   |       |              |
|foreignUuid('foreign_uuid')                     |foreign_uuid            |char(36)                   |NO  |   |       |              |
|geometry('geometry', subtype: 'point', srid: 0) |geometry                |point                      |NO  |   |       |              |
|integer('integer')                              |integer                 |int                        |NO  |   |       |              |
|ipAddress('ip_address')                         |ip_address              |varchar(45)                |NO  |   |       |              |
|json('json')                                    |json                    |json                       |NO  |   |       |              |
|jsonb('jsonb')                                  |jsonb                   |json                       |NO  |   |       |              |
|longText('long_text')                           |long_text               |longtext                   |NO  |   |       |              |
|macAddress('mac_address')                       |mac_address             |varchar(17)                |NO  |   |       |              |
|mediumInteger('medium_integer')                 |medium_integer          |mediumint                  |NO  |   |       |              |
|mediumText('medium_text')                       |medium_text             |mediumtext                 |NO  |   |       |              |
|morphs('morph')                                 |morph_type              |varchar(255)               |NO  |MUL|       |              |
|_Ditto make 2 fields_                                                       |morph_id                |bigint unsigned            |NO  |   |       |              |
|nullableTimestamps(precision: 0)                |created_at              |timestamp                  |YES |   |       |              |
|_Ditto make 2 fields_                                                       |updated_at              |timestamp                  |YES |   |       |              |
|nullableMorphs('nullable_morph')                |nullable_morph_type     |varchar(255)               |YES |MUL|       |              |
|_Ditto make 2 fields_                                                      |nullable_morph_id       |bigint unsigned            |YES |   |       |              |
|nullableUlidMorphs('nullable_ulid_morph')       |nullable_ulid_morph_type|varchar(255)               |YES |MUL|       |              |
|_Ditto make 2 fields_                                                      |nullable_ulid_morph_id  |char(26)                   |YES |   |       |              |
|nullableUuidMorphs('nullable_uuid_morph')       |nullable_uuid_morph_type|varchar(255)               |YES |MUL|       |              |
|_Ditto make 2 fields_                                                     |nullable_uuid_morph_id  |char(36)                   |YES |   |       |              |
|rememberToken()                                 |remember_token          |varchar(100)               |YES |   |       |              |
|set('set', \['strawberry', 'vanilla'\])           |set                     |set('strawberry','vanilla')|NO  |   |       |              |
|smallInteger('small_integer')                   |small_integer           |smallint                   |NO  |   |       |              |
|softDeletesTz('soft_delete_tz', precision: 0)   |soft_delete_tz          |timestamp                  |YES |   |       |              |
|softDeletes('soft_delete', precision: 0)        |soft_delete             |timestamp                  |YES |   |       |              |
|string('string', length: 100)                   |string                  |varchar(100)               |NO  |   |       |              |
|text('text')                                    |text                    |text                       |NO  |   |       |              |
|time('time_tz', 0)                              |time_tz                 |time                       |NO  |   |       |              |
|time('time', 0)                                 |time                    |time                       |NO  |   |       |              |
|timestampTz('timestamp_tz', precision: 0)       |timestamp_tz            |timestamp                  |NO  |   |       |              |
|timestamp('timestamp', precision: 0)            |timestamp               |timestamp                  |NO  |   |       |              |
|tinyInteger('tiny_integer')                     |tiny_integer            |tinyint                    |NO  |   |       |              |
|tinyText('tiny_text')                           |tiny_text               |tinytext                   |NO  |   |       |              |
|unsignedBigInteger('unsigned_big_integer')      |unsigned_big_integer    |bigint unsigned            |NO  |   |       |              |
|unsignedInteger('unsigned_integer')             |unsigned_integer        |int unsigned               |NO  |   |       |              |
|unsignedMediumInteger('unsigned_medium_integer')|unsigned_medium_integer |mediumint unsigned         |NO  |   |       |              |
|unsignedSmallInteger('unsigned_small_integer')  |unsigned_small_integer  |smallint unsigned          |NO  |   |       |              |
|unsignedTinyInteger('unsigned_tiny_integer')    |unsigned_tiny_integer   |tinyint unsigned           |NO  |   |       |              |
|ulidMorphs('ulid_morph')                        |ulid_morph_type         |varchar(255)               |NO  |MUL|       |              |
|_Ditto make 2 fields_                                                   |ulid_morph_id           |char(26)                   |NO  |   |       |              |
|uuidMorphs('uuid_morph')                        |uuid_morph_type         |varchar(255)               |NO  |MUL|       |              |
|_Ditto make 2 fields_                                                    |uuid_morph_id           |char(36)                   |NO  |   |       |              |
|ulid('ulid')                                    |ulid                    |char(26)                   |NO  |   |       |              |
|uuid('uuid')                                    |uuid                    |char(36)                   |NO  |   |       |              |
|year('year')                                    |year                    |year                       |NO  |   |       |              |

## Credits

- [Samgu Lee](https://github.com/cable8mm)

## License

The Xeed project is open-sourced software licensed under the [MIT license](LICENSE.md).
