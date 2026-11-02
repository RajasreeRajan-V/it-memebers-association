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
          Browse Services
        </h1>
        <p class="mt-2 text-sm text-gray-500">Discover talented freelancers offering tailored services for your project.</p>
      </div>
    </div>

    <!-- Search & Filter Bar -->
    <form method="GET" action="{{ route('employer.marketplace.index') }}" class="bg-white border border-gray-100 rounded-2xl p-4 sm:p-5 shadow-[0_8px_20px_-6px_rgba(0,0,0,0.05)] mb-6 flex flex-col sm:flex-row gap-3">
      <div class="relative flex-1">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </span>
        <input
          name="q"
          value="{{ request('q') }}"
          placeholder="Search skills or services..."
          class="w-full border border-gray-300 rounded-xl pl-10 pr-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2563eb] focus:border-[#2563eb] transition-colors"
        >
      </div>

      <div class="relative sm:w-56">
        <select
          name="category"
          class="w-full appearance-none border border-gray-300 rounded-xl pl-4 pr-10 py-2.5 text-sm text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2563eb] focus:border-[#2563eb] transition-colors cursor-pointer"
        >
          <option value="">All categories</option>
          @foreach(\App\Models\FreelancerService::CATEGORIES as $c)
            <option @selected(request('category') === $c)>{{ $c }}</option>
          @endforeach
        </select>
        <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
          </svg>
        </span>
      </div>

      <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#2563eb] hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-all duration-200 hover:shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        Search
      </button>
    </form>

    <!-- ================= SERVICES GRID ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      @forelse($services as $s)
        <a href="{{ route('employer.marketplace.show', $s) }}"
           class="group bg-white border border-gray-100 rounded-2xl p-6 shadow-[0_8px_20px_-6px_rgba(0,0,0,0.05)] hover:shadow-lg hover:border-[#2563eb]/30 transition-all duration-200 flex flex-col">

          <!-- Top row: title + status badge -->
          <div class="flex justify-between items-start gap-3">
            <div class="min-w-0">
              <h2 class="text-xl font-semibold text-gray-900 flex items-center gap-2 group-hover:text-[#2563eb] transition-colors">
                <span class="bg-blue-50 text-[#2563eb] text-xs font-medium px-2 py-0.5 rounded-full whitespace-nowrap">Service</span>
                <span class="truncate">{{ $s->title }}</span>
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
                @if($s->delivery_days ?? false)
                  <span class="flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#2563eb]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $s->delivery_days }} days delivery
                  </span>
                @endif
              </div>
            </div>

            <!-- Approved badge (marketplace only shows approved) -->
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium whitespace-nowrap bg-green-100 text-green-800">
              <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span> Approved
            </span>
          </div>

          <!-- Description -->
          <p class="mt-4 text-sm text-gray-600 leading-relaxed line-clamp-2">
            {{ \Illuminate\Support\Str::limit($s->description, 140) }}
          </p>

          <!-- Freelancer + CTA footer -->
          <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between gap-3 mt-auto">
            <div class="flex items-center gap-2.5 min-w-0">
              <div class="h-9 w-9 rounded-full bg-blue-50 text-[#2563eb] flex items-center justify-center font-semibold text-sm flex-shrink-0">
                {{ strtoupper(substr($s->user->name, 0, 1)) }}
              </div>
              <div class="min-w-0">
                <p class="text-xs text-gray-400">Offered by</p>
                <p class="text-sm font-medium text-gray-900 truncate">{{ $s->user->name }}</p>
              </div>
            </div>

            <!-- Button: static color, only the arrow slides in on card hover -->
            <span class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl text-sm font-medium text-gray-700 transition-colors">
              View service
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5 text-[#2563eb] transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
              </svg>
            </span>
          </div>
        </a>
      @empty
        <!-- Empty state -->
        <div class="col-span-full bg-white border border-gray-100 rounded-2xl p-12 text-center shadow-sm">
          <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#2563eb]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-1">No services found</h3>
          <p class="text-gray-500 mb-6">No approved services match your search. Try adjusting your filters.</p>
          <a href="{{ route('employer.marketplace.index') }}" class="inline-flex items-center px-5 py-2.5 bg-[#2563eb] hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-colors duration-200">
            Clear filters
          </a>
        </div>
      @endforelse
    </div>

    <!-- Pagination -->
    @if($services->hasPages())
      <div class="mt-8 flex justify-center">
        <div class="bg-white border border-gray-100 rounded-xl px-4 py-3 shadow-sm">
          {{ $services->links() }}
        </div>
      </div>
    @endif

  </div>
</div>
@endsection