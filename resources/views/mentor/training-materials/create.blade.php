@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/mentor-theme.css') }}">
@endpush

@section('content')
<div class="mentor-shell" style="max-width: 640px;">

    <div class="mentor-card">
        <div class="mentor-form-header">
            <h1>Upload Material</h1>
            <p>Share a new resource with your mentees. It'll be sent to the admin for approval before it goes live.</p>
        </div>

        <form class="mentor-form" method="POST" action="{{ route('mentor.training-materials.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="e.g. Laravel Basics for Beginners" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" placeholder="What will mentees learn from this material?"></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" id="category" name="category" placeholder="e.g. Resume Writing, Interview Skills" required>
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <select id="type" name="type" required>
                        <option value="pdf">PDF</option>
                        <option value="video">Video</option>
                        <option value="ppt">PPT</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="cover_image">Cover Image</label>
                <input type="file" id="cover_image" name="cover_image" accept="image/*">
                <p class="hint">Optional — JPG, PNG or WebP, up to 5MB. Shown as the thumbnail in your materials list.</p>
            </div>

            <div class="form-group">
                <label for="file">File</label>
                <input type="file" id="file" name="file" required>
                <p class="hint">PDF, video, or PPT — up to your organization's upload limit.</p>
            </div>

            <div class="mentor-form-footer">
                <a href="{{ route('mentor.training-materials.index') }}" class="btn btn-ghost">Cancel</a>
                <button class="btn btn-primary" type="submit">Submit for Admin Approval</button>
            </div>
        </form>
    </div>

</div>
@endsection