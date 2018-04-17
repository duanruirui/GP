@extends('layouts.app')
@section('style')
<style type="text/css">
.index_map{
    width:50%;
    height: auto;
    margin:0 auto;
    padding: 0 auto;
}
.index_map img{
    width:90%;
    margin:0 auto;
}
</style>
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
                        <img src="http://img.tupianzj.com/uploads/allimg/160812/9-160Q2215I3.jpg">
                    </div>
                    <div class="index_map">
                        <img src="http://img.tupianzj.com/uploads/allimg/160812/9-160Q2215I3.jpg">
                    </div>
                    <div class="index_map">
                        <img src="http://img.tupianzj.com/uploads/allimg/160812/9-160Q2215I3.jpg">
                    </div>
                    <div class="index_map">
                        <img src="http://img.tupianzj.com/uploads/allimg/160812/9-160Q2215I3.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
