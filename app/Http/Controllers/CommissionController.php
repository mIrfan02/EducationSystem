<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Commission;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commissions = Commission::all();
        $courses=Course::all();
        return view('commission.index', compact('commissions','courses'));
    }

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'rate' => 'required|numeric',
            'course_id' => 'required|exists:courses,id',
        ]);

        Commission::create($request->all());

        // Display SweetAlert message
        Alert::success('Success', 'Commission created successfully!')->persistent(true);

        return redirect()->route('commissions.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commission $commission)
    {
        $request->validate([
            'rate' => 'required|numeric',
            'course_id' => 'required|exists:courses,id',
        ]);

        $commission->update($request->all());

        // Display SweetAlert message
        Alert::success('Success', 'Commission updated successfully!')->persistent(true);

        return redirect()->route('commissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commission $commission)
    {
        $commission->delete();

        // Display SweetAlert message
        Alert::success('Success', 'Commission deleted successfully!')->persistent(true);

        return redirect()->route('commissions.index');
    }

}
