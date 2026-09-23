@extends('layouts.app')

@section('content')

@include('employers.internships._styles')

<div class="internship-page">

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="internship-page-header">

        <div class="page-title-row">

            <div class="page-title-icon">
                <i class="fas fa-user-graduate"></i>
            </div>

            <div>
                <h1>Post an Internship</h1>

                <p>
                    Find talented students and young professionals for your organization.
                </p>
            </div>

        </div>

        <a href="{{ route('employer.internships.index') }}"
           class="back-button">

            <i class="fas fa-arrow-left"></i>

            <span>Back</span>

        </a>

    </div>


    {{-- =========================================================
         PROGRESS STEPS
    ========================================================== --}}

    <div class="progress-card">

        <div class="progress-step active">

            <div class="step-circle">
                <i class="fas fa-briefcase"></i>
            </div>

            <span>Internship Details</span>

        </div>


        <div class="progress-line"></div>


        <div class="progress-step">

            <div class="step-circle">
                <i class="fas fa-map-marker-alt"></i>
            </div>

            <span>Location</span>

        </div>


        <div class="progress-line"></div>


        <div class="progress-step">

            <div class="step-circle">
                <i class="fas fa-align-left"></i>
            </div>

            <span>Description</span>

        </div>

    </div>


    {{-- =========================================================
         MAIN LAYOUT
    ========================================================== --}}

    <div class="internship-layout">


        {{-- =====================================================
             MAIN FORM
        ====================================================== --}}

        <div class="internship-main">

            <div class="form-card">


                {{-- CARD HEADER --}}

                <div class="form-card-header">

                    <div class="section-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>

                    <div>

                        <h2>Internship Details</h2>

                        <p>
                            Provide the basic information about your internship opportunity.
                        </p>

                    </div>

                </div>


                <div class="form-card-body">


                    {{-- =================================================
                         SUCCESS MESSAGE
                    ================================================== --}}

                    @if(session('success'))

                        <div class="alert-custom alert-success-custom">

                            <i class="fas fa-check-circle"></i>

                            <span>
                                {{ session('success') }}
                            </span>

                        </div>

                    @endif


                    {{-- =================================================
                         VALIDATION ERRORS
                    ================================================== --}}

                    @if ($errors->any())

                        <div class="alert-custom alert-error-custom">

                            <i class="fas fa-exclamation-circle"></i>

                            <div>

                                <strong>Please check the form.</strong>

                                <span>
                                    Some information needs your attention.
                                </span>

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                         INFO BOX
                    ================================================== --}}

                    <div class="info-box">

                        <div class="info-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>

                        <div>

                            <strong>Make your internship attractive</strong>

                            <p>
                                Add a clear title, required skills, duration and detailed
                                information to help candidates understand the opportunity.
                            </p>

                        </div>

                    </div>


                    {{-- =================================================
                         FORM
                    ================================================== --}}

                    <form action="{{ route('employer.internships.store') }}"
                          method="POST"
                          id="internshipForm">

                        @csrf


                        {{-- FORM FIELDS --}}

                        @include('employers.internships._form')


                        {{-- =================================================
                             ACTIONS
                        ================================================== --}}

                        <div class="form-actions">

                            <a href="{{ route('employer.internships.index') }}"
                               class="btn-secondary-custom">

                                <i class="fas fa-times"></i>

                                Cancel

                            </a>


                            <button type="submit"
                                    class="btn-primary-custom"
                                    id="submitBtn">

                                <i class="fas fa-paper-plane"></i>

                                Post Internship

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        {{-- =========================================================
             SIDEBAR
        ========================================================== --}}

        <aside class="internship-sidebar">


            {{-- =====================================================
                 TIPS
            ====================================================== --}}

            <div class="tips-card">

                <div class="tips-header">

                    <div class="tips-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>

                    <h3>Tips for a better post</h3>

                </div>


                <div class="tip-item">

                    <div class="tip-bullet">
                        <i class="fas fa-check"></i>
                    </div>

                    <p>
                        Use a specific internship title such as
                        <strong>Laravel Developer Intern</strong>
                        instead of simply "Developer Intern".
                    </p>

                </div>


                <div class="tip-item">

                    <div class="tip-bullet">
                        <i class="fas fa-check"></i>
                    </div>

                    <p>
                        Clearly mention whether the internship is
                        <strong>paid or unpaid</strong>.
                    </p>

                </div>


                <div class="tip-item">

                    <div class="tip-bullet">
                        <i class="fas fa-check"></i>
                    </div>

                    <p>
                        If the internship is paid, clearly mention the
                        <strong>monthly stipend</strong>.
                    </p>

                </div>


                <div class="tip-item">

                    <div class="tip-bullet">
                        <i class="fas fa-check"></i>
                    </div>

                    <p>
                        Add the important technical skills candidates
                        should have before applying.
                    </p>

                </div>


                <div class="tip-item">

                    <div class="tip-bullet">
                        <i class="fas fa-check"></i>
                    </div>

                    <p>
                        Keep the internship description clear and
                        explain what the intern will actually work on.
                    </p>

                </div>


                <div class="tip-item">

                    <div class="tip-bullet">
                        <i class="fas fa-check"></i>
                    </div>

                    <p>
                        Make sure the location and work mode are
                        accurate before publishing.
                    </p>

                </div>

            </div>


            {{-- =====================================================
                 QUICK INFO
            ====================================================== --}}

            <div class="quick-card">

                <div class="quick-card-icon">
                    <i class="fas fa-info-circle"></i>
                </div>

                <div>

                    <h4>Before you post</h4>

                    <p>
                        Review all the details carefully. A complete
                        internship post helps you attract better candidates.
                    </p>

                </div>

            </div>

        </aside>

    </div>

</div>


@include('employers.internships._scripts')

@endsection