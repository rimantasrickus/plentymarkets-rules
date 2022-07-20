<?php declare(strict_types = 1);

namespace App;

use PHPStan\Testing\RuleTestCase;
use PlentymarketsRules\Rules\DisallowedFunctionsRule;

/**
 * @extends RuleTestCase<DisallowedNewRule>
 */
class DisallowedFunctionsRuleTest extends RuleTestCase
{
    protected function getRule(): \PHPStan\Rules\Rule
    {
        return new DisallowedFunctionsRule();
    }

    public function testDisallowRule(): void
    {
        $this->analyse([__DIR__ . '/data/disallowed-functions.php'], [
            [
                'Function "is_dir()" is not allowed',
                7,
            ],
            [
                'Function "gettype()" is not allowed',
                12,
            ],
        ]);
    }
}
