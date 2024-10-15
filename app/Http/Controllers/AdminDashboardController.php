<?php
namespace App\Http\Controllers;

use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Exibe a visão do painel do admin.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
            
        $this->authorize('admin-access');
        return view('admin-dashboard'); 
    }
}
