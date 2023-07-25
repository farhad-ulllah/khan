<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Attribute_Values;
use Illuminate\Support\Facades\file;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes= Attribute::all(); 
        $attr=AttributeValue::select('id','value')->get();
        $attr_value=Attribute_Values::select('group_id','attribute_value')->get();
        $attr_value=AttributeValue::where('attribute_id',1)->get();
        return view('admin.attributes.index',compact('attributes','attr','attr_value'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data=[
            'name'=>$request->attribute_name,
            'created_at'=>date('Y-m-d H:i:s')
        ];
      
        if($request->hasFile('image'))
        {
           $imageName = time().'.'.$request->image->extension(); 
           $request->image->storeAs('public/attribute', $imageName);
          $data['icon']=$imageName;
        }else{
            $data['icon']='';
        }
        $insert = Attribute::insert($data);
        $attr_id=Attribute::select('id as attr_id')->orderBy('id','DESC')->first();
   
     
        foreach($request->values as $val)
        {
            $val_data=[
                'attribute_id'=>$attr_id->attr_id,
                'value'=>$val
            ];
            $valu_insert = AttributeValue::insert($val_data);
        }
        alert::success('Attribute Added Successfully');
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
        $attribute=Attribute::find($id);
        $category=Attribute::all();
        return view('admin.attributes.edit',compact('attribute'));
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
        if($request->hasFile('image')) {
            $file_name = time().'.'.$request->image->extension(); 
            $path = $request->file('image')->storeAs('public/attribute',$file_name);
            $category->image=$file_name;
            
            $Image = str_replace('/storage', '', $request->old_image);
            // dd($Image);
            #Using storage
           
            if(Storage::exists('public/attribute/' . $Image)){

               $delete= Storage::delete('/public/attribute/' . $Image);
              
            }
        } 
    
         $attribute =Attribute::where('id', $id)->update([
        'name'=>$request->attribute_name
             ]);
             $atr_id=AttributeValue::where('attribute_id',$id)->get();
            
              foreach($request->values as $key=>$val) 
                  {
                    $attributes =AttributeValue::where('id', $key)->update([
                        'value'=>$val,
                             ]);
                    // AttributeValue::update([ "id"=> $key], [
                    //     'value' => $val,
                    // ]);
               
                }

                if($request->new_values){
                foreach($request->new_values as $key1=>$attr_val) 
                {
                
                  $data_3=[
                    'attribute_id'=>$request->attributes_id,
                      'value'=>$attr_val,
                      'created_at'=>date('Y-m-d H:i:s'),
                  ];
                  AttributeValue::insert($data_3);
              }
            }

    alert::success('Attribute Updated Successfully');
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
        $Attribute=Attribute::find($id);
        $Attribute->values()->delete();
        $Attribute->delete();
        alert::success('Attribute Deleted Successfully');
        return redirect()->back();
    }
    //View attributes Values
    public function ViewValues($id)
    {
        $attr_value=AttributeValue::where('attribute_id',$id)->get();
        return $attr_value;
    }
    public function AttibuteDelete($id)
    {
        $AttributeValue=AttributeValue::find($id);
        $AttributeValue->delete();
        alert::success('Attribute  Deleted Successfully');
        return redirect()->back();
    }
}
