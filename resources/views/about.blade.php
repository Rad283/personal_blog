@extends('layouts.template')
@section('content')
    <main>
        <br>
        <div class="container">
            <div class="card" style="background-color: #2d2d30">
                <div class="card-body">
                    <center>
                        <br>
                        <h1>{{ $about->nama }}</h1>
                        <div
                            style="background-image:url(&quot;{{ asset('storage' . $about->photo_profile) }}&quot;);width:150px;height:150px;background-size:cover;background-repeat:no-repeat;margin:auto;border-radius:100px;">

                        </div>
                        <br>
                        <br>


                    </center>
                    <div>
                        {!! $about->tentang !!}
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <br>

    </main>
@endsection
