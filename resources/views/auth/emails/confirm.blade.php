<p>
Thank you for signing up {{ $user->name }}. Please <a href="{{ url("register/confirm/{$user->token}") }}">confirm your email address</a>.
</p>

<p>
Yours Sincerely,
<br>
Laravel Auth App team
</p>