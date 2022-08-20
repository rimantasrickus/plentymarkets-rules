<?php

declare(strict_types=1);

namespace App;

use PHPStan\Node\Printer\Printer;
use PHPStan\Testing\RuleTestCase;
use PHPStan\Node\Printer\ExprPrinter;
use PlentymarketsRules\Rules\DisallowedDynamicPropertyAccess;

/**
 * @extends RuleTestCase<DisallowedDynamicPropertyAccess>
 */
class DisallowedDynamicPropertyAccessTest extends RuleTestCase
{
    protected function getRule(): \PHPStan\Rules\Rule
    {
        return new DisallowedDynamicPropertyAccess(new ExprPrinter(new Printer()));
    }

    public function testDisallowRule(): void
    {
        $this->analyse([__DIR__ . '/data/disallowed-dynamic-property-access.php'], [
            [
                'Dynamic property access is not allowed',
                13,
            ],
            [
                'Dynamic property access is not allowed',
                21,
            ],
        ]);
    }
}
