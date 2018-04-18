@extends('layouts.app')
@section('style')
<link rel="stylesheet" type="text/css" href="/css/index.css">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <div class="index_map">
                        <img src="/images/1.jpg">
                    </div>
                    <div class="index_map">
                        <img src="/images/1.jpg">
                    </div>
                    <div class="index_map">
                        <img src="/images/1.jpg">
                    </div>
                    <div class="index_map">
                        <img src="/images/1.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
