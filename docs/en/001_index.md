# Documentation

## Setup

These workflows are designed to work in a vendor module scope.

Optional repositories entries.
This can be removed once the module is in packagist.

```json
"repositories": [
    {
        "type": "git",
        "url": "https://github.com/nswdpc/ci-files.git"
    }
]
```

If you are not using a tagged nswdpc/ci-files, add the following at the root of the module's composer.json:

```json
{
    "prefer-stable": true,
    "minimum-stability": "dev"
}
```

Require the module:

```sh
composer require --dev nswdpc/ci-files
```

Result (version may alter):

```json
"require-dev": {
    "nswdpc/ci-files": "*"
}
```


### Silverstripe requirements

For Silverstripe refactoring, a silverstripe-vendormodule should also have the following dev requirements in composer.json. These are not installed by default.

```json
"require-dev": {
    "cambis/silverstripe-rector": "^0.5.1",
    "syntro/silverstripe-phpstan": "^5"
}
```

## Paths

By default, the configuration files will set the directories `src` and `tests` as the directories to find and update files within. These cannot be changed.

## Workflows

See also [workflows](./docs/en/002_workflows.md)

### Silverstripe

(silverstripe.yml)

This workflow does the following on the `pull_request` event:

1. Preps the environment
1. Checks out the project
1. Runs a `composer install`
1. Runs `php-cs-fixer fix` (see silverstripe.yml)
1. Commits any changes to the PR's branch (see silverstripe.yml)
1. Runs `rector process` (see silverstripe.yml)
1. Commits any changes to the PR's branch (see silverstripe.yml)

#### Skipping

+ To skip php-cs-fixer actions, ensure the branch name has `no-cs-fix` in it e.g `feat-myfeature-no-cs-fix`
+ To skip rector actions, ensure the branch name has `no-rector` in it e.g `feat-myfeature-no-rector`

```yml
name: Automated tasks
on:
  pull_request: null
jobs:
  Silverstripe:
    name: Run automated code quality workflows
    uses: nswdpc/ci-files/.github/workflows/silverstripe.yml@main
```

### PHP-CS-Fixer

(php-cs-fixer.yml)

Process php-cs-fixer steps

```yml
name: PHP-CS-Fixer
on:
  pull_request: null
jobs:
  php-cs-fixer:
    name: PHP-CS-Fixer (fix)
    uses: nswdpc/ci-files/.github/workflows/php-cs-fixer.yml@main
```

### Rector

(rector.silverstripe.yml)

Does everything the silverstripe.yml does in prep, but only processes rector steps

```yml
name: Rector
on:
  pull_request: null
jobs:
  rector:
    name: Rector (process)
    uses: nswdpc/ci-files/.github/workflows/rector.silverstripe.yml@main
```

### PhpStan

(phpstan.silverstripe.yml)


Does everything the silverstripe.yml does in prep, but only processes phpstan analyse

```yml
name: Rector
on:
  pull_request: null
jobs:
  PHPStan:
    name: 'PHPStan (analyse)'
    uses: nswdpc/ci-files/.github/workflows/phpstan.silverstripe.yml@main
```

## .gitignore

Ensure directories created via a composer install are not added to VCS. For a Silverstripe vendor module the base entries are:

```
/vendor/
/public/
/composer.lock
```
Alongside any other ignore rules you have.
