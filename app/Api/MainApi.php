<?php

namespace App\Api;

use App\External\ApiServiceEntities\Language;
use App\External\ApiServiceEntities\User;
use App\External\ApiServices\PublicApiService;

class MainApi {

    /**
     * @var PublicApiService
     */
    private $publicApiService;

    public function __construct(
        PublicApiService $publicApiService) {
        $this->publicApiService = $publicApiService;
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUserById(int $id) {
        return $this->publicApiService->getUserById($id);
    }

    /**
     * @return Language[]
     */
    public function getLanguages() {
        return $this->publicApiService->getLanguages();
    }

}
