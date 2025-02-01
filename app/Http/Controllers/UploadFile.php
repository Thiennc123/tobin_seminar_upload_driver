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

    
    
        public function authenticate() {
            $user = $_POST['user'];
            $pass = $_POST['pass';
            $authenticated = false;
    
            $query = "SELECT * FROM users WHERE user = '" . $user . "' AND pass = '" . $pass . "'";
    
            $stmt = $this->conn->query($query); // Noncompliant
    
            if ($stmt->num_rows == 1) {
              $authenticated = true;
            }
    
            return $authenticated;
        }
    
}
