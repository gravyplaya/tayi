<?php

namespace App\Http\Controllers;

use App\Models\HowTo;
use App\Models\HowToBoxes;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Models\Banner;
use App\Models\FAQ;
use App\Models\FooterBlock;
use App\Models\Home2Box;
use App\Models\PricingSection;
use App\Models\UseCasesBox;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('userweb.dashboard');
    }
    public function homepage(){       
        $how_to = HowToBoxes::with('howtosection')->get();
        return view('home',compact('how_to'));
    }
    public function edithomepage(){       
        return view('admin.home.edithomepage');
    }
    public function edithome($id){

        $how_to_box = HowToBoxes::where('id',$id)->with('howtosection')->first();
        // dd($how_to);
        return view('admin.home.edit-home',compact('how_to_box'));
    }
	
    public function how_to_list(Request $request){

        if($request->ajax()){
            $how_to = HowToBoxes::with('howtosection')->get();
            return DataTables::of($how_to)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn.='<div class="dropdown">
                <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                <ul class="dropdown-menu">
                </li>
                <li><a class="dropdown-item" title="Edit" href="'.route('admin.edithome',$row->id).'">Edit</a>  </li>
                </ul>
                </div>';
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
        }
        
        return view('admin.home.how_to_list');
    }
    public function updatehome(Request $request,$id){

        $section = HowToBoxes::find($id);
        $box_list = implode('",',$request->box_list);
        $image = $request->file('box_image');
        $icon = $request->file('icon');
        if ($image != Null) {
        
            if (Storage::disk('public')->exists($icon)) {
                Storage::disk('public')->delete($icon);
            }
            if (Storage::disk('public')->exists($image)) {
                Storage::disk('public')->delete($image);
            }
            if ($image->isValid()) {
              
                $icon_path =Helpers::upload('how_to_box/', 'png', $request->file('icon'));
                $image_path =Helpers::upload('how_to_box/', 'png', $request->file('box_image'));
            }
        }else{            
            $icon_path = $section->icon;
            $image_path = $section->box_image;
        }
        $section->update([
            'box_heading' =>$request->box_heading,
            'box_content' =>$request->box_content,
            'box_list' =>$box_list,
            'box_image' =>$image_path,          
            'icon' => $icon_path, 
        ]);
        // dd($request);
        return redirect()->route('admin.home_how_to_list')->with('success','How to Section Updated Successfuly!!');
    }
    public function how_to_section_update(Request $request){
        $section = HowTo::find($request->id);
        $section->update([
            'main_heading'=>$request->main_heading,
            'main_content'=>$request->main_content,
        ]);
        return redirect()->back()->with('success','How to Section Updated Successfuly!!');
    }


    public function how_to_box_create(Request $request){

        $box_list = implode('",',$request->box_list);
        HowToBoxes::create([
            'box_heading' =>$request->box_heading,
            'box_content' =>$request->box_content,
            'box_list' =>$box_list,
            'box_image' =>Helpers::upload('how_to_box/', 'png', $request->file('box_image')),
          
            'icon' =>  Helpers::upload('how_to_box/', 'png', $request->file('icon')),
        ]);
        
        return redirect()->back()->with('success','Box Created Successfuly!!');
        // dd($request);
    }
	
public function use_cases_list(Request $request){

    if($request->ajax()){
        $how_to = UseCasesBox::get();
        return DataTables::of($how_to)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn = '';
            $btn.='<div class="dropdown">
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
            <ul class="dropdown-menu">
            </li>
            <li><a class="dropdown-item" title="Edit" href="'.route('admin.edithome',$row->id).'">Edit</a>  </li>
            </ul>
            </div>';
            return $btn;
        })
        
        ->rawColumns(['action'])
        ->make(true);
    }
    
    return view('admin.home.use_case_list');
}

public function use_cases_create(Request $request){
    
    UseCasesBox::create([
        'box_heading' =>$request->box_heading,
        'box_content' =>$request->box_content,
        'icon'        =>Helpers::upload('use_cases_box/', 'png', $request->file('icon'))
    ]);
    
    return redirect()->back()->with('success','Box Created Successfuly!!');
}

