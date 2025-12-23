<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit"
        class="flex items-center px-4 py-2 hover:bg-red-600 hover:text-white rounded text-sm w-full">
        @if($icon)
            <i class="{{ $icon }} mr-2"></i>
        @endif
        {{ $slot }}
    </button>
</form>