<?php

namespace App\ViewModelsServices;

use App\Custom\Logging\AppLog;
use App\ViewModels\Pages\BreadcrumbViewModel;

class BreadcrumbViewModelService {

    function __construct() {
    }

    /**
     * @param string $pageId
     * @return BreadcrumbViewModel[]
     */
    public function getBreadcrumbByPageId($pageId) {
        try {
            $outcome = [];
            switch ($pageId) {
                case config('custom.pages.AUTH_LOGIN'):
                $outcome = $this->getHomePageBreadcrumb();
                break;
            }
            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            return [];
        }
    }

    /**
     * @return BreadcrumbViewModel[]
     */
    public function getHomePageBreadcrumb() {
        try {
            return [
                new BreadcrumbViewModel(
                    $this->getPageTextFromConfig('custom.pages.index'),
                    route('index') )
            ];

        } catch (\Exception $e) {
            AppLog::error($e);
            return [];
        }
    }

    private function getPageTextFromConfig($pageConfigPath) {
        $pageConfig = config($pageConfigPath);
        $shortNameKey = $pageConfig['shortNameKey'];
        $outcome = __($shortNameKey);
        if($outcome == $shortNameKey) {
            $shortNameKey = $pageConfig['titleKey'];
            $outcome = __($shortNameKey);
        }
        return $outcome;
    }

}
