@extends('layouts.app')

@section('content')
<!-- Light gray background matching the dashboard -->
<div class="bg-[#f8fafc] min-h-screen py-10">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
      <div>
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight flex items-center gap-2">
          <!-- Indian Rupee icon (header) -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#2563eb]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h12M6 8h12M6 13l8.5 8M6 13h3a6 6 0 000-12H6v12z" />
          </svg>
          My Services
        </h1>
        <p class="mt-2 text-sm text-gray-500">Manage the service services you present to clients — each is a tailored proposal.</p>
      </div>
      <a href="{{ route('freelancer.services.create') }}" class="inline-flex items-center px-5 py-2.5 bg-[#2563eb] hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-all duration-200 hover:shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Create new service
      </a>
    </div>

    <!-- Success Message -->
    @if(session('status'))
      <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        {{ session('status') }}
      </div>
    @endif

    <!-- ================= SERVICES GRID ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      @forelse($services as $s)
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-[0_8px_20px_-6px_rgba(0,0,0,0.05)] hover:shadow-lg transition-all duration-200 flex flex-col">

          <!-- Top row: title + status badge -->
          <div class="flex justify-between items-start gap-3">
            <div>
              <h2 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                <span class="bg-blue-50 text-[#2563eb] text-xs font-medium px-2 py-0.5 rounded-full">Service</span>
                {{ $s->title }}
              </h2>
              <!-- Category / price / delivery meta -->
              <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mt-3 text-sm text-gray-500">
                <span class="flex items-center gap-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#2563eb]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                  </svg>
                  {{ $s->category }}
                </span>
                <span class="flex items-center gap-1.5">
                  <!-- Indian Rupee icon (price) -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#2563eb]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h12M6 8h12M6 13l8.5 8M6 13h3a6 6 0 000-12H6v12z" />
                  </svg>
                  ₹{{ number_format($s->price, 2) }}
                </span>
                <span class="flex items-center gap-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#2563eb]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  {{ $s->delivery_days }} days delivery
                </span>
              </div>
            </div>

            <!-- Status badge -->
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium whitespace-nowrap
              {{ $s->status === 'approved' ? 'bg-green-100 text-green-800' : ($s->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
              @if($s->status === 'approved')
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
              @elseif($s->status === 'rejected')
                <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
              @else
                <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span>
              @endif
              {{ ucfirst($s->status) }}
            </span>
          </div>

          <!-- Short description (service-style) -->
          @if($s->description ?? false)
            <p class="mt-4 text-sm text-gray-600 leading-relaxed line-clamp-2">
              {{ \Illuminate\Support\Str::limit($s->description, 140) }}
            </p>
          @endif

          <!-- Rejection reason block -->
          @if($s->status === 'rejected')
            <div class="mt-4 p-3 bg-red-50 rounded-xl border border-red-100">
              <p class="text-sm text-red-700 flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <span><strong>Reason:</strong> {{ $s->rejection_reason }}</span>
              </p>
            </div>
          @endif

          <!-- Actions -->
          <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end gap-3 mt-auto">
            <a href="{{ route('freelancer.services.edit', $s) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#2563eb] hover:border-[#2563eb] transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
              Edit
            </a>
            <form method="POST" action="{{ route('freelancer.services.destroy', $s) }}" onsubmit="return confirm('Are you sure you want to delete this service?');" class="inline-block">
              @csrf
              @method('DELETE')
              <button type="submit" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 hover:border-red-200 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Delete
              </button>
            </form>
          </div>
        </div>
      @empty
        <!-- Empty state -->
        <div class="col-span-full bg-white border border-gray-100 rounded-2xl p-12 text-center shadow-sm">
          <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#2563eb]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-1">No services found</h3>
          <p class="text-gray-500 mb-6">You haven't posted any service services yet. Start serviceing your skills to clients.</p>
          <a href="{{ route('freelancer.services.create') }}" class="inline-flex items-center px-5 py-2.5 bg-[#2563eb] hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-colors duration-200">
            Create your first service
          </a>
        </div>
      @endforelse
    </div>

  </div>
</div>
@endsection