public function use_cases_edit($id){
    $use_cases_box = UseCasesBox::where('id',$id)->first();  
    
    return view('admin.home.use_cases_edit',compact('use_cases_box'));
}
public function use_cases_update(Request $request,$id){
    $use_cases = UseCasesBox::find($id);
    $icon = $request->file('icon');
    if ($icon != Null) {
    
        if (Storage::disk('public')->exists($icon)) {
            Storage::disk('public')->delete($icon);
        }
        
        if ($icon->isValid()) {
            
            $icon_path =Helpers::upload('use_cases_box/', 'png', $request->file('icon'));
        }
    }else{            
        $icon_path = $use_cases->icon;
    }
    $use_cases->update([
        'box_heading' =>$request->box_heading,
        'box_content' =>$request->box_content,
        'icon'        =>$icon_path,
    ]);
    
    return redirect()->route('admin.use_cases_list')->with('success','Box Updated Successfuly!!');
}
	//Home 2 Box 
public function home2_box_list(Request $request){

    if($request->ajax()){
        $home2_box = Home2Box::get();
        return DataTables::of($home2_box)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn = '';
            $btn.='<div class="dropdown">
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
            <ul class="dropdown-menu">
            </li>
            <li><a class="dropdown-item" title="Edit" href="'.route('admin.home2_box_edit',$row->id).'">Edit</a>  </li>
            </ul>
            </div>';
            return $btn;
        })
        
        ->rawColumns(['action'])
        ->make(true);
    }
    
    return view('admin.home.home2_box');
}

public function home2_box_create(Request $request){
    
    Home2Box::create([
        'box_heading' =>$request->box_heading,
        'box_content' =>$request->box_content,
        'icon'        =>Helpers::upload('home2_box/', 'png', $request->file('icon'))
    ]);
    
    return redirect()->back()->with('success','Box Created Successfuly!!');
}
public function home2_box_update(Request $request,$id){
    $home2_box = Home2Box::find($id);
    $icon = $request->file('icon');
    if ($icon != Null) {
    
        if (Storage::disk('public')->exists($icon)) {
            Storage::disk('public')->delete($icon);
        }
        
        if ($icon->isValid()) {
            
            $icon_path =Helpers::upload('home2_box/', 'png', $request->file('icon'));
        }
    }else{            
        $icon_path = $home2_box->icon;
    }
    $home2_box->update([
        'box_heading' =>$request->box_heading,
        'box_content' =>$request->box_content,
        'icon'        =>$icon_path,
    ]);
    
    return redirect()->route('admin.home2_box_list')->with('success','Box Updated Successfuly!!');
}

public function home2_box_edit($id){
    $home2_box = Home2Box::where('id',$id)->first();  
    
    return view('admin.home.home2_box_edit',compact('home2_box'));
}
	
public function faq_list(Request $request){

    if($request->ajax()){
        $faq_list = FAQ::get();
        return DataTables::of($faq_list)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn = '';
            $btn.='<div class="dropdown">
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
            <ul class="dropdown-menu">
            </li>
            <li><a class="dropdown-item" title="Edit" href="'.route('admin.faq_edit',$row->id).'">Edit</a>  </li>
            </ul>
            </div>';
            return $btn;
        })
        
        ->rawColumns(['action'])
        ->make(true);
    }
    
    return view('admin.home.faq_list');
}

public function faq_create(Request $request){
    
    FAQ::create([
        'question' =>$request->question,
        'answer' =>$request->answer,
    ]);
    
    return redirect()->back()->with('success','FAQ Created Successfuly!!');
}
public function faq_update(Request $request,$id){
    $faq = FAQ::find($id);
   
    $faq->update([
        'question' =>$request->question,
        'answer' =>$request->answer,
    ]);
    
    return redirect()->route('admin.faq_list')->with('success','Box Updated Successfuly!!');
}

