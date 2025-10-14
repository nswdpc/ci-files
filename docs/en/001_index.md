# Documentation

## Setup

These workflows and configurations are designed to work in either a vendor module or project scope. After requiring this module as a dev requirement in your project or module, read the relevant section below for usage hints.

The initial upgrade / refactor of code can be time consuming, depending on code quality, but once this has been done subsequent updates are very simple.

### Require the module

```sh
composer require --dev nswdpc/ci-files:^4
```
or to use the latest dev branch for the most recent configuration updates:

```sh
composer require --dev nswdpc/ci-files:dev-v-4
```

### Should I run this in production?

No. These tools are designed to run as development requirements on a developer's machine or within a CI process as an aid to improving and upgrading code.

### Minimum dev requirements

You may also want to set specific minimum versions of `phpstan/phpstan`, `phpstan/phpstan-phpunit`, `rector/rector` and `friendsofphp/php-cs-fixer` in your project's composer requirements.

If your project requires other [phpstan-* extensions](https://github.com/phpstan) as dev requirements, install those.

### PSR-4

Analysis and automated refactoring work best (or only) when your code is [PSR-4 compliant](https://www.php-fig.org/psr/psr-4/). Run [`composer dump-autoload -o --strict-psr` to verify and make changes](https://getcomposer.org/doc/03-cli.md#dump-autoload-dumpautoload). You may need to provide [psr-4 `autoload` configuration in composer](https://getcomposer.org/doc/04-schema.md#psr-4) and then verify with another `dump-autoload`.

### Parts

### phpstan analysis

Does static analysis via phpstan. Will report on basic coding errors, unknown classes from missing composer requirements,  syntax errors and lots of other items. Our default configuration for phpstan is not to loose, and not too strict.

### rector automated refactoring (and dry run)

Automated refactoring of PHP code from one version of PHP to another. Also includes Silverstripe configuration to move code from one version of that framework to a newer one.

You can use the "dry run" options and commands provided to see what the change would be before it is made.

### php-cs-fixer code standards fixing

This configuration updates code to a standard specified in the configuration referenced.

## Silverstripe requirements

For Silverstripe refactoring, your project or module should also have the following dev requirements in composer.json. **These are not installed by default**.

```json
"require-dev": {
    "cambis/silverstripe-rector": "^2",
    "cambis/silverstan": "^2"
}
```

These two modules (https://github.com/Cambis/silverstan and https://github.com/Cambis/silverstripe-rector) provide specific extensions and configuration to assist phpstan and rector in understanding your Silverstripe project or vendor module code.

## Workflows

See [workflows](./002_workflows.md) for more information on the workflows available.

## Usage 

### Within a vendor module

For local analysis & refactoring of a composer vendor module, you must clone the module to a location and run a `composer install` on that location (requires composer and dependencies). Running e.g. rector automated updates on a module while it is installed in a project as a vendor module can lead to errors and unhappiness.

1. Checkout/clone a module to a location from its repo.
2. Run a composer install, ensuring the relevant dev requirements are set
3. Run the relevant analysis / refactoring scripts/commands
4. Observe the changes made or suggested, and make any required changes and fixes
5. Commit changes when done and follow your normal merge request process

For easy access to analysis and refactoring, add scripts to your composer.json:

```json
"scripts": {
    "phpstan-analyse": "./vendor/bin/phpstan analyse --ansi --no-progress --no-interaction --configuration vendor/nswdpc/ci-files/phpstan/.phpstan.silverstripe.neon src/",
    "rector-dryrun": "./vendor/bin/rector process --dry-run --ansi --config vendor/nswdpc/ci-files/rector/.rector.silverstripe_53_83.php src/ tests/*.php",
    "rector-process": "./vendor/bin/rector process --no-diffs --ansi --config vendor/nswdpc/ci-files/rector/.rector.silverstripe_53_83.php src/ tests/*.php",
    "phpcsfixer-fix": "./vendor/bin/php-cs-fixer fix --ansi --no-interaction --config vendor/nswdpc/ci-files/php-cs-fixer/.php-cs-fixer.php src/"
},
```

Then:

```sh
composer run-script phpstan-analyse
```

When it comes time to refactor/update to a new version, update the relevant configuration files referenced in these commands.

#### .gitignore

For vendor module analysis and automated updates ensure directories created via a composer install are not added to version control. For a Silverstripe vendor module the base entries in e.g. a `.gitignore` file are:

```
/vendor/
/public/
/composer.lock
```

### Within your project

To analyse and refactor project code, e.g. code not in a /vendor/ directory in a Silverstripe project, ensure the dev requirements are installed in the project. After this is done, run the relevant commands using the paths for the project.

For easy access to analysis and refactoring, add scripts to your composer.json. The paths analysed and refactored in these examples are app/src and app/tests, relative to the root directory of your project.

```json
"scripts": {
    "phpstan-analyse": "./vendor/bin/phpstan analyse --ansi --no-progress --no-interaction --configuration vendor/nswdpc/ci-files/phpstan/.phpstan.silverstripe.neon app/src/ app/tests/*.php",
    "rector-dryrun": "./vendor/bin/rector process --dry-run --ansi --config vendor/nswdpc/ci-files/rector/.rector.silverstripe_53_83.php app/src/ app/tests/*.php",
    "rector-process": "./vendor/bin/rector process --no-diffs --ansi --config vendor/nswdpc/ci-files/rector/.rector.silverstripe_53_83.php app/src/ app/tests/*.php",
    "phpcsfixer-fix": "./vendor/bin/php-cs-fixer fix --ansi --no-interaction --config vendor/nswdpc/ci-files/php-cs-fixer/.php-cs-fixer.php app/src/ app/tests/*.php"
},
```

Then:

```sh
composer run-script phpstan-analyse
```

A suggested workflow is:
1. Checkout a branch of a project
2. Ensure the relevant dev requirements (this module) are installed
3. Run the relevant refactoring/analysis commands
4. Observe changes and make any required manual changes to your code
5. Commit the changes back to your branch and follow your testing process

When it comes time to refactor/update to a new version, update the relevant configuration files referenced in these commands.

## Github actions

Automated refactoring can be done e.g. on a pull request by referencing the relevant jobs in a workflow file in your module:

```yml
# ./.github/workflows/my_pr_workflow.yml
name: add your action name

on:
  pull_request: null

jobs:
  # run automated refactoring and code standards
  Silverstripe:
    name: 'Silverstripe (bundle)'
    uses: nswdpc/ci-files/.github/workflows/silverstripe_53_83.yml@v-4
  # run automated static analysis
  PHPStan:
    name: 'PHPStan (analyse)'
    uses: nswdpc/ci-files/.github/workflows/phpstan.silverstripe_83.yml@v-4
    needs: Silverstripe
```

When a pull request occurs, these actions will run.

Again, when it comes time to refactor/update to a new version, update the relevant configuration files referenced in these commands.


## Development tools

If you use tools like lando or ddev, these commands can be included as e.g. lando tooling.