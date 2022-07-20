<?php declare(strict_types = 1);

namespace PlentymarketsRules\Rules;

use PhpParser\Node;
use PHPStan\Rules\Rule;
use PHPStan\Analyser\Scope;

/**
 * @implements Rule<Node\Stmt\Class_>
 */
class DisallowedClassRule implements Rule
{
    private $disallowedClasses = [
        'App',
        'Artisan',
        'Auth',
        'Bus',
        'Config',
        'DB',
        'Eloquent',
        'Event',
        'File',
        'Gate',
        'Password',
        'Schema',
        'Storage',
    ];

    public function getNodeType(): string
    {
        return Node\Stmt\Class_::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if ($node->extends !== null) {
            $className = $node->extends->getLast();
            if (in_array($className, $this->disallowedClasses)) {
                return [
                    sprintf('Not allowed to extend class "%s"', $className),
                ];
            }
        }

        return [];
    }
}
