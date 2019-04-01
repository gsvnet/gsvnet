<?php

class AprilFoolsController extends BaseController {

    public function index()
    {
        return view('april-fools');
    }

    public function purchase($bundle)
    {
        Auth::user()->getAprilFools()->purchaseBundle($bundle);
        
        return redirect()->action('AprilFoolsController@index');
    }

    public function spend()
    {
        $request = request();
        //dd($request->all());

        $colorRegex = "regex:/^(\#[\da-f]{3}|\#[\da-f]{6}|rgba\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)(,\s*(0\.\d+|1))\)|hsla\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)(,\s*(0\.\d+|1))\)|rgb\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)|hsl\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)\))$/i";

        $this->validate($request, [
            'bg-color' => [
                $colorRegex
            ],
            'text-color' => [
                $colorRegex
            ]
        ]);

        //dd(request()->all());
        if(request()->has('bg-color')) {
            Auth::user()->getAprilFools()->spendOnBgColor($request['bg-color']);
        }
        if(request()->has('txt-color')) {
            Auth::user()->getAprilFools()->spendOnTextColor($request['txt-color']);
        }
        if(request()->has('special_menu')) {
            Auth::user()->getAprilFools()->spendOnSpecialMenu();
        }
        if(request()->has('remove_special_menu')) {
            Auth::user()->getAprilFools()->removeSpecialMenu();
        }

        return redirect()->action('AprilFoolsController@index');
    }
}