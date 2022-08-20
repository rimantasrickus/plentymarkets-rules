<?php

declare(strict_types=1);

namespace App;

use PHPStan\Testing\RuleTestCase;
use PlentymarketsRules\Rules\DisallowedNewRule;

/**
 * @extends RuleTestCase<DisallowedNewRule>
 */
class DisallowedNewRuleTest extends RuleTestCase
{
    protected function getRule(): \PHPStan\Rules\Rule
    {
        return new DisallowedNewRule();
    }

    public function testDisallowRule(): void
    {
        $this->analyse([__DIR__ . '/data/disallowed-new.php'], [
            [
                'New is not allowed',
                7,
            ],
        ]);
    }
}
