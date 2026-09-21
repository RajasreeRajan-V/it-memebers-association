@csrf

<div class="sp-form-tip">
    <i class="bi bi-info-circle"></i>
    <div>
        <strong>Before you submit</strong>
        <span>
            Complete your startup information carefully. Your profile will be reviewed by an admin before it goes live.
        </span>
    </div>
</div>


{{-- ============================================================
    STARTUP BASIC INFORMATION
============================================================ --}}

<div style="margin-bottom:20px;">
    <h3 style="margin:0 0 5px;font-size:15px;color:#172033;font-weight:750;">
        Startup Information
    </h3>

    <p style="margin:0;color:#7b8498;font-size:12px;">
        Basic information about your startup or company.
    </p>
</div>

<div class="sp-form-row">

    {{-- Startup Name --}}
    <div class="sp-form-field">
        <label>
            Startup Name
            <span class="sp-required">*</span>
        </label>

        <input
            type="text"
            id="startup_name"
            name="startup_name"
            value="{{ old('startup_name', $profile->startup_name ?? '') }}"
            placeholder="e.g. Nimbus Robotics"
            required
        >

        @error('startup_name')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Slug --}}
    <div class="sp-form-field">
        <label>
            Slug
            <span class="sp-required">*</span>
        </label>

        <input
            type="text"
            id="slug"
            name="slug"
            value="{{ old('slug', $profile->slug ?? '') }}"
            placeholder="e.g. nimbus-robotics"
            required
        >

        <p style="margin:6px 0 0;color:#929aaa;font-size:11px;">
            Used in your public startup profile URL.
        </p>

        @error('slug')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Tagline --}}
    <div class="sp-form-field sp-field-full">
        <label>Tagline</label>

        <input
            type="text"
            id="tagline"
            name="tagline"
            value="{{ old('tagline', $profile->tagline ?? '') }}"
            placeholder="e.g. Building intelligent technology for tomorrow"
        >

        @error('tagline')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Category --}}
    <div class="sp-form-field">
        <label>
            Category
            <span class="sp-required">*</span>
        </label>

        <select id="category" name="category" required>
            <option value="">Select Category</option>

            @foreach([
                'Business',
                'IT & Software',
                'Products',
                'SaaS',
                'AI & Machine Learning',
                'FinTech',
                'EdTech',
                'HealthTech',
                'AgriTech',
                'E-commerce',
                'Cybersecurity',
                'Cloud & DevOps',
                'IoT',
                'Web3 & Blockchain',
                'DeepTech',
                'Manufacturing',
                'Logistics',
                'Media & Entertainment',
                'Food & Beverage',
                'Travel & Tourism',
                'Real Estate',
                'Professional Services',
                'Other'
            ] as $category)

                <option
                    value="{{ $category }}"
                    {{ old('category', $profile->category ?? '') === $category ? 'selected' : '' }}
                >
                    {{ $category }}
                </option>

            @endforeach
        </select>

        @error('category')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Industry --}}
    <div class="sp-form-field">
        <label>
            Industry
            <span class="sp-required">*</span>
        </label>

        <select id="industry" name="industry" required>
            <option value="">Select Industry</option>

            @foreach([
                'Information Technology',
                'Software Development',
                'Education',
                'Healthcare',
                'Finance & Banking',
                'Agriculture',
                'E-commerce & Retail',
                'Manufacturing',
                'Logistics & Supply Chain',
                'Media & Entertainment',
                'Food & Beverage',
                'Travel & Tourism',
                'Real Estate',
                'Consulting',
                'Marketing & Advertising',
                'Professional Services',
                'Other'
            ] as $industry)

                <option
                    value="{{ $industry }}"
                    {{ old('industry', $profile->industry ?? '') === $industry ? 'selected' : '' }}
                >
                    {{ $industry }}
                </option>

            @endforeach
        </select>

        @error('industry')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Startup Type --}}
    <div class="sp-form-field">
        <label>
            Startup Type
            <span class="sp-required">*</span>
        </label>

        <select id="startup_type" name="startup_type" required>
            <option value="">Select Startup Type</option>

            @foreach([
                'Product Startup',
                'Service Startup',
                'SaaS Startup',
                'Technology Startup',
                'Social Enterprise',
                'E-commerce',
                'Marketplace',
                'Consulting',
                'Other'
            ] as $type)

                <option
                    value="{{ $type }}"
                    {{ old('startup_type', $profile->startup_type ?? '') === $type ? 'selected' : '' }}
                >
                    {{ $type }}
                </option>

            @endforeach
        </select>

        @error('startup_type')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Founded Year --}}
    <div class="sp-form-field">
        <label>Founded Year</label>

        <select id="founded_year" name="founded_year">
            <option value="">Select Year</option>

            @for($year = date('Y'); $year >= 1900; $year--)
                <option
                    value="{{ $year }}"
                    {{ (string)old('founded_year', $profile->founded_year ?? '') === (string)$year ? 'selected' : '' }}
                >
                    {{ $year }}
                </option>
            @endfor
        </select>

        @error('founded_year')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Startup Stage --}}
    <div class="sp-form-field">
        <label>Startup Stage</label>

        <select id="startup_stage" name="startup_stage">
            <option value="">Select Stage</option>

            @foreach([
                'Idea',
                'Pre-Seed',
                'Seed',
                'Early Stage',
                'Growth Stage',
                'Established'
            ] as $stage)

                <option
                    value="{{ $stage }}"
                    {{ old('startup_stage', $profile->startup_stage ?? '') === $stage ? 'selected' : '' }}
                >
                    {{ $stage }}
                </option>

            @endforeach
        </select>

        @error('startup_stage')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Team Size --}}
    <div class="sp-form-field">
        <label>Team Size</label>

        <select id="team_size" name="team_size">
            <option value="">Select Team Size</option>

            @foreach([
                '1-10',
                '11-50',
                '51-200',
                '201-500',
                '501-1000',
                '1000+'
            ] as $size)

                <option
                    value="{{ $size }}"
                    {{ old('team_size', $profile->team_size ?? '') === $size ? 'selected' : '' }}
                >
                    {{ $size }}
                </option>

            @endforeach
        </select>

        @error('team_size')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Location --}}
    <div class="sp-form-field">
        <label>Location</label>

        <input
            type="text"
            id="location"
            name="location"
            value="{{ old('location', $profile->location ?? '') }}"
            placeholder="e.g. Bengaluru, Karnataka, India"
        >

        @error('location')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Website --}}
    <div class="sp-form-field">
        <label>Website</label>

        <input
            type="url"
            id="website"
            name="website"
            value="{{ old('website', $profile->website ?? '') }}"
            placeholder="https://yourstartup.com"
        >

        @error('website')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>

