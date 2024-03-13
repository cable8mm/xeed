# DB to markdown

[![code-style](https://github.com/cable8mm/xeed/actions/workflows/code-style.yml/badge.svg)](https://github.com/cable8mm/db-to-markdown/actions/workflows/code-style.yml)
[![run-tests](https://github.com/cable8mm/xeed/actions/workflows/run-tests.yml/badge.svg)](https://github.com/cable8mm/db-to-markdown/actions/workflows/run-tests.yml)

The Xeed is to generate a new seed file based on data from the existing database table.

## Features

- [ ] Generate factories
- [ ] Generate seed files
- [ ] Generate database seed files
- [ ] Database testing is supported

## Support & Tested

| Versions  | PHP 8.0.2 | PHP 8.1.\* | PHP 8.2.\* | PHP 8.3.\* |
| :-------: | :-------: | :--------: | :--------: | :--------: |
| Available |    ✅     |     ✅     |     ✅     |     ✅     |

## Installation

```sh
# composer create-project cable8mm/xeed
```

### Formatting

```bash
composer lint
# Modify all files to comply with the PSR-12.

composer inspect
# Inspect all files to ensure compliance with PSR-12.
```

### Test

It uses the built-in SQLite database, not your own database. It will never cause harm to your data. You don't need to worry about that.

```sh
composer test
```

## License

The Xeed project is open-sourced software licensed under the [MIT license](LICENSE.md).
