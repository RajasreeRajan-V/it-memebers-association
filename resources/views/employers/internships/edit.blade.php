@extends('layouts.app')

@section('content')

@include('employers.internships._styles')

<div class="internship-page">

    {{-- PAGE HEADER --}}
    <div class="internship-page-header">

        <div class="page-title-row">

            <div class="page-title-icon">
                <i class="fas fa-edit"></i>
            </div>

            <div>

                <h1>Edit Internship</h1>

                <p>
                    Update the details of your internship opportunity.
                </p>

            </div>

        </div>


        <a href="{{ route('employer.internships.show', $internship) }}"
           class="back-button">

            <i class="fas fa-arrow-left"></i>

            <span>Back</span>

        </a>

    </div>


    {{-- PROGRESS --}}
    <div class="progress-card">

        <div class="progress-step active">

            <div class="step-circle">
                <i class="fas fa-briefcase"></i>
            </div>

            <span>Internship Details</span>

        </div>


        <div class="progress-line"></div>


        <div class="progress-step active">

            <div class="step-circle">
                <i class="fas fa-map-marker-alt"></i>
            </div>

            <span>Location</span>

        </div>


        <div class="progress-line"></div>


        <div class="progress-step active">

            <div class="step-circle">
                <i class="fas fa-align-left"></i>
            </div>

            <span>Description</span>

        </div>

    </div>


    {{-- MAIN --}}
    <div class="internship-layout">

        <div class="internship-main">

            <div class="form-card">

                {{-- HEADER --}}
                <div class="form-card-header">

                    <div class="section-icon">

                        <i class="fas fa-edit"></i>

                    </div>


                    <div>

                        <h2>Update Internship</h2>

                        <p>
                            Make changes to your internship information.
                        </p>

                    </div>

                </div>


                <div class="form-card-body">


                    {{-- ERRORS --}}
                    @if ($errors->any())

                        <div class="alert-custom alert-error-custom">

                            <i class="fas fa-exclamation-circle"></i>

                            <div>

                                <strong>
                                    Please check the form.
                                </strong>

                                <span>
                                    Some information needs your attention.
                                </span>

                            </div>

                        </div>

                    @endif


                    {{-- INFO --}}
                    <div class="info-box">

                        <div class="info-icon">

                            <i class="fas fa-info-circle"></i>

                        </div>


                        <div>

                            <strong>
                                Keep your internship updated
                            </strong>

                            <p>
                                Make sure the information, dates, location
                                and requirements are still accurate.
                            </p>

                        </div>

                    </div>


                    {{-- FORM --}}
                    <form action="{{ route('employer.internships.update', $internship) }}"
                          method="POST"
                          id="internshipForm">

                        @csrf

                        @method('PUT')


                        @include(
                            'employers.internships._form',
                            ['internship' => $internship]
                        )


                        {{-- ACTIONS --}}
                        <div class="form-actions">

                            <a href="{{ route('employer.internships.show', $internship) }}"
                               class="btn-secondary-custom">

                                <i class="fas fa-times"></i>

                                Cancel

                            </a>


                            <button type="submit"
                                    class="btn-primary-custom"
                                    id="submitBtn">

                                <i class="fas fa-save"></i>

                                Save Changes

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        {{-- SIDEBAR --}}
        <aside class="internship-sidebar">

            <div class="tips-card">

                <div class="tips-header">

                    <div class="tips-icon">

                        <i class="fas fa-lightbulb"></i>

                    </div>

                    <h3>
                        Editing Tips
                    </h3>

                </div>


                <div class="tip-item">

                    <div class="tip-bullet">
                        <i class="fas fa-check"></i>
                    </div>

                    <p>
                        Keep the internship title specific
                        and easy to understand.
                    </p>

                </div>


                <div class="tip-item">

                    <div class="tip-bullet">
                        <i class="fas fa-check"></i>
                    </div>

                    <p>
                        Update the required skills when
                        your project requirements change.
                    </p>

                </div>


                <div class="tip-item">

                    <div class="tip-bullet">
                        <i class="fas fa-check"></i>
                    </div>

                    <p>
                        Check the internship dates before
                        saving changes.
                    </p>

                </div>


                <div class="tip-item">

                    <div class="tip-bullet">
                        <i class="fas fa-check"></i>
                    </div>

                    <p>
                        Keep the description useful and
                        informative for applicants.
                    </p>

                </div>

            </div>


            {{-- QUICK CARD --}}
            <div class="quick-card">

                <div class="quick-card-icon">

                    <i class="fas fa-info-circle"></i>

                </div>


                <div>

                    <h4>
                        Important
                    </h4>

                    <p>
                        Saving changes will update the internship
                        information shown to candidates.
                    </p>

                </div>

            </div>

        </aside>

    </div>

</div>

@include('employers.internships._scripts')

@endsection