<?php

namespace App\Http\Controllers;

use App\Exports\BooksExport;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\UploadFileExcelRequest;
use App\Imports\BooksImport;
use App\Models\Books;
use App\Models\Bookshelfs;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['books'] = Books::with('Bookshelfs')->get();
        return view('books.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['bookshelfs'] = Bookshelfs::all();
        $data['mode'] = 'create';
        return view('books.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request)
    {
        $image = $request->file('cover');
        $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('covers', $imageName, 'public');
        $model = $request->validated();
        $model['cover'] = 'covers/'.$imageName;
        Books::create($model);
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Books $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Books $book)
    {
        $data['mode'] = 'update';
        $data['bookshelfs'] = Bookshelfs::all();
        $data['data'] = $book;
        return view('books.create')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookStoreRequest $request, Books $book)
    {
        if($book->cover){
            if (Storage::exists($book->cover)) {
                Storage::delete($book->cover);
            }
        }
        $image = $request->file('cover');
        $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('covers', $imageName, 'public');
        $model = $request->validated();
        $model['cover'] = 'covers/'.$imageName;
        Books::updateOrCreate([
            'id' => $book->id
        ],$model);
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Books $book)
    {
        if($book->cover){
            if (Storage::exists($book->cover)) {
                Storage::delete($book->cover);
            }
        }
        $book->delete();
        return redirect()->route('books.index');
    }

    public function import_excel(UploadFileExcelRequest $request){
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_import',$nama_file);

        // import data
        Excel::import(new BooksImport, public_path('/file_import/'.$nama_file));
        return redirect()->route('books.index');
    }

    public function export_excel()
    {
        return Excel::download(new BooksExport, 'books.xlsx');

    }

    public function export_pdf()
    {
        $books = Books::all();
        foreach ($books as $row){
            $path = public_path("storage"."/".$row->cover );
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $row->cover = $base64;
        }
        $pdf = PDF::loadview('books.print',['books'=>$books])->setPaper('a4', 'landscape');;
        return $pdf->download('laporan-book.pdf');
    }

}
