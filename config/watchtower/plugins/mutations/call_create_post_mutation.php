<?php

declare(strict_types=1);

namespace Wedrix\Watchtower\MutationPlugin;

use App\Entity\Post;
use App\Entity\User;
use Wedrix\Watchtower\Resolver\Node;

function call_create_post_mutation(
    Node $node
): mixed
{
    $entityManager = $node->context()['entity_manager'];

    $title = $node->args()['title'];
    $content = $node->args()['content'];
    $author = $entityManager->find(User::class, $node->args()['authorId']);

    if (!$author instanceof User) {
        return [
            '__typename' => 'FailedPostResponse',
            'status' => 'FAILED',
            'errors' => [
                ['body' => 'Invalid authorId'],
            ],
        ];
    }

    $post = new Post;
    $post->setTitle($title);
    $post->setContent($content);
    $post->setAuthor($author);
    $slug = \strtolower(\trim((string) \preg_replace('/[^a-z0-9]+/i', '-', $title), '-'));
    $post->setSlug($slug !== '' ? $slug : 'post');
    $post->setSummary(\substr($content, 0, 15));

    $entityManager->persist($post);

    $entityManager->flush();

    return [
        '__typename' => 'SuccessfulPostResponse',
        'status' => 'SUCCESSFUL',
        'createdPost' => [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'slug' => $post->getSlug(),
            'summary' => $post->getSummary(),
            'content' => $post->getContent(),
            'publishedAt' => $post->getPublishedAt(),
            'commentsCount' => 0
        ]
    ];
}
