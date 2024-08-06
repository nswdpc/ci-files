# Documentation

## Project setup

Your project should have the following dev requirements in composer.json:

```json
"require-dev": {
    "friendsofphp/php-cs-fixer": "^3",
    "phpstan/phpstan": "^1",
    "rector/rector": "^1",
    "nswdpc/ci-files": "*"
}
```

For Silverstripe development, it should also have the following dev requirements in composer.json:

```json
"require-dev": {
    "cambis/silverstripe-rector": "^0.5.1",
    "syntro/silverstripe-phpstan": "^5"
}
```

To include nswdpc/ci-files via composer add the following repository entry to composer.json:
```json
"repositories": [
    {
        "type": "git",
        "url": "https://github.com/nswdpc/ci-files.git"
    }
]
```

If you are not using a tagged nswdpc/ci-files, add the following at the root of composer.json:

```json
{
    "prefer-stable": true,
    "minimum-stability": "dev"
}
```

## Paths

By default, the configuration files will set the directories `src` and `tests` as the directories to find and update files within. These cannot be changed.

## Workflows

### Bundle

(bundle.yml)

This bundle does the following on the `pull_request` event:

1. Preps the environment
1. Checks out the project
1. Runs a `composer install`
1. Runs `php-cs-fixer fix` (see bundle.yml)
1. Commits any changes to the PR's branch (see bundle.yml)
1. Runs `rector process` (see bundle.yml)
1. Commits any changes to the PR's branch (see bundle.yml)

#### Skipping

+ To skip php-cs-fixer actions, ensure the branch name has `no-cs-fix` in it e.g `feat-myfeature-no-cs-fix`
+ To skip rector actions, ensure the branch name has `no-rector` in it e.g `feat-myfeature-no-rector`

```yml
name: Automated tasks
on:
  pull_request: null
jobs:
  Bundle:
    name: Run automated code quality workflows
    uses: nswdpc/ci-files/.github/workflows/bundle.yml@main
    secrets: inherit
```

### PHP-CS-Fixer

Does everything the bundle.yml does in prep, but only processes php-cs-fixer steps

```yml
name: PHP-CS-Fixer
on:
  pull_request: null
jobs:
  php-cs-fixer:
    name: PHP-CS-Fixer
    uses: nswdpc/ci-files/.github/workflows/php-cs-fixer.yml@main
    secrets: inherit
```

### Rector


Does everything the bundle.yml does in prep, but only processes rector steps

```yml
name: Rector
on:
  pull_request: null
jobs:
  rector:
    name: Rector
    uses: nswdpc/ci-files/.github/workflows/rector.yml@main
    secrets: inherit
```
