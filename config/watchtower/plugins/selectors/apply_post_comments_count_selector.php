<?php

declare(strict_types=1);

namespace Wedrix\Watchtower\SelectorPlugin;

use Wedrix\Watchtower\Resolver\Node;
use Wedrix\Watchtower\Resolver\QueryBuilder;

function apply_post_comments_count_selector(
    QueryBuilder $queryBuilder,
    Node $node
): void
{
    $rootEntityAlias = $queryBuilder->rootEntityAlias();
    $commentsAlias = $queryBuilder->reconciledAlias('comments');

    $queryBuilder
        ->leftJoin("$rootEntityAlias.comments", $commentsAlias)
        ->addGroupBy("$rootEntityAlias.id")
        ->addSelect("COUNT($commentsAlias) AS commentsCount");
}
