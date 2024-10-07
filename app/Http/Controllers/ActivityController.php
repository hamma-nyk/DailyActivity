<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::where('user_id', auth()->user()->id)->where('tanggal', '<', date('Y-m-d'))->orderBy('id', 'desc')->get();
        $activities_today = Activity::where('user_id', auth()->user()->id)->where('tanggal', date('Y-m-d'))->orderBy('id', 'desc')->get();
        return view('activity_management', ['activities' => $activities, 'activities_today' => $activities_today]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $now = date('Y-m-d', strtotime(now()));
        // return response()->json(['tgl'=>$request->input('tanggal'),'now'=> $date]);
        $check = Activity::where('user_id', $request->input('user_id'))->where('tanggal', $request->input('tanggal'))->first();
        if ($check) {
            $error_add = "Tidak bisa menambahkan aktivitas yang sama atau di hari yang sama";
            if (auth()->user()->type == 'admin') {
                return redirect()->route('admin.activity_management')->with('error_add', $error_add);
            }else if (auth()->user()->type == 'user') {
                return redirect()->route('user.activity_management')->with('error_add', $error_add);
            }
        }

        $activity = new Activity();
        $activity->user_id = $request->input('user_id');
        $activity->name = $request->input('name');
        $activity->email = $request->input('email');
        $activity->activity = $request->input('activity');
        $activity->tanggal = $request->input('tanggal');
        $activity->save();
        if (auth()->user()->type == 'admin') {
            $success_add = "Aktivitas berhasil ditambahkan";
            return redirect()->route('admin.activity_management')->with('success_add', $success_add);
        }else if (auth()->user()->type == 'user') {
            $success_add = "Aktivitas berhasil ditambahkan";
            return redirect()->route('user.activity_management')->with('success_add', $success_add);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = Activity::find($id);
        $activity->delete();
        if (auth()->user()->type == 'admin') {
            return redirect()->route('admin.activity_management');
        }else if (auth()->user()->type == 'user') {
            return redirect()->route('user.activity_management');
        }
    }
}
