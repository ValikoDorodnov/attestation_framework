<?php

declare(strict_types=1);

namespace App\Models\Article;

use App\Core\Interfaces\EntityManagerInterface;
use App\Models\Article\Exceptions\ArticleNotFoundException;
use App\Models\Article\Exceptions\ArticleAlreadyExistException;

final class ArticleRepository
{
    public function __construct()
    {
    }

    /**
     * @return ArticleEntity[]
     */
    public function getAllArticles(): array
    {
        $articles = [];
        $data = $this->getFakeArticles();

        foreach ($data as $element) {
            $articles[] = new ArticleEntity(
                $element['id'],
                $element['name'],
                $element['text']
            );
        }

        return $articles;
    }

    public function getArticleById(string $id): ArticleEntity
    {
        $data = $this->getFakeArticles();

        foreach ($data as $element) {
            if ($element['id'] === $id) {
                return new ArticleEntity(
                    $element['id'],
                    $element['name'],
                    $element['text']
                );
            }
        }

        throw new ArticleNotFoundException();
    }

    public function addNewArticle(EntityManagerInterface $em, array $postData): string
    {
        $data = $this->getFakeArticles();

        foreach ($data as $element) {
            if ($element['id'] === $postData['id']) {
                throw new ArticleAlreadyExistException($postData['id']);
            }
        }

        $article = new ArticleEntity(
            id: $postData['id'],
            name: $postData['name'],
            text: $postData['text']
        );

        $em->flush($article);

        return $article->getId();
    }

    public function updateArticle(EntityManagerInterface $em, string $id, array $postData): ArticleEntity
    {
        $article = $this->getArticleById($id);

        $article->name = $postData['name'];
        $article->text = $postData['text'];

        $em->update($article);

        return $article;
    }

    public function deleteArticle(EntityManagerInterface $em, string $id): string
    {
        $article = $this->getArticleById($id);

        $em->remove($article);

        return $article->getId();
    }

    private function getFakeArticles(): array
    {
        return [
            [
                'id'   => 'article-1',
                'name' => 'Статья 1',
                'text' => 'Текст 1'
            ],
            [
                'id'   => 'article-2',
                'name' => 'Статья 2',
                'text' => 'Текст 2'
            ],
            [
                'id'   => 'article-3',
                'name' => 'Статья 3',
                'text' => 'Текст 3'
            ]
        ];
    }
}
