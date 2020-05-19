<?php

namespace App\External\ApiServices;

use App\Custom\Logging\AppLog;
use App\External\ApiServiceEntities\Language;
use App\External\ApiServiceEntities\User;
use App\External\Repositories\LocalesRepository;
use App\External\Repositories\UsersRepository;

class PublicApiService {

    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * @var LocalesRepository
     */
    private $localesRepository;

    public function __construct(
        UsersRepository $usersRepository,
        LocalesRepository $localesRepository) {

        $this->usersRepository = $usersRepository;
        $this->localesRepository = $localesRepository;
    }

    /**
     * @param int $userId
     * @return User
     */
    public function getUserById(int $userId) {
        try {
            $outcome = null;

            if ($userId != null && $userId > 0) {
                /** @var \App\User $dbUser */
                $dbUser = $this->usersRepository->find($userId);
                $outcome = $this->createUserEntityByDbModel($dbUser);
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    /**
     * @return Language[]
     */
    public function getLanguages() {
        try {
            $outcome = [];

            /** @var array $dbLocales */
            $dbLocales = $this->localesRepository->all();

            if ($dbLocales != null && !empty($dbLocales)) {
                /** @var \App\Locale $dbLocale */
                foreach ($dbLocales as $dbLocale) {
                    $entity = $this->createLanguageEntityByDbModel($dbLocale);
                    if ($entity != null) {
                        array_push($outcome, $entity);
                    }
                }
            }

            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    /**
     * @param \App\User|null $dbUser
     * @return User
     */
    private function createUserEntityByDbModel($dbUser) {
        $outcome = new User();
        if ($dbUser != null) {
            $outcome->id = $dbUser->id;
            $outcome->name = $dbUser->name;
            $outcome->email = $dbUser->email;
        }
        return $outcome;
    }

    /**
     * @param \App\Locale|null $dbLocale
     * @return Language
     */
    private function createLanguageEntityByDbModel($dbLocale) {
        $outcome = new Language();
        if ($dbLocale != null) {
            $outcome->code = $dbLocale->code;
            $outcome->cultureCode = $dbLocale->culture_code;
            $outcome->name = $dbLocale->name;
            $outcome->isDefault = $dbLocale->default;
            $outcome->isEnabled = $dbLocale->enabled;
            $outcome->isVisible = $dbLocale->visible;
            $outcome->isAuthVisible = $dbLocale->auth_visible;
        }
        return $outcome;
    }
}
