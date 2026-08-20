@extends('layouts.app')

@section('title', 'Attendance — ' . $webinar->title)

@section('content')

@if(session('success'))
    <div class="registration-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="registration-error">{{ session('error') }}</div>
@endif

<div class="container" style="max-width:900px;padding:40px 0;">
    <a href="{{ route('mentor.webinars.index') }}" style="font-size:0.85rem;color:var(--muted);">&larr; Back to Webinars</a>

    <h1 style="font-size:1.4rem;font-weight:700;color:var(--primary);margin-top:12px;">
        {{ $webinar->title }} — Attendance & Resources
    </h1>

    {{-- ===== Attendance ===== --}}
    <div class="sidebar-card" style="padding:20px;margin-top:20px;">
        <h3 style="margin-bottom:14px;">Attendance</h3>

        @if($registrations->isEmpty())
            <p style="color:var(--muted);">No approved registrations yet.</p>
        @else
            <form method="POST" action="{{ route('mentor.webinars.attendance.update', $webinar) }}">
                @csrf
                @method('PUT')

                <table style="width:100%;border-collapse:collapse;font-size:0.85rem;">
                    <thead>
                        <tr style="text-align:left;color:var(--muted);border-bottom:1px solid #e5e7eb;">
                            <th style="padding:8px 6px;">Student</th>
                            <th style="padding:8px 6px;">Status</th>
                            <th style="padding:8px 6px;">Joined at</th>
                            <th style="padding:8px 6px;">Left at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $reg)
                            <tr style="border-bottom:1px solid #f3f4f6;">
                                <td style="padding:8px 6px;">
                                    {{ $reg->student->name ?? '—' }}<br>
                                    <small style="color:var(--muted);">{{ $reg->student->email ?? '' }}</small>
                                </td>
                                <td style="padding:8px 6px;">
                                    <select name="attendance[{{ $reg->id }}][status]" style="padding:5px 8px;font-size:0.8rem;">
                                        @foreach(['registered' => 'Registered', 'joined' => 'Joined', 'attended' => 'Attended', 'absent' => 'Absent'] as $val => $label)
                                            <option value="{{ $val }}" {{ $reg->attendance_status === $val ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="padding:8px 6px;">
                                    <input type="time" name="attendance[{{ $reg->id }}][joined_at_time]"
                                           value="{{ $reg->joined_at?->format('H:i') }}" style="padding:5px;font-size:0.8rem;">
                                    <input type="hidden" name="attendance[{{ $reg->id }}][joined_at]"
                                           id="joined_at_{{ $reg->id }}" value="{{ $reg->joined_at }}">
                                </td>
                                <td style="padding:8px 6px;">
                                    <input type="time" name="attendance[{{ $reg->id }}][left_at_time]"
                                           value="{{ $reg->left_at?->format('H:i') }}" style="padding:5px;font-size:0.8rem;">
                                    <input type="hidden" name="attendance[{{ $reg->id }}][left_at]"
                                           id="left_at_{{ $reg->id }}" value="{{ $reg->left_at }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="submit" class="btn btn-primary" style="margin-top:16px;">
                    Save Attendance
                </button>
            </form>
        @endif
    </div>

    {{-- ===== Resources ===== --}}
    <div class="sidebar-card" style="padding:20px;margin-top:20px;">
        <h3 style="margin-bottom:14px;">Recording & Resources</h3>

        @if($resources->isNotEmpty())
            <ul style="list-style:none;padding:0;margin-bottom:18px;">
                @foreach($resources as $res)
                    <li style="display:flex;align-items:center;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f3f4f6;">
                        <span>
                            <strong>{{ ucfirst($res->type) }}:</strong> {{ $res->title }}
                            <a href="{{ $res->link }}" target="_blank" style="margin-left:8px;font-size:0.8rem;">Open</a>
                        </span>
                        <form method="POST" action="{{ route('mentor.webinar-resources.destroy', $res) }}" onsubmit="return confirm('Remove this resource?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color:#b91c1c;background:none;border:none;font-size:0.78rem;cursor:pointer;">
                                Remove
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('mentor.webinars.resources.store', $webinar) }}" enctype="multipart/form-data">
            @csrf
            <div style="display:grid;grid-template-columns:140px 1fr;gap:10px;margin-bottom:10px;">
                <select name="type" style="padding:7px;font-size:0.85rem;">
                    <option value="recording">Recording (link)</option>
                    <option value="pdf">PDF</option>
                    <option value="ppt">Presentation</option>
                    <option value="code">Source Code</option>
                    <option value="other">Other</option>
                </select>
                <input type="text" name="title" placeholder="Title (e.g. Session Recording)" style="padding:7px;font-size:0.85rem;">
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px;">
                <input type="url" name="url" placeholder="External link (for recordings)" style="padding:7px;font-size:0.85rem;">
                <input type="file" name="file" style="padding:5px;font-size:0.85rem;">
            </div>
            <button type="submit" class="btn btn-primary">Add Resource</button>
        </form>
    </div>
</div>

<script>
    document.querySelector('form[action*="attendance"]')?.addEventListener('submit', function () {
        this.querySelectorAll('input[name$="_time]"]').forEach(function (timeInput) {
            if (!timeInput.value) return;
            var hiddenName = timeInput.name.replace('_time]', ']');
            var hidden = document.querySelector('input[name="' + hiddenName + '"]');
            if (hidden) {
                var today = new Date().toISOString().slice(0, 10);
                hidden.value = today + ' ' + timeInput.value + ':00';
            }
        });
    });
</script>

<style>
    .registration-success { max-width:900px;margin:0 auto 16px;padding:14px 20px;background:#ecfdf5;border:1px solid #10b981;color:#047857;border-radius:10px;font-weight:600; }
    .registration-error   { max-width:900px;margin:0 auto 16px;padding:14px 20px;background:#fef2f2;border:1px solid #ef4444;color:#b91c1c;border-radius:10px;font-weight:600; }
</style>

@endsection