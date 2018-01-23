<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private function servePage(Request $request, String $view_name) {
        $locale = $request->getLocale();
        return view($view_name, ['locale' => $locale, 'view' => $view_name]);
    }

    public function index(Request $request) {
        return $this->servePage($request, 'home');
    }

    public function spellCompendium(Request $request) {
        return $this->servePage($request, 'spellCompendium');
    }

    public function monsterCreator(Request $request) {
        return $this->servePage($request, 'monsterCreator');
    }

}
