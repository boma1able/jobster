@component('mail::message')
    Reset Password!

    @component('mail::button', ['url' => $actionUrl])
        Update your password
    @endcomponent

    <br>
    {{ config('app.name') }}
@endcomponent
