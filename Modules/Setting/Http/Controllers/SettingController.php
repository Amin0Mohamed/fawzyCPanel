<?php

namespace Modules\Setting\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function abstract_webs()
    {
        $setting = Setting::where('var','abstract_webs')->first();
        return view('setting::abstract_webs',compact('setting'));
    }

    public function committee_feeds()
    {
        $setting = Setting::where('var','committee_feeds')->first();
        return view('setting::committee_feeds',compact('setting'));
    }

    public function main_topics()
    {
        $setting = Setting::where('var','maintopics')->first();
        return view('setting::committee_feeds',compact('setting'));
    }

    public function new_feeds()
    {
        $setting = Setting::where('var','new_feeds')->first();
        return view('setting::committee_feeds',compact('setting'));
    }

    public function Exhibiitionss()
    {
        $settings = Setting::where('type',2)->get();
        return view('setting::homes',compact('settings'));
    }
    
    public function index()
    {
        $settings = Setting::all();
        return view('setting::settings',compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($request->all() as $key=>$value){
            if ($request->file($key)){
                    $input[$key] = $request->file($key);
                    $allowedfileExtension=['jpg','png','jpeg','pdf'];
                    $extension = $input[$key]->getClientOriginalExtension();
                    $filename =pathinfo($input[$key]->getClientOriginalName(), PATHINFO_FILENAME);
                    $filename = md5($filename . time()) .'.' . $extension;
                    $check=in_array($extension,$allowedfileExtension);
                    if($check){
                        $path     = $input[$key]->move(public_path("/storage/settings") , $filename);
                        $fileURL  = url('/storage/settings/'. $filename);
                        $settings = Setting::where('var',$key)->first();
                        if ($settings !== null){
                            $settings->update(['value'=>$fileURL]);
                        }
                    }

            }else{
                $settings = Setting::where('var',$key)->first();
                if ($settings !== null){
                    $settings->update(['value'=>$value]);
                }
            }
        }
        // $settings->save();

        // dd($settings);
        Session::flash('message', 'Settings Edited Successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }


}
