{{-- @if($user->profile->avatar && file_exists(public_path('images/avatars/' . $user->id . '/' . $user->profile->avatar))) --}}
@if($user->profile->avatar)
{{-- <a href="/profiles/{{ $user->id }}" class="img-thumbnail float-left mr-2 profile-photo-thumbnail" style="background-image:url('/images/avatars/{{ $user->id }}/{{ $user->profile->avatar }}');"></a> --}}
<a href="/profiles/{{ $user->id }}" class="img-thumbnail float-left mr-2 profile-photo-thumbnail" style="background-image:url('{{ $user->profile->avatar }}');"></a>
@else
<a href="/profiles/{{ $user->id }}" class="img-thumbnail float-left mr-2 profile-photo-thumbnail" style="background-image:url('/images/avatars/default.png');"></a>
@endif
