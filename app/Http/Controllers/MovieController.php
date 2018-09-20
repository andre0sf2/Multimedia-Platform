<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

define('DIR', getcwd()."/storage/Movies/");

class MovieController extends Controller
{
    private function getMoviePath($dir)
    {
        $allowed_extensions = array("webm", "mp4", "ogv", "mkv");
        $items = array_diff(scandir($dir), array('.', '..'));
        foreach($items as $item){
            if($this->isVideo($item)){ 
                $path = explode(getcwd(), $dir);
                return end($path).'/'.$item;
            }
        }
        return null;
    }
    
    private function getAllSubs($rootDir, $allData=array()) 
    {
        $dirContent = array_diff(scandir($rootDir), array(".", ".."));
        foreach($dirContent as $key => $content) {
            $path = $rootDir.'/'.$content;
            if(is_file($path) && is_readable($path)) {
                $str = explode('.', $path);
                if(end($str) == 'srt'){
                    $result = explode(getcwd(), $path);
                    $allData[] = end($result);
                }
            }elseif(is_dir($path) && is_readable($path)) {
                $allData = $this->getAllSubs($path, $allData);
            }
        }
        return $allData;
    }

    private function getAllFolders($rootDir)
    {
        $allData = array();
        $invisibleFileNames = array(".", "..");
        $dirContent = scandir($rootDir);
        foreach($dirContent as $key => $content) {
            $path = $rootDir.'/'.$content;
            if(!in_array($content, $invisibleFileNames)) {
                if(is_dir($path) && is_readable($path)) {
                    $result = explode($rootDir.'/', $path);
                    $realPath = explode(getcwd(), $path);
                    if($this->scanDir($path)){
                        $allData[] = end($result);
                    }
                }
            }
        }
        return $allData;
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

    private function isVideo($movie)
    {
        $allowed_extensions = array("webm", "mp4", "ogv", "mkv");
        $ext = explode('.', $movie);
        return in_array(end($ext), $allowed_extensions);
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
