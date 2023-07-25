<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\Module;
use Spatie\Permission\Models\Role;
use App\Models\RoleHasPermission;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Str;
use Auth;
use Session;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(Auth()->user()->hasPermissionTo(Permission::find(2)->id));
 
        $modules=Module::all();
        return view('admin.permission.create',compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $module_id=Module::insertGetId([ 'name'=>$request->module_name, 'status'=>'1']);
        
        $id = Permission::orderBy('id', 'desc')
        ->first();
        
      
        $module=Str::lower($request->module_name);

        $permissions = Permission::where('name', 'like', '%'.$module)->get();

 
       if (count($permissions) < 1) {
        $data = [
            [
                'name' => 'module '.$module,
                'module_id'=>$module_id
            ],
            [
                'name' => 'view '.$module,
                'module_id'=>$module_id
            ],
            [
                'name' => 'add '.$module,
                'module_id'=>$module_id
            ],
            [
                'name' => 'edit '.$module,
                'module_id'=>$module_id
            ],
            [
                'name' => 'delete '.$module,
                'module_id'=>$module_id
            ],
        ];

       //  dd($data);

        foreach($data as $key){
          
            $permission = Permission::create(['name'=>$key['name'],'guard_name'=>'web','module_id'=>$key['module_id']]); 
        
        }
   

    if($permission)

    alert::success('Permission Added Successfully');
        return redirect('/permission/create');
       
       }
       else {
        alert::success('Permission Not Successfully');
          return redirect('/permission/create');
       }
    
        
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
        //
    }
    public function de_Active($id)
    {
        // $data=[
        //     'status'=>0
        // ];
        $moudel=Module::find($id);
        $moudel->permissions()->delete();
        $moudel->delete();

        alert::success('Attribute Deleted Successfully');
        // Module::where('id', $id)->update($data);
        return redirect()->back();
    }
    //assign Permissions
    public function assignPermissions(Request $request)
    {
        $role_id=$request->role_id;
          $role = Role::findorfail($role_id);

    //    dd($request->permission);
    foreach ($request->permission as $value1) {
    $permissions = RoleHasPermission::where('role_id',$role_id)->get();
    foreach ($permissions as $per) {
           $per_id=$per->permission_id;
           if($per_id!=$value1){
            $old_permissions = RoleHasPermission::where(['permission_id'=>$per_id,'role_id'=>$role_id])->delete();
           }
    }
    }
       foreach ($request->permission as $value) {
        // $role_id->givenPermissionTo($value);
        $permissions = RoleHasPermission::where('permission_id',$value)->get();
           $permission = RoleHasPermission::Insert(
               [
                   'permission_id'=>$value,
                   'role_id'=>$request->role_id, 
               ]
           );
        
       } 
       $user= User::where('id',Auth::user()->id)->first();
       $role_id= $user->user_role->first()->role_id;
       $permissionse = RoleHasPermission::select('role_has_permissions.*','permissions.name')
       ->leftjoin('permissions','permissions.id','role_has_permissions.permission_id')
       ->where('role_has_permissions.role_id',$role_id)
       ->get(); 
         $permissions = $permissions->pluck('name'); 
          Session::put('permissions',$permissions);
       alert::success('Permission Assign Successfully  Successfully');
  
       return redirect()->back();

    //    if (count($request->permission) == 1) {
    //        UserDetail::where( ['userid' => $id, 'dept_id' => $request->department])->delete(); 
    //    }
    //    else {
    //        UserDetail::updateOrInsert(
    //            ['userid' => $id, 'dept_id' => $request->department],
    //            ['dept_id' => $request->department]
    //        ); 
    //    }
    }
    //Get Permissions
    public function GetPermissions(Request $request)
    {
        $roles=Role::all();
        $modules=Module::all();
        $role_id=$request->role;
        // $role_permission=RoleHasPermission::where('role_id',$role_id)->get();
        return view('admin.permission.assign',compact('modules','roles','role_id'));
    }
}
