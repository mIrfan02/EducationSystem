<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CourseTeacherController extends Controller
{

    public function assignCourse(Request $request, User $teacher)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $course = Course::findOrFail($request->course_id);

        // Check if the course is already assigned to the teacher
        if ($teacher->courses->contains($course)) {
            Alert::error('Error', 'This course is already assigned to the teacher.');
            return redirect()->back();
        }

        // Attach the course to the teacher
        $teacher->courses()->attach($course);

        Alert::success('Success', 'Course assigned successfully.');

        return redirect()->back();
    }


    public function update(Request $request, User $teacher, $pivot_id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        // Update the pivot table entry
        $teacher->courses()->updateExistingPivot($pivot_id, ['course_id' => $request->course_id]);

        Alert::success('Success', 'Course Assigned Updated successfully.');
        return redirect()->back();
    }


    public function destroy(User $teacher, $course_id)
{
    // Detach the course from the teacher
    $teacher->courses()->detach($course_id);

    Alert::success('Success', 'Assigned Course Deleted Successfully.');

    return redirect()->back();
}


}
