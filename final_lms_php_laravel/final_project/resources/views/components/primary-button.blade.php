<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => '
        inline-flex items-center
        px-5 py-2
        bg-blue-600
        text-primary
        rounded-md
        font-semibold text-sm
        uppercase tracking-wide
        shadow
        hover:bg-blue-700
        focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2
        transition duration-150 ease-in-out
    '
]) }}>
    {{ $slot }}
</button>
