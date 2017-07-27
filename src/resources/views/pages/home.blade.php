@extends('layouts.topnav')

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
                    @if( $lastest->count() > 0 )
                        @foreach( $lastest as $frame )
                            <div class="col-md-3">
                                <a href="{{ $frame->permalink() }}">{{ $frame->title }}</a>
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
        <div class="col-md-4">

        </div>
    </div>
@endsection