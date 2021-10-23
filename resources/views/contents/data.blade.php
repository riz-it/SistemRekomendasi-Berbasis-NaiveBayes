@extends('layouts.main')
@section('title', 'Data')
@section('header')
    <nav aria-label="breadcrumb xd">
        <ol class="breadcrumb xd has-arrow">
            <li class="breadcrumb-item">
                <a class="text-panel" href="{{ url('/dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-panel" href="{{ url('/data') }}">Data</a>
            </li>
        </ol>

    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-4 col">
            <div class="row">
                <div class="grid">
                    <p class="grid-header">Sample Elements</p>
                    <div class="grid-body">
                        <div class="item-wrapper">
                            <form action="{{ route('data.store') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="data">Data Ke</label>
                                            <input type="number" min="0" name="data_ke" class="form-control" id="data">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name">Nama Barang</label>
                                            <input autocomplete="off" type="text" class="form-control" name="nama_barang"
                                                id="nama_barang" placeholder="Nama Barang">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="awal">Stok Awal</label>
                                            <input type="number" min="0" class="form-control" name="stok_awal" id="awal">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="masuk">Masuk</label>
                                            <input type="number" min="0" class="form-control" name="stok_masuk" id="masuk">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="keluar">Keluar</label>
                                            <input type="number" min="0" class="form-control" name="stok_keluar"
                                                id="keluar">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <hr>
                                    </div>
                                    <div class="col"><i>Atau Import</i></div>
                                    <div class="col">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row mt-3 showcase_row_area mb-3">

                                    <div class="col showcase_content_area">
                                        <div class="custom-file">
                                            <input type="file" name="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Pilih file excel</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-sm mt-3 btn-success has-icon"> <i
                                            class="mdi mdi-account-plus-outline"></i>Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="grid">
                <p class="grid-header">List Data</p>
                <div class="item-wrapper p-2">
                    <div class="table-responsive">
                        <table id="datatable" class="display table info-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Stok Awal</th>
                                    <th>Masuk</th>
                                    <th>Keluar</th>
                                    <th>Stok Akhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->data_to }}</td>
                                        <td>{{ $item->stock_name }}</td>
                                        <td>{{ $item->first_stock }}</td>
                                        <td>{{ $item->stock_in }}</td>
                                        <td>{{ $item->stock_out }}</td>
                                        <td>{{ $item->last_stock }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button data-id="{{ $item->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal" type="button"
                                                    class="btn tombol-edit btn-warning btn-xs"><i
                                                        class="mdi mdi-pencil"></i></button>
                                                <span data-name="{{ $item->stock_name }}" data-id="{{ $item->id }}"
                                                    class="btn btn-danger btn-xs">
                                                    <form class="delete-form-{{ $item->id }}"
                                                        action="{{ route('data.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                    <i class="mdi mdi-delete"></i>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({

            });
        });

        $('.btn-danger').on('click', function(event) {
            var name = $(this).data('name');
            var id = $(this).data('id');
            swal({
                    title: "Data akan dihapus?",
                    text: "Anda ingin menghapus " + name + "?",
                    icon: "warning",
                    buttons: ["Batal", "Ya, hapus!"],
                    dangerMode: true,
                })
                .then(willDelete => {
                    if (willDelete) {
                        $('.delete-form-' + id).submit();
                    }
                });

        });

        $('.tombol-edit').on('click', function() {
            let id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "data/" + id + "/edit",
                success: function(response) {
                    $('#exampleModal').find('.modal-content').html(response)
                }

            });
        });

    </script>
@endpush
