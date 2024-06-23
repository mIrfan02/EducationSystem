<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class MeetingController extends Controller
{
    public function index()
    {
        $sessions = Meeting::where('teacher_id', auth()->user()->id)->get();
        return view('teacher.index', compact('sessions'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'date' => 'required|date',
    //         'start_time' => 'required|date_format:H:i',
    //         'end_time' => 'required|date_format:H:i|after:start_time',
    //         'title' => 'required|string|max:255',
    //         'meeting_link' => 'required|url',
    //         'fee_per_hour' => 'required|numeric|min:0',
    //         'teacher_id' => 'required|exists:users,id',
    //     ]);

    //     $overlappingSessions = Meeting::where('date', $request->date)
    //         ->where('start_time', '<', $request->end_time)
    //         ->where('end_time', '>', $request->start_time)
    //         ->exists();

    //     if ($overlappingSessions) {
    //         return redirect()->back()->with('error', 'Another session is already scheduled during this time.');
    //     }

    //     Meeting::create($request->all());

    //     Alert::success('Success', 'Session added successfully.');
    //     return redirect()->back();
    // }


    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'title' => 'required|string|max:255',
            'meeting_link' => 'required|url|max:255',
            'fee_per_hour' => 'required|numeric|min:0',
            'session_type'=>'required',
        ]);

        // Check for overlapping sessions
        $overlappingSession = Meeting::where('teacher_id', $request->teacher_id)
            ->where('date', $request->date)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_time', '<', $request->start_time)
                            ->where('end_time', '>', $request->end_time);
                    });
            })
            ->exists();

        if ($overlappingSession) {
            return back()->withErrors(['date' => 'You already have a session scheduled during this time.'])->withInput();
        }

        $meeting = new Meeting();
        $meeting->date = $request->date;
        $meeting->start_time = $request->start_time;
        $meeting->end_time = $request->end_time;
        $meeting->title = $request->title;
        $meeting->meeting_link = $request->meeting_link;
        $meeting->fee_per_hour = $request->fee_per_hour;
        $meeting->teacher_id = $request->teacher_id;
        $meeting->session_type=$request->session_type;
        $meeting->save();

        Alert::success('Success', 'Session added successfully.');

        return redirect()->back();
    }




    public function update(Request $request, $id)
    {
        $meeting = Meeting::findOrFail($id);

        // Convert time to H:i format
        $start_time = date('H:i', strtotime($request->start_time));
        $end_time = date('H:i', strtotime($request->end_time));

        $request->merge([
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);

        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'title' => 'required|string|max:255',
            'meeting_link' => 'required|url|max:255',
            'fee_per_hour' => 'required|numeric|min:0',
            'session_type'=>'required',

        ]);

        // Check for overlapping sessions
        $overlappingSession = Meeting::where('teacher_id', $request->teacher_id)
            ->where('date', $request->date)
            ->where('id', '!=', $meeting->id)
            ->where(function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('start_time', '<', $request->end_time)
                          ->where('end_time', '>', $request->start_time);
                });
            })
            ->exists();

        if ($overlappingSession) {
            return back()->withErrors(['date' => 'You already have a session scheduled during this time.'])->withInput();
        }

        $meeting->date = $request->date;
        $meeting->start_time = $request->start_time;
        $meeting->end_time = $request->end_time;
        $meeting->title = $request->title;
        $meeting->meeting_link = $request->meeting_link;
        $meeting->fee_per_hour = $request->fee_per_hour;
        $meeting->teacher_id = $request->teacher_id;
        $meeting->session_type=$request->session_type;

        $meeting->save();

        Alert::success('Success', 'Session updated successfully.');

        return redirect()->back();
    }


    // public function update(Request $request, Meeting $meeting)
    // {
    //     $request->validate([
    //         'date' => 'required|date',
    //         'start_time' => ['required', 'date_format:H:i'],
    //         'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
    //         'title' => 'required|string|max:255',
    //         'meeting_link' => 'required|url',
    //         'fee_per_hour' => 'required|numeric|min:0',
    //         'teacher_id' => 'required|exists:users,id',
    //     ]);

    //     // Check for overlapping sessions excluding the current session
    //     $overlappingSessions = Meeting::where('date', $request->date)
    //         ->where('start_time', '<', $request->end_time)
    //         ->where('end_time', '>', $request->start_time)
    //         ->where('id', '!=', $meeting->id)
    //         ->exists();

    //     if ($overlappingSessions) {
    //         return redirect()->back()->with('error', 'Another session is already scheduled during this time.');
    //     }

    //     $meeting->update($request->all());

    //     Alert::success('Success', 'Session updated successfully.');
    //     return redirect()->back();
    // }


    public function destroy($id)
    {
        $meeting=Meeting::findOrFail($id);
        $meeting->delete();
        Alert::success('Success', 'Session deleted successfully.');
        return redirect()->back();
    }
}
