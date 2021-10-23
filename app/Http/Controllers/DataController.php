<?php

namespace App\Http\Controllers;

use App\Models\Database;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataImport;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'contents.data',
            [
                'data' => Database::orderBy('data_to', 'desc')->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty($request->file)) {


            $validator = Validator::make($request->all(), [
                'data_ke' => 'required',
                'nama_barang' => 'required',
                'stok_awal' => 'required',
                'stok_masuk' => 'required',
                'stok_keluar' => 'required',
            ], [
                'data_ke.required' => 'Key data harus diisi!',
                'nama_barang.required'    => 'Nama barang harus diisi!',
                'stok_awal.required'    => 'Stok awal harus diisi!',
                'stok_masuk.required'    => 'Stok masuk diisi!',
                'stok_keluar.required'    => 'Stok keluar diisi!',
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }

            Database::create([
                'data_to' => $request->data_ke,
                'stock_name' => $request->nama_barang,
                'first_stock' => $request->stok_awal,
                'stock_in' => $request->stok_masuk,
                'stock_out' => $request->stok_keluar,
                'last_stock' => $request->stok_awal + $request->stok_masuk - $request->stok_keluar
            ]);

            return redirect('data')->with('toast_success', 'Data berhasil ditambahkan!');
        }

        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // // upload ke folder file_siswa di dalam folder public
        // $file->move('file_data', $nama_file);

        // // import data
        Excel::import(new DataImport, $file);
        return redirect()->route('data.index')
            ->with('success', 'Data berhasil diimport.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('contents.modals.edit', [
            'data' => Database::where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'data_ke' => 'required',
            'nama_barang' => 'required',
            'stok_awal' => 'required',
            'stok_masuk' => 'required',
            'stok_keluar' => 'required',
        ], [
            'data_ke.required' => 'Key data harus diisi!',
            'nama_barang.required'    => 'Nama barang harus diisi!',
            'stok_awal.required'    => 'Stok awal harus diisi!',
            'stok_masuk.required'    => 'Stok masuk diisi!',
            'stok_keluar.required'    => 'Stok keluar diisi!',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        Database::where('id', $id)->update([
            'data_to' => $request->data_ke,
            'stock_name' => $request->nama_barang,
            'first_stock' => $request->stok_awal,
            'stock_in' => $request->stok_masuk,
            'stock_out' => $request->stok_keluar,
            'last_stock' => $request->stok_akhir
        ]);

        return redirect('data')->with('toast_success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Database::where('id', $id)->delete();
        return redirect('data')->with('toast_success', 'Data berhasil dihapus!');
    }
}
