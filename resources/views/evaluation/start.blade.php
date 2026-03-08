@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-8">
Business Evaluation
</h1>

<form method="POST" action="/evaluation/store">

@csrf

@foreach($categories as $category)

<div class="bg-white shadow rounded-lg p-6 mb-8">

<h2 class="text-xl font-semibold mb-6">
{{ $category->name }}
</h2>

@foreach($category->questions as $question)

<div class="mb-6">

<p class="mb-3 font-medium">
{{ $question->question }}
</p>

<div class="flex gap-4">

@for($i=1;$i<=5;$i++)

<label class="flex items-center gap-1">

<input type="radio"
name="answers[{{ $question->id }}]"
value="{{ $i }}"
required>

<span>{{ $i }}</span>

</label>

@endfor

</div>

</div>

@endforeach

</div>

@endforeach

<button
type="submit"
class="bg-blue-600 text-white px-6 py-3 rounded-lg">

Submit Evaluation

</button>

</form>

@endsection