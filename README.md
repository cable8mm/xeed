# Xeed

[![code-style](https://github.com/cable8mm/xeed/actions/workflows/code-style.yml/badge.svg)](https://github.com/cable8mm/xeed/actions/workflows/code-style.yml)
[![run-tests](https://github.com/cable8mm/xeed/actions/workflows/run-tests.yml/badge.svg)](https://github.com/cable8mm/xeed/actions/workflows/run-tests.yml)

The Xeed is to generate a new seed file based on data from the existing database table.

## Features

- [ ] Generate factories
- [ ] Generate seed files
- [ ] Generate database seed files
- [ ] Database testing is supported

## Support & Tested

| Database  | MySQL | SQLite |
| :-------: | :---: | :----: |
| Available |  ✅   |   ✅   |

| Versions  | PHP 8.0.2 | PHP 8.1.\* | PHP 8.2.\* | PHP 8.3.\* |
| :-------: | :-------: | :--------: | :--------: | :--------: |
| Available |    ✅     |     ✅     |     ✅     |     ✅     |

## Installation

```sh
composer create-project cable8mm/xeed
```

And edit the `.env` file to configure your own database. You can manually copy `.env.example` to `.env` whenever you need to.

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
```

## License

The Xeed project is open-sourced software licensed under the [MIT license](LICENSE.md).
