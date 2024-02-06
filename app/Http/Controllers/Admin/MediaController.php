<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use  Illuminate\Support\Str;

class MediaController extends Controller
{
    public function index(){
        return view('admin.media.index');
    }

    public function temp_upload(Request $request){
        try{
            if($request->hasFile('filepond')){
                $fileNameOriginal = $request->file('filepond')->getClientOriginalName();
                $fileNameOld = pathinfo($fileNameOriginal, PATHINFO_FILENAME);
                $extension = $request->file('filepond')->getClientOriginalExtension();
                $image = $request->file('filepond');
                $filenameNew = Str::slug($fileNameOld).'_'.time().'.'.$extension;
                $filename = str_replace(' ', '_', $filenameNew);
                
    
                $path = $image->storeAs('bumein/media', $filename, 'imagekit');
                
                if($path){
                    return $filename;
                }else{
                    return null;
                }
            }
        }catch(Exception $error){
            return null;
        }
    }

    public function store(Request $request)
    {
        try{
            $filename = $request->filepond;

            if (!Storage::disk('imagekit')->exists('bumein/media/'.$filename)) { 
                return redirect()->back()->with(['alert' => true, 'alertColor' => 'red', 'message' => 'media does not exist in temporary folder. Try re-uploading']);
            }

            DB::beginTransaction();
            Media::create([
                'url' => config('filesystems.disks.imagekit.endpoint_url'). '/bumein/media/' .$filename,
                'path' => 'bumein/media/'.$filename,
                'title' => $request->title
            ]);
            DB::commit();
            
            return redirect()->back()->with(['alert' => true, 'alertColor' => 'green', 'message' => 'new media created successfully!']);
        }catch(Exception $error){
            DB::rollBack();
            return redirect()->back()->with(['alert' => true, 'alertColor' => 'red', 'message' => $error->getMessage()]);
        }
    }
}
