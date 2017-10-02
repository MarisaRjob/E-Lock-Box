<?php

namespace App\Http\Controllers\Admin\CaseManagement;

use App\Avatar;
use App\CreateCase;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Docs;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use File;
use Sentinel;


class FileuploadingController extends Controller
{
    /**
     * This function is show the case upload page
     * @return [return case.upload]
     */
    public function index(){
        return view('case.upload');
    }

    // create new function for show uploaded page
    /**
     * This function is save the file uploaded and it's information
     * @param  [array] $request [form data from admin.case.detail]
     * @return                  [return admin.case.$id.view]
     */
    public function showfileupload(Request $request){
        $file = $request -> file('image');
        $id = $request->id;
        $case = CreateCase::where("id", $id)->first();
        $type = $request->type;
        // show the file name
        $time = time();
//        echo 'File Name : '.$file->getClientOriginalName();
//        echo '<br>';
        $newName = str_replace('.'.$file->getClientOriginalExtension(), '_'.$time.'.'.$file->getClientOriginalExtension(), $file->getClientOriginalName());

        // move uploaded File
        $destinationPath = 'uploads/case/'.$id;
//        $filenewname = 'public/case/'.$id.'/'.$newName;
        $file->move($destinationPath, $newName);
//        Storage::disk('local')->put($filenewname, file_get_contents($file->getRealPath()));
        //save information in database docs
        $doc = new Docs;
        $doc->case_id = $id;
        $doc->type = $request->get('type');
        $doc->title = $request->get('title');
        $doc->description = $request->get('description');
        $doc->uploader = $request->get('uploader');
        $doc->path = $destinationPath;
        $doc->visible = $request->get('visible');
        $doc->filename = $newName;
        $doc->save();
        @Log::info('File uploaded: ' . Sentinel::getUser()->email . ' Case: ' . $case->email. ' File name: ' . $newName);
        return redirect('admin/case/'.$id.'/view');
    }

    /**
     * This function is to upload the avatar for the youth user of a case
     * @param  [array] $request [form data from admin.case.detail]
     * @return [array]          [return admin.case.$id.view]
     */
    public function uploadAvatar(Request $request) {
        //case avatar
        $file = $request->file('avatar');
        $id = $request->id;
        $time = time();
        $newName = str_replace('.'.$file->getClientOriginalExtension(), '_'.$time.'.'.$file->getClientOriginalExtension(), $file->getClientOriginalName());
        $destinationPath = 'uploads/case/'.$id;
        $file->move($destinationPath, $newName);
//        Storage::disk('local')->put($filenewname, file_get_contents($file->getRealPath()));
        $old_ava = Avatar::where('case_id', $id)->first();
        if($old_ava) {
            $deletepath = "uploads/case/" . $id . "/". $old_ava->filename;
            File::delete($deletepath);
            $old_ava->case_id = $id;
            $old_ava->path = $destinationPath;
            $old_ava->filename = $newName;
            $old_ava->save();
        } else {
            $ava = new Avatar;
            $ava->case_id = $id;
            $ava->path = $destinationPath;
            $ava->filename = $newName;
            $ava->save();
        }
        return redirect('admin/case/'.$id.'/view');
    }
}
