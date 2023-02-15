<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class BookcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    
    	
public function BookCategoryList(Request $request)
{
    $list = DB::table('bookcategories')->get();
    return view('backend.bookcategory.list_bookcategory',compact('list'));

}


    public function PageCategoryAdd()
    {
        $all = DB::table('pagecategories')->get();
    	return view('backend.pagecategory.add_pagecategory',compact('all'));
    }

    

    public function PageCategoryInsert(Request $request)
    {
    

        $data = array();
    $data['name'] = $request->name;
    $data['details'] = $request->details;    
    $data['pictures'] = $image_url;
     
        $insert = DB::table('pagecategories')->insert($data);
        if ($insert) {
                 $notification=array(
                 'messege'=>'Successfully Page Category Inserted ',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('pagecategory.index')->with($notification);
                 
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'error'
                  );
                 return Redirect()->route('pagecategory.index')->with($notification);
             }
           

  
    }


 



      public function PageEditCategory($id)
    {
        $edit=DB::table('pagecategories')
             ->where('id',$id)
             ->first();
        return view('backend.pagecategory.edit_pagecategory', compact('edit'));     
    }

        public function PageUpdateCategory(Request $request,$id)
    {
      
        $sliders = DB::table('pagecategories')->where('id', $id)->first();

        
        $data = array();

$data['name'] = $request->name;
$data['details'] = $request->details;

	      

        $update = DB::table('pagecategories')->where('id', $id)->update($data);

        if ($update) 
{
        $notification=array
        (
        'messege'=>'Successfully Page Category Updated ',
        'alert-type'=>'success'
        );
return Redirect()->route('pagecategory.index')->with($notification);                      
}
        else
    {
            $notification=array
            (
            'messege'=>'error ',
            'alert-type'=>'error'
            );
    return Redirect()->route('pagecategory.index')->with($notification);
    }



     
    }


public function PageDeleteCategory ($id)
    {
    
        $sliders = DB::table('pagecategories')->where('id', $id)->first();
        if(file_exists($sliders->pictures))
        {
            unlink($sliders->pictures);
        }
        $delete = DB::table('pagecategories')->where('id', $id)->delete();
        if ($delete)
                            {
                            $notification=array(
                            'messege'=>'Successfully Category Deleted ',
                            'alert-type'=>'success'
                            );
                            return Redirect()->back()->with($notification);                      
                            }
             else
                  {
                  $notification=array(
                  'messege'=>'error ',
                  'alert-type'=>'error'
                  );
                  return Redirect()->back()->with($notification);

                  }

      }
}
