

    @if(Sentinel::check() && $user = Sentinel::getUser(true))
        @include('partials.scripts')
    @endif
    {!!  HTML::script("js/scripts.js") !!}
    </body>
</html>
