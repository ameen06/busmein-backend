<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MediaDataTable;
use App\Http\Controllers\Controller;
use App\Models\Media;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use  Illuminate\Support\Str;

class MediaController extends Controller
{
    public function index(MediaDataTable $dataTable){
        return $dataTable->render('admin.media.index');
    }

    public function temp_upload(Request $request){
        try{
            if($request->hasFile('filepond')){
                $fileNameOriginal = $request->file('filepond')->getClientOriginalName();
                $fileNameOld = pathinfo($fileNameOriginal, PATHINFO_FILENAME);
                $extension = $request->file('filepond')->getClientOriginalExtension();
                $filename = Str::slug($fileNameOld).'_'.time().'.'.$extension;
                $image = $request->file('filepond');
                
                $path = $image->storeAs('bumein/media', $filename, 'imagekit');

                if(!$path){
                    return null;
                }

                DB::beginTransaction();
                Media::create([
                    'url' => config('filesystems.disks.imagekit.endpoint_url') . '/' . $path,
                    'path' => $path
                ]);
                DB::commit();
                
                return $filename;
            }
        }catch(Exception $error){
            return null;
        }
    }

    public function store(Request $request)
    {
        try{
            $path = $request->filepond;

            if (!Storage::disk('imagekit')->exists($path)) { 
                return redirect()->back()->with(['alert' => true, 'alertColor' => 'red', 'message' => 'media does not exist in temporary folder. Try re-uploading']);
            }

            DB::beginTransaction();
            Media::where('path', 'bumein/media/'.$path)->update([
                'title' => $request->title
            ]);
            DB::commit();
            
            return redirect()->back()->with(['alert' => true, 'alertColor' => 'green', 'message' => 'new media created successfully!']);
        }catch(Exception $error){
            DB::rollBack();
            return redirect()->back()->with(['alert' => true, 'alertColor' => 'red', 'message' => $error->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try{
            $filename = $request->filepond;

            if($filename){
                if (!Storage::disk('imagekit')->exists($filename)) { 
                    return redirect()->back()->with(['alert' => true, 'alertColor' => 'red', 'message' => 'media does not exist in temporary folder. Try re-uploading']);
                }
            }

            DB::beginTransaction();
            Media::find($request->media)->update(['title' => $request->title]);
            if($filename){
                Media::find($request->media)->update([
                    'url' => config('filesystems.disks.imagekit.endpoint_url') . '/bumein/media/' . $filename
                ]);
            }
            DB::commit();
            
            return redirect()->back()->with(['alert' => true, 'alertColor' => 'green', 'message' => 'media updated successfully!']);
        }catch(Exception $error){
            DB::rollBack();
            return redirect()->back()->with(['alert' => true, 'alertColor' => 'red', 'message' => $error->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $media = Media::find($id);
            $media->delete();

            DB::commit();

            return redirect()->route('media.index')->with(['alert' => true, 'alertColor' => 'green', 'message' => 'media deleted successfully!']);
        } catch(Exception $error) {
            DB::rollBack();
            return redirect()->back()->with(['alert' => true, 'alertColor' => 'red', 'message' => $error->getMessage()]);
        }
    }
}
