<?php

declare(strict_types=1);

namespace App\Models\Article;

use App\Models\Article\Exceptions\ParameterRequireException;

final class ArticleValidator
{
    /**
     * @param array $data
     * @return void
     * @throws ParameterRequireException
     */
    public function validateNewItem(array $data): void
    {
        $this->validateRequired(['id', 'name', 'text'], $data);
    }

    /**
     * @param array $data
     * @return void
     * @throws ParameterRequireException
     */
    public function validateUpdateData(array $data): void
    {
        $this->validateRequired(['name', 'text'], $data);
    }

    /**
     * @param $requiredParams
     * @param array $data
     * @return void
     * @throws ParameterRequireException
     */
    private function validateRequired($requiredParams, array $data): void
    {
        foreach ($requiredParams as $param) {
            if (!isset($data[$param])) {
                throw new ParameterRequireException($param);
            }
        }
    }
}
