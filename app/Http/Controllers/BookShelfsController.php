<?php

namespace App\Http\Controllers;

use App\Exports\BookShelfsExport;
use App\Http\Requests\BookShelfsRequest;
use App\Http\Requests\UploadFileExcelRequest;
use App\Imports\BookShelfsImport;
use App\Models\Bookshelfs;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class BookShelfsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['bookshelfs'] = Bookshelfs::get();
        return view('bookshelfs.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['mode'] = 'create';
        return view('bookshelfs.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookShelfsRequest $request)
    {
        $model = $request->validated();
        Bookshelfs::create($model);
        return redirect()->route('bookshelfs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bookshelfs $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bookshelfs $bookshelf)
    {
        $data['mode'] = 'update';
        $data['data'] = $bookshelf;
        return view('bookshelfs.create')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookShelfsRequest $request, Bookshelfs $bookshelf)
    {
        Bookshelfs::updateOrCreate([
            'id' => $bookshelf->id
        ],$request->all());
        return redirect()->route('bookshelfs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bookshelfs $bookshelf)
    {
        $bookshelf->delete();
        return redirect()->route('bookshelfs.index');
    }

    public function import_excel(UploadFileExcelRequest $request){
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_import',$nama_file);

        // import data
        Excel::import(new BookShelfsImport, public_path('/file_import/'.$nama_file));
        return redirect()->route('bookshelfs.index');
    }

    public function export_excel()
    {
        return Excel::download(new BookShelfsExport, 'bookshelfs.xlsx');
    }

    public function export_pdf()
    {
        $bookshelfs = Bookshelfs::all();
        $pdf = PDF::loadview('bookshelfs.print',['bookshelfs'=>$bookshelfs])->setPaper('a4', 'landscape');;
        return $pdf->download('laporan-bookshelfs.pdf');
    }

}
