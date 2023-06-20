@component('mail::panel')
Kids Saviour App.
@endcomponent

@component('mail::message')
#  Hello , This Your Code

@component('mail::table')




|Your Code To Chang Your Password|
|:------------:|
| {{ $user['code'] }} |


@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
