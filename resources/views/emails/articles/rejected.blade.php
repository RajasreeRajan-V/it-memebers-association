<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color: #1e293b; line-height: 1.6;">
    <div style="max-width: 560px; margin: 0 auto; padding: 24px;">
        <h2 style="color: #dc2626;">Your article was not approved</h2>

        <p>Hi {{ $article->author->name ?? 'there' }},</p>

        <p>
            Your article <strong>"{{ $article->title }}"</strong> was reviewed
            by an admin and was not approved for publishing. It will not
            appear on the Articles page.
        </p>

        @if (!empty($article->rejection_reason))
            <div style="background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; padding: 14px 16px; margin: 20px 0;">
                <strong>Reason given:</strong><br>
                {{ $article->rejection_reason }}
            </div>
        @endif

        <p>
            Feel free to revise your article and submit a new one if you'd
            like another review.
        </p>

        <p style="margin-top: 24px;">
            <a href="{{ route('employee.articles.create') }}"
               style="background: #2563eb; color: #fff; padding: 10px 20px; border-radius: 8px; text-decoration: none;">
                Write a New Article
            </a>
        </p>
    </div>
</body>
</html>