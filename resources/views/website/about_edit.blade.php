<x-app-layout>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists | image | link',
            toolbar: 'undo redo | formatselect |fontfamily fontsize blocks bold italic | alignleft aligncenter alignright alignjustify| indent outdent | bullist numlist |  link|table| image | code ',
            promotion: false,
            branding: false,
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            skin: 'oxide-dark',
            content_css: "dark",
            image_class_list: [{
                title: 'Responsive',
                value: 'img-fluid'
            }],

            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');


                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function() {

                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            },
        });
    </script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit profile About') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('about.update', 1) }}" method="post" class="  text-white"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div>
                            <x-input-label for="nama" :value="__('Nama pengguna')" />
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full"
                                :value="old('nama', $about->nama)" required autofocus autocomplete="name" />

                        </div>
                        <br>
                        <div>
                            <label for="load">photo profile about (ukuran 1x1)</label>
                            <img id="load" src="{{ asset('storage/' . $about->photo_profile) }}" alt="your image"
                                style="max-height: 250px;" />
                            <input accept="image/*" type='file' id="photo_profile" name="photo_profile" />
                        </div>
                        <br>
                        <br>
                        <center>
                            <label for="myeditorinstance">Isi tentang diri anda</label>
                        </center>
                        <textarea id="myeditorinstance" name="tentang" rows="35">
                            {{ $about->tentang }}
                        </textarea>
                        <br>
                        <br>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- buat nampilin gambar yang baru diupload --}}
    <script type="text/javascript">
        photo_profile.onchange = evt => {
            const [file] = photo_profile.files
            if (file) {
                load.src = URL.createObjectURL(file)
            }
        }
    </script>
</x-app-layout>
