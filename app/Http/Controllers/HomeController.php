<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
define('DIR', getcwd()."/storage/Movies/");
class HomeController extends Controller
{
    private function getAllFolders($rootDir){
        $allData = array();
        $invisibleFileNames = array(".", "..");
        $dirContent = scandir($rootDir);
        foreach($dirContent as $key => $content) {
            // filter all files not accessible
            $path = $rootDir.'/'.$content;
            if(!in_array($content, $invisibleFileNames)) {
                if(is_dir($path) && is_readable($path)) {
                    // recursive callback to open new directory
                    $result = explode($rootDir.'/', $path);
                    $realPath = explode(getcwd(), $path);
                    $allData[] = end($result);
                }
            }
        }
        return $allData;
    }
    private function getMoviePath($dir){
        $allowed_extensions = array("webm", "mp4", "ogv", "mkv");
        $items = array_diff(scandir($dir), array('.', '..'));
        foreach($items as $item){
            $ext = explode('.', $item);
            if(in_array(end($ext), $allowed_extensions)){ 
                $path = explode(getcwd(), $dir);
                return end($path).'/'.$item;
            }
        }
        return null;
    }
    private function getAllSubs($rootDir, $allData=array()) {
        // set filenames invisible if you want
        $invisibleFileNames = array(".", "..");
        // run through content of root directory
        $dirContent = scandir($rootDir);
        foreach($dirContent as $key => $content) {
            // filter all files not accessible
            $path = $rootDir.'/'.$content;
            if(!in_array($content, $invisibleFileNames)) {
                // if content is file & readable, add to array
                if(is_file($path) && is_readable($path)) {
                    // save file name with path
                    $str = explode('.', $path);
                    if(end($str) == 'srt'){
                        $result = explode(getcwd(), $path);
                        $allData[] = end($result);
                    }
                // if content is a directory and readable, add path and name
                }elseif(is_dir($path) && is_readable($path)) {
                    // recursive callback to open new directory
                    $allData = $this->getAllSubs($path, $allData);
                }
            }
        }
        return $allData;
    }
    public function index()
    {
        return view('home');
    }
    public function getAllMovies()
    {
        $folders = $this->getAllFolders(DIR);
        return view('movieList', ['folders' => $folders]);
    }
    public function getMovie($name)
    {
        $movie = $this->getMoviePath(DIR.$name);
        $subs = $this->getAllSubs(DIR.$name);
        if(!$movie){
            abort(404);
        }
        return view('movie', ['name' => $name, 'movie' => $movie, 'subs' => $subs]);
    }
}