@props(['active' => false])

<a class="{{ $active ? 'text-[#659633]' : 'text-[#3D3D3D]' }} px-7 py-2 font-poppins"
    aria-current="{{ $active ? 'page' : 'false' }}" {{ $attributes }}>{{ $slot }}</a>
