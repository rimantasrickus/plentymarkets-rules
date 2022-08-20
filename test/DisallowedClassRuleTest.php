<?php

declare(strict_types=1);

namespace App;

use PHPStan\Testing\RuleTestCase;
use PlentymarketsRules\Rules\DisallowedClassRule;

/**
 * @extends RuleTestCase<DisallowedClassRule>
 */
class DisallowedClassRuleTest extends RuleTestCase
{
    protected function getRule(): \PHPStan\Rules\Rule
    {
        return new DisallowedClassRule();
    }

    public function testDisallowRule(): void
    {
        $this->analyse([__DIR__ . '/data/disallowed-class.php'], [
            [
                'Not allowed to extend class "App"',
                3,
            ],
        ]);
    }
}
