<?php

namespace App\Http\ViewComponents\Navbar\Services;

use App\Custom\Languages\Services\LanguagesService;
use App\Http\ViewComponents\Navbar\Models\NavbarLinkViewModel;
use App\Http\ViewComponents\Navbar\Models\NavbarViewModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class NavbarViewModelService {

    private $languagesService;

    public function __construct(LanguagesService $languagesService) {
        $this->languagesService = $languagesService;
    }

    public function getModel() {
        $outcome = new NavbarViewModel();
        $outcome->pageLinks = $this->createPageLinks();
        $outcome->userPageLinks = $this->createUserPageLinks();
        $outcome = $this->createViewModelLanguagesPart($outcome);
        $outcome = $this->createViewModelAdminPart($outcome);

        return $outcome;
    }

    /**
     * @return NavbarLinkViewModel[]
     */
    private function createPageLinks() {
        $outcome = [
            $this->createHomeLinkModel(),
        ];
        return $outcome;
    }

    /**
     * @return NavbarLinkViewModel[]
     */
    private function createUserPageLinks() {
        $outcome = [
            $this->createLoginLinkModel(),
            $this->createRegisterLink()
        ];
        return $outcome;
    }

    /**
     * @param NavbarViewModel $outcome
     * @return mixed
     */
    private function createViewModelLanguagesPart($outcome) {
        $outcome->isMultilanguageActive = $this->languagesService->isMultilanguageActive();
        if($outcome->isMultilanguageActive) {
            $availableLanguages = $this->languagesService->getAvailableLanguages();
            foreach ($availableLanguages as $availableLanguage) {
                if($availableLanguage->isCurrent) {
                    $outcome->currentLanguage = $availableLanguage->text;
                }
                else {
                    $url = route('lang.switch', $availableLanguage->id);
                    $linkViewModel = new NavbarLinkViewModel($url,$availableLanguage->text, false );
                    array_push($outcome->languageLinks, $linkViewModel);
                }
            }
        }

        return $outcome;
    }

    /**
     * @return NavbarLinkViewModel
     */
    private function createHomeLinkModel() {
        $url = route('index');
        $text = $this->getMenuPageTextFromConfig('custom.pages.index');
        $isActive = Route::currentRouteNamed('index*');
        return new NavbarLinkViewModel($url, $text, $isActive);
    }

    /**
     * @param NavbarViewModel $vieModel
     * @return NavbarViewModel
     */
    private function createViewModelAdminPart($vieModel) {
        $vieModel->isUserAuth = Auth::check();
        if($vieModel->isUserAuth) {
            $vieModel->userName = '@' . Auth::user()->name;
        }
        return $vieModel;

    }

    private function createLoginLinkModel() {
        $url = route('login');
        $text = $this->getMenuPageTextFromConfig('custom.pages.auth.login');
        $isActive = Route::currentRouteNamed('login*');
        return new NavbarLinkViewModel($url, $text, $isActive);
    }

    private function createRegisterLink() {
        $url = route('register');
        $text = $this->getMenuPageTextFromConfig('custom.pages.auth.register');
        $isActive = Route::currentRouteNamed('register*');
        return new NavbarLinkViewModel($url, $text, $isActive);
    }

    private function getMenuPageTextFromConfig($pageConfigPath) {
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
