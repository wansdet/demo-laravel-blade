<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function indexUserFiles()
    {
        $directory = "users/" . auth()->user()->id;
        $userFiles = Storage::files($directory);
        $files = [];

        foreach ($userFiles as $key => $userFile) {
            $filename = str_replace($directory . '/', '', $userFile);
            $files[] = [
                'filename' => $filename,
                'url' => url('user/files/' . pathinfo($filename, PATHINFO_FILENAME)) . '/'. pathinfo($filename, PATHINFO_EXTENSION),
                'lastModified' => date('d-m-Y H:i:s', Storage::lastModified($userFile)),
            ];
        }

        return view('user.files-index', [
            'userFiles' => $files,
        ]);
    }

    public function downloadFile(string $filename, string $extension)
    {
        $filePath = 'users/' . auth()->user()->id . '/' . $filename . '.' . $extension;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        } else {
            // Handle the case where the file doesn't exist
            // You can redirect to an error page or return a response
            // abort(404);
        }
    }
}
