<tr>
<td class="header">
<a href="{{ $url }}" style="display: none;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('assets/pngwing.com(1).png') }}" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
