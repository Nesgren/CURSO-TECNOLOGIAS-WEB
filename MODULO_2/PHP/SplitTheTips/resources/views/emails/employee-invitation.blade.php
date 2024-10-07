<h1>Invitación para unirte a {{ $invitation->company->name }}</h1>

<p>Has sido invitado a unirte a nuestra empresa como empleado en el área de {{ $invitation->area->name }}.</p>

<p>Para aceptar esta invitación, por favor haz clic en el siguiente enlace:</p>

<a href="{{ route('invitation.accept', $invitation->token) }}">Aceptar invitación</a>

<p>Este enlace expirará en 7 días.</p>

<p>Si no esperabas esta invitación, puedes ignorar este correo electrónico.</p>