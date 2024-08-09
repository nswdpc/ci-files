<?php

declare(strict_types=1);

/**
 * Add Page and PageController from the module stub files to the class manifest
 */
(function() {
    $classManifest = SilverStripe\Core\Manifest\ClassLoader::inst()->getManifest();
    $basename = realpath(__DIR__ . '/../../../../cambis/silverstripe-rector/stubs/');
    if(!$basename || !is_dir($basename)) {
        throw new \Exception("Silverstripe stub basename not found");
    }
    if(class_exists(\Page::class)) {
        $classManifest->handleFile($basename, $basename . '/Page.php', false);
    }
    if(class_exists(\PageController::class)) {
        $classManifest->handleFile($basename, $basename . '/PageController.php', false);
    }
})();
