<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function getAllFolders(Request $request, $allData = array())
    {
        $dir = explode('/', getcwd());
        $realPath = '/'.$dir[1].'/'.$dir[2];
        $rootDir = $request->path;

        if(is_null($rootDir)){
            $rootDir = $realPath;
        }

        $invisibleFileNames = array(".");
        $dirContent = preg_grep('/^([^.])/', scandir($rootDir));
        array_push($dirContent, '..');
        foreach($dirContent as $key => $content) {
            $path = $rootDir.'/'.$content;
            if(!in_array($content, $invisibleFileNames)) {
                if(is_dir($path) && is_readable($path)) {
                    $result = explode($rootDir.'/', $path);
                    $realPath = explode(getcwd(), $path);
                    $allData[] = ['name' => end($result), 'path' => $path];
                }
            }
        }
        return response()->json(['path' => $rootDir, 'folders' => $allData]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('backoffice.home');
    }
}
