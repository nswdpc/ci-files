<?php
/**
 * Configuration file for https://github.com/PHP-CS-Fixer/PHP-CS-Fixer
 */
$finder = PhpCsFixer\Finder::create()
            ->in(__DIR__);

$config = new PhpCsFixer\Config();
return $config->setRules([
            '@PSR12' => true,// PSR-12 rule set
            'array_indentation' => true,
            'array_syntax' => ['syntax' => 'short'],
            'blank_line_after_namespace' => true,
            'blank_line_after_opening_tag' => true,
            'full_opening_tag' => true,
            'no_closing_tag' => true,
        ])
        ->setIndent("    ")
        ->setFinder($finder);
