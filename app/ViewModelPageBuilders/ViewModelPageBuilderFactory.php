<?php

namespace App\ViewModelPageBuilders;

use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\AuthIndexViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\LoginViewModelPageBuilder;

class ViewModelPageBuilderFactory {

    private $pageBuilders = [];

    function __construct(
        IndexViewModelPageBuilder $indexPageBuilder,

        LoginViewModelPageBuilder $authLoginViewModelPageBuilder,
        AuthIndexViewModelPageBuilder $authIndexViewModelPageBuilder) {

        $this->pageBuilders[config('custom.pages.index.id')] = $indexPageBuilder;

        $this->pageBuilders[config('custom.pages.auth.login.id')] = $authLoginViewModelPageBuilder;
        $this->pageBuilders[config('custom.pages.auth.index.id')] = $authIndexViewModelPageBuilder;
    }

    /**
     * @param string $configurationKey
     * @return ViewModelPageBuilder|null
     */
    public function getViewModelPageBuilderByConfigurationKey (string $configurationKey) {
        $pageConfiguration = config($configurationKey);
        $pageId = $pageConfiguration['id'];
        return $this->pageBuilders[$pageId];
    }
}
