<?php

namespace App\Http\ViewComponents\Navbar\Models;

class NavbarViewModel {

    /**
     * @var array
     */
    public $sectionslinks;

    /**
     * @var NavbarLinkViewModel
     */
    public $loginPageLink;

    /**
     * @var NavbarLinkViewModel
     */
    public $registerPageLink;

    /**
     * @var bool
     */
    public $isUserAuth;

    /**
     * @var string
     */
    public $userName;

    public function __construct() {
        $this->sectionslinks = [];
        $this->isUserAuth = false;
    }

}
