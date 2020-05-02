<?php

namespace App\Http\ViewComponents\Navbar\Services;

use App\Http\ViewComponents\Navbar\Models\NavbarLinkViewModel;
use App\Http\ViewComponents\Navbar\Models\NavbarViewModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class NavbarViewModelService {

    public function __construct() {
    }

    public function getModel() {
        $outcome = new NavbarViewModel();
        $outcome->sectionslinks = [
            $this->createHomeLinkModel(),
        ];

        $outcome = $this->createViewModelAdminPart($outcome);

        return $outcome;
    }

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
        $vieModel->loginPageLink = $this->createLoginLinkModel();
        $vieModel->registerPageLink = $this->createRegisterLink();
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
        $text = "Register";
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