public function faq_edit($id){
    $faq_edit = FAQ::where('id',$id)->first();  
    
    return view('admin.home.faq_edit',compact('faq_edit'));
}



//Footer Block

// public function footer_block_list(Request $request){

//     if($request->ajax()){
//         $footer_block = FooterBlock::get();
//         return DataTables::of($footer_block)
//         ->addIndexColumn()
//         ->addColumn('action', function ($row) {
//             $btn = '';
//             $btn.='<div class="dropdown">
//             <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
//             <ul class="dropdown-menu">
//             </li>
//             <li><a class="dropdown-item" title="Edit" href="'.route('admin.footer_block_edit',$row->id).'">Edit</a>  </li>
//             </ul>
//             </div>';
//             return $btn;
//         })
        
//         ->rawColumns(['action'])
//         ->make(true);
//     }
    
//     return view('admin.home.footer_block_list');
// }

// public function footer_block_create(Request $request){
    
//     FooterBlock::create([
//         'heading' =>$request->heading,
//         'main_heading' =>$request->main_heading,
//         'content' =>$request->content,
//         'list' =>$request->list,
//         'image'   =>Helpers::upload('footer_block/', 'png', $request->file('image'))
//     ]);
    
//     return redirect()->back()->with('success','Block Created Successfuly!!');
// }
public function footer_block_update(Request $request,$id){
    $footer_block = FooterBlock::find($id);
    $image = $request->file('image');
    if ($image != Null) {
    
        if (Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }
        
        if ($image->isValid()) {
            
            $image_path =Helpers::upload('footer_block/', 'png', $request->file('image'));
        }
    }else{            
        $image_path = $footer_block->image;
    }
    $footer_block->update([
        'heading' =>$request->heading,
        'main_heading' =>$request->main_heading,
        'list1' =>$request->list1,
        'list2' =>$request->list2,
        'content' =>$request->content,
        'image'   =>$image_path,
    ]);
    
    return redirect()->route('admin.footer_block_edit')->with('success','Footer Block Updated Successfuly!!');
}

public function footer_block_edit(){
    $footer_block = FooterBlock::first(); 
    return view('admin.home.footer_block_edit',compact('footer_block'));
}
public function banner_edit(){
    $banner = Banner::first(); 
    return view('admin.home.banner_edit',compact('banner'));
}

public function banner_update(Request $request,$id){
    $banner = Banner::find($id);

    $multiImage = request('multi_logo');
    $logo_path = [];
    foreach($multiImage as $logo){
            // dd($logo);
        $logo_path[] = Helpers::upload('banner/', 'png',$logo);
    }
    $path = implode(',',$logo_path);

    $banner->update([
        'icon1'      =>Helpers::upload('banner/', 'png', $request->file('icon1')),
        'icon2'      =>Helpers::upload('banner/', 'png', $request->file('icon2')),
        'icon3'      =>Helpers::upload('banner/', 'png', $request->file('icon3')),
        'icon4'      =>Helpers::upload('banner/', 'png', $request->file('icon4')),
        'banner'      =>Helpers::upload('banner/', 'png', $request->file('banner')),
        'icon1_name' =>$request->icon1_name,
        'icon2_name' =>$request->icon2_name,
        'icon3_name' =>$request->icon3_name,
        'icon4_name' =>$request->icon4_name,
        'content'    =>$request->content,
        'multi_logo'  =>$path,
    ]);

    return redirect()->back()->with('success','Banner Section Updated Successfuly!!');
}

public function pricing_list(Request $request){
  
    
    return view('admin.home.pricing_list');
}

public function pricing_update(Request $request,$id){
$pricing =PricingSection::find($id);

$list_text = implode('",',$request->list_text);
$pricing->update([
    'main_title'        =>$request->main_title ,
    'title'         =>$request->title ,
    'content'           =>$request->content ,
    'btn_text'          =>$request->btn_text ,
    'heading'           =>$request->heading ,
    'list_text'         =>$list_text, 
]);
return redirect()->back()->with('success','Pricing Section Updated Successfuly!!');
}

}
