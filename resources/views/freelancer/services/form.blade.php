@extends('layouts.app')
@section('content')
@php $editing = $service->exists; @endphp

<div class="min-h-screen bg-gray-50/50 py-10">
    <!-- Increased width from max-w-3xl to max-w-5xl to fill the screen better -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                {{ $editing ? 'Edit Service' : 'Post a New Service' }}
            </h1>
            <p class="mt-2 text-sm text-gray-500">
                {{ $editing ? 'Update the details of your existing service offering.' : 'Fill out the details below to publish your service to the network.' }}
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <form method="POST" enctype="multipart/form-data"
                  action="{{ $editing ? route('freelancer.services.update', $service) : route('freelancer.services.store') }}">
                @csrf 
                @if($editing) @method('PUT') @endif

                <div class="p-6 sm:p-8">
                    <!-- Validation Errors -->
                    @if($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md mb-8">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach($errors->all() as $e)
                                            <li>{{ $e }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Split Grid Layout -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                        
                        <!-- LEFT COLUMN: Main Details -->
                        <div class="space-y-6">
                            <h2 class="text-lg font-semibold text-gray-900 border-b border-gray-100 pb-2">Service Details</h2>
                            
                            <div>
                                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Service Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $service->title) }}" 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                       placeholder="e.g. I will build a responsive React dashboard" required maxlength="90">
                                <p class="mt-1 text-xs text-gray-500">Make it clear and descriptive (Max 90 characters).</p>
                            </div>

                            <div>
                                <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                                <select name="category" id="category" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white">
                                    @foreach(\App\Models\FreelancerService::CATEGORIES as $c)
                                        <option @selected(old('category', $service->category) === $c)>{{ $c }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="skills" class="block text-sm font-semibold text-gray-700 mb-2">Skills & Technologies</label>
                                <input type="text" name="skills" id="skills" value="{{ old('skills', $service->skills) }}" 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                       placeholder="e.g. HTML, CSS, JavaScript, React" required>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                                <textarea name="description" id="description" rows="8" 
                                          class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none" 
                                          placeholder="Describe what you offer, your process, and what the client will receive..." required>{{ old('description', $service->description) }}</textarea>
                            </div>
                        </div>

                        <!-- RIGHT COLUMN: Pricing, Uploads & Terms -->
                        <div class="space-y-6">
                            <h2 class="text-lg font-semibold text-gray-900 border-b border-gray-100 pb-2">Pricing & Terms</h2>

                            <!-- Price & Delivery Grid -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Price</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">$</span>
                                        </div>
                                        <input type="text" name="price" id="price" value="{{ old('price', $service->price) }}" 
                                               class="w-full border border-gray-300 rounded-lg pl-8 pr-4 py-2.5 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                               placeholder="500.00" required>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="delivery_days" class="block text-sm font-semibold text-gray-700 mb-2">Delivery (Days)</label>
                                    <input type="number" min="1" name="delivery_days" id="delivery_days" value="{{ old('delivery_days', $service->delivery_days) }}" 
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                           placeholder="3" required>
                                </div>
                            </div>

                            <div>
                                <label for="revision_policy" class="block text-sm font-semibold text-gray-700 mb-2">Revision Policy & Terms</label>
                                <input type="text" name="revision_policy" id="revision_policy" value="{{ old('revision_policy', $service->revision_policy) }}" 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                       placeholder="e.g. 2 free revisions included" required>
                            </div>

                            <div>
                                <label for="portfolio_url" class="block text-sm font-semibold text-gray-700 mb-2">Portfolio Link <span class="text-gray-400 font-normal">(Optional)</span></label>
                                <input type="url" name="portfolio_url" id="portfolio_url" value="{{ old('portfolio_url', $service->portfolio_url) }}" 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                       placeholder="https://yourportfolio.com/project">
                            </div>

                            <!-- File Upload Area -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Sample Image</label>
                                <div class="mt-1 flex justify-center px-6 pt-8 pb-8 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition-colors bg-gray-50 group">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-blue-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600 justify-center">
                                            <label for="portfolio_image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 px-2 py-1">
                                                <span>Upload a file</span>
                                                <input id="portfolio_image" name="portfolio_image" type="file" class="sr-only" accept="image/*">
                                            </label>
                                            <p class="pl-1 pt-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions (Full width footer) -->
                <div class="bg-gray-50 px-6 py-4 sm:px-8 flex items-center justify-end gap-4 border-t border-gray-100 rounded-b-2xl">
                    <a href="{{ url()->previous() }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ $editing ? 'Update Service' : 'Submit for Review' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection