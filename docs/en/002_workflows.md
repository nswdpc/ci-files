# Workflows

All the bundled workflows can be found in `.github/workflows`. The file naming follows a somewhat standard of `application_version_phpversion.yml`.

Configuration files including the name "vanilla" are not tied to any framework.

## Configurations

You can reference the configuration files directly, e.g. on a shell or in a composer script.

### Composer script

```json
"scripts": {
    "phpstan-analyse": "./vendor/bin/phpstan analyse --ansi --no-progress --no-interaction --configuration vendor/nswdpc/ci-files/phpstan/.phpstan.silverstripe.neon src/",
```

### Command

```sh
./vendor/bin/phpstan analyse --ansi --no-progress --no-interaction --configuration vendor/nswdpc/ci-files/phpstan/.phpstan.silverstripe.neon src/
```

### Versions

More recent workflows will use later version of PHP to run static analysis, refactoring and code standards updates.

For Rector, the relevant configuration will set the PHP version to refactor at, e.g:
```
   ->withPhpSets(
        php83: true
    );
```

This instructs rector to refactor to that version (8.3), even if the environment is running  a greater php version.

As frameworks and projects drop older version of PHP, the `withPhpSets` value can be increased.
