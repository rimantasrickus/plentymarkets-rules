<?php declare(strict_types = 1);

namespace PlentymarketsRules\Rules;

use PhpParser\Node;
use PHPStan\Rules\Rule;
use PHPStan\Analyser\Scope;
use PhpParser\Node\Stmt\Throw_;

/**
 * @implements Rule<Node\Expr\New_>
 */
class DisallowedNewRule implements Rule
{
    public function getNodeType(): string
    {
        return Node\Expr\New_::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if ($node->getAttribute('parent') !== null && get_class($node->getAttribute('parent')) === Throw_::class) {
            return [];
        }

        return [
            'New is not allowed',
        ];
    }
}
