<?php

declare(strict_types=1);

namespace PlentymarketsRules\Rules;

use PhpParser\Node;
use PHPStan\Rules\Rule;
use PHPStan\Analyser\Scope;
use PhpParser\Node\Identifier;
use PhpParser\Node\Expr\Variable;
use PHPStan\Node\Printer\ExprPrinter;

/**
 * @implements Rule<Node\Expr\PropertyFetch>
 */
class DisallowedDynamicPropertyAccess implements Rule
{
    private $exprPrinter;

    public function __construct(ExprPrinter $exprPrinter)
    {
        $this->exprPrinter = $exprPrinter;
    }

    public function getNodeType(): string
    {
        return \PhpParser\Node\Expr\PropertyFetch::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if (!$node->name instanceof Variable) {
            return [];
        }

        $expression = $this->exprPrinter->printExpr($node);
        if (preg_match('/->{\$\w+}/m', $expression) !== 1) {
            return [];
        }

        return [
            'Dynamic property access is not allowed',
        ];
    }
}
