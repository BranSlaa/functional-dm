@extends('layouts.app') @section('content')
<section class="hero hero-cardOnly">
    <div class="heroCard">
        <div class="heroContent">
            <h1>{!! __('404.title') !!}</h1>
            <p>
                <a class="button primary" href="{!! __('404.button.link') !!}" title="{!! __('404.button.title') !!}">{!! __('404.button.text') !!}</a>
            </p>
        </div>
    </div>
</section>
@endsection