</div>


{{-- ============================================================
    BRANDING
============================================================ --}}

<div style="margin:30px 0 20px;">
    <h3 style="margin:0 0 5px;font-size:15px;color:#172033;font-weight:750;">
        Startup Branding
    </h3>

    <p style="margin:0;color:#7b8498;font-size:12px;">
        Add your startup logo and cover image.
    </p>
</div>

<div class="sp-form-row">

    {{-- Logo --}}
    <div class="sp-form-field">
        <label>Logo</label>

        <input
            type="file"
            id="logo"
            name="logo"
            accept="image/jpeg,image/png,image/webp"
        >

        @if(!empty($profile) && !empty($profile->logo))

            <span class="sp-current-file">
                Current:
                <a
                    href="{{ asset('storage/' . $profile->logo) }}"
                    target="_blank"
                >
                    View Logo
                </a>
            </span>

        @endif

        @error('logo')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Cover Image --}}
    <div class="sp-form-field">
        <label>Cover Image</label>

        <input
            type="file"
            id="cover_image"
            name="cover_image"
            accept="image/jpeg,image/png,image/webp"
        >

        @if(!empty($profile) && !empty($profile->cover_image))

            <span class="sp-current-file">
                Current:
                <a
                    href="{{ asset('storage/' . $profile->cover_image) }}"
                    target="_blank"
                >
                    View Cover Image
                </a>
            </span>

        @endif

        @error('cover_image')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>

