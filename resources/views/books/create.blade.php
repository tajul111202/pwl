<x-app-layout>
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-8 border rounded shadow dark:border-gray-600">
            <h1 class="text-2xl font-bold mb-6 text-gray-600 dark:text-gray-400">Tambah Buku</h1>

            <form action="{{ $mode == 'create' ? route('books.store') : route('books.update', ['book' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($mode == 'update')
                    @method('PATCH')
                    <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                @endif
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Judul</label>
                    <input type="text" name="title" id="title" class="mt-1 p-2 w-full border rounded-md dark:border-gray-600" value="{{ old('title') ?? $data->title ?? '' }}">
                    @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="author" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Penulis</label>
                    <input type="text" name="author" id="author" class="mt-1 p-2 w-full border rounded-md dark:border-gray-600" value="{{ old('author') ?? $data->author ?? '' }}">
                    @error('author')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="year" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Tahun Terbit</label>
                    <input type="number" min="1000" max="{{ date("Y") }}" name="year" id="year" class="mt-1 p-2 w-full border rounded-md" value="{{ old('year') ?? $data->year ?? '' }}">
                    @error('year')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="publisher" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Penerbit</label>
                    <input type="text" name="publisher" id="publisher" class="mt-1 p-2 w-full border rounded-md" value="{{ old('publisher') ?? $data->publisher ?? '' }}">
                    @error('publisher')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="city" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Kota Terbit</label>
                    <input type="text" name="city" id="city" class="mt-1 p-2 w-full border rounded-md" value="{{ old('city') ?? $data->city ?? '' }}">
                    @error('city')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="cover" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Sampul</label>
                    <input type="file" name="cover" id="cover" class="mt-1 p-2 w-full border rounded-md">
                    @error('cover')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="bookshelf_id" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Bookshelfs</label>
                    <select name="bookshelf_id" id="bookshelf_id" class="mt-1 p-2 w-full border rounded-md">
                        <option value="">Silahkan Pilih </option>
                        @if($mode == 'update')
                        @foreach($bookshelfs as $row)
                            <option value="{{ $row->id }}" {{ $data->bookshelf_id == $row->id ? 'selected' : '' }}>{{ $row->code." - ".$row->name }}</option>
                        @endforeach
                        @else
                            @foreach($bookshelfs as $row)
                                <option value="{{ $row->id }}" {{ old('bookshelf_id') == $row->id ? 'selected' : '' }}>{{ $row->code." - ".$row->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('bookshelf_id')
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
