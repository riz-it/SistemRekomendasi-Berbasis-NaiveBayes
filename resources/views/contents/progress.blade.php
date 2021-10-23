@extends('layouts.main')
@section('title', 'Dashboard')
@section('header')
    <nav aria-label="breadcrumb xd">
        <ol class="breadcrumb xd has-arrow">
            <li class="breadcrumb-item">
                <a class="text-panel" href="{{ url('/dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-panel" href="{{ url('/progress') }}">Progress</a>
            </li>
        </ol>
    </nav>
@endsection
@section('content')
    @if ($message = Session::get('toast_error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error! ~ </strong> Data tidak valid, cek kembali data anda {{ ';)' }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col">
            <div class="grid">
                <p class="grid-header">Data Progress</p>
                <div class="item-wrapper p-2">
                    <div class="table-responsive">
                        <table id="datatable" class="display table info-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ket</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>Output minggu ke-{{ $item->data_to }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('/progress/' . $item->data_to) }}"
                                                    class="btn btn-secondary btn-xs"><i
                                                        class="mdi mdi-arrow-right-bold-circle"></i></a>
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
@push('script')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "lengthChange": false
            });
        });

    </script>
@endpush