</div>


{{-- ============================================================
    DESCRIPTION
============================================================ --}}

<div style="margin:30px 0 20px;">
    <h3 style="margin:0 0 5px;font-size:15px;color:#172033;font-weight:750;">
        About Your Startup
    </h3>

    <p style="margin:0;color:#7b8498;font-size:12px;">
        Explain what your startup does and the problem you are solving.
    </p>
</div>

<div class="sp-form-row">

    {{-- Short Description --}}
    <div class="sp-form-field sp-field-full">
        <label>
            Short Description
            <span class="sp-required">*</span>
        </label>

        <textarea
            id="short_description"
            name="short_description"
            placeholder="Give a short overview of your startup..."
            required
        >{{ old('short_description', $profile->short_description ?? '') }}</textarea>

        @error('short_description')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- About --}}
    <div class="sp-form-field sp-field-full">
        <label>About</label>

        <textarea
            id="about"
            name="about"
            placeholder="Describe your startup, the problem you solve, your solution, market and business model..."
        >{{ old('about', $profile->about ?? '') }}</textarea>

        @error('about')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Mission --}}
    <div class="sp-form-field">
        <label>Mission</label>

        <textarea
            id="mission"
            name="mission"
            placeholder="What is your startup's mission?"
        >{{ old('mission', $profile->mission ?? '') }}</textarea>

        @error('mission')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Vision --}}
    <div class="sp-form-field">
        <label>Vision</label>

        <textarea
            id="vision"
            name="vision"
            placeholder="What is your long-term vision?"
        >{{ old('vision', $profile->vision ?? '') }}</textarea>

        @error('vision')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>

</div>


{{-- ============================================================
    PRODUCTS & TECHNOLOGIES
============================================================ --}}

<div style="margin:30px 0 20px;">
    <h3 style="margin:0 0 5px;font-size:15px;color:#172033;font-weight:750;">
        Products & Technologies
    </h3>

    <p style="margin:0;color:#7b8498;font-size:12px;">
        Tell investors what you build and which technologies you use.
    </p>
</div>

<div class="sp-form-row">

    {{-- Products / Services --}}
    <div class="sp-form-field sp-field-full">
        <label>Products / Services</label>

        <textarea
            id="products_services"
            name="products_services"
            placeholder="Describe your products, services, solutions or platforms..."
        >{{ old('products_services', $profile->products_services ?? '') }}</textarea>

        @error('products_services')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Technologies --}}
    <div class="sp-form-field sp-field-full">
        <label>Technologies</label>

        <textarea
            id="technologies"
            name="technologies"
            placeholder="e.g. Laravel, PHP, React, Python, AI, MySQL, AWS..."
        >{{ old('technologies', $profile->technologies ?? '') }}</textarea>

        @error('technologies')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>

</div>


{{-- ============================================================
    LOOKING FOR
============================================================ --}}

@php

    $lookingFor = old(
        'looking_for',
        !empty($profile?->looking_for)
            ? (is_array($profile->looking_for)
                ? $profile->looking_for
                : json_decode($profile->looking_for, true))
            : []
    );

    $lookingFor = is_array($lookingFor) ? $lookingFor : [];

@endphp


<div style="margin:30px 0 20px;">
    <h3 style="margin:0 0 5px;font-size:15px;color:#172033;font-weight:750;">
        Looking For
    </h3>

    <p style="margin:0;color:#7b8498;font-size:12px;">
        Select the people or organisations your startup is currently looking for.
    </p>
</div>

