<?php

namespace App\Http\Controllers;

use App\Models\Loket;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
  // Dashboard - Analytics
  public function dashboardAnalytics()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-analytics', ['pageConfigs' => $pageConfigs]);
  }

  // Dashboard
  public function dashboard(Loket $loket)
  {
    $pageConfigs = ['pageHeader' => false];
    $lok = $loket->getData();
    return view('/content/dashboard/dashboard-ecommerce', ['pageConfigs' => $pageConfigs, 'loket' => $lok]);
  }
}
