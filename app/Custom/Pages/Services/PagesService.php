<?php


namespace App\Custom\Pages\Services;


use App\Custom\Languages\Services\LanguageService;
use App\Custom\Logging\AppLog;
use App\Custom\Pages\Entities\PageEntity;
use App\ViewModelPageBuilders\Auth\AuthIndexViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\ForgotPasswordViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\LoginViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\RegisterViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\ResetPasswordViewModelPageBuilder;
use App\ViewModelPageBuilders\IndexViewModelPageBuilder;
use App\ViewModelPageBuilders\UnknownViewModelPageBuilder;

class PagesService {

    private $pageConfigurations = [];

    /**
     * @var LanguageService
     */
    private $languageService;

    public function __construct(
        LanguageService $languageService,
        UnknownViewModelPageBuilder $unknownViewModelPageBuilder,
        IndexViewModelPageBuilder $indexViewModelPageBuilder,
        LoginViewModelPageBuilder $loginViewModelPageBuilder,
        RegisterViewModelPageBuilder $registerViewModelPageBuilder,
        ForgotPasswordViewModelPageBuilder $forgotPasswordViewModelPageBuilder,
        ResetPasswordViewModelPageBuilder $resetPasswordViewModelPageBuilder,
        AuthIndexViewModelPageBuilder $authIndexViewModelPageBuilder
        ) {

        $this->languageService = $languageService;

        $this->pageConfigurations[config('custom.pages.UNKNOWN')] = [
            'config' => config('pages.unknown'),
            'viewModelPageBuilder' => $unknownViewModelPageBuilder
        ];

        $this->pageConfigurations[config('custom.pages.INDEX')] = [
            'config' => config('pages.index'),
            'viewModelPageBuilder' => $indexViewModelPageBuilder
        ];
        $this->pageConfigurations[config('custom.pages.AUTH_LOGIN')] = [
            'config' => config('pages.auth.login'),
            'viewModelPageBuilder' => $loginViewModelPageBuilder
        ];
        $this->pageConfigurations[config('custom.pages.AUTH_REGISTER')] = [
            'config' => config('pages.auth.register'),
            'viewModelPageBuilder' => $registerViewModelPageBuilder
        ];
        $this->pageConfigurations[config('custom.pages.AUTH_FORGOT_PASSWORD')] = [
            'config' => config('pages.auth.forgot-password'),
            'viewModelPageBuilder' => $forgotPasswordViewModelPageBuilder
        ];
        $this->pageConfigurations[config('custom.pages.AUTH_RESET_PASSWORD')] = [
            'config' => config('pages.auth.reset-password'),
            'viewModelPageBuilder' => $resetPasswordViewModelPageBuilder
        ];
        $this->pageConfigurations[config('custom.pages.AUTH_INDEX')] = [
            'config' => config('pages.auth.index'),
            'viewModelPageBuilder' => $authIndexViewModelPageBuilder
        ];

    }

    /**
     * @param int $pageId
     * @return PageEntity
     */
    public function getPageById($pageId) {
        return $this->createPageById($pageId);
    }


    /**
     * @param int $pageId
     * @return PageEntity|null
     */
    private function createPageById($pageId) {
        try {
            $outcome = new PageEntity();
            $pageConfiguration = $this->pageConfigurations[$pageId]['config'];
            $outcome->id = $pageConfiguration['id'];
            $outcome->htmlTitle = !empty($pageConfiguration['htmlTitleKey']) ? __($pageConfiguration['htmlTitleKey']) : __(config('custom.web.htmlTitleKey'));
            $outcome->htmlMetaDescription = !empty($pageConfiguration['htmlMetaDescriptionKey']) ? __($pageConfiguration['htmlMetaDescriptionKey']) : __(config('custom.web.htmlMetaDescriptionKey'));
            $outcome->htmlMetaKeywords = !empty($pageConfiguration['htmlMetaKeywordsKey']) ? __($pageConfiguration['htmlMetaKeywordsKey']) : __(config('custom.web.htmlMetaKeywordsKey'));
            $outcome->title = __($pageConfiguration['titleKey']);
            $outcome->description = __($pageConfiguration['descriptionKey']);
            $outcome->shortName = __($pageConfiguration['shortNameKey']) == $pageConfiguration['shortNameKey'] ? __($pageConfiguration['titleKey']) : __($pageConfiguration['shortNameKey']);
            $outcome->viewPath = $pageConfiguration['viewPath'];
            $outcome->currentLanguage = $this->languageService->getCurrentLanguage();
            $outcome->viewModelPageBuilder = $this->pageConfigurations[$pageId]['viewModelPageBuilder'];
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

}
