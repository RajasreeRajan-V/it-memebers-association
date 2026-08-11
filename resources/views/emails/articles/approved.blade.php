<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color: #1e293b; line-height: 1.6;">
    <div style="max-width: 560px; margin: 0 auto; padding: 24px;">
        <h2 style="color: #2563eb;">Good news — your article is live! 🎉</h2>

        <p>Hi {{ $article->author->name ?? 'there' }},</p>

        <p>
            Your article <strong>"{{ $article->title }}"</strong> has been reviewed
            and approved by an admin. It's now visible to everyone on the
            Articles page.
        </p>

        <p style="margin-top: 24px;">
            <a href="{{ route('employee.articles.index') }}"
               style="background: #2563eb; color: #fff; padding: 10px 20px; border-radius: 8px; text-decoration: none;">
                View Articles Page
            </a>
        </p>

        <p style="margin-top: 32px; color: #64748b; font-size: 13px;">
            Thanks for contributing!
        </p>
    </div>
</body>
</html>