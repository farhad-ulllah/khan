<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Filter;
use App\Models\FilterValue;
use Illuminate\Support\Facades\file;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use DB;
class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Filters= Filter::all(); 
        return view('admin.filters.index',compact('Filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.filters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request);
        $data=[
            'filter_name'=>$request->filter_name
        ];
        $insert = Filter::insert($data);
        $filter_id=Filter::select('id as filter_id')->orderBy('id','DESC')->first();
   
     
        foreach($request->filter_values as $value)
        {
            $val_data=[
                'filter_id'=>$filter_id->filter_id,
                'filter_value'=>$value
            ];
            $filter_insert = FilterValue::insert($val_data);
        }
        if( $filter_insert){
            alert::success('Filter Added Successfully');
            return redirect()->back();
        }else{
            alert::success('Not Added ');
            return redirect()->back();
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
        $Filters=Filter::find($id);
        return view('admin.filters.edit',compact('Filters'));
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
       
        $filters =Filter::where('id', $id)->update([
            'filter_name'=>$request->filter_name
                 ]);
                 if($request->new_value)
                 {
                     foreach($request->new_value as $new)
                     {
                         $data_3 = [
                             'filter_id'=>$id,
                             'filter_value'=> $new
                         ];
                      
                         $insert = FilterValue::insert($data_3);
                     }
                    
                 }else{
                  foreach($request->values as $key=>$val) 
                      {
                      
                    

                       
                        // if ($value=FilterValue::where('filter_value', '=',$val)->exists()) { 
                        //     dd($value);
                            $data_2=[
                                'filter_value'=>$val
                            ];
                           $update= FilterValue::where('id', $key)->update($data_2);
                          
                        // }else{
                        //     $filter =FilterValue::select('filter_id')->OrderBy('filter_id','DESC')->first();
                         
                        //    
                         }
                        
                     
                    }
        alert::success('Filter Updated Successfully');
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
        $Filters=Filter::find($id);
        $Filters->filter_value()->delete();
        $Filters->delete();
        alert::success('Filter Deleted Successfully');
        return redirect()->back();
    }

    //delete_value
    public function delete_value($id)
    {
        $FilterValue=FilterValue::find($id);
        $FilterValue->delete();
        alert::success('Filter Value Deleted Successfully');
        return redirect()->back();
    }
}
