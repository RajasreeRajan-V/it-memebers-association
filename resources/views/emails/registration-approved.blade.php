<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; background:#f4f4f7; padding:2rem 0; margin:0;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="480" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 1px 4px rgba(0,0,0,0.08);">
                    <tr>
                        <td style="background:#504482; padding:1.5rem; text-align:center;">
                            <h1 style="color:#ffffff; margin:0; font-size:1.25rem;">Registration Approved 🎉</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:2rem;">
                            <p>Hi {{ $name }},</p>

                            <p>
                                Congratulations! Your registration and documents have been
                                <strong>verified and approved</strong>. You are now officially
                                a member of our association.
                            </p>

                            <table width="100%" cellpadding="8" cellspacing="0"
                                style="background:#f4f4f7; border-radius:8px; margin:1.5rem 0;">
                                <tr>
                                    <td style="font-weight:600; width:140px;">Email (Login ID)</td>
                                    <td>{{ $email }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:600;">Temporary Password</td>
                                    <td><code style="background:#eee; padding:2px 6px; border-radius:4px;">{{ $password }}</code></td>
                                </tr>
                            </table>

                            <p>
                                For security, please log in and change this password as soon
                                as possible.
                            </p>

                            <p style="text-align:center; margin:1.5rem 0;">
                                <a href="{{ $loginUrl }}"
                                    style="background:#504482; color:#fff; padding:0.7rem 1.5rem;
                                    border-radius:6px; text-decoration:none; font-weight:600;">
                                    Log in to your account
                                </a>
                            </p>

                            <p style="font-size:0.85rem; color:#666;">
                                If you did not expect this email, please contact our support team.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>