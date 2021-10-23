@extends('layouts.main')
@section('title', 'Dashboard')
@section('header')
    <div class="row">
        <div class="col-12 py-5">
            <h4>Dashboard</h4>
            <p class="text-gray">Selamat datang, {{ Auth::user()->name }}</p>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-5">
            <div class="jumbotron">
                <p class="text-panel" style="color: white; font-size: 25px">Sistem Rekomendasi UD Hamdalah Jaya
                    menggunakan metode Naive Bayes.</p>
                <br>
            </div>
        </div>
        <div class="col-lg-7 mx-auto">
            <div class="grid">
                <div class="grid-body">
                    <h5 class="card-title">Keterangan :</h5>
                    <hr>
                    <p class="card-text"> - Data yang diinput minimal 2 data.</p>
                    <hr>
                    <h5 class="card-title">Format import excel :</h5>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">data_to</th>
                                <th scope="col">stock_name</th>
                                <th scope="col">first_stock</th>
                                <th scope="col">stock_out</th>
                                <th scope="col">stock_in</th>
                                <th scope="col">last_stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>Material</td>
                                <td>40</td>
                                <td>5</td>
                                <td>10</td>
                                <td>35</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>

    </script>
@endpush
