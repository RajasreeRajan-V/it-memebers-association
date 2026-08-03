@extends('layouts.app')

@section('content')
@push('styles')

<script src="https://cdn.tailwindcss.com"></script>
<style>
    .line-clamp-2{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .modal-body-text{white-space:pre-line}
</style>
@endpush
<a href="{{ route('employee.legal-help.index') }}" class="text-sm text-slate-500 hover:text-slate-700">&larr; Back to Legal Help</a>

@if(session('success'))
    <div class="mt-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">
        {{ session('success') }}
    </div>
@endif

<div class="mt-4 grid grid-cols-1 gap-6 lg:grid-cols-3">
    <div class="lg:col-span-1 rounded-xl border border-slate-200 bg-white p-6">
        @include('employees.legal-help.partials.request-details', ['legalRequest' => $legalRequest])
    </div>

    <div class="lg:col-span-2 rounded-xl border border-slate-200 bg-white p-6">
        @include('employees.legal-help.partials.messages', ['legalRequest' => $legalRequest])
    </div>
</div>
@endsection
