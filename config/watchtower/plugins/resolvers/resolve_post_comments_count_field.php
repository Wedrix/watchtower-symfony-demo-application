<?php

declare(strict_types=1);

namespace Wedrix\Watchtower\ResolverPlugin;

use Wedrix\Watchtower\Resolver\Node;

function resolve_post_comments_count_field(
    Node $node
): mixed
{
    $entityManager = $node->context()['entity_manager'];

    $postId = $node->root()['id'];

    return $entityManager->createQuery("SELECT COUNT(postComment) FROM App\\Entity\\Post post
                            JOIN post.comments postComment
                            WHERE post.id = :postId
                        ")
                        ->setParameter('postId',$postId)
                        ->getSingleScalarResult();
}
