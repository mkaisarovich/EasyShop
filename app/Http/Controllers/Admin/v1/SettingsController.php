<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Privacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    function about_us(){
        $data = AboutUs::query()->get();
        return view('admin.pages.super_admin.settings.about_us',compact('data'));
    }

    function privacy(){

        $data = Privacy::query()->get();
        return view('admin.pages.super_admin.settings.privacy',compact('data'));

    }

    function createAboutUs(Request $request)
    {
        AboutUs::query()->create([
            'title'=>$request->title,
            'description'=>$request->description
        ]);

        return back()->withSuccess('Успешно');
    }



    function createPrivacy(Request $request)
    {
        Privacy::query()->create([
            'name'=>$request->name,
            'file'=>$request->hasFile('file') ?
                config('app.url').'/storage/'.Storage::disk('public')->put("settings/privacy/".$request->name , $request->file)
                : null
        ]);
        return back()->withSuccess('Успешно');

    }


    function editAboutUs(Request $request,AboutUs $about_us){

        $about_us->title = $request->title;
        $about_us->description = $request->description;
        $about_us->save();

        return back()->withSuccess('Успешно');

    }

    function editPrivacy(Request $request,Privacy $privacy){
        $privacy->update([
            'name'=>$request->name,
            'file'=>$request->hasFile('file') ?
                config('app.url').'/storage/'.Storage::disk('public')->put("settings/privacy/".$request->name , $request->file)
                : null
        ]);

        return back()->withSuccess('Успешно');
    }

    function deleteAboutUs(AboutUs $about_us){
        $about_us->delete();
        return back()->withSuccess('Успешно');
    }

    function deletePrivacy(Privacy $privacy){
        $privacy->delete();
        return back()->withSuccess('Успешно');
    }

}
