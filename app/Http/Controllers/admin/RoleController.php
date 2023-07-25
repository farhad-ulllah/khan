<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\Module;
use Spatie\Permission\Models\Role;
use App\Models\ModelHasRole;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Str;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $roles=Role::all();
        return view('admin.permission.roles',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Role::create([
            'name' => $request->role_name,
            'guard_name'=>'web',
            'created_at'=>date('Y-m-d H:m:s')
        ]);
   


        alert::success('Role Added Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roles=Role::find($id);
        $roles->delete();
        alert::success('Deleted  Successfully');
        return redirect()->back();
    }
    // Roles Update
    public function RolesUpdate(Request $request)
    {
        $data=[
            'name'=>$request->role_name,
        ];
        $update= Role::where('id', $request->role_id)
        ->update($data);
        alert::success('Roles Updated  Successfully');
        return redirect()->back();
    }
    //de_Active_role
    public function de_Active_role($id)
    {
        $data=[
            'status'=>0
        ];
        Module::where('id', $id)->update($data);
        alert::success('Updated  Successfully');
        return redirect()->back();
    }

}
