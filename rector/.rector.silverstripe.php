<?php

declare(strict_types=1);

/**
 * Example commands:
 * add -n for --dry-run
 * use -h for help docs
 * Standard: ./vendor/bin/rector process -c .rector.dist.php vendor/vendorname/module
 * With no diff: ./vendor/bin/rector process --no-diffs -c .rector.dist.php vendor/vendorname/module
 */

$ssBootstrap = realpath(__DIR__ . '/../../../cambis/silverstripe-rector/bootstrap.php');
if(!is_file($ssBootstrap)) {
    exit("Bootstrap 'cambis/silverstripe-rector/bootstrap.php' not found, is cambis/silverstripe-rector a dev requirement in composer.json?");
}

// @var \Rector\Configuration\RectorConfigBuilder $builder
$builder = \Rector\Config\RectorConfig::configure();
return $builder

    ->withBootstrapFiles([
        // cambis/silverstripe-rector bootstrap
        $ssBootstrap,
        // our bootstrap
        __DIR__ . '/bootstrap/silverstripe.php',
    ])

    ->withPaths([
        'src/',
        'tests/'
    ])

    // skip rules example
    ->withSkip([

        // Avoid applying this rule, due to the protected class method -> public subclass method -> protected sub-subclass method issue
        \Rector\CodingStyle\Rector\ClassMethod\MakeInheritedMethodVisibilitySameAsParentRector::class,

        // Avoid applying this rule, due to parent existing but with a different case
        // Should never have a parent class method call without a parent class anyway
        \Rector\DeadCode\Rector\StaticCall\RemoveParentCallWithoutParentRector::class,

        // Avoid applying this rule, as it's an opinion
        \Rector\CodeQuality\Rector\Concat\JoinStringConcatRector::class,

        // Avoid applying this as it adds properties for called SS $db fields
        \Rector\CodeQuality\Rector\Class_\CompleteDynamicPropertiesRector::class,

        //Avoid applying this rule, parent methods can have no void return type, better to be consistent
        \Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector::class,

        // Avoid applying this rule, encapsed strings are more readable
        \Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector::class

    ])

    // register a single rule example
    ->withRules([
        // add specific rules here
    ])

    ->withSets([
        \Cambis\SilverstripeRector\Set\ValueObject\SilverstripeSetList::CODE_QUALITY
    ])

    // define sets of rules
    ->withPreparedSets(
        //carbon: false,
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
