@props(['active','link','icon'])

@php
    $classes = ($active ?? false) ? 'bg-primary mx-auto rounded-2' : 'mx-auto rounded-2';
    
    $divStyles = ($active ?? false) ? 'padding: 8px 16px;display:flex;align-items: baseline;width:90%;margin-bottom:5px':
                                    'padding: 8px 16px;display:flex;align-items: baseline;width:90%;margin-bottom:5px';
    
    $aStyles = ($active ?? false) ? 'color:white;text-decoration:none;':
                                    'color:rgb(194, 199, 208);text-decoration:none;';
@endphp
<a href="{{ route($link) }}" style="{{$aStyles}}" class="admin-nav-link">
    <div {{ $attributes->merge(['class' => $classes,'style'=>$divStyles]) }}>
        <i class="{{ $icon }}" style="{{$aStyles}}margin-right:7px; font-size:18px;"></i>
        <span>{{ $slot }}</span>
    </div>
</a>
