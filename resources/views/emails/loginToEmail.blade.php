@component('mail::message')
    <h2>component hello</h2>
    @component('mail::button',['url'=>url('/')])
        Click!
    @endcomponent
    Best Regard
@endcomponent
