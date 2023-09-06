<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Edit Kategori') }}
                    </h2>


                    {{-- form untuk kategori  --}}
                    <form action="{{ route('kategori.update',$kategori) }}" method="post" class="mt-6 space-y-6 text-white"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div>
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" value="{{$kategori->nama}}"
                                required autofocus autocomplete="nama" />

                        </div>

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Update</button>
                    </form>
                    <br>
                    <br>
                <a href="{{url()->previous()}}"><button class="bg-white-700 text-white font-bold py-2 px-4 rounded">Kembali</button></a>
<br>

                </div>
</x-app-layout>