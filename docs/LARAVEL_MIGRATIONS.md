# Laravel Migrations Compatibility

Here's a table outlining some commonly used field types in Laravel migrations and their equivalents between SQLite and MySQL:

|   Laravel Migration Type    | SQLite Equivalent | MySQL Equivalent |
| :-------------------------: | :---------------: | :--------------: |
| `$table->year('birth_day')` |       year        |     integer      |

These are basic mappings and may not cover all possible scenarios. It's important to consult the documentation for SQLite and MySQL to ensure compatibility with your specific requirements. Additionally, some Laravel-specific features like $table->timestamps() and $table->softDeletes() do not directly translate to specific field types in database systems like SQLite or MySQL.
