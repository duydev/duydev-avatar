@extends('layouts.topnav')

@section('page-header','')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ $frame->title }}</h3>
                </div>
                <div class="box-body">
                    <div class="image-wrapper" style="background-image: url('{{ $frame->picture() }}')">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            Sidebar
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-body">
                    <div class="avatar">
                        <img src="{{ $frame->user->avatar() }}" alt="">
                    </div>
                    <div class="info">
                        <ul>
                            <li>{{ $frame->user->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('cropper/cropper.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('cropper/cropper.min.js') }}"></script>
    <script>
        $(function(){
            $('.image-wrapper img').cropper({

            });
        });
    </script>
@endpush