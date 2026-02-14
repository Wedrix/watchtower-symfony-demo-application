<?php

declare(strict_types=1);

namespace Wedrix\Watchtower\FilterPlugin;

use Wedrix\Watchtower\Resolver\Node;
use Wedrix\Watchtower\Resolver\QueryBuilder;

function apply_comments_ids_filter(
    QueryBuilder $queryBuilder,
    Node $node
): void
{
    $rootEntityAlias = $queryBuilder->rootEntityAlias();
    $ids = $node->args()['queryParams']['filters']['ids'] ?? [];

    if (!\is_array($ids) || $ids === []) {
        $queryBuilder->andWhere('1 = 0');

        return;
    }

    $queryBuilder->andWhere("$rootEntityAlias.id IN (:ids)")
        ->setParameter('ids', $ids);
}
