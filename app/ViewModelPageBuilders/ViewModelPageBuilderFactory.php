<?php

namespace App\ViewModelPageBuilders;

use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\AuthIndexViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\ForgotPasswordViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\LoginViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\RegisterViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\ResetPasswordViewModelPageBuilder;

class ViewModelPageBuilderFactory {

    private $pageBuilders = [];

    function __construct(
        IndexViewModelPageBuilder $indexPageBuilder,

        LoginViewModelPageBuilder $authLoginViewModelPageBuilder,
        RegisterViewModelPageBuilder $authRegisterViewModelPageBuilder,
        ForgotPasswordViewModelPageBuilder $authForgotPasswordViewModelPageBuilder,
        ResetPasswordViewModelPageBuilder $authResetPasswordViewModelPageBuilder,
        AuthIndexViewModelPageBuilder $authIndexViewModelPageBuilder) {

        $this->pageBuilders[config('custom.pages.index.id')] = $indexPageBuilder;

        $this->pageBuilders[config('custom.pages.auth.login.id')] = $authLoginViewModelPageBuilder;
        $this->pageBuilders[config('custom.pages.auth.register.id')] = $authRegisterViewModelPageBuilder;
        $this->pageBuilders[config('custom.pages.auth.forgot-password.id')] = $authForgotPasswordViewModelPageBuilder;
        $this->pageBuilders[config('custom.pages.auth.reset-password.id')] = $authResetPasswordViewModelPageBuilder;
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
