<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
Use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "User"]
        ];

        if ($request->ajax()) {
            $data = $user->getData();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function($data) {
                    return '<button type="button" class="btn btn-sm btn-icon" id="getEditUser" data-id="'.$data->id.'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-2 text-body"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>
                        <a href="#" data-id="'.$data->id.'" class="btn btn-sm btn-icon" id="getDeleteUser"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-2 text-body"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('/erp/User/index', [
            'breadcrumbs' => $breadcrumbs
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
    public function store(Request $request, User $user)
    {
        $validator = \Validator::make($request->all(), [
            'name'          => 'required',
            'level'         => 'required',
            'password'      => 'required',
            'email'         => 'required|email|unique:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = array(
            'name'          => $request->input('name'),
            'level'         => $request->input('level'),
            'email'         => $request->input('email'),
            'password'      => Hash::make($request->input('password')),
            'created_by'    => Auth::user()->name,
            'updated_by'    => Auth::user()->name,
            'ip_address'    => $request->ip()
        );

        $user->storeData($data);

        return response()->json(['success'=>'User berhasil ditambahkan']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = new User;
        $data = $user->findData($id);

        $html = '   <div class="mb-1">
                        <label class="form-label" for="name"><font style="color: red">*</font> Nama Pengguna</label>
                        <input class="form-control" id="editname" type="text" name="name" aria-describedby="name" autofocus="" tabindex="1" value="'.$data->name.'" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="level"><font style="color: red">*</font> Level</label>
                        <select class="form-control" name="level" id="editlevel">
                            <option value="admin"'.($data->level == "admin" ? ' selected' : '').'>Admin</option>
                            <option value="dokter"'.($data->level == "dokter" ? ' selected' : '').'>Dokter</option>
                            <option value="pasien"'.($data->level == "pasien" ? ' selected' : '').'>Pasien</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="email"><font style="color: red">*</font> Email</label>
                        <input class="form-control" id="editemail" type="text" name="email"
                            placeholder="john@example.com" aria-describedby="email" tabindex="2" required value="'.$data->email.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="password"><font style="color: red">*</font> Kata Sandi</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input class="form-control form-control-merge" id="editpassword" type="password"
                                name="password" placeholder="············" aria-describedby="password"
                                tabindex="3" required value="'.$data->password.'" />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                    </div>';

        return response()->json(['html'=>$html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'name'          => 'required',
            'level'         => 'required',
            'password'      => 'required',
            'email'         => 'required|email|unique:users,email,'.$id
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = array(
            'name'          => $request->input('name'),
            'level'         => $request->input('level'),
            'email'         => $request->input('email'),
            'password'      => Hash::make($request->input('password')),
            'created_by'    => Auth::user()->name,
            'updated_by'    => Auth::user()->name,
            'ip_address'    => $request->ip()
        );

        $user = new User;
        $user->updateData($id, $data);

        return response()->json(['success'=>'User berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = new User;
        $user->deleteData($id);

        return response()->json(['success'=>'User berhasil dihapus']);
    }
}
