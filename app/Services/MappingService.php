<?php

namespace App\Services;

use App\Custom\Languages\Entities\LanguageEntity;
use App\Entities\UserEntity;
use App\External\ApiServiceEntities\Language;
use App\External\ApiServiceEntities\User;

class MappingService {

    public function __construct() {
    }

    /**
     * @param User
     * @return UserEntity
     */
    public function mapUser(User $serviceUser) {
        $outcome = null;
        if ($serviceUser != null) {
            $outcome = new UserEntity();
            $outcome->id = $serviceUser->id;
            $outcome->name = $serviceUser->name;
            $outcome->email = $serviceUser->email;
        }
        return $outcome;
    }

    /**
     * @param Language[]
     * @return LanguageEntity[];
     */
    public function mapLanguages($serviceLanguages) {
        $outcome = [];
        if ($serviceLanguages && !empty($serviceLanguages)) {
            foreach ($serviceLanguages as $serviceLanguage) {
                $languageEntity = $this->mapLanguage($serviceLanguage);
                if ($languageEntity != null) {
                    array_push($outcome, $languageEntity);
                }
            }
        }
        return $outcome;
    }

    /**
     * @param Language
     * @return LanguageEntity
     */
    public function mapLanguage($serviceLanguage) {
        $outcome = new LanguageEntity();
        /** @var Language $serviceLanguage */
        if ($serviceLanguage != null) {
            $outcome->code = $serviceLanguage->code;
            $outcome->cultureCode = $serviceLanguage->cultureCode;
            $outcome->name = $serviceLanguage->name;
            $outcome->isDefault = $serviceLanguage->isDefault;
            $outcome->isVisible = $serviceLanguage->isVisible;
            $outcome->isAuthVisible = $serviceLanguage->isAuthVisible;
        }
        return $outcome;
    }

}
