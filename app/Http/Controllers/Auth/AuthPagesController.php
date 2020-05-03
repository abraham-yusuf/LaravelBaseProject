<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\ViewModelsServices\PageViewModelService;
use Illuminate\Http\Request;

class AuthPagesController extends Controller
{
    /**
     * @var PageViewModelService
     */
    private $pageViewModelService;

    public function __construct(PageViewModelService $pageViewModelService) {
        $this->pageViewModelService = $pageViewModelService;

        $this->middleware('auth');
    }

    public function index() {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.AUTH_INDEX'));
        return view($model->viewPath, compact('model'));
    }
}
