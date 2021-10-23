@extends('layouts.main')
@section('title', 'Dashboard')
@section('header')
    <nav aria-label="breadcrumb xd">
        <ol class="breadcrumb xd has-arrow">
            <li class="breadcrumb-item">
                <a class="text-panel" href="{{ url('/dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-panel" href="{{ url('/output') }}">Output</a>
            </li>
            <li class="breadcrumb-item text-panel" aria-current="page">Data Ke {{ $id }}</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="grid">
                <p class="grid-header">Output</p>
                <div class="item-wrapper p-2">
                    <div class="table-responsive">
                        <table id="datatable" class="display table info-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hasil as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item['stock_name'] }}</td>
                                        <td>{{ $item['new_class'] }}</td>
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

            });
        });

    </script>
@endpush
