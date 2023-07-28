@extends('layouts.template')
@section('content')
    <br>

    <div class="container">
        <div class="card" style="background-color: #2d2d30">
            <div class="card-body">
                @php
                    $timestamp = $post->created_at;
                    echo 'Posted at: ' . date('jS F , Y', strtotime($timestamp));
                @endphp
                <center>

                    <h1>{{ $post->judul }}</h1>

                    <img src="{{ asset('storage' . $post->thumbnail) }}" class="img-fluid" style="max-height: 350px">
                </center>
                <br>
                <br>

                {!! $post->postingan !!}


                <div class="mt-1">
                    <center>
                        <a href="{{ url()->previous() }}" class="btn"
                            style="background-color: rgb(166, 2, 166);color:white">Back</a>
                    </center>
                </div>

            </div>

        </div>
    </div>
    <br>
@endsection
