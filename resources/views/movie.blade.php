<?php
    $dir = getcwd()."/storage/Movies/".$movie;

    function getMovie($dir){
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

    function getAllSubs($rootDir, $allData=array()) {
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
                    $allData = getAllSubs($path, $allData);
                }
            }
        }
        return $allData;
    }
?>

@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="py-2">{{$movie}}</h1>
        <div class="d-flex">
            <div class="col-md-3">
                <img src="" alt="Poster">
            </div>
            <div class="col-md-9">
                <h3 class="py-2">Decrição:</h3>
                <p>Cenas</p>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <video-component :video-src="{{json_encode(getMovie($dir))}}" :sub-src="{{json_encode(getAllSubs($dir))}}"></video-component>
    </div>
@endsection