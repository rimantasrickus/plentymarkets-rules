<?php

declare(strict_types=1);

namespace App;

use PHPStan\Testing\RuleTestCase;
use PhpParser\PrettyPrinter\Standard;
use PlentymarketsRules\Rules\DisallowConstantVisibility;

/**
 * @extends RuleTestCase<DisallowConstantVisibility>
 */
class DisallowConstantVisibilityTest extends RuleTestCase
{
    protected function getRule(): \PHPStan\Rules\Rule
    {
        return new DisallowConstantVisibility(new Standard());
    }

    public function testDisallowRule(): void
    {
        $this->analyse([__DIR__ . '/data/disallowed-constant-visibility.php'], [
            [
                'Constant visibility not allowed',
                5,
            ],
            [
                'Constant visibility not allowed',
                6,
            ],
            [
                'Constant visibility not allowed',
                7,
            ],
        ]);
    }
}
