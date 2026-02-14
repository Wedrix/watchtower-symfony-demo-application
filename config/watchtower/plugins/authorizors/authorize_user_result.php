<?php

declare(strict_types=1);

namespace Wedrix\Watchtower\AuthorizorPlugin;

use GraphQL\Error\UserError;
use Wedrix\Watchtower\Resolver\Node;
use Wedrix\Watchtower\Resolver\Result;

function authorize_user_result(
    Result $result,
    Node $node
): void
{
    $request = $node->context()['request'];

    if (!$request->headers->has('X-TOKEN')) {
        throw new UserError("Unauthorized");
    }
}
