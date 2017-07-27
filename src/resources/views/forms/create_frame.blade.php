@extends('layouts.topnav')

@section('page-title','Thêm khung mới')

@section('page-header','')

@section('content')
    @if( Session::has('success') )
        <div class="alert alert-{{session('success') ? 'success' : 'danger'}}"><strong>{{ session('message') }}</strong></div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm khung mới</h3>
                </div>
                <div class="box-body">
                    {{ Form::open(['files'=>true]) }}

                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        {{ Form::label('title','Tiêu đề') }}
                        {{ Form::text('title', old('title'), ['class'=>'form-control','required','autofocus']) }}
                        @if( $errors->has('title') )
                            <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        {{ Form::label('description','Mô tả') }}
                        {{ Form::textarea('description', old('description'), ['class'=>'form-control']) }}
                        @if( $errors->has('description') )
                            <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                        {{ Form::label('slug','Đường dẫn') }}
                        {{ Form::text('slug', old('slug'), ['class'=>'form-control','required']) }}
                        @if( $errors->has('slug') )
                            <span class="help-block"><strong>{{ $errors->first('slug') }}</strong></span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('picture') ? 'has-error' : '' }}">
                        {{ Form::label('picture','Khung ảnh') }}
                        {{ Form::file('picture', ['class'=>'form-control','required']) }}
                        @if( $errors->has('picture') )
                            <span class="help-block"><strong>{{ $errors->first('picture') }}</strong></span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('default_picture') ? 'has-error' : '' }}">
                        {{ Form::label('default_picture','Ảnh mặc định') }}
                        {{ Form::file('default_picture', ['class'=>'form-control','required']) }}
                        @if( $errors->has('default_picture') )
                            <span class="help-block"><strong>{{ $errors->first('default_picture') }}</strong></span>
                        @endif
                    </div>

                    <div class="form-group">
                        {{ Form::submit('Thêm mới',['class'=>'btn btn-primary']) }}
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function(){
            $('[name="title"]').change(function(){
                $.post('{{ route('slug') }}', {
                    '_token':'{{ csrf_token() }}',
                    'title':$(this).val()
                },function(res){
                    $('[name="slug"]').val(res.slug);
                });
            });
        });
    </script>
@endpush