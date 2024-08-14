<?php
namespace NSWDPC\Rector;

/**
 * Rules handling class, stores common rules used across workflows
 */
abstract class Rules {

    /**
     * Specific rules can be added here
     */
    public static function commonRules(): array
    {
        return [];
    }

    /**
     * Return merged rules
     */
    public static function mergeRules(array $rules = []): array {
        return array_unique(array_merge( self::commonRules(), $rules));
    }

    /**
     * Return common skip rules, see comments for reasons
     */
    public static function commonSkipRules(): array
    {
        return [

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
            \Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector::class,

            // Avoid applying this rule, too verbose
            \Rector\TypeDeclaration\Rector\BooleanAnd\BinaryOpNullableToInstanceofRector::class,

            // Avoid applying this rule, too verbose
            \Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector::class,

            // Avoid applying this rule, not handling ?SomeClass return types appropriately
            \Rector\Strict\Rector\Ternary\BooleanInTernaryOperatorRuleFixerRector::class

        ];
    }

    /**
     * Return rules merged with common skip rules
     */
    public static function mergeSkipRules(array $rules = []): array {
        return array_unique(array_merge( self::commonSkipRules(), $rules));
    }
}
