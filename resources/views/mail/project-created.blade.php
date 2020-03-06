@component('mail::message')
Department: {{ $department }}
Project Title: {{ $projectTitle}}

Project Description

{{ $projectDescription }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
