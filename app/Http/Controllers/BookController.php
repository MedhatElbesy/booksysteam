<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Grade;
use App\Models\Stage;
use App\Models\Term;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    public function index(Request $request)
    {
        $books = Book::with('media')
            ->when($request->term_id, function ($query) use ($request) {
                return $query->where('term_id', $request->term_id);
            })
            ->when($request->stage_id, function ($query) use ($request) {
                return $query->where('stage_id', $request->stage_id);
            })
            ->when($request->grade_id, function ($query) use ($request) {
                return $query->where('grade_id', $request->grade_id);
            })
            ->when($request->type, function ($query) use ($request) {
                return $query->where('type', $request->type);
            })
            ->get();

        $terms = Term::all();
        $stages = Stage::all();
        $grades = Grade::all();

        return view('books.index', compact('books', 'terms', 'stages', 'grades'));
    }

    public function create()
    {
        if (auth()->user()->user_type == 'admin') {

            $users = User::all();
            $terms = Term::all();
            $stages = Stage::all();
            $grades = Grade::all();
        }
        return view('books.create', compact('users', 'terms','stages','grades')); // Pass users to the view
    }

    public function store(Request $request)
    {
            if (auth()->user()->user_type == 'admin') {

        $request->merge([
            'user_id' => Auth::user()->id
        ]);
        $request->validate([
            'name'    => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'term_id'  => 'required|exists:terms,id',
            'stage_id' => 'required|exists:stages,id',
            'grade_id' => 'required|exists:grades,id',
            'file'     => 'required|file|max:2048',
            'type'     => 'nullable'
        ]);
        $book = Book::create($request->except('file'));

        if ($request->hasFile('file')) {
            $book->addMedia($request->file('file'))->toMediaCollection('books');
        }
    }
        return redirect()->route('books.index')->with('success', 'book uploaded successfully.');
    }

    public function show(Book $book)
    {
        $pdfUrl = $book->getFirstMediaUrl('books');
        return view('books.show', compact('pdfUrl'));
    }

    public function edit(Book $book)
    {
                if (auth()->user()->user_type == 'admin') {

        $users = User::all();
        $terms = Term::all();
        $stages = Stage::all();
        $grades = Grade::all();
                }
        return view('books.edit', compact('book', 'users', 'terms','stages','grades')); // Pass users, terms, and the current book to the view
    }

    public function update(Request $request, Book $book)
    {
                if (auth()->user()->user_type == 'admin') {

        $request->merge([
            'user_id' => Auth::user()->id
        ]);
        $request->validate([
        'name'     => 'required|string|max:255',
        'user_id'  => 'required|exists:users,id',
        'term_id'  => 'required|exists:terms,id',
        'stage_id' => 'required|exists:stages,id',
        'file'     => 'nullable|file|max:2048',
        'type'     => 'nullable'
    ]);

    $book->update($request->except('file'));

        if ($request->hasFile('file')) {
            $book->clearMediaCollection('books');
            $book->addMedia($request->file('file'))->toMediaCollection('books');
        }
    }
        return redirect()->route('books.index')->with('success', 'book updated successfully.');
    }

    public function destroy(Book $book)
    {
                if (auth()->user()->user_type == 'admin') {

        $book->delete();
                }
        return redirect()->route('books.index')->with('success', 'book deleted successfully.');
    }

    public function getGradesByTerm($termId)
    {
        $grades = Grade::where('term_id', $termId)->get();
        return response()->json($grades);
    }

    public function getGradesByStage($stageId)
    {
        $grades = Grade::where('stage_id', $stageId)->get();
        return response()->json($grades);
    }

    public function getGradesByTermAndStage($termId, $stageId)
    {
        $grades = Grade::where('term_id', $termId)
                        ->where('stage_id', $stageId)
                        ->get();

        return response()->json($grades);
    }

    public function getGradesByStagee(Request $request)
    {
        $stageId = $request->get('stage_id');
        $grades = Grade::where('stage_id', $stageId)->get();
        return response()->json($grades);
    }

    public function getStagesByTerm(Request $request)
    {
        $stages = Stage::where('term_id', $request->term_id)->get();
        return response()->json($stages);
    }

}
