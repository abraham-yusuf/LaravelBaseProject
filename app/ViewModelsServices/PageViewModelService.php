<?php

namespace App\ViewModelsServices;

use App\Custom\Languages\Services\LanguagesService;
use App\Custom\Logging\AppLog;
use App\ViewModelPageBuilders\ViewModelPageBuilderFactory;
use App\ViewModels\Pages\PageViewModel;

class PageViewModelService {

    /**
     * @var ViewModelPageBuilderFactory
     */
    private $viewModelPageBuilderFactory;

    /**
     * @var BreadcrumbViewModelService
     */
    private $breadcrumbViewModelService;

    /**
     * @var LanguagesService
     */
    private $languagesService;


    function __construct(
        LanguagesService $languagesService,
        ViewModelPageBuilderFactory $viewModelPageBuilderFactory,
        BreadcrumbViewModelService $breadcrumbViewModelService) {

        $this->breadcrumbViewModelService = $breadcrumbViewModelService;
        $this->viewModelPageBuilderFactory = $viewModelPageBuilderFactory;
        $this->languagesService = $languagesService;
    }

    /**
     * @param string $configurationKey
     * @param array $params
     * @return PageViewModel|null
     */
    public function getViewModelByConfigurationKey (string $configurationKey, $params = []) {
        $viewModelPageBuilder = $this->viewModelPageBuilderFactory->getViewModelPageBuilderByConfigurationKey($configurationKey);

        /** @var PageViewModel $viewModel */
        $viewModel = $viewModelPageBuilder->createNewViewModel();

        $viewModel = $this->setInitialDataForPage($viewModel, $configurationKey);

        return $viewModelPageBuilder->fillPageViewModel($viewModel, $params);
    }

    /**
     * @param PageViewModel $pageViewModel
     * @param string $configurationKey
     * @return PageViewModel|null
     */
    private function setInitialDataForPage(PageViewModel $pageViewModel,  string $configurationKey) {
        try {
            $pageConfiguration = config($configurationKey);
            $pageViewModel->id = $pageConfiguration['id'];
            $pageViewModel->htmlTitle = !empty($pageConfiguration['htmlTitleKey']) ? __($pageConfiguration['htmlTitleKey']) : __(config('custom.web.htmlTitleKey'));
            $pageViewModel->htmlMetaDescription = !empty($pageConfiguration['htmlMetaDescriptionKey']) ? __($pageConfiguration['htmlMetaDescriptionKey']) : __(config('custom.web.htmlMetaDescriptionKey'));
            $pageViewModel->htmlMetaKeywords = !empty($pageConfiguration['htmlMetaKeywordsKey']) ? __($pageConfiguration['htmlMetaKeywordsKey']) : __(config('custom.web.htmlMetaKeywordsKey'));
            $pageViewModel->title = __($pageConfiguration['titleKey']);
            $pageViewModel->description = __($pageConfiguration['descriptionKey']);
            $pageViewModel->viewPath = __($pageConfiguration['viewPath']);
            $pageViewModel->currentLanguageId = str_replace('_', '-', $this->languagesService->getCurrentLanguage()->id);
            $pageViewModel->breadcrumbs = $this->breadcrumbViewModelService->getBreadcrumbByPageId($pageConfiguration['id']);

            return $pageViewModel;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

}
