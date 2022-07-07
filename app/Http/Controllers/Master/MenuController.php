<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Menu;
use App\Models\Master\Icons;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Menu $menu, Icons $icons)
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Menu"]
        ];

        $icons = $icons->getData();

        if ($request->ajax()) {
            $data = $menu->getData();
            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function($data) {
                    return '<button type="button" class="btn btn-icon btn-icon rounded-circle btn-primary" id="getEditMenu" data-id="'.$data->kode.'"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></button>
                        <a href="#" data-id="'.$data->kode.'" class="btn btn-icon btn-icon rounded-circle btn-danger" id="getDeleteMenu"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></i></a>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('/erp/master/Menu/index', [
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
    public function store(Request $request, Menu $menu)
    {
        $validator = \Validator::make($request->all(), [
            'kode' => 'required',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = array(
            'kode'          => $request->input('kode'),
            'class'         => $request->input('class'),
            'a_class'       => $request->input('a_class'),
            'url'           => $request->input('url'),
            'name'          => $request->input('name'),
            'icon'          => $request->input('icon'),
            'parent'        => $request->input('parent'),
            'parent_code'   => $request->input('parent_code'),
            'active'        => $request->input('active'),
            'created_by'    => Auth::user()->name,
            'updated_by'    => Auth::user()->name
        );

        $menu->storeData($data);

        return response()->json(['success'=>'Menu berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = new Menu;
        $data = $menu->findData($id);

        $html = '<div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Kode</label>
                    <input type="text" class="form-control dt-full-name" id="editkode"
                        name="kode" value="'.$data->kode.'" readonly />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                    <input type="text" class="form-control dt-full-name" id="editnama"
                        name="nama" value="'.$data->nama.'" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Telepon</label>
                    <input type="text" class="form-control dt-full-name" id="edittelp"
                        name="telp" value="'.$data->telp.'" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Email</label>
                    <input type="text" class="form-control dt-full-name" id="editemail"
                        name="email" value="'.$data->email.'" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Fax</label>
                    <input type="text" class="form-control dt-full-name" id="editfax"
                        name="fax" value="'.$data->fax.'" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Alamat</label>
                    <input type="text" class="form-control dt-full-name" id="editalamat"
                        name="alamat" value="'.$data->alamat.'" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="country">Aktif</label>
                    <select class="select2 form-select" name="aktif" id="editaktif">
                        <option value="Y"'.($data->aktif == "Y" ? ' selected' : '').'>Ya</option>
                        <option value="T"'.($data->aktif == "T" ? ' selected' : '').'>Tidak</option>
                    </select>
                </div>';

        return response()->json(['html'=>$html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'kode' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = array(
            'class'         => $request->input('class'),
            'a_class'       => $request->input('a_class'),
            'url'           => $request->input('url'),
            'name'          => $request->input('name'),
            'icon'          => $request->input('icon'),
            'parent'        => $request->input('parent'),
            'parent_code'   => $request->input('parent_code'),
            'active'        => $request->input('active'),
            'updated_by'    => Auth::user()->name
        );

        $menu = new Menu;
        $menu->updateData($id, $data);

        return response()->json(['success'=>'Menu berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = new Menu;
        $menu->deleteData($id);

        return response()->json(['success'=>'Menu berhasil dihapus']);
    }
}
