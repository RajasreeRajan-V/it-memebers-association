<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Startup Profile Approved</title>
</head>

<body style="margin:0; padding:0; background:#f5f7fb; font-family:Arial, Helvetica, sans-serif;">

    <div style="width:100%; padding:40px 0;">

        <div style="
            max-width:600px;
            margin:0 auto;
            background:#ffffff;
            border-radius:12px;
            overflow:hidden;
            border:1px solid #e5e7eb;
        ">

            <!-- Header -->
            <div style="
                background:#2563eb;
                padding:28px 30px;
                text-align:center;
            ">
                <h1 style="
                    margin:0;
                    color:#ffffff;
                    font-size:24px;
                    font-weight:700;
                ">
                    Startup Profile Approved
                </h1>
            </div>

            <!-- Content -->
            <div style="padding:35px 30px;">

                <p style="
                    margin:0 0 18px;
                    color:#1f2937;
                    font-size:16px;
                    line-height:1.6;
                ">
                    Hi {{ $startup->founder_name }},
                </p>

                <p style="
                    margin:0 0 18px;
                    color:#4b5563;
                    font-size:15px;
                    line-height:1.7;
                ">
                    Good news! Your startup profile for
                    <strong>{{ $startup->startup_name }}</strong>
                    has been reviewed and approved.
                </p>

                <p style="
                    margin:0 0 25px;
                    color:#4b5563;
                    font-size:15px;
                    line-height:1.7;
                ">
                    Your startup profile is now approved and can be published
                    according to the visibility settings you selected.
                </p>

                <!-- Button -->
                <div style="text-align:center; margin:30px 0;">

                    <a href="{{ url('/') }}"
                       style="
                           display:inline-block;
                           padding:13px 25px;
                           background:#2563eb;
                           color:#ffffff;
                           text-decoration:none;
                           border-radius:7px;
                           font-size:15px;
                           font-weight:600;
                       ">
                        View Portal
                    </a>

                </div>

                <p style="
                    margin:25px 0 0;
                    color:#4b5563;
                    font-size:15px;
                    line-height:1.7;
                ">
                    Thanks,<br>
                    <strong>{{ config('app.name') }}</strong>
                </p>

            </div>

            <!-- Footer -->
            <div style="
                padding:20px 30px;
                background:#f8fafc;
                border-top:1px solid #e5e7eb;
                text-align:center;
            ">
                <p style="
                    margin:0;
                    color:#94a3b8;
                    font-size:12px;
                ">
                    This is an automated email. Please do not reply directly to this message.
                </p>
            </div>

        </div>

    </div>

</body>
</html>