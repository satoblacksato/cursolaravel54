@component('mail::message')
# Se ingreso un nuevo libro

Hola {{ $sendMail->names }}.

@component('mail::button', ['url' => $sendMail->parameters->route])
Ver Libro
@endcomponent

@component('mail::panel')
<b> Nombre: </b> {{ $sendMail->parameters->libro }}<br/>
<b> Publicado por: </b> {{ $sendMail->parameters->user }}
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
