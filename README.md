# Automated analysis and upgrade tools

A collection of files and configuration for upgrading and analysing your code in CI and development.

* Code standards updates using `friendsofphp/php-cs-fixer`
* Static analyis using `phpstan/phpstan` and
* Automated code refactoring using `rector/rector` to make upgrades faster and easier.

## Install

Require as a dev component in your project/module.

```sh
composer require --dev nswdpc/ci-files:^4
```
OR

```sh
composer require --dev nswdpc/ci-files:dev-v-4
```
OR

```sh
composer require --dev nswdpc/ci-files:dev-v-4#abcd1234
```

Use the relevant tag or dev-v-N branch or a tag, depending on your refactoring requirements. The branch will have the latest untagged changes in that major version.

## Use

[Read the documentation](./docs/en/001_index.md)

## License

[BSD-3-Clause](./LICENSE.md)

## Maintainers

+ PD web team

## Bugtracker

We welcome bug reports, pull requests and feature requests on the Github Issue tracker for this project.

Please review the [code of conduct](./code-of-conduct.md) prior to opening a new issue.

## Security

If you have found a security issue with this module, please email digital[@]dpc.nsw.gov.au in the first instance, detailing your findings.

## Development and contribution

If you would like to make contributions to the module please ensure you raise a pull request and discuss with the module maintainers.

Please review the [code of conduct](./code-of-conduct.md) prior to completing a pull request.
