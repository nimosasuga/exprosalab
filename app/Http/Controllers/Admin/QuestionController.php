<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EvaluationQuestion;
use App\Models\EvaluationCategory;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // 1. Menampilkan daftar pertanyaan
    public function index()
    {
        // Mengambil pertanyaan beserta nama kategorinya (Eager Loading)
        $questions = EvaluationQuestion::with('category')->latest()->paginate(15);
        return view('admin.questions', compact('questions'));
    }

    // 2. Menampilkan form tambah pertanyaan
    public function create()
    {
        $categories = EvaluationCategory::all();
        return view('admin.questions_form', compact('categories'));
    }

    // 3. Menyimpan pertanyaan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:evaluation_categories,id',
            'question' => 'required|string',
            'code' => 'required|string|max:50'
        ]);

        EvaluationQuestion::create($request->all());

        return redirect()->route('admin.questions.index')->with('success', 'Pertanyaan baru berhasil ditambahkan!');
    }

    // 4. Menampilkan form edit pertanyaan
    public function edit(EvaluationQuestion $question)
    {
        $categories = EvaluationCategory::all();
        return view('admin.questions_form', compact('question', 'categories'));
    }

    // 5. Menyimpan perubahan (Update) ke database
    public function update(Request $request, EvaluationQuestion $question)
    {
        $request->validate([
            'category_id' => 'required|exists:evaluation_categories,id',
            'question' => 'required|string',
            'code' => 'required|string|max:50'
        ]);

        $question->update($request->all());

        return redirect()->route('admin.questions.index')->with('success', 'Pertanyaan berhasil diperbarui!');
    }

    // 6. Menghapus pertanyaan
    public function destroy(EvaluationQuestion $question)
    {
        $question->delete();
        return back()->with('success', 'Pertanyaan berhasil dihapus!');
    }
}
