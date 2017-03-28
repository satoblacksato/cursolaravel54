@component('mail::message')
# Hola administrador

Se ha registrado un nuevo usuario su email es : {{ $user->email }}

@component('mail::button', ['url' => url('/home')])
Para ir al sistema click aqui
@endcomponent


@component('mail::panel')
<b> Mensaje desde el panel </b>
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
