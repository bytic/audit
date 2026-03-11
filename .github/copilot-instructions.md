# Copilot Instructions for bytic/audit

## Project Overview

`bytic/audit` is a PHP audit trail bundle for the [bytic framework](https://github.com/bytic). It records model changes (create, update, delete) and associates them with users and requests for full auditability.

## Technology Stack

- **Language**: PHP 7.2+, 8.0+
- **Framework**: bytic framework (uses `bytic/orm`, `bytic/actions`, `bytic/auth`, `bytic/event-dispatcher`, `bytic/package-base`)
- **Testing**: PHPUnit 9, Mockery
- **Static Analysis**: PHPStan, Psalm
- **Code Style**: PSR-2 (enforced via PHP_CodeSniffer / StyleCI)

## Repository Structure

```
src/
  AuditServiceProvider.php       # Service provider to register the package
  Application/Library/           # Application-level library classes
  Models/AuditTrails/            # ORM models: AuditTrail (Record) and AuditTrails (RecordManager)
  Trails/
    AuditTrailBuilder.php        # Builder for creating audit trail entries
    AuditableModel/              # Traits for auditable record and repository
    Actions/                     # Action classes (e.g., Finder)
    Events/                      # Event classes for audit lifecycle
  Utility/                       # Helper utilities and package config
migrations/                      # Database migrations (create audit_trails table)
tests/
  bootstrap.php
  fixtures/                      # Test fixture models/data
  src/                           # PHPUnit test cases (mirrors src/ structure)
config/                          # Package configuration files
resources/                       # Views and other resources
```

## Bootstrap and Build

```bash
# Install dependencies
composer install

# Run tests
vendor/bin/phpunit

# Run static analysis
vendor/bin/phpstan analyse
vendor/bin/psalm

# Run code style check
vendor/bin/phpcs --standard=PSR2 src/ tests/
```

## Coding Conventions

- Follow **PSR-2** coding standard for all PHP files.
- Use **PSR-4 autoloading**: namespace `ByTIC\Audit\` maps to `src/`, test namespace `ByTIC\Audit\Tests\` maps to `tests/src/`.
- Class names use **PascalCase**; methods and properties use **camelCase**.
- All classes belong to a sub-namespace matching their directory (e.g., `ByTIC\Audit\Models\AuditTrails`).
- Use **traits** to add audit capabilities to existing models (see `HasAuditTrailsRecordTrait`, `HasAuditTrailsTrait`).
- Prefer **docblocks** for return types when using mixed or complex types, using `@param` and `@return` annotations.
- Add PHPDoc blocks to all public methods.

## Testing Conventions

- All test classes extend `ByTIC\Audit\Tests\AbstractTestCase` (which extends `PHPUnit\Framework\TestCase`).
- Use **Mockery** for mocking; `MockeryPHPUnitIntegration` trait is included in `AbstractTestCase`.
- Test files are placed under `tests/src/` and mirror the `src/` directory structure.
- Test class names end with `Test` (e.g., `AuditTrailBuilderTest`).
- Use `@covers` annotations where appropriate.

## Key Concepts

- **AuditTrail**: An ORM record storing a single audit event (model type, model id, event type, user, IP, timestamps, metadata).
- **AuditTrailBuilder**: Fluent builder for constructing and persisting `AuditTrail` entries. Use `AuditTrailBuilder::for($model, $event)` as the entry point.
- **Auditable Model traits**: Add `HasAuditTrailsRecordTrait` to a `Record` class and `HasAuditTrailsRepositoryTrait` to the corresponding `RecordManager` to make a model auditable.
- **AuditServiceProvider**: Registers the package with the bytic service container and provides the migrations path.
- **AuditModels utility**: Central registry (`ByTIC\Audit\Utility\AuditModels`) for resolving the `AuditTrails` repository.
