<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

define('MOVIE_DIR', getcwd()."/storage/Movies/");

class HomeController extends Controller
{ 
    private function last4Folders($dir) {
        $items = array_diff(scandir($dir), array('.', '..'));

        $files = array();    
        foreach ($items as $file) {
            if($this->scanDir(MOVIE_DIR.'/'.$file)){
                $files[$file] = filemtime($dir . '/' . $file);
            }
        }

        arsort($files);
        $files = array_keys($files);
        
        $folders = array_slice($files, 0, 4, true);

        return ($folders) ? $folders : false;
    }

    private function isVideo($movie)
    {
        $allowed_extensions = array("webm", "mp4", "ogv", "mkv");
        $ext = explode('.', $movie);
        return in_array(end($ext), $allowed_extensions);
    }

    private function scanDir($dir)
    {
        $folders = opendir($dir);

        while (false !== ($entry = readdir($folders))) {
            if($this->isVideo($entry)){
                return true;
            }
        }
        
        return false;
    }

    public function index()
    {
        $movies = $this->last4Folders(MOVIE_DIR);
        
        return view('home', ['movies' => $movies]);
    }
}