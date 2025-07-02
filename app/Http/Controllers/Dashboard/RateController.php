<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\blogs;
use App\Models\Chield;
use App\Models\Customer;
use App\Models\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('view_rates');

          if ($request->ajax()){
         $data = getModelData(model: new Rate(), relations: ['child' => ['id', 'name']]);

            return response($data);
         }
        else
            return view('dashboard.customerRate.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create_rates');

        $data = $request->validate([
            'full_name'    => 'required|string|max:255',
            'job_position' => 'nullable|string|max:255',
            'video_url'    => 'nullable|url|max:1000',
            'audio'        => 'nullable|file|mimes:mp3,wav,m4a|max:10240', // 10MB
            'description'  => 'nullable|string',
            'rate'         => 'required|integer|between:1,5',
            'is_publish'   => 'nullable|boolean',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload image if exists
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('rates/images', 'public');
        }

        // Upload audio if exists
        if ($request->hasFile('audio')) {
            $data['audio_url'] = $request->file('audio')->store('rates/audio', 'public');
        }

        $data['is_publish'] = $request->has('is_publish');

        $rate = Rate::create($data);

    }
    /**
     * Display the specified resource.
     */
    public function show(Rate $Rate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rate $Rate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rate $Rate)
    {
        //
    }



    public function destroy( $Rate)
    {
         $customrRate=Rate::find($Rate);
        $this->authorize('delete_rates');

        $customrRate->delete();
        return response(["Rate deleted successfully"]);
    }
}
