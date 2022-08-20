<?php

declare(strict_types=1);

namespace PlentymarketsRules\Rules;

use PhpParser\Node;
use PHPStan\Rules\Rule;
use PHPStan\Analyser\Scope;
use PhpParser\PrettyPrinter\Standard;

/**
 * @implements Rule<Node\Stmt\ClassConst>
 */
class DisallowConstantVisibility implements Rule
{
    private $printer;

    public function __construct(Standard $printer)
    {
        $this->printer = $printer;
    }

    public function getNodeType(): string
    {
        return \PhpParser\Node\Stmt\ClassConst::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if ($node->hasAttribute('comments')) {
            $node->setAttribute('comments', []);
        }

        $statement = $this->printer->prettyPrint([$node]);
        if (str_starts_with($statement, 'public')
            || str_starts_with($statement, 'protected')
            || str_starts_with($statement, 'private')
        ) {
            return [
                'Constant visibility not allowed',
            ];
        }

        return [];
    }
}
