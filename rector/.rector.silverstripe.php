<?php

declare(strict_types=1);

/**
 * Example commands:
 * add -n for --dry-run
 * use -h for help docs
 * Standard: ./vendor/bin/rector process -c .rector.dist.php vendor/vendorname/module
 * With no diff: ./vendor/bin/rector process --no-diffs -c .rector.dist.php vendor/vendorname/module
 */

// common Silverstripe bootstrap
require_once(__DIR__ . '/support/SilverstripeBootstrap.php');

// common rules handling class
require_once(__DIR__ . '/support/Rules.php');

// @var \Rector\Configuration\RectorConfigBuilder $builder
$builder = \Rector\Config\RectorConfig::configure();
return $builder

    ->withBootstrapFiles([
        $ssBootstrap,
        __DIR__ . '/bootstrap/silverstripe.php',
    ])

    ->withPaths([
        'src/',
        'tests/'
    ])

    ->withSkip(
        \NSWDPC\Rector\Rules::commonSkipRules()
    )

    ->withRules(
        \NSWDPC\Rector\Rules::commonRules()
    )

    ->withSets([
        \Cambis\SilverstripeRector\Set\ValueObject\SilverstripeSetList::CODE_QUALITY
    ])

    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        earlyReturn: false,
        instanceOf: true,
        typeDeclarations: true,
        naming: false,
        phpunit: false,
        strictBooleans: true
    )

    ->withPhpSets(
        php83: true
    );
