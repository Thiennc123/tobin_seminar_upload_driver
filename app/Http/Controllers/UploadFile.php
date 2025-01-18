<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class UploadFile extends Controller
{
    public function uploadFile(Request $request)
    {
        $image = $request->file('file');
        $contents = file_get_contents($image);
        $nameFile = $image->getClientOriginalName();
        $googleDriveStorage = Storage::disk('google');
        $googleDriveStorage->put($nameFile, $contents);
        return 1;
    }

    public function getListFile()
    {
        $googleDriveStorage = Storage::disk('google');
        $listFile = $googleDriveStorage->files();
        return view('action', compact("listFile"));

    }

    public function downloadFile($nameFile)
    {
        $googleDriveStorage = Storage::disk('google');
        $listFile = $googleDriveStorage->download($nameFile);
        $listFile->send();
    }

    public function removeFile($name)
    {
        $googleDriveStorage = Storage::disk('google');
        $listFile           = $googleDriveStorage->delete($name);
        return redirect()->route('get-list-file');
    }

    public function unsafeQuery(Request $request)
    {
        $unsafeInput = $request->input('search');
        $results = DB::select("SELECT * FROM users WHERE name = '$unsafeInput'");
        return response()->json($results);

        $userInput = $_GET['username']; 
$       $users = DB::select("SELECT * FROM users WHERE username = '$userInput'");
    }
}
