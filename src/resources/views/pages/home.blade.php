@extends('layouts.topnav')

@section('page-title','Trang chủ')

@section('page-header','')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                        Khung tạo gần đây
                    </h3>
                </div>
                <div class="box-body">
                    <div class="wrapper-frame">
                        @if( $lastest->count() > 0 )
                            @foreach( $lastest as $frame )
                                <div class="col-md-3 item">
                                    <img src="{{ $frame->thumbnail() }}" alt="" class="thumnail">
                                    <a href="{{ $frame->permalink() }}" class="title">{{ $frame->title }}</a>
                                    <ul>
                                        <li>Người tạo: {{ $frame->user->name }}</li>
                                        <li>Ngày tạo: {{ $frame->created_at->diffForHumans() }}</li>
                                    </ul>
                                </div>
                            @endforeach
                        @else
                            <p>Chưa có khung nào được thêm.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                        Thống kê
                    </h3>
                </div>
                <div class="box-body">
                    <ul>
                        <li>Số khung đã thêm: {{ $frames->count() }}</li>
                        <li>Tổng số  lượt xem: {{ $frames->sum('view') }}</li>
                        <li>Tổng số  lượt sử dụng: {{ $frames->sum('count') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .item {
            box-shadow: 0px 1px 7px 0px rgba(0,0,0,0.1);
        }

        .item:hover {
            box-shadow: 0px 5px 30px 0px rgba(0,0,0,0.05);
        }

        .item .thumnail {
            width: 100%;
        }

        .item .title {
            display: block;
            margin: 15px 0;
            font-size: 1.25em;
            text-align: center;
        }

        .item ul {
            list-style: none;
            padding:0;
        }

    </style>
@endpush