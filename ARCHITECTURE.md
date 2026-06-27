# ARCHITECTURE.md — Xeed System Overview

Xeed is a schema-driven Laravel and Nova code generator.

It inspects a live database schema, applies deterministic rules, and writes generated files to the package output directories.

## 1. Core Flow

```text
Database schema
  -> Xeed introspection
  -> Table / Column / ForeignKey objects
  -> Resolver and generator rules
  -> File writers
  -> Laravel / Nova / database output
```

The same schema should always produce the same output.

## 2. Main Responsibilities

### Commands

Located in `src/Commands/`.

Commands are thin orchestration layers:

- read the current database connection
- ask `Xeed` for tables
- call the matching generator
- pass the `--force` flag through unchanged

### Introspection

`Xeed`, `Table`, `Column`, and `ForeignKey` describe the database schema in memory.

- `Xeed` connects to the database and discovers tables
- `Table` models table-level metadata
- `Column` models column metadata and type mapping inputs
- `ForeignKey` models relation metadata

### Rules and Resolvers

Located in `src/Resolvers/`.

Resolvers turn schema metadata into Laravel-specific outputs:

- PHP types and casts
- Nova field definitions
- relationship helpers

### Generators

Located in `src/Generators/`.

Generators transform schema objects into files:

- `ModelGenerator` -> `app/Models`
- `FactoryGenerator` -> `database/factories`
- `SeederGenerator` -> `database/seeders`
- `FakerSeederGenerator` -> `database/seeders`
- `DatabaseSeederGenerator` -> `database/seeders`
- `MigrationGenerator` -> `database/migrations`
- `NovaResourceGenerator` -> `app/Nova`
- `RelationGenerator` -> updates existing models in `app/Models`

## 3. Output Locations

Default output locations follow Laravel conventions:

- `app/Models`
- `app/Nova`
- `database/factories`
- `database/seeders`
- `database/migrations`

In tests, generated files may be redirected to `tests/Generate`.

## 4. Relation Generation

`xeed:relation` is different from the other generators.

- It augments existing model files with `belongsTo` and `hasMany` methods
- It requires existing model files to be present
- It respects the same `--force` semantics as the other generators

## 5. Determinism

The package is intended to be deterministic.

Given the same schema and the same generator rules:

- output file names should stay stable
- generated content should stay stable
- no random or environment-specific naming should appear

## 6. File Safety Model

Generated files are treated as disposable outputs.

Source files, tests, and package code are authoritative.

The safe editing rule is:

- update generator inputs, resolvers, or tests when behavior changes
- update generated output only when it is meant to serve as a fixture or expected result
