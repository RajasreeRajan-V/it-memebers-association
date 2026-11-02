@extends('layouts.app')

@section('content')
<!-- Light gray background matching the dashboard -->
<div class="bg-[#f8fafc] min-h-screen py-10">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Back link -->
    <a href="{{ route('employer.marketplace.index') }}"
       class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-[#2563eb] transition-colors mb-6 group">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 transition-transform duration-200 group-hover:-translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
      </svg>
      Back to services
    </a>

    <!-- ================= TWO-COLUMN LAYOUT (equal height) ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch">

      <!-- ============ LEFT COLUMN (2/3) — MAIN SERVICE CONTENT ============ -->
      <div class="lg:col-span-2 flex flex-col">

        <!-- Main service card -->
        <div class="flex-1 bg-white border border-gray-100 rounded-2xl p-6 sm:p-8 shadow-[0_8px_20px_-6px_rgba(0,0,0,0.05)]">

          <!-- Title + approved badge -->
          <div class="flex flex-col sm:flex-row justify-between items-start gap-3">
            <div class="min-w-0">
              <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight flex items-center gap-2 flex-wrap">
                <span class="bg-blue-50 text-[#2563eb] text-xs font-medium px-2 py-0.5 rounded-full whitespace-nowrap">Service</span>
                {{ $service->title }}
              </h1>

              <!-- Category / price / delivery meta -->
              <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mt-3 text-sm text-gray-500">
                <span class="flex items-center gap-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#2563eb]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                  </svg>
                  {{ $service->category }}
                </span>
                <span class="flex items-center gap-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#2563eb]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h12M6 8h12M6 13l8.5 8M6 13h3a6 6 0 000-12H6v12z" />
                  </svg>
                  ₹{{ number_format($service->price, 2) }}
                </span>
                <span class="flex items-center gap-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#2563eb]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  {{ $service->delivery_days }} days delivery
                </span>
              </div>
            </div>

            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium whitespace-nowrap bg-green-100 text-green-800">
              <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span> Approved
            </span>
          </div>

          <!-- Portfolio image (reduced size) -->
          @if($service->portfolio_image)
            <div class="mt-6 overflow-hidden rounded-xl border border-gray-100">
              <img src="{{ Storage::url($service->portfolio_image) }}" alt="{{ $service->title }}" class="w-full h-56 object-cover">
            </div>
          @endif

          <!-- Description -->
          <div class="mt-6">
            <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-2">About this service</h2>
            <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">{{ $service->description }}</p>
          </div>

          <!-- Delivery & revision info -->
          <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div class="flex items-start gap-3 p-4 bg-[#f8fafc] rounded-xl border border-gray-100">
              <div class="h-9 w-9 rounded-full bg-blue-50 text-[#2563eb] flex items-center justify-center flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-400">Delivery time</p>
                <p class="text-sm font-medium text-gray-900">{{ $service->delivery_days }} days</p>
              </div>
            </div>

            <div class="flex items-start gap-3 p-4 bg-[#f8fafc] rounded-xl border border-gray-100">
              <div class="h-9 w-9 rounded-full bg-blue-50 text-[#2563eb] flex items-center justify-center flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-400">Revision policy</p>
                <p class="text-sm font-medium text-gray-900">{{ $service->revision_policy }}</p>
              </div>
            </div>
          </div>

          <!-- Skills -->
          @if(!empty($service->skillList()))
            <div class="mt-6">
              <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-2">Skills</h2>
              <div class="flex flex-wrap gap-2">
                @foreach($service->skillList() as $skill)
                  <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-[#2563eb]">
                    {{ $skill }}
                  </span>
                @endforeach
              </div>
            </div>
          @endif

          <!-- Sample work link -->
          @if($service->portfolio_url)
            <div class="mt-6">
              <a href="{{ $service->portfolio_url }}" target="_blank" rel="noopener"
                 class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#2563eb] hover:border-[#2563eb] transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
                View sample work
              </a>
            </div>
          @endif

          <!-- Freelancer footer -->
          <div class="mt-6 pt-5 border-t border-gray-100 flex items-center gap-3">
            <div class="h-11 w-11 rounded-full bg-blue-50 text-[#2563eb] flex items-center justify-center font-semibold text-base flex-shrink-0">
              {{ strtoupper(substr($service->user->name, 0, 1)) }}
            </div>
            <div class="min-w-0">
              <p class="text-xs text-gray-400">Offered by</p>
              <p class="text-sm font-semibold text-gray-900 truncate">{{ $service->user->name }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- ============ RIGHT COLUMN (1/3) — SIDEBAR ============ -->
      <div class="lg:col-span-1">
        <div class="flex flex-col gap-6 h-full">

          <!-- Price / summary panel -->
          <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-[0_8px_20px_-6px_rgba(0,0,0,0.05)]">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Price</p>
            <div class="flex items-end gap-1.5 mt-1">
              <span class="text-3xl font-bold text-gray-900">₹{{ number_format($service->price, 2) }}</span>
            </div>

            <div class="mt-4 space-y-2.5 text-sm">
              <div class="flex items-center justify-between">
                <span class="text-gray-500 flex items-center gap-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#2563eb]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  Delivery
                </span>
                <span class="font-medium text-gray-900">{{ $service->delivery_days }} days</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-gray-500 flex items-center gap-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#2563eb]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                  </svg>
                  Revisions
                </span>
                <span class="font-medium text-gray-900">{{ $service->revision_policy }}</span>
              </div>
            </div>

            <a href="#inquiry" class="mt-5 w-full inline-flex items-center justify-center px-5 py-2.5 bg-[#2563eb] hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-all duration-200 hover:shadow-md">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
              </svg>
              Contact freelancer
            </a>
          </div>

          <!-- Inquiry form card (grows to fill remaining height) -->
          <div id="inquiry" class="flex-1 flex flex-col bg-white border border-gray-100 rounded-2xl p-6 shadow-[0_8px_20px_-6px_rgba(0,0,0,0.05)]">
            <div class="flex items-center gap-2 mb-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#2563eb]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
              </svg>
              <h2 class="text-lg font-semibold text-gray-900">Send an inquiry</h2>
            </div>
            <p class="text-sm text-gray-500 mb-4">Message the freelancer directly to discuss your project.</p>

            <!-- Success message -->
            @if(session('status'))
              <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-start shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="text-sm">{{ session('status') }}</span>
              </div>
            @endif

            <form method="POST" action="{{ route('employer.marketplace.inquire', $service) }}" class="flex-1 flex flex-col gap-3">
              @csrf

              <div class="flex-1 flex flex-col">
                <label for="message" class="block text-sm font-medium text-gray-700 mb-1.5">
                  Your message
                </label>
                <textarea
                  id="message"
                  name="message"
                  rows="4"
                  required
                  placeholder="Hi, I'm interested in this service. I'd like to discuss..."
                  class="flex-1 min-h-[8rem] w-full border border-gray-300 rounded-xl p-3 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2563eb] focus:border-[#2563eb] transition-colors resize-none"
                >{{ old('message') }}</textarea>
                @error('message')
                  <p class="mt-1.5 text-sm text-red-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                  </p>
                @enderror
              </div>

              <button type="submit" class="w-full inline-flex items-center justify-center px-5 py-2.5 bg-[#2563eb] hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-all duration-200 hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
                Send inquiry
              </button>
            </form>
          </div>

        </div>
      </div>

    </div>
    <!-- ============ END TWO-COLUMN LAYOUT ============ -->

  </div>
</div>
@endsection