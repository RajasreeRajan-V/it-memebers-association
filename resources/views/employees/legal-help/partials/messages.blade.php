<div class="flex items-center justify-between">
    <h3 class="text-sm font-semibold text-slate-800">Messages</h3>
    @if($legalRequest->lawyer)
        <span class="text-xs text-slate-400">with {{ $legalRequest->lawyer->name }}</span>
    @endif
</div>

<div class="mt-4 max-h-72 space-y-4 overflow-y-auto pr-1">
    @forelse($legalRequest->messages as $message)
        @php $isMine = $message->sender_id === auth()->id(); @endphp
        <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}">
            <div class="max-w-[80%] rounded-xl px-4 py-2.5 text-sm {{ $isMine ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-700' }}">
                @if(!$isMine)
                    <p class="mb-1 text-xs font-semibold {{ $isMine ? 'text-blue-100' : 'text-slate-500' }}">
                       {{ $message->sender->name ?? 'Legal Team' }}
                    </p>
                @endif
                <p>{{ $message->message }}</p>

                @if($message->attachments->count())
                    <div class="mt-2 space-y-1">
                        @foreach($message->attachments as $attachment)
                            <a href="{{ Storage::disk('public')->url($attachment->file_path) }}"
                               target="_blank"
                               class="block text-xs underline {{ $isMine ? 'text-blue-100' : 'text-blue-600' }}">
                                📎 {{ $attachment->file_name }}
                            </a>
                        @endforeach
                    </div>
                @endif

                <p class="mt-1 text-[10px] {{ $isMine ? 'text-blue-100/80' : 'text-slate-400' }}">
                    {{ $message->created_at->format('d M, h:i A') }}
                </p>
            </div>
        </div>
    @empty
        <p class="text-xs text-slate-400">No messages yet. Start the conversation below.</p>
    @endforelse
</div>

<form action="{{ route('employee.legal-help.messages.store', $legalRequest) }}"
      method="POST"
      enctype="multipart/form-data"
      class="mt-4 flex items-center gap-2 border-t border-slate-100 pt-4">
    @csrf
    <input type="text"
           name="message"
           required
           placeholder="Type your message..."
           class="flex-1 rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">
    <label class="cursor-pointer text-slate-400 hover:text-slate-600">
        📎
        <input type="file" name="attachments[]" multiple class="hidden">
    </label>
    <button type="submit"
            class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
        Send
    </button>
</form>
