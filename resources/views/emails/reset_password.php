<!DOCTYPE html>
<html>
<head>
    <title>{{ config('mail.from.address') }}</title>
</head>
<body>
    <h1>Reset Password &mdash; {{ config('mail.from.address') }}</h1>
    <p>Halo <b>{{ $data->username }}</b>, klik link berikut ini untuk mengganti password anda.</p>
    <p>
        <a href="{{ $data->link }}">{{ $data->link }}</a>
    </p>
    <p>Terima kasih.</p>
</body>
</html>