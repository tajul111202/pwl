<x-app-layout>
    <div class="container mx-auto mt-8">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 border rounded shadow dark:border-gray-600">
            <h1 class="text-2xl font-bold mb-6 dark:text-white">Import RAK Buku</h1>
            <form action="{{ route('book-shelfs.import-excel') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="file" class="block text-sm font-medium text-gray-600 dark:text-gray-400">File Excel</label>
                    <input type="file" name="file" id="file" class="mt-1 p-2 w-full border rounded-md">
                    @error('file')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md dark:bg-gray-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container mx-auto mt-8">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 border rounded shadow dark:border-gray-600">
            <h1 class="text-2xl font-bold mb-6 dark:text-white">Daftar RAK Buku</h1>

            @if(session('success'))
                <div class="bg-green-200 p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex space-x-4">
                <a href="{{ route('bookshelfs.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Tambah</a>
                <a href="{{ route('book-shelfs.export-excel') }}" target="_blank" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Download Excel</a>
                <a href="{{ route('book-shelfs.export-pdf') }}" target="_blank" class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Download PDF</a>
            </div>
            <br><br>
            <table class="w-full table-auto border">
                <thead class="border-collapse border border-slate-500">
                    <tr class="bg-gray-200 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left border-collapse border border-slate-500 dark:text-black">Kode</th>
                        <th class="py-3 px-6 text-left border-collapse border border-slate-500 dark:text-black">Nama/RAK</th>
                        <th class="py-3 px-6 text-left border-collapse border border-slate-500 dark:text-black">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @if(count($bookshelfs) > 0)
                        @foreach($bookshelfs as $bookshelf)
                            <tr class="border-b border-gray-200">
                                <td class="py-3 px-6 text-center dark:text-white border-collapse border border-slate-500">
                                    <span>{{ $bookshelf->code }}</span>
                                </td>
                                <td class="py-3 px-6 text-center dark:text-white border-collapse border border-slate-500">
                                    <span>{{ $bookshelf->name }}</span>
                                </td>
                                <td class="py-3 px-6 text-center dark:text-white border-collapse border border-slate-500 m-4">
                                    <a href="{{ route('bookshelfs.edit', $bookshelf->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Edit</a>
                                    <br><br>
                                    <form action="{{ route('bookshelfs.destroy', $bookshelf->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="border-b border-gray-200">
                            <td colspan="8" class="py-3 px-6 text-center dark:text-white border-collapse border border-slate-500">
                                <span>Belum ada data</span>
                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
