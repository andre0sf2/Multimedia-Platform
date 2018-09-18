<?php
    $sub = [];
    $dir = getcwd()."/storage/Movies/";

    function getAllFolders($rootDir){
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
                    $allData[] = ["name" => end($result), "path" => end($realPath)];
                }
            }
        }
        return $allData;
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
    
    //<video-component video-src="/storage/Movies/Game Night/Game.Night.2018.720p.BRRip.MkvCage.mp4" :sub-src="{{json_encode(getAllSubs($dir))}}"></video-component>
?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        @foreach(getAllFolders($dir) as $d)
            <div class="col-xl-3">
                <div class="d-flex justify-content-center">
                    <thumb-component :details="{{json_encode($d)}}"></thumb-component>
                </div>
            </div>
        @endforeach
        </div>        
    </div>
@endsection