@extends('layouts.template')
@section('content')
    <br>

    <div class="container">
        <div class="card" style="background-color: #2d2d30">
            <div class="card-body">
                <div class="row ">

                    <div class="col-md-6">
                        @php
                            $timestamp = $post->created_at;
                            echo 'Posted at: ' . date('j F , Y', strtotime($timestamp));
                        @endphp
                    </div>

                    <div class="col-md-6">
                        <div style="text-align: end">
                            <button type="button" class="btn btn-outline-primary">{{ $post->kategori->nama }}</button>
                        </div>
                    </div>

                </div>

                {!! $post->postingan !!}
                <br>

                
            </div>
            <div class="my-2">
                <center>
                    <a href="{{ url()->previous() }}" class="btn"
                        style="background-color: rgb(166, 2, 166);color:white">Back</a>
                </center>
            </div>


        </div>
    </div>
    <br>
@endsection
