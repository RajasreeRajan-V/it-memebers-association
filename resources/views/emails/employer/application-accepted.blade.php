<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Application Accepted</title>
</head>

<body style="margin:0; padding:0; background:#f4f7fb; font-family:Arial, sans-serif;">

    <div style="max-width:650px; margin:40px auto; background:#ffffff; border-radius:12px; overflow:hidden;">

        {{-- HEADER --}}
        <div style="background:#3457D5; padding:28px; text-align:center;">

            <h1 style="margin:0; color:#ffffff; font-size:24px;">
                Tech Leaders Network
            </h1>

        </div>

        {{-- CONTENT --}}
        <div style="padding:35px;">

            <h2 style="margin-top:0; color:#1f2937;">
                Congratulations, {{ $employee->name }}!
            </h2>

            <p style="font-size:16px; line-height:1.7; color:#4b5563;">
                Your application for the following project has been accepted
                by the employer.
            </p>

            {{-- PROJECT --}}
            <div style="
                background:#f8fafc;
                border:1px solid #e5e7eb;
                border-radius:10px;
                padding:20px;
                margin:25px 0;
            ">

                <h3 style="
                    margin-top:0;
                    color:#111827;
                ">
                    {{ $project->title }}
                </h3>

                @if($project->category)
                    <p style="margin:8px 0; color:#6b7280;">
                        <strong>Category:</strong>
                        {{ $project->category }}
                    </p>
                @endif

                @if($project->project_type)
                    <p style="margin:8px 0; color:#6b7280;">
                        <strong>Project Type:</strong>
                        {{ ucfirst($project->project_type) }}
                    </p>
                @endif

                @if($project->work_mode)
                    <p style="margin:8px 0; color:#6b7280;">
                        <strong>Work Mode:</strong>
                        {{ ucfirst($project->work_mode) }}
                    </p>
                @endif

                @if($project->budget)
                    <p style="margin:8px 0; color:#6b7280;">
                        <strong>Budget:</strong>
                        {{ $project->budget }}
                    </p>
                @endif

            </div>

            <p style="
                font-size:16px;
                line-height:1.7;
                color:#4b5563;
            ">
                Please log in to your Tech Leaders Network account
                for further details and communication regarding the project.
            </p>

            {{-- SUCCESS --}}
            <div style="
                background:#ecfdf5;
                border:1px solid #a7f3d0;
                color:#047857;
                padding:15px;
                border-radius:8px;
                margin-top:25px;
            ">
                <strong>Application Status: Accepted</strong>
            </div>

            <p style="
                margin-top:30px;
                color:#6b7280;
                line-height:1.6;
            ">
                Best regards,<br>
                <strong>Tech Leaders Network</strong>
            </p>

        </div>

    </div>

</body>
</html>