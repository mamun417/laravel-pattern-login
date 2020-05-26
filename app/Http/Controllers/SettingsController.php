<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class SettingsController extends Controller
{
    public function settings()
    {
        $settings = json_decode(auth()->user()->setting->value);
        return view('settings.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'security_type' => 'required',
        ]);

        $request_data = $this->filterFormRequest(['security_type', 'line_on_move'], $request->all());
        $request_data['line_on_move'] = isset($request->line_on_move) ? 0 : 1;

        $request_data = [
            'user_id' => auth()->id(),
            'value' => json_encode($request_data)
        ];

        if ($setting = $request->user()->setting){
            $setting->update($request_data);
        }else{
            Setting::create($request_data);
        }

        return back();
    }

    public function filterFormRequest($excepts, $request)
    {
        return collect($excepts)->filter(function ($item) use ($request) {
            if (array_key_exists($item, $request)){
                return true;
            }
            return false;
        })->mapWithKeys(function ($item) use ($request){
            return [$item => $request[$item]];
        });
    }
}
