@extends('layouts.app')

@section('content')

@push('styles')
{{-- Remove once Tailwind is compiled into your app's build. --}}
<script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
<div class="bg-white min-h-screen">
    <div class="max-w-3xl mx-auto px-6 py-10">

        <div class="mb-8">
            <a href="{{ route('employee.articles.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-blue-600 mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"><path d="m15 18-6-6 6-6"/></svg>
                Back to Articles
            </a>
            <h1 class="text-2xl font-extrabold text-slate-900">Write a New Article</h1>
            <p class="text-sm text-slate-500 mt-1">Share insights, tutorials, or advice with your peers.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <p class="font-semibold mb-1">Please fix the following:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employee.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-1.5">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                       placeholder="e.g. Building Scalable Web Apps with React.js and TypeScript"
                       class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-400">
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="category_slug" class="block text-sm font-semibold text-slate-700 mb-1.5">Category</label>
                    <select name="category_slug" id="category_slug" required
                            class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-400">
                        <option value="" disabled {{ old('category_slug') ? '' : 'selected' }}>Select a category</option>
                        @foreach ($categoryOptions as $slug => $label)
                            <option value="{{ $slug }}" {{ old('category_slug') === $slug ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="read_minutes" class="block text-sm font-semibold text-slate-700 mb-1.5">Read Time (minutes)</label>
                    <input type="number" name="read_minutes" id="read_minutes" min="1" max="120" value="{{ old('read_minutes', 5) }}"
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-400">
                </div>
            </div>

            <div>
                <label for="excerpt" class="block text-sm font-semibold text-slate-700 mb-1.5">
                    Excerpt <span class="text-slate-400 font-normal">(optional — shown on the articles list)</span>
                </label>
                <textarea name="excerpt" id="excerpt" rows="2" maxlength="500"
                          placeholder="A short summary that appears on the article card..."
                          class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-400">{{ old('excerpt') }}</textarea>
            </div>

            <div>
                <label for="body" class="block text-sm font-semibold text-slate-700 mb-1.5">Article Content</label>
                <textarea name="body" id="body" rows="12" required
                          placeholder="Write your article here..."
                          class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-800 placeholder-slate-400 leading-relaxed focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-400">{{ old('body') }}</textarea>
            </div>

            <div>
                <label for="image" class="block text-sm font-semibold text-slate-700 mb-1.5">
                    Cover Image <span class="text-slate-400 font-normal">(optional)</span>
                </label>
                <input type="file" name="image" id="image" accept="image/*"
                       class="block w-full text-sm text-slate-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
            </div>

            <label class="flex items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" name="published" value="1" {{ old('published') ? 'checked' : '' }}
                       class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                Publish immediately (uncheck to save as a draft)
            </label>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-blue-600 text-white text-sm font-semibold px-6 py-2.5 hover:bg-blue-700 transition">
                    Publish Article
                </button>
                <a href="{{ route('employee.articles.index') }}" class="rounded-xl border border-slate-200 text-slate-600 text-sm font-semibold px-6 py-2.5 hover:bg-slate-50 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection