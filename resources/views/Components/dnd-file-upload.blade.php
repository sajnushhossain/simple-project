@props(['name', 'existingImage' => null])

<div x-data="fileUpload({
    name: '{{ $name }}',
    existingImage: '{{ $existingImage }}'
})" class="relative flex flex-col items-center justify-center w-full">

    <input type="hidden" name="remove_{{ $name }}" x-model="removed">

    <div x-on:dragover.prevent="dragover = true"
         x-on:dragleave.prevent="dragover = false"
         x-on:drop.prevent="drop($event)"
         class="w-full p-8 border-2 border-1px-soliod-grey rounded-lg text-center transition-colors duration-300 flex flex-col items-center justify-center min-h-[200px]"
         :class="{ 'border-blue-500 bg-blue-100': dragover, 'border-gray-300 bg-gray-50': !dragover }">

        <!-- Content when no preview -->
        <div x-show="!preview" class="flex flex-col items-center">
            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"></path>
            </svg>

            <p class="mt-4 text-lg text-gray-600">
                <span class="font-semibold">Drag and drop</span> your file here
            </p>
            <p class="mt-1 text-sm text-gray-500">or</p>

            <label :for="name"
                   class="inline-block px-4 py-2 mt-2 text-sm font-medium text-white bg-blue-600 rounded-lg cursor-pointer hover:bg-blue-700">
                Browse for a file
            </label>

            <input :id="name" name="{{ $name }}" type="file" class="hidden" x-on:change="onChange($event)" accept="image/*">
        </div>

        <!-- Content when preview is available -->
        <div x-show="preview" class="relative inline-block">
            <template x-if="isImage">
                <img :src="preview" class="w-full h-auto object-cover rounded-lg" style="max-width: 300px;">
            </template>
            <template x-if="!isImage && preview">
                <div class="p-4 border rounded-lg bg-gray-100">
                    <p class="font-semibold">Selected file:</p>
                    <p x-text="fileName"></p>
                </div>
            </template>
            <button type="button" x-on:click="removeFile()"
                    class="absolute -top-2 -right-2 bg-white rounded-full p-1 text-gray-500 hover:text-red-600 transition-colors duration-300 border shadow-md">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
    function fileUpload(config) {
        return {
            dragover: false,
            file: null,
            fileName: '',
            preview: null,
            isImage: false,
            removed: false,
            name: config.name || 'file-upload',

            init() {
                if (config.existingImage) {
                    this.preview = config.existingImage;
                    this.isImage = true; // Assume existing is an image
                    this.fileName = this.extractFileName(config.existingImage);
                }
            },

            onChange(event) {
                this.setFile(event.target.files[0]);
            },

            drop(event) {
                this.dragover = false;
                this.setFile(event.dataTransfer.files[0]);
            },

            setFile(file) {
                if (file) {
                    this.file = file;
                    this.fileName = file.name;
                    this.isImage = file.type.startsWith('image/');
                    this.removed = false;

                    if (this.isImage) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.preview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        this.preview = 'file_selected'; // A non-null value to trigger preview visibility
                    }

                    const fileInput = document.getElementById(this.name);
                    if (fileInput) {
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        fileInput.files = dataTransfer.files;
                    }
                }
            },

            removeFile() {
                this.file = null;
                this.preview = null;
                this.fileName = '';
                this.isImage = false;
                this.removed = true;

                const fileInput = document.getElementById(this.name);
                if (fileInput) {
                    fileInput.value = '';
                }
            },

            extractFileName(path) {
                if (path) {
                    return path.split('/').pop();
                }
                return '';
            }
        }
    }
</script>