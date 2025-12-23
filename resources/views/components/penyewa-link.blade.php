@props(['route', 'icon'])

<a href="{{ route($route) }}" class="flex items-center gap-3 px-4 py-3 rounded
   {{ request()->routeIs($route . '*')
    ? 'bg-teal-600 text-white'
    : 'text-teal-100 hover:bg-teal-700' }}">
    <span class="mr-3">
        <i class="{{ $icon }}"></i>
    </span>
    <span>{{ $slot }}</span>
</a>