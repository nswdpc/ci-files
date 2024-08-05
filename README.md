#  CI Files

A collection of files for use in CI and development.

## Install

Require as a dev component in your project/module:

```sh
composer require --dev nswdpc/ci-files
```

## Use

Use the files across projects by referencing the file locations.

```yaml
# Use rector.yaml in a  Github Action, with version number
uses: nswdpc/ci-files/github/workflows/rector.yaml@v1
```
