<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class UserDashboardController extends Controller
{
    /**
     * Exibe a visão do painel do usuário.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $this->authorize('user-access');
        return view('user-dashboard'); 
    }
}
