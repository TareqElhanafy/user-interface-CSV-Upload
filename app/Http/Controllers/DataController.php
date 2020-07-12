<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Jobs\ProcessCsvUpload;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DataController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadFileRequest $request)
    {
        
        $file=file($request->file->getRealPath());
        $data=array_slice($file,1);
        $parts=array_chunk($data,3000);

        foreach($parts as $index=>$part){
            $FileName=resource_path('pending-files/'.date('H-i-s').$index.'.csv');

            file_put_contents($FileName,$part);
        }

        $path=resource_path('pending-files/*.csv');

        $files=glob($path);

        foreach($files as $file){
         ProcessCsvUpload::dispatch($file);
         session()->flash('success','Data imported successfully');
         return redirect('/');
        }
    }

    public function resetdata()
    {
        User::truncate();
        return redirect('/');
    }
}
