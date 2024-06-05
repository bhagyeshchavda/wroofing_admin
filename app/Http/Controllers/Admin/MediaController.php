<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MediaFile;
use App\Models\MediaFolder;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class MediaController extends Controller
{
    
    public function index(Request $request, $folderId = null)
    {   
        if($folderId){
            $folderBreadcrumb =  MediaFolder::where('id', '=', $folderId)
            ->get();

            $BreadcrumbHTML = NULL;
            if(!empty($folderBreadcrumb)){
                foreach($folderBreadcrumb as $folderBreadcrumbVal)
                {
                    if($folderBreadcrumbVal->folder_id != null){
                        $resultData = getBreadcrumbItems($folderBreadcrumbVal->folder_id);
                        $BreadcrumbHTML .= $resultData;                        
                    }
                    $BreadcrumbHTML .= '<li class="breadcrumb-item active">'.$folderBreadcrumbVal->name.'</li>';
                }
            }   
            $CurrentDIRHTML = NULL;
            if(!empty($folderBreadcrumb)){
                foreach($folderBreadcrumb as $folderBreadcrumbVal)
                {
                    if($folderBreadcrumbVal->folder_id != null){
                        $resultData = getWorkingDirItems($folderBreadcrumbVal->folder_id);
                        $CurrentDIRHTML .= $resultData;                        
                    }
                    $CurrentDIRHTML .= '/'.$folderBreadcrumbVal->name.'/';
                }
            }   

            $folderInfo = MediaFolder::where('id', '=', $folderId)
            ->orWhere('folder_id', '=', $folderId)
            ->get();
            if(!empty($folderInfo)){
                $FilesItems   = MediaFile::where('folder_id', '=', $folderId)
                ->orderBy('created_at', 'desc')
                ->paginate(15);
                $postList = array(
                    'page_id'           => $folderId, 
                    'title'             => 'Media',
                    'name'              => 'media',
                    'FoldersItems'      => $folderInfo,
                    'CurrentFolderPath' => $CurrentDIRHTML,
                    'FilesItems'        => $FilesItems,
                    'folderBreadcrumb'  => $BreadcrumbHTML,
                );
                return view('admin.media.index', array('postList' => $postList));
            }
        }else{ 
            $folderBreadcrumb = null;
            $FoldersItems   = MediaFolder::where('folder_id', '=', null)->get();
            $FilesItems     = MediaFile::where('folder_id', '=', null)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            $postList = array(
                'page_id' => null, 
                'title' => 'Media',
                'name' => 'media',
                'FoldersItems' => $FoldersItems,
                'FilesItems' => $FilesItems,
                'folderBreadcrumb'  => $folderBreadcrumb,
            );
            return view('admin.media.index', array('postList' => $postList));
        }
    }

   

    public function storeFile(Request $request)
    {   
        $infoPath   = pathinfo($request['fileinfo']['filename']);
        $extension  = $infoPath['extension'];
        $path       = $string = str_replace('//', '/', $request->working_dir.'/'.$request['fileinfo']['filename']);

        if($request->folder_id == NULL){
            $folderName = $request->working_dir;
            $folderId = get_folder_id_by_folder_slug($folderName);
            $request->merge(["folder_id" => $folderId]);
        }
        
        $fileInfo = array(
            'name' => $request['fileinfo']['filename'],
            'type' => $request->fileType,
            'mime_type' => $request->fileType,
            'path' => $path,
            'size' => $request->fileSize,
            'extension' => $extension,
            'folder_id' => $request->folder_id,
            'user_id' => auth()->user()->id,
        );

        $CreatedInfo = MediaFile::create( $fileInfo );

        session::flash('success','File saved successfully !');

        return $response = [
            'status'  => true,
            'data'    => array(
                'status'  => true, 
                'message' => 'File uploaded succesfully.',
            ),
        ];
    }

    public function addfolder(Request $request)
    {
        $folder_name    = request()->input('name') ? request()->input('name') : request()->input('folder_name');
        $parent_id      = request()->input('working_dir');

        if (empty($folder_name)) {
            return $this->throwError('folder-name');
        }
        if (preg_match('/[^\w-]/i', $folder_name)) {
            $folder_name = str_replace(' ', '-', $folder_name);
        }
        
        if(request()->input('folder_id') == null){
            $folder_id = NUll;
            $exists         =  Storage::exists("/public/photos/{$folder_name}");
            if ($exists == true) {
                return $response = [
                    'status'  => false,
                    'data'    => array(
                        'status'  => true, 
                        'message' => 'folder already exists',
                    ),
                ];
            }
            try {
                $fileInfo = array(
                    'name'      => $folder_name,
                    'type'      => 'image',
                    'folder_id' => $folder_id,
                );
                $CreatedInfo = MediaFolder::create( $fileInfo );
                Storage::makeDirectory("/public/photos/{$folder_name}",0775, true, true);
            } catch (\Exception $e) {
                DB::rollBack();
                return $e->getMessage();
            }
        }else{
            $folder_id      = request()->input('folder_id');
            $sub_dir_exists =  Storage::exists("/public/photos{$parent_id}/{$folder_name}");

            if ($sub_dir_exists == true) {
                return $response = [
                    'status'  => false,
                    'data'    => array(
                        'status'  => true, 
                        'message' => 'folder already exists',
                    ),
                ];
            }
            try {
                $fileInfo = array(
                    'name'      => $folder_name,
                    'type'      => 'image',
                    'folder_id' => $folder_id,
                );
                $CreatedInfo = MediaFolder::create( $fileInfo );
                Storage::makeDirectory("/public/photos/{$parent_id}/{$folder_name}",0775, true, true);
            } catch (\Exception $e) {
                DB::rollBack();
                return $e->getMessage();
            }
        }

        return $response = [
            'status'  => true,
            'data'    => array(
                'status'  => true, 
                'message' => 'Folder created succesfully.',
            ),
        ];
    }
    public function destroy(Request $request)
    {
        $id                 = $request->id;
        $AllFilesItems      = MediaFile::get()->toArray();

        $FilesItems         = MediaFile::where('id', '=', $id)->get('path')->toArray();
        $FilePathInfo       = str_replace('//', '', $FilesItems[0]['path']);
        $FilesPath          = storage_path('app/public/photos'.$FilePathInfo);
        //$FilesPath          = public_path().'storage/photos'.'/'.$FilesItems[0]['path'];
        
        $samePathAvailable = false;
        if(!empty($AllFilesItems)){
            foreach($AllFilesItems as $AllFilesItemsVal){
                if($AllFilesItemsVal['id'] != $id){
                    if($FilesItems[0]['path'] == $AllFilesItemsVal['path']){
                        $samePathAvailable = true;
                    }
                }
            }
        }
        try {
            if($samePathAvailable == false){
                $deleteStatus = unlink($FilesPath);
                if(!empty($request->input('is_file')) && $deleteStatus == true){
                    MediaFile::destroy($id);
                }
            }else{
                if(!empty($request->input('is_file'))){
                    MediaFile::destroy($id);
                }
            }
        } catch (\Exception $e) {
            dd('something is wrong.');
            throw $e;
        }

        Session::flash('error','File Deleted Successfully !');

        return $response = [
            'status'  => true,
            'data'    => array(
                'status'  => true, 
                'message' => 'File Deleted Successfully',
            ),
        ];
    }

    // public function dropzoneStore(Request $request)
    // {
    //     if($request->hasFile('tourimage')){
    //         $image = $request->file('tourimage');
    //     } else {
    //         $image = $request->file('file');
    //     }
        
    //     $imageName = $image->getClientOriginalName();
        
    //     $fileInfo = array(
    //         'name' => $imageName,
    //         'type' => $image->getMimeType(),
    //         'mime_type' => $image->getMimeType(),
    //         'path' => '/'.$imageName,
    //         'size' => $image->getSize(),
    //         'extension' => $image->extension(),
    //         'folder_id' => null,
    //         'user_id' => auth()->user()->id,
    //     );
    //     // dd($fileInfo);
        
    //     $CreatedInfo = MediaFile::create( $fileInfo );
        
    //     $image->move(storage_path('/app/public/photos/'),$imageName);

    //     return response()->json(['success'=> $imageName]);
    // }

    // public function store(Request $request)
    // {
    //     foreach($request->input('document', []) as $file) {
    //         //your file to be uploaded
    //         return $file;
    //     }
    // }

    public function uploads(Request $request)
    {
        $path = storage_path('/app/public/photos');

        if($request->hasFile('tourimage')){
            $file = $request->file('tourimage');
        } else if ($request->hasFile('file')) {
            $file = $request->file('file');
        } else {
            return response()->json([
                'message' => 'Request has no file'
            ]);
        }

        // $file = $request->file('file');
        $name = $file->getClientOriginalName();

        try {
            // dd(file_exists($path.'/'.$name));
            if(!file_exists($path.'/'.$name)){
                
                $fileInfo = array(
                    'name' => $name,
                    'type' => $file->getMimeType(),
                    'mime_type' => $file->getMimeType(),
                    'path' => '/'.$name,
                    'size' => $file->getSize(),
                    'extension' => $file->extension(),
                    'folder_id' => null,
                    'user_id' => auth()->user()->id,
                );
                // dd($fileInfo);
                
                $CreatedInfo = MediaFile::create( $fileInfo );
        
                $file->move($path, $name);
                
            }
        } catch (\Exception $e) {
            dd('something is wrong.');
            throw $e;
        }
        
        return response()->json([
            'name'          => $name,
            'exist' => file_exists($path.'/'.$name),
            'message' => 'File Uploaded Successfully'
        ]);
    }
    public function getfiledata(Request $request){
        // dd($path);
        $fileData = [];
        foreach ($request->data as $key => $value) {
            // $path = 'storage/photos/'.$value;
            // $file = Storage::disk('public')->get($path);
            // $fileData[$value] = $file;
            $imagePath = 'public/photos/'.$value;
            
            // Check if the image file exists
            if (Storage::exists($imagePath)) {
                // Get the image content as binary data
                $imageData = Storage::get($imagePath);
                // dd($imageData);
                // Convert the binary data to base64
                $base64Image = base64_encode($imageData);

                $fileData[] = $base64Image;
                
                // Pass the base64-encoded image data to the Blade view
                // return view('image.show', ['imageData' => $base64Image]);
            } else {
                // Handle the scenario when the image file is not found
                dd(Storage::exists($imagePath));
                return redirect()->back()->with('error', 'Image not found.');
            }
        }
        return $fileData;
    }

}
