<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit profile website') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Edit profile websites') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Update semua informasi website') }}
                    </p>
                    <form action="{{ route('website.update', 1) }}" method="post" class="mt-6 space-y-6 text-white"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div>
                            <x-input-label for="nama_website" :value="__('Nama website')" />
                            <x-text-input id="nama_website" name="nama_website" type="text" class="mt-1 block w-full"
                                :value="old('nama', $website->nama_website)" required autofocus autocomplete="name" />

                        </div>
                        <div>
                            <label for="load">Header website (ukuran 1500x500)</label>
                            <img id="load" src="{{ asset('storage/' . $website->header_image) }}" alt="your image"
                                style="max-height: 250px;" />
                            <input accept="image/*" type='file' id="header_image" name="header_image" />
                        </div>
                        <div>
                            <x-input-label for="github_link" :value="__('Link github')" />
                            <x-text-input id="github_link" name="github_link" type="text" class="mt-1 block w-full"
                                :value="old('github_link', $website->github_link)" required autofocus autocomplete="github_link" />

                        </div>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- buat nampilin gambar yang baru diupload --}}
    <script type="text/javascript">
        header_image.onchange = evt => {
            const [file] = header_image.files
            if (file) {
                load.src = URL.createObjectURL(file)
            }
        }
    </script>
</x-app-layout>
