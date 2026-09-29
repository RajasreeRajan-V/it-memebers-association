{{-- Renders one existing (or blank) module block for the curriculum builder --}}

<div class="module-block card mb-3" data-mi="{{ $mi }}">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="form-label fw-bold mb-0">
                Module <span class="module-number">{{ $mi + 1 }}</span>
            </label>

            <button type="button" class="btn btn-sm btn-outline-danger remove-module">
                Remove Module
            </button>
        </div>

        <input
            type="text"
            name="modules[{{ $mi }}][title]"
            class="form-control mb-3"
            placeholder="Module title"
            value="{{ $module->title ?? '' }}"
        >

        <div class="sessions-wrapper ps-3 border-start">

            @forelse (($module->sessions ?? collect()) as $si => $session)

                <div class="session-block border rounded p-2 mb-2" data-si="{{ $si }}">

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong class="small">
                            Session {{ $si + 1 }}
                        </strong>

                        <button
                            type="button"
                            class="btn btn-sm btn-outline-danger remove-session"
                        >
                            &times;
                        </button>
                    </div>

                    <input
                        type="text"
                        name="modules[{{ $mi }}][sessions][{{ $si }}][title]"
                        class="form-control form-control-sm mb-2"
                        placeholder="Session title"
                        value="{{ $session->title }}"
                    >

                    <textarea
                        name="modules[{{ $mi }}][sessions][{{ $si }}][description]"
                        class="form-control form-control-sm mb-2"
                        rows="2"
                        placeholder="Description"
                    >{{ $session->description }}</textarea>

                    <div class="row g-2">

                        <div class="col-md-6">
                            <label class="form-label small mb-1">
                                Video
                            </label>

                            <input
                                type="file"
                                name="modules[{{ $mi }}][sessions][{{ $si }}][video]"
                                class="form-control form-control-sm"
                                accept="video/*"
                            >

                            @if ($session->video_path)
                                <small class="text-success">
                                    Current video uploaded
                                </small>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small mb-1">
                                PDF
                            </label>

                            <input
                                type="file"
                                name="modules[{{ $mi }}][sessions][{{ $si }}][pdf]"
                                class="form-control form-control-sm"
                                accept="application/pdf"
                            >

                            @if ($session->pdf_path)
                                <small class="text-success">
                                    Current PDF uploaded
                                </small>
                            @endif
                        </div>

                    </div>

                </div>

            @empty

                <div class="session-block border rounded p-2 mb-2" data-si="0">

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong class="small">
                            Session 1
                        </strong>

                        <button
                            type="button"
                            class="btn btn-sm btn-outline-danger remove-session"
                        >
                            &times;
                        </button>
                    </div>

                    <input
                        type="text"
                        name="modules[{{ $mi }}][sessions][0][title]"
                        class="form-control form-control-sm mb-2"
                        placeholder="Session title"
                    >

                    <textarea
                        name="modules[{{ $mi }}][sessions][0][description]"
                        class="form-control form-control-sm mb-2"
                        rows="2"
                        placeholder="Description"
                    ></textarea>

                    <div class="row g-2">

                        <div class="col-md-6">
                            <label class="form-label small mb-1">
                                Video
                            </label>

                            <input
                                type="file"
                                name="modules[{{ $mi }}][sessions][0][video]"
                                class="form-control form-control-sm"
                                accept="video/*"
                            >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small mb-1">
                                PDF
                            </label>

                            <input
                                type="file"
                                name="modules[{{ $mi }}][sessions][0][pdf]"
                                class="form-control form-control-sm"
                                accept="application/pdf"
                            >
                        </div>

                    </div>

                </div>

            @endforelse

        </div>

        <button
            type="button"
            class="btn btn-sm btn-outline-primary mt-2 add-session"
        >
            <i class="bi bi-plus-circle"></i>
            Add Session
        </button>

    </div>
</div>