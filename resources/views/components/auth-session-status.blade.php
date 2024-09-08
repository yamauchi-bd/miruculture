@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-cyan-600 dark:text-cyan-400']) }}>
        {{ $status }}
    </div>
@endif
