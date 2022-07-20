<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Alias\ModernizeStrposFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\Comment\SingleLineCommentStyleFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUselessElseFixer;
use PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer;
use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use PhpCsFixer\Fixer\LanguageConstruct\IsNullFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\IncrementStyleFixer;
use PhpCsFixer\Fixer\ReturnNotation\NoUselessReturnFixer;
use PhpCsFixer\Fixer\ReturnNotation\ReturnAssignmentFixer;
use PhpCsFixer\Fixer\Semicolon\MultilineWhitespaceBeforeSemicolonsFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->parallel();
    $ecsConfig->cacheDirectory(__DIR__.'/.ecs_cache');
    $ecsConfig->paths([
        __DIR__.'/src',
        __DIR__.'/tests'
    ]);

    $ecsConfig->skip([
        IsNullFixer::class,
        MultilineWhitespaceBeforeSemicolonsFixer::class,
        NativeFunctionInvocationFixer::class,
        ReturnAssignmentFixer::class,
        SingleLineCommentStyleFixer::class,
        YodaStyleFixer::class,
    ]);

    $ecsConfig->sets([
        SetList::PSR_12,
    ]);

    $ecsConfig->rules([
        NoUselessReturnFixer::class,
        NoUselessElseFixer::class,
        ModernizeStrposFixer::class,
    ]);

    $ecsConfig->ruleWithConfiguration(IncrementStyleFixer::class, [
        'style' => 'post'
    ]);

    $ecsConfig->ruleWithConfiguration(ClassAttributesSeparationFixer::class, [
        'elements' => ['const' => 'only_if_meta', 'method' => 'one', 'property' => 'one', 'trait_import' => 'only_if_meta'],
    ]);

    $ecsConfig->ruleWithConfiguration(BlankLineBeforeStatementFixer::class, [
        'statements' => ['if', 'break', 'continue', 'declare', 'return', 'throw', 'try', 'switch'],
    ]);

    $ecsConfig->ruleWithConfiguration(BinaryOperatorSpacesFixer::class, [
        'default'   => 'align_single_space_minimal',
        'operators' => [
            '|'  => 'no_space',
            '/' => null,
            '*' => null,
            '||' => null,
            '&&' => null,
            '??' => null,
        ],
    ]);
};
