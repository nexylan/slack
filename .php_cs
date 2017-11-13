<?php

$finder = \PhpCsFixer\Finder::create()
    ->in([
        __DIR__.'/src',
        __DIR__.'/tests',
    ])
;

$header = <<<HEADER
This file is part of the Nexylan packages.

(c) Nexylan SAS <contact@nexylan.com>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
HEADER;

return \PhpCsFixer\Config::create()
    ->setRules([
        '@PHPUnit57Migration:risky' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'array_syntax' => [
            'syntax' => 'short'
        ],
        'combine_consecutive_unsets' => true,
        'doctrine_annotation_braces' => true,
        'doctrine_annotation_spaces' => true,
        'general_phpdoc_annotation_remove' => [
            'covers',
        ],
        'linebreak_after_opening_tag' => true,
        'modernize_types_casting' => true,
        'native_function_invocation' => true,
        'no_php4_constructor' => true,
        'no_unreachable_default_argument_value' => true,
        'ordered_imports' => true,
        'php_unit_strict' => true,
        'phpdoc_order' => true,
        'phpdoc_summary' => false,
        'semicolon_after_instruction' => true,
        'strict_comparison' => true,
        'strict_param' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
