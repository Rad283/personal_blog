@extends('layouts.template')
@section('content')
    <br>

    <div class="container-fluid">
        <div class="mx-2">
            <div class="row ">
                <div class="col-md-9 mb-4">
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
                                        <button type="button"
                                            class="btn btn-outline-primary">{{ $post->kategori->nama }}</button>
                                    </div>
                                </div>
    
                            </div>
    
                            {!! $post->postingan !!}
                            <br>
    
    
                        </div>
                        <!-- <div>
                            <center>
                                <a href="{{ url()->previous() }}" class="btn mb-2"
                                    style="background-color: rgb(166, 2, 166);color:white">Back</a>
                            </center>
                        </div> -->
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="background-color: #2d2d30">
                        <h5 style="text-align: center" class="my-3">
                            Recomended Post
                        </h5>
                        @foreach ($recomendedPost as $item)
                            <div class="col">
                                <div class="card h-100" style="background-color: #2d2d30;">
                                    <a href="{{ route('post.show', $item->id) }}" style="color: white"
                                        class="text-decoration-none">
                                        <div class="card-body p-4">
                                            <p style="text-align: center;">
                                                {{-- judul postingan dengan h1 pertama dari isi postingan --}}
                                                @php
                                                $htmlContent = $item->postingan;
                                                preg_match('/<h1[.]?[style="]?(.*?)]?>(.*?)?<\/h1>/s', $htmlContent, $match);
                                                if (empty($match)) {
                                                $judul = 'Tidak ada judul';
                                                } else {
                                                $raw = $match[2];
                                                $judul = html_entity_decode(strip_tags($raw));
                                                }
                                                 @endphp
                                                {{ Str::limit($judul, 65) }}
                                                
                                            </h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <br>
    </div>
@endsection
