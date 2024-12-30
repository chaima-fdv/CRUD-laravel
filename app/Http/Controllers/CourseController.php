<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with('category');
        
        // Barre de recherche
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
        }
        
        $courses = $query->paginate(5);
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id'
        ]);

        Course::create($request->all());
        return redirect()->route('courses.index')->with('success', 'Cours créé avec succès!');
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        // Verrouillage pessimiste
        DB::beginTransaction();
        try {
            $lockedCourse = Course::lockForUpdate()->findOrFail($course->id);
            
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:categories,id'
            ]);

            $lockedCourse->update($request->all());
            DB::commit();
            return redirect()->route('courses.index')->with('success', 'Cours mis à jour avec succès!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erreur lors de la mise à jour.');
        }
    }

    public function destroy(Course $course)
    {
        // Verrouillage pessimiste
        DB::beginTransaction();
        try {
            $lockedCourse = Course::lockForUpdate()->findOrFail($course->id);
            $lockedCourse->delete();
            DB::commit();
            return redirect()->route('courses.index')->with('success', 'Cours supprimé avec succès!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erreur lors de la suppression.');
        }
    }
}