# Xeed

[한글(Korean) 👈](README.ko.md)

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

### Features

- [x] Database testing is supported
- [x] Generate models for Laravel
- [x] Generate seed files for Laravel
- [x] Generate database seed files for Laravel
- [x] Generate factories for Laravel
- [x] Generate migrations for Laravel
- [x] Laravel multi & reserved columns supported
- [ ] Laravel integration

### Support & Tested

![MySQL Supported](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)
![SQLite Supported](https://img.shields.io/badge/SQLite-07405e?logo=sqlite&logoColor=white)
![PHP 8.0.2+ Supported](https://img.shields.io/badge/PHP-8.0.2%2B-777BB4?logo=php&logoColor=white)
![PHP 8.1.0+ Supported](https://img.shields.io/badge/PHP-8.1.0%2B-777BB4?logo=php&logoColor=white)
![PHP 8.2.0+ Supported](https://img.shields.io/badge/PHP-8.2.0%2B-777BB4?logo=php&logoColor=white)
![PHP 8.3.0+ Supported](https://img.shields.io/badge/PHP-8.3.0%2B-777BB4?logo=php&logoColor=white)

## Installation

```sh
composer create-project cable8mm/xeed
```

And edit the `.env` file to configure your own database. You can manually copy `.env.example` to `.env` whenever you need to.

## Usage

### Generate `Models`

```sh
bin/console models
# Generate all models from database in `dist/app/Models` folder
```

### Generate `Seeders`

```sh
bin/console seeders
# Generate all seeds from database in `dist/database/seeders` folder
```

### Generate `DatabaseSeeder`

```sh
bin/console database
# Generate a database seed from database in `dist/database/seeders` folder
```

### Generate `Factories`

```sh
bin/console factories
# Generate all factories from database in `dist/database/factories' folder
```

### Generate `Migrations`

```sh
bin/console migrations
# Generate all migrations from database in `dist/database/migrations' folder
```

The generated files are stored in the same folder as your Laravel project. Please check the `dist` folder.

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