<div class="sp-form-field">

    <div style="
        display:grid;
        grid-template-columns:repeat(2,minmax(0,1fr));
        gap:10px 16px;
    ">

        @foreach([
            'employee' => 'Employees',
            'freelancer' => 'Freelancers',
            'investor' => 'Investors',
            'mentor' => 'Mentors',
            'student' => 'Students',
            'business_partner' => 'Business Partners'
        ] as $value => $label)

            <label style="
                display:flex;
                align-items:center;
                gap:9px;
                padding:11px 13px;
                border:1px solid #e1e6ee;
                border-radius:10px;
                background:#fafbfc;
                cursor:pointer;
                text-transform:none;
                letter-spacing:0;
                font-size:12px;
                font-weight:600;
            ">

                <input
                    type="checkbox"
                    name="looking_for[]"
                    value="{{ $value }}"
                    style="width:16px;height:16px;"
                    {{ in_array($value, $lookingFor) ? 'checked' : '' }}
                >

                {{ $label }}

            </label>

        @endforeach

    </div>

    @error('looking_for')
        <p class="sp-field-error">{{ $message }}</p>
    @enderror

</div>


{{-- ============================================================
    OPPORTUNITIES
============================================================ --}}

@php

    $opportunities = old(
        'opportunities',
        !empty($profile?->opportunities)
            ? (is_array($profile->opportunities)
                ? $profile->opportunities
                : json_decode($profile->opportunities, true))
            : []
    );

    $opportunities = is_array($opportunities) ? $opportunities : [];

@endphp


<div style="margin:30px 0 20px;">
    <h3 style="margin:0 0 5px;font-size:15px;color:#172033;font-weight:750;">
        Opportunities
    </h3>

    <p style="margin:0;color:#7b8498;font-size:12px;">
        Select the opportunities currently available through your startup.
    </p>
</div>

<div class="sp-form-field">

    <div style="
        display:grid;
        grid-template-columns:repeat(2,minmax(0,1fr));
        gap:10px 16px;
    ">

        @foreach([
            'jobs' => 'Full-time Jobs',
            'internships' => 'Internships',
            'freelance_projects' => 'Freelance Projects',
            'student_projects' => 'Student Projects',
            'mentorship' => 'Mentorship',
            'business_partnerships' => 'Business Partnerships',
            'investment' => 'Investment Opportunities'
        ] as $value => $label)

            <label style="
                display:flex;
                align-items:center;
                gap:9px;
                padding:11px 13px;
                border:1px solid #e1e6ee;
                border-radius:10px;
                background:#fafbfc;
                cursor:pointer;
                text-transform:none;
                letter-spacing:0;
                font-size:12px;
                font-weight:600;
            ">

                <input
                    type="checkbox"
                    name="opportunities[]"
                    value="{{ $value }}"
                    style="width:16px;height:16px;"
                    {{ in_array($value, $opportunities) ? 'checked' : '' }}
                >

                {{ $label }}

            </label>

        @endforeach

    </div>

    @error('opportunities')
        <p class="sp-field-error">{{ $message }}</p>
    @enderror

</div>


{{-- ============================================================
    CONTACT INFORMATION
============================================================ --}}

<div style="margin:30px 0 20px;">
    <h3 style="margin:0 0 5px;font-size:15px;color:#172033;font-weight:750;">
        Startup Contact
    </h3>

    <p style="margin:0;color:#7b8498;font-size:12px;">
        Contact information that can be displayed on your startup profile.
    </p>
</div>

<div class="sp-form-row">

    {{-- Startup Email --}}
    <div class="sp-form-field">
        <label>Startup Email</label>

        <input
            type="email"
            id="startup_email"
            name="startup_email"
            value="{{ old('startup_email', $profile->startup_email ?? '') }}"
            placeholder="contact@yourstartup.com"
        >

        @error('startup_email')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Startup Phone --}}
    <div class="sp-form-field">
        <label>Startup Phone</label>

        <input
            type="tel"
            id="startup_phone"
            name="startup_phone"
            value="{{ old('startup_phone', $profile->startup_phone ?? '') }}"
            placeholder="+91 98765 43210"
        >

        @error('startup_phone')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- LinkedIn --}}
    <div class="sp-form-field sp-field-full">
        <label>LinkedIn</label>

        <input
            type="url"
            id="linkedin"
            name="linkedin"
            value="{{ old('linkedin', $profile->linkedin ?? '') }}"
            placeholder="https://www.linkedin.com/company/your-startup"
        >

        @error('linkedin')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>

