<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Settings $settings)
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Settings"]
        ];

        $data = $settings->getData();
        return view('/erp/settings/index', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function menu(Settings $settings, Request $request)
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Menu"]
        ];
        $icons = $settings->getDataIcons();

        if ($request->ajax()) {
            $data = $settings->getDataMenu();
            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function($data) {
                    return '<button type="button" class="btn btn-sm btn-icon" id="getEditMenu" data-id="'.$data->kode.'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-2 text-body"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>
                        <a href="#" data-id="'.$data->kode.'" class="btn btn-sm btn-icon" id="getDeleteMenu"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-2 text-body"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('/erp/settings/menu', [
            'breadcrumbs' => $breadcrumbs,
            'icons' => $icons
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMenu(Request $request, Settings $settings)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = array(
            'name'          => $request->input('name'),
            'url'           => $request->input('url'),
            'icon'          => $request->input('icon'),
            'class'         => $request->input('class'),
            'parent'        => $request->input('parent'),
            'parent_code'   => $request->input('parent_code'),
            'active'        => $request->input('active'),
            'sequence'      => $request->input('sequence'),
            'created_by'    => Auth::user()->name,
            'updated_by'    => Auth::user()->name
        );

        $settings->storeDataMenu($data);

        return response()->json(['success'=>'Menu berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function editMenu($id)
    {
        $settings = new Settings;
        $data = $settings->findDataMenu($id);
        $icons = $settings->getDataIcons();

        $html = '   <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Nama Menu</label>
                        <input type="text" class="form-control dt-full-name" id="editname" name="name" value="'.$data->name.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Icon</label>
                        <select class="select2 form-select" name="icon" id="editicon">';
                            foreach ($icons as $i){
                                $html .= '<option value="'.$i->nama.'" data-icon="'.$i->nama.'"'.($data->icon == $i->nama ? ' selected' : '').'>'.$i->nama.'</option>';
                            }
        $html .= '      </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">URL</label>
                        <input type="text" class="form-control dt-full-name" id="editurl" name="url" value="'.$data->url.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Class</label>
                        <select class="select2 form-select" name="class" id="editclass">
                            <option value="nav-item"'.($data->class == "nav-item" ? ' selected' : '').'>Item</option>
                            <option value="navigation-header"'.($data->class == "navigation-header" ? ' selected' : '').'>Header</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Parent Menu</label>
                        <select class="select2 form-select" name="parent" id="editparent">
                            <option value="Y"'.($data->parent == "Y" ? ' selected' : '').'>Ya</option>
                            <option value="T"'.($data->parent == "Y" ? ' selected' : '').'>Tidak</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Parent Code</label>
                        <input type="text" class="form-control dt-full-name" id="editparent_code" name="parent_code" value="'.$data->parent_code.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Sequence</label>
                        <input type="text" class="form-control dt-full-name" id="editsequence" name="sequence" value="'.$data->sequence.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="country">Aktif</label>
                        <select class="select2 form-select" name="aktif" id="editaktif">
                            <option value="Y"'.($data->active == "Y" ? ' selected' : '').'>Ya</option>
                            <option value="T"'.($data->active == "T" ? ' selected' : '').'>Tidak</option>
                        </select>
                    </div>';

        return response()->json(['html'=>$html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function updateMenu(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'kode' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = array(
            'kode'          => $request->input('kode'),
            'name'          => $request->input('name'),
            'url'           => $request->input('url'),
            'icon'          => $request->input('icon'),
            'class'         => $request->input('class'),
            'a_class'       => $request->input('a_class'),
            'parent'        => $request->input('parent'),
            'parent_code'   => $request->input('parent_code'),
            'active'        => $request->input('aktif'),
            'sequence'      => $request->input('sequence'),
            'updated_by'    => Auth::user()->name
        );

        $settings = new Settings;
        $settings->updateDataMenu($id, $data);

        return response()->json(['success'=>'Menu berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroyMenu($id)
    {
        $settings = new Settings;
        $settings->deleteDataMenu($id);

        return response()->json(['success'=>'Menu berhasil dihapus']);
    }
}
