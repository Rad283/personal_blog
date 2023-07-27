<x-template>
    @include('layouts/navbar')
    <main>
        <br>
        <div class="container">

            <center>
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

        </div>





    </main>
    <br>
    <br>
    @include('layouts/footer')

</x-template>
