<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileManagers;
class FileManager extends Controller
{
    public function createForm(){
        $allFiles = FileManagers::whereNull('deleted_at')->paginate(10);
        $dfiles = FileManagers::onlyTrashed()->paginate(10);
        return view('file-upload',['allfiles' => $allFiles,'dfiles' => $dfiles]);
    }

    public function fileUpload(Request $req){
        $req->validate([
        'file' => 'required|mimes:txt,doc,docx,pdf,png,jpeg,jpg,gif|max:2048'
        ]);

        $fileModel = new FileManagers;

        if($req->file()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time().'_'.$req->file->getClientOriginalName();
            $fileModel->path = '/storage/' . $filePath;
            $fileModel->save();

            return back()
            ->with('success','File has been uploaded.')
            ->with('file', $fileName);
        }
    }

    public function deleteFile($id){
        $task=FileManagers::find($id);
        $task->delete();
        return redirect('file-upload');
    }

    public function searchFile(Request $request){
        $name = $_POST['name'];
        if(empty($name))
            $allFiles = FileManagers::whereNull('deleted_at')->get();
        else
            $allFiles = FileManagers::whereNull('deleted_at')->where('name', 'like', '%'.$name.'%')->get();
        return $allFiles;
    }
}
