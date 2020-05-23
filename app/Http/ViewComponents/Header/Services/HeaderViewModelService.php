<?php

namespace App\Http\ViewComponents\Header\Services;

use App\Http\ViewComponents\Header\Models\HeaderLogoViewModel;
use App\Http\ViewComponents\Header\Models\HeaderSocialLinkViewModel;
use App\Services\AuthService;
use App\Custom\Languages\Services\LanguageService;
use App\Custom\Pages\Services\PagesService;
use App\Http\ViewComponents\Header\Models\HeaderLinkViewModel;
use App\Http\ViewComponents\Header\Models\HeaderViewModel;
use Illuminate\Support\Facades\Route;

class HeaderViewModelService {

    /**
     * @var LanguageService
     */
    private $languageService;

    /**
     * @var PagesService
     */
    private $pagesService;

    /**
     * @var AuthService
     */
    private $authService;

    function __construct(
        PagesService $pagesService,
        LanguageService $languageService,
        AuthService $authService) {

        $this->pagesService = $pagesService;
        $this->languageService = $languageService;
        $this->authService = $authService;
    }

    public function getModel() {
        $outcome = new HeaderViewModel();
        $outcome->logo = $this->createLogoViewModel();
        $outcome->pageLinks = $this->createPageLinks();
        $outcome->socialLinks = $this->createSocialLinks();
        $outcome->userPageLinks = $this->createUserPageLinks();
        $outcome = $this->createViewModelLanguagesPart($outcome);
        $outcome = $this->createViewModelAdminPart($outcome);

        return $outcome;
    }

    /**
     * @return HeaderLogoViewModel
     */
    private function createLogoViewModel() {
        $outcome = new HeaderLogoViewModel();
        $outcome->imageUrl = config('custom.images.static.logoBlack');
        $outcome->url = route('index');
        $outcome->linkText = config('custom.company.name');
        $outcome->htmlTitle = $this->getMenuPageHtmlTitleFromConfig(config('custom.pages.INDEX'));
        return $outcome;
    }

    /**
     * @return HeaderLinkViewModel[]
     */
    private function createPageLinks() {
        $outcome = [
            $this->createHomeLinkModel(),
        ];
        return $outcome;
    }

    /**
     * @return HeaderLinkViewModel[]
     */
    private function createSocialLinks() {
        $outcome = [
            new HeaderSocialLinkViewModel(
                config('custom.company.socials.instagram.linkUrl'),
                config('custom.company.socials.instagram.linkText'),
                config('custom.company.socials.instagram.iconClass'))
        ];
        return $outcome;
    }

    /**
     * @return HeaderLinkViewModel[]
     */
    private function createUserPageLinks() {
        $outcome = [
            $this->createLoginLinkModel(),
            $this->createRegisterLink()
        ];
        return $outcome;
    }

    /**
     * @param HeaderViewModel $outcome
     * @return mixed
     */
    private function createViewModelLanguagesPart($outcome) {
        $visibleLanguages = $this->languageService->getVisibleLanguages();
        if (count($visibleLanguages) > 1) {
            foreach ($visibleLanguages as $visibleLanguage) {
                if ($visibleLanguage->isCurrent) {
                    $outcome->currentLanguage = $visibleLanguage->code;
                } else {
                    $url = route('lang.switch', $visibleLanguage->code);
                    $linkViewModel = new HeaderLinkViewModel($url, $visibleLanguage->code, false);
                    array_push($outcome->languageLinks, $linkViewModel);
                }
            }
        }
    }

    /**
     * @return HeaderLinkViewModel
     */
    private function createHomeLinkModel() {
        $url = route('index');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.INDEX'));
        $isActive = Route::currentRouteNamed('index*');
        $outcome = new HeaderLinkViewModel($url, $text, $isActive);
        $outcome->htmlTitle = $this->getMenuPageHtmlTitleFromConfig(config('custom.pages.INDEX'));
        return $outcome;
    }

    /**
     * @param HeaderViewModel $vieModel
     * @return HeaderViewModel
     */
    private function createViewModelAdminPart($vieModel) {
        $vieModel->isUserAuth = $this->authService->isAnyUserAuthenticated();
        if($vieModel->isUserAuth) {
            $userEntity = $this->authService->getAuthUser();
            $vieModel->userName =  '@' . $userEntity->name;
        }
        $vieModel->adminPageLinks = [
            $this->createAuthHomeLink()
        ];
        return $vieModel;

    }

    private function createLoginLinkModel() {
        $url = route('login');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.AUTH_LOGIN'));
        $isActive = Route::currentRouteNamed('login*');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    private function createRegisterLink() {
        $url = route('register');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.AUTH_REGISTER'));
        $isActive = Route::currentRouteNamed('register*');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    private function createAuthHomeLink() {
        $userEntity = $this->authService->getAuthUser();
        $url = route('auth');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.AUTH_INDEX'));
        $isActive = Route::currentRouteNamed('auth');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    private function getMenuPageTextFromConfig(int $pageId) {
        $pageEntity = $this->pagesService->getPageById($pageId);
        $outcome = $pageEntity->shortName;
        return $outcome;
    }

    private function getMenuPageHtmlTitleFromConfig(int $pageId) {
        $pageEntity = $this->pagesService->getPageById($pageId);
        $outcome = $pageEntity->htmlTitle;
        return $outcome;
    }

}
