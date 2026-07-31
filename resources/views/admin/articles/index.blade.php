
<style>
    .aa-wrap { max-width: 72rem; margin: 0 auto; padding: 2rem 1.5rem; }

    .aa-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 0.75rem; }
    .aa-title { display: flex; align-items: center; gap: 0.6rem; font-size: 1.3rem; font-weight: 700; color: #0f172a; }
    .aa-title i { color: #2563eb; }
    .aa-count-pill {
        display: inline-flex; align-items: center; gap: 0.4rem;
        background: #eff6ff; color: #2563eb; font-size: 0.75rem; font-weight: 600;
        padding: 0.3rem 0.7rem; border-radius: 999px; border: 1px solid #bfdbfe;
    }

    .aa-alert {
        margin-bottom: 1.25rem; border-radius: 0.75rem; padding: 0.85rem 1rem;
        font-size: 0.875rem; background: #ecfdf5; border: 1px solid #a7f3d0; color: #047857;
        display: flex; align-items: center; gap: 0.5rem;
    }

    .aa-card {
        background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0;
        overflow: hidden; box-shadow: 0 1px 3px rgba(15,23,42,0.04);
    }

    table.aa-table { width: 100%; font-size: 0.875rem; border-collapse: collapse; }
    .aa-table thead { background: #f8fafc; }
    .aa-table thead th {
        text-align: left; padding: 0.85rem 1rem; font-size: 0.68rem;
        letter-spacing: 0.05em; text-transform: uppercase; color: #64748b; font-weight: 600;
        border-bottom: 1px solid #e2e8f0;
    }
    .aa-table tbody tr { border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease; }
    .aa-table tbody tr:last-child { border-bottom: none; }
    .aa-table tbody tr:hover { background: #f8fafc; }
    .aa-table td { padding: 0.9rem 1rem; vertical-align: top; }

    .aa-article-title { font-weight: 600; color: #1e293b; margin-bottom: 0.15rem; }
    .aa-category-badge {
        display: inline-block; font-size: 0.68rem; font-weight: 600; letter-spacing: 0.03em;
        text-transform: uppercase; color: #2563eb; background: #eff6ff;
        padding: 0.15rem 0.55rem; border-radius: 999px;
    }

    .aa-author { display: flex; align-items: center; gap: 0.5rem; color: #475569; }
    .aa-avatar {
        width: 1.75rem; height: 1.75rem; border-radius: 999px; background: #e2e8f0;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 0.7rem; font-weight: 700; color: #64748b; flex-shrink: 0;
    }

    .aa-date { color: #94a3b8; font-size: 0.8rem; }

    .aa-actions { display: flex; align-items: center; gap: 0.5rem; }
    .aa-btn {
        display: inline-flex; align-items: center; gap: 0.35rem;
        font-size: 0.75rem; font-weight: 600; padding: 0.4rem 0.8rem;
        border-radius: 0.5rem; border: none; cursor: pointer; transition: all 0.15s ease;
    }
    .aa-btn-approve { background: #059669; color: #fff; }
    .aa-btn-approve:hover { background: #047857; transform: translateY(-1px); }
    .aa-btn-reject { background: #dc2626; color: #fff; }
    .aa-btn-reject:hover { background: #b91c1c; transform: translateY(-1px); }

    .aa-reject-form {
        margin-top: 0.6rem; display: flex; gap: 0.5rem;
        animation: aaFadeIn 0.15s ease;
    }
    .aa-reject-form.hidden { display: none; }
    .aa-reject-input {
        flex: 1; border: 1px solid #e2e8f0; border-radius: 0.4rem;
        font-size: 0.75rem; padding: 0.4rem 0.6rem;
    }
    .aa-reject-input:focus { outline: none; border-color: #f87171; box-shadow: 0 0 0 3px rgba(248,113,113,0.15); }

    @keyframes aaFadeIn {
        from { opacity: 0; transform: translateY(-4px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .aa-empty { text-align: center; padding: 3.5rem 1rem; color: #94a3b8; }
    .aa-empty i { font-size: 2rem; color: #cbd5e1; margin-bottom: 0.75rem; display: block; }

    .aa-pagination { margin-top: 1.5rem; }
</style>

<div class="aa-wrap">
    <div class="aa-header">
        <div class="aa-title">
            <i class="fa-solid fa-newspaper"></i>
            Article Approvals
        </div>
        <span class="aa-count-pill">
            <i class="fa-solid fa-clock"></i>
            {{ $articles->total() }} pending
        </span>
    </div>

    @if (session('success'))
        <div class="aa-alert">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="aa-card">
        <table class="aa-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Submitted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $article)
                    <tr>
                        <td class="aa-article-title">{{ $article->title }}</td>
                        <td>
                            <div class="aa-author">
                                <span class="aa-avatar">
                                    {{ strtoupper(substr($article->author->name ?? 'U', 0, 1)) }}
                                </span>
                                {{ $article->author->name ?? 'Unknown' }}
                            </div>
                        </td>
                        <td><span class="aa-category-badge">{{ $article->category }}</span></td>
                        <td class="aa-date">{{ $article->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="aa-actions">
                                <form action="{{ route('admin.articles.approve', $article->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="aa-btn aa-btn-approve">
                                        <i class="fa-solid fa-check"></i> Approve
                                    </button>
                                </form>

                                <button type="button" class="aa-btn aa-btn-reject"
                                        onclick="document.getElementById('reject-form-{{ $article->id }}').classList.toggle('hidden')">
                                    <i class="fa-solid fa-xmark"></i> Reject
                                </button>
                            </div>

                            <form id="reject-form-{{ $article->id }}"
                                  action="{{ route('admin.articles.reject', $article->id) }}"
                                  method="POST" class="aa-reject-form hidden">
                                @csrf
                                <input type="text" name="reason" placeholder="Reason (optional)" class="aa-reject-input">
                                <button type="submit" class="aa-btn aa-btn-reject">Confirm</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="aa-empty">
                                <i class="fa-solid fa-inbox"></i>
                                No articles awaiting review.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="aa-pagination">{{ $articles->links() }}</div>
</div>
