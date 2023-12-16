<x-app-layout>
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-8 border rounded shadow dark:border-gray-600">
            <h1 class="text-2xl font-bold mb-6 text-gray-600 dark:text-gray-400">Tambah Buku</h1>

            <form action="{{ $mode == 'create' ? route('bookshelfs.store') : route('bookshelfs.update', ['bookshelf' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($mode == 'update')
                    @method('PATCH')
                    <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                @endif
                <div class="mb-4">
                    <label for="code" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Kode</label>
                    <input type="text" name="code" id="code" class="mt-1 p-2 w-full border rounded-md dark:border-gray-600" value="{{ old('code') ?? $data->code ?? '' }}">
                    @error('code')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Nama/RAK</label>
                    <input type="text" name="name" id="name" class="mt-1 p-2 w-full border rounded-md dark:border-gray-600" value="{{ old('name') ?? $data->name ?? '' }}">
                    @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md dark:bg-gray-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
