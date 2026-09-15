<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Job Invitation</title>
</head>

<body style="
    margin:0;
    padding:0;
    background:#f4f7fb;
    font-family:Arial,Helvetica,sans-serif;
">

<div style="
    width:100%;
    padding:35px 15px;
    box-sizing:border-box;
">

    <div style="
        max-width:620px;
        margin:0 auto;
        background:#ffffff;
        border-radius:14px;
        overflow:hidden;
        box-shadow:0 8px 30px rgba(20,50,100,.08);
    ">

        {{-- Header --}}
        <div style="
            background:#3376f2;
            padding:28px 30px;
            color:#ffffff;
        ">

            <div style="
                font-size:13px;
                font-weight:bold;
                letter-spacing:.5px;
                opacity:.9;
            ">
                SKILLCONNECT
            </div>

            <div style="
                font-size:26px;
                font-weight:700;
                margin-top:8px;
            ">
                You're Invited to Apply
            </div>

        </div>

        {{-- Content --}}
        <div style="
            padding:32px 30px;
        ">

            <p style="
                margin:0 0 18px;
                color:#26364d;
                font-size:16px;
                line-height:1.7;
            ">
                Hello {{ $invitation->candidate->name ?? 'Candidate' }},
            </p>

            <p style="
                margin:0 0 22px;
                color:#68778c;
                font-size:14px;
                line-height:1.8;
            ">
                <strong>
                    {{ $invitation->employer->name ?? 'An employer' }}
                </strong>
                has invited you to apply for a job opportunity that may
                be a good match for your profile.
            </p>

            {{-- Job Card --}}
            <div style="
                background:#f7faff;
                border:1px solid #e1eafa;
                border-radius:12px;
                padding:22px;
                margin-bottom:25px;
            ">

                <div style="
                    color:#3376f2;
                    font-size:12px;
                    font-weight:bold;
                    text-transform:uppercase;
                    letter-spacing:.5px;
                    margin-bottom:8px;
                ">
                    Job Opportunity
                </div>

                <div style="
                    color:#1e3555;
                    font-size:21px;
                    font-weight:700;
                    margin-bottom:14px;
                ">
                    {{ $invitation->job->title }}
                </div>

                @if(!empty($invitation->job->employment_type))
                    <div style="
                        color:#718096;
                        font-size:13px;
                        margin-bottom:7px;
                    ">
                        <strong>Employment:</strong>
                        {{ $invitation->job->employment_type }}
                    </div>
                @endif

                @if(!empty($invitation->job->location))
                    <div style="
                        color:#718096;
                        font-size:13px;
                        margin-bottom:7px;
                    ">
                        <strong>Location:</strong>
                        {{ $invitation->job->location }}
                    </div>
                @endif

                @if(!empty($invitation->job->description))
                    <div style="
                        color:#718096;
                        font-size:13px;
                        line-height:1.7;
                        margin-top:14px;
                    ">
                        {{ \Illuminate\Support\Str::limit(strip_tags($invitation->job->description), 300) }}
                    </div>
                @endif

            </div>

            {{-- Apply Button --}}
            <div style="
                text-align:center;
                margin:28px 0;
            ">

                <a href="{{ route('job.invitations.open', $invitation->token) }}"
                   style="
                    display:inline-block;
                    padding:13px 28px;
                    background:#3376f2;
                    color:#ffffff;
                    text-decoration:none;
                    border-radius:8px;
                    font-size:14px;
                    font-weight:bold;
                ">
                    View Job &amp; Apply Now
                </a>

            </div>

            <p style="
                margin:25px 0 0;
                color:#8996a8;
                font-size:12px;
                line-height:1.7;
                text-align:center;
            ">
                If you are interested in this opportunity, click the
                button above to view the complete job details and apply.
            </p>

        </div>

        {{-- Footer --}}
        <div style="
            border-top:1px solid #edf1f6;
            padding:20px 30px;
            text-align:center;
            background:#fafbfd;
        ">

            <div style="
                color:#7d8da2;
                font-size:12px;
            ">
                Sent through SkillConnect
            </div>

            <div style="
                color:#a0acba;
                font-size:11px;
                margin-top:5px;
            ">
                Connect • Learn • Grow • Lead
            </div>

        </div>

    </div>

</div>

</body>
</html>