<?php

namespace App\Http\Controllers;

use App\Models\Loket;
use App\Models\Poli;
use Illuminate\Support\Facades\DB;
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
  public function dashboard(Loket $loket, Poli $poli)
  {
    // DB::connection()->enableQueryLog();
    $pageConfigs = ['pageHeader' => false];
    // $pol = $poli->getData();
    $lok = $loket->getData();
    // $queries = \DB::getQueryLog();
    // dd($pol[0]->id);
    return view('/content/dashboard/dashboard-ecommerce', ['pageConfigs' => $pageConfigs, 'loket' => $lok]);
  }

  public function PanggilAntrian($id, $id_poli)
  {
    $loket = new Loket;
    $loket->updateNomor($id, $id_poli);

    return redirect()->route('dashboard')->with([ 'idloket' => $id ]);
  }
}
