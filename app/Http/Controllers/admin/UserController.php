<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Support\Facades\file;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use App\Models\Module;
use App\Models\Role;
use App\Models\ModelHasRole;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use App\Actions\Fortify\PasswordValidationRules;
use Crypt;
use Session;
class UserController extends Controller 
{
    use PasswordValidationRules;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
     
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $roles=Role::all();
        return view('admin.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          
         $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role'=>'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
     
        if($request->hasFile('image'))
        {
           $imageName = time().'.'.$request->image->extension(); 
          $request->image->storeAs('public/user', $imageName);
        }else{
            $imageName=''  ;
        }
        $user = User::create([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_photo_path'=>$imageName,
        ]);
        $user_id=User::select('id')->OrderBy('id','DESC')->first();
        $roles = ModelHasRole::create([
            'role_id' => $request->role,
            'model_type'=>'App\Models\User',
            'model_id'=>$user_id->id
        ]);

        alert::success('User Register Successfully');
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
        $users=User::find($id);
        $roles=Role::all();
        $role_id= $users->user_role->first()->role_id;
 
        return view('admin.user.edit',compact('users','roles','role_id'));
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
        $users=User::find($id);
        if($request->hasFile('image')) {
            $file_name = time().'.'.$request->image->extension(); 
            $path = $request->file('image')->storeAs('public/user',$file_name);
            $users->profile_photo_path=$file_name;
            $Image = str_replace('/storage', '', $request->old_image);
            #Using storage
            if(Storage::exists('public/user/' . $Image)){
               $delete= Storage::delete('/public/user/' . $Image);
            }
        } 
        $users->name=$request->name;
        $users->user_name=$request->user_name;
        $users->email=$request->email;
        $users->update();
        $data=[
            'role_id'=>$request->role,
        ];
         ModelHasRole::where('model_id', $id)
        ->update($data);
        alert::success('User Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users=User::find($id);
        if($users->image)
        {
            if(Storage::exists('public/user/' . $users->image)){
            $delete= Storage::delete('/public/user/' . $users->image);   
             }
        }
        $users->delete();
        alert::success('Users Deleted Successfully');
        return redirect()->back();
    }

    public function assign_permission()
    {
        $roles=Role::all();
        $modules=Module::all();
        $role_id=0;
        // $role_permission=RoleHasPermission::where('role_id',$role_id)->get();
        return view('admin.permission.assign',compact('modules','roles','role_id'));
    }

    public function updatepassword(Request $request,$id)
    {
        
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
             $users=User::select('password')->where('id',$id)->first();

             if(!Hash::check($request->current_password, $users->password)){
                Session::flash('message', 'The provided password does not match your current password.!');
            // if (! isset($request->current_password) || ! Hash::check($request->current_password, $users->password)) {
            //     Session::flash('message', 'The provided password does not match your current password.!');
            // }
            return redirect()->back();
            }else{
                User::where('id',$id)->update([
                    'password' => Hash::make($request->password),
                ]);
                alert::success('Password Changed Successfully');
            return redirect()->back();
            }
  
    }
}
