<?php
namespace NSWDPC\Rector;

/**
 * Silverstripe rector support requires cambis/silverstripe-rector
 * If the bootstrap is not available, exit
 */
$ssBootstrap = realpath(__DIR__ . '/../../../../cambis/silverstripe-rector/bootstrap.php');
if(!is_file($ssBootstrap)) {
    throw new \RuntimeException("Bootstrap 'cambis/silverstripe-rector/bootstrap.php' not found, is cambis/silverstripe-rector a dev requirement in composer.json?");
}
