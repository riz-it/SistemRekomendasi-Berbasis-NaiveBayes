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
            <li class="breadcrumb-item text-panel" aria-current="page">Data Ke {{ $id }}</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="grid">
                <p class="grid-header">Rata rata</p>
                <div class="item-wrapper p-2">
                    <div class="table-responsive">
                        <table id="ratarata" class="display table info-table">
                            <thead>
                                <tr>
                                    <th>Kelas</th>
                                    <th>Stok Awal</th>
                                    <th>Masuk</th>
                                    <th>Keluar</th>
                                    <th>Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rata_rata as $item)
                                    <tr>
                                        <td>{{ $item['key'] }}</td>
                                        <td>{{ $item['AV1'] }}</td>
                                        <td>{{ $item['AV2'] }}</td>
                                        <td>{{ $item['AV3'] }}</td>
                                        <td>{{ $item['AV4'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="grid">
                <p class="grid-header">Deviasi</p>
                <div class="item-wrapper p-2">
                    <div class="table-responsive">
                        <table id="deviasi" class="display table info-table">
                            <thead>
                                <tr>
                                    <th>Kelas</th>
                                    <th>Stok Awal</th>
                                    <th>Masuk</th>
                                    <th>Keluar</th>
                                    <th>Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deviasi as $item)
                                    <tr>
                                        <td>{{ $item['key'] }}</td>
                                        <td><?= round($item['DV1'], 3) ?></td>
                                        <td><?= round($item['DV2'], 3) ?></td>
                                        <td><?= round($item['DV3'], 3) ?></td>
                                        <td><?= round($item['DV4'], 3) ?></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="grid">
                <p class="grid-header">Probabilitas</p>
                <div class="item-wrapper p-2">
                    <div class="table-responsive">
                        <table id="ratarata" class="display table info-table">
                            <thead>
                                <tr>
                                    <th>Kelas</th>
                                    <th>Probabilitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($probabilitas as $item)
                                    <tr>
                                        <td>{{ $item['key'] }}</td>
                                        <td>{{ $item['value'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th>Total :</th>
                                <th>{{ $count_probability }}</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>


    </script>
@endpush
