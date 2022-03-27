<?php

declare(strict_types=1);

namespace App\Controller\Api;

use JsonException;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Models\Article\ArticleValidator;
use App\Models\Article\ArticleRepository;
use App\Core\Interfaces\EntityManagerInterface;
use App\Models\Article\Exceptions\ArticleNotFoundException;
use App\Models\Article\Exceptions\ParameterRequireException;
use App\Models\Article\Exceptions\ArticleAlreadyExistException;

final class ArticleController
{
    public function __construct(
        private ArticleRepository      $repository,
        private ArticleValidator       $validator,
        private EntityManagerInterface $em,
        private Request                $request
    )
    {
    }

    /**
     * @return Response
     * @throws JsonException
     */
    public function index(): Response
    {
        return new Response($this->repository->getAllArticles());
    }

    /**
     * @param string $id
     * @return Response
     * @throws ArticleNotFoundException
     * @throws JsonException
     */
    public function view(string $id): Response
    {
        return new Response($this->repository->getArticleById($id));
    }

    /**
     * @return Response
     * @throws JsonException
     * @throws ArticleAlreadyExistException
     * @throws ParameterRequireException
     */
    public function create(): Response
    {
        $body = $this->request->bodyParams();
        $this->validator->validateNewItem($body);
        $id = $this->repository->addNewArticle($this->em, $body);

        return new Response(['id' => $id]);
    }

    /**
     * @param string $id
     * @return Response
     * @throws JsonException
     * @throws ParameterRequireException
     */
    public function update(string $id): Response
    {
        $body = $this->request->bodyParams();
        $this->validator->validateUpdateData($body);
        $article = $this->repository->updateArticle($this->em, $id, $body);

        return new Response($article);
    }

    public function delete(string $id): Response
    {
        $deletedId = $this->repository->deleteArticle($this->em, $id);

        return new Response(['id' => $deletedId]);
    }
}
