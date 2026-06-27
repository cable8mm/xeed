# AGENTS.md — Xeed Agent Rules

This file defines how AI agents should work in this repository.

Read `ARCHITECTURE.md` first to understand the system layout, then use this file for task execution rules.

## 1. Working Model

- Treat Xeed as a schema-driven code generator.
- Use the live database schema and the repository’s generator rules as the source of truth.
- Do not infer relationships, types, or naming behavior beyond what the schema and code already define.

## 2. Before Making Changes

- Inspect `ARCHITECTURE.md`.
- Inspect the relevant files in `src/Commands/`, `src/Generators/`, and `src/Resolvers/`.
- Inspect `composer.json` when command behavior, scripts, or test entrypoints matter.
- Inspect tests before changing behavior.

## 3. Change Strategy

- Prefer minimal, targeted diffs.
- Preserve public behavior unless the task explicitly asks for a change.
- Keep command, generator, and resolver responsibilities separated.
- Update tests when behavior changes.

## 4. Force and Overwrite Rules

- `--force` or `-f` means an existing generated file may be overwritten.
- Without `--force`, generated files must not be overwritten.
- `xeed:relation` follows the same `--force` semantics for both the source model and related models.
- Generated files are disposable outputs, not authoritative sources.

## 5. Safety Rules

- Do not modify `vendor/`, external package code, or Testbench internals.
- Do not introduce unrelated framework conventions.
- Do not optimize beyond the task scope.

## 6. Determinism Rules

- Preserve deterministic output for the same schema and settings.
- Avoid random naming or hidden environment-specific behavior.
- If a change affects determinism, treat it as a bug unless explicitly intended.

## 7. Final Priority

If this file conflicts with other conventions or defaults, follow this file.
