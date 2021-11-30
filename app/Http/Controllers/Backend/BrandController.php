<?php

namespace App\Http\Controllers\Backend;

 use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;


class BrandController extends Controller
{
    //

    public function BrandView()
    {
        $brands=Brand::latest()->get(); // get all latest data
        return view('backend.brand.brand_view',compact('brands'));
    }

    public function BrandStore(Request $request)
    {
        $request->validate([
            'brand_name_en'=>'required',
            'brand_name_hin'=>'required',
            'brand_name_ben'=>'required',
            'brand_image'=>'required'
        ],
        [
            'brand_name_en.required'=>'Input Brand Name as English',       
            'brand_name_hin.required'=>'Input Brand Name as Hindi',       
            'brand_name_ben.required'=>'Input Brand Name as Bengali',
            'brand_image.required'=>'Select a Brand Image'       
        ]); 

        $image=$request->file('brand_image');
        $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url='upload/brand/'.$name_gen;
        Brand::insert([
            'brand_name_en'=>$request->brand_name_en,
            'brand_name_hin'=>$request->brand_name_hin,
            'brand_name_ben'=>$request->brand_name_ben,
            'brand_slug_en'=>strtolower(str_replace(' ','-',$request->brand_name_en)),
            'brand_slug_hin'=>strtolower(str_replace(' ','-',$request->brand_name_hin)),
            'brand_slug_ben'=>strtolower(str_replace(' ','-',$request->brand_name_ben)),
            'brand_image'=>$save_url,

        ]);

        $notification=array('message'=>"Brands Successfully Inserted",'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function BrandEdit($id)
    {
        // get the data
        $brand=Brand::findOrFail($id);
        return view('backend.brand.brand_edit',compact('brand'));
    }

    public function BrandUpdate(Request $request)
    {
        $brand_id=$request->id;
        $old_img=$request->old_image;
        if($request->file('brand_image'))
        {
            
            $image=$request->file('brand_image');
            unlink($old_img);
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
            $save_url='upload/brand/'.$name_gen;

            Brand::findOrFail($brand_id)->update([
                'brand_name_en'=>$request->brand_name_en,
                'brand_name_hin'=>$request->brand_name_hin,
                'brand_name_ben'=>$request->brand_name_ben,
                'brand_slug_en'=>strtolower(str_replace(' ','-',$request->brand_name_en)),
                'brand_slug_hin'=>strtolower(str_replace(' ','-',$request->brand_name_hin)),
                'brand_slug_ben'=>strtolower(str_replace(' ','-',$request->brand_name_ben)),
                'brand_image'=>$save_url,
    
            ]);
    
            $notification=array('message'=>"Brands Updated Successfully",'alert-type'=>'success');
            return redirect()->route('all.brand')->with($notification);
    
        }

        else

        {
            // without image
            Brand::findOrFail($brand_id)->update([
                'brand_name_en'=>$request->brand_name_en,
                'brand_name_hin'=>$request->brand_name_hin,
                'brand_name_ben'=>$request->brand_name_ben,
                'brand_slug_en'=>strtolower(str_replace(' ','-',$request->brand_name_en)),
                'brand_slug_hin'=>strtolower(str_replace(' ','-',$request->brand_name_hin)),
                'brand_slug_ben'=>strtolower(str_replace(' ','-',$request->brand_name_ben)),
    
            ]);
    
            $notification=array('message'=>"Brands Updated Successfully",'alert-type'=>'success');
            return redirect()->route('all.brand')->with($notification);
    

        }

    }
    public function BrandDelete($id)
    {
        // get the data
        $brand=Brand::findOrFail($id);
        $img=$brand->brand_image;
        unlink($img); // delete image after confirm delete record
        $brand=Brand::findOrFail($id)->delete();
        $notification=array('message'=>"Brand Delete Successfully",'alert-type'=>'success');
        return redirect()->back()->with($notification);


    }


}