</div>


{{-- ============================================================
    FUNDING
============================================================ --}}

<div style="margin:30px 0 20px;">
    <h3 style="margin:0 0 5px;font-size:15px;color:#172033;font-weight:750;">
        Funding Information
    </h3>

    <p style="margin:0;color:#7b8498;font-size:12px;">
        Provide your current funding information.
    </p>
</div>

<div class="sp-form-row">

    {{-- Funding Stage --}}
    <div class="sp-form-field">
        <label>Funding Stage</label>

        <select id="funding_stage" name="funding_stage">
            <option value="">Select Funding Stage</option>

            @foreach([
                'Bootstrapped',
                'Pre-Seed',
                'Seed',
                'Series A',
                'Series B',
                'Series C+',
                'Growth',
                'Not Disclosed',
                'Not Applicable'
            ] as $stage)

                <option
                    value="{{ $stage }}"
                    {{ old('funding_stage', $profile->funding_stage ?? '') === $stage ? 'selected' : '' }}
                >
                    {{ $stage }}
                </option>

            @endforeach
        </select>

        @error('funding_stage')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Currently Raising --}}
    <div class="sp-form-field">
        <label>Currently Raising</label>

        <select id="currently_raising" name="currently_raising">
            <option value="">Select Option</option>

            <option
                value="yes"
                {{ old('currently_raising', $profile->currently_raising ?? '') == 'yes' ? 'selected' : '' }}
            >
                Yes
            </option>

            <option
                value="no"
                {{ old('currently_raising', $profile->currently_raising ?? '') == 'no' ? 'selected' : '' }}
            >
                No
            </option>

        </select>

        @error('currently_raising')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Funding Requirement --}}
    <div class="sp-form-field sp-field-full">
        <label>Funding Requirement</label>

        <input
            type="text"
            id="funding_requirement"
            name="funding_requirement"
            value="{{ old('funding_requirement', $profile->funding_requirement ?? '') }}"
            placeholder="e.g. ₹50,00,000 or $100,000"
        >

        @error('funding_requirement')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>

</div>


{{-- ============================================================
    SYSTEM STATUS
============================================================ --}}

<div style="margin:30px 0 20px;">
    <h3 style="margin:0 0 5px;font-size:15px;color:#172033;font-weight:750;">
        Profile Status
    </h3>

    <p style="margin:0;color:#7b8498;font-size:12px;">
        These fields are managed by the system and admin.
    </p>
</div>

<div class="sp-form-row">

    {{-- Status --}}
    <div class="sp-form-field">
        <label>Status</label>

        <select
            id="status"
            name="status"
            disabled
        >
            <option
                value="draft"
                {{ old('status', $profile->status ?? 'draft') === 'draft' ? 'selected' : '' }}
            >
                Draft
            </option>

            <option
                value="pending"
                {{ old('status', $profile->status ?? '') === 'pending' ? 'selected' : '' }}
            >
                Pending Review
            </option>

            <option
                value="approved"
                {{ old('status', $profile->status ?? '') === 'approved' ? 'selected' : '' }}
            >
                Approved
            </option>

            <option
                value="rejected"
                {{ old('status', $profile->status ?? '') === 'rejected' ? 'selected' : '' }}
            >
                Rejected
            </option>
        </select>

        <p style="margin:6px 0 0;color:#929aaa;font-size:11px;">
            Status is controlled by the startup approval workflow.
        </p>

        @error('status')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>


    {{-- Rejection Reason --}}
    <div class="sp-form-field">
        <label>Rejection Reason</label>

        <textarea
            id="rejection_reason"
            name="rejection_reason"
            placeholder="Admin will provide a rejection reason if required."
            readonly
        >{{ old('rejection_reason', $profile->rejection_reason ?? '') }}</textarea>

        <p style="margin:6px 0 0;color:#929aaa;font-size:11px;">
            This field can only be changed by an admin.
        </p>

        @error('rejection_reason')
            <p class="sp-field-error">{{ $message }}</p>
        @enderror
    </div>

</div>