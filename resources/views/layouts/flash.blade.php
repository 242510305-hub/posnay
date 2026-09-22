@if(session('success') || session('error') || session('errors'))
    @php
        $isSuccess = session('success');
        $message = session('success') ?? session('error') ?? session('errors');
        $message = is_array($message)
            ? implode(', ', $message)
            : (is_object($message) && method_exists($message, 'all')
                ? implode(', ', $message->all())
                : $message);
    @endphp

    <div class="app-flash alert {{ $isSuccess ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show border-0 shadow-sm"
         role="alert">
        <i class="bi {{ $isSuccess ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' }}"></i>
        <span>{{ $message }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
@endif
