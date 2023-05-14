<h1>Email Verification Mail</h1>

Please verify your email with bellow link:
<a href="{{ route('email.verify', $token) }}">Verify Email</a>
<h4>Password : {{ $request->password }}</h4>