@props(['url'])
@php
    $generalSetting = get_general_settings();
    $gs_adminlogo = $generalSetting['gs_adminlogo'];
    $gs_adminlogo = asset($gs_adminlogo) ? asset($gs_adminlogo) : 'https://laravel.com/img/notification-logo.png';
@endphp
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ $gs_adminlogo }}" class="logo" alt="Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
