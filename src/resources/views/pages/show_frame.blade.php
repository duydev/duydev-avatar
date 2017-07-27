@extends('layouts.topnav')

@section('page-header','')

@section('content')
    @if( Session::has('success') )
        <div class="alert alert-{{session('success') ? 'success' : 'danger'}}"><strong>{{ session('message') }}</strong></div>
    @endif
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ $frame->title }}</h3>
                </div>
                <div class="box-body">
                    <div class="wrapper">
                        <img src="{{ $frame->picture() }}" class="frame-hidden">
                        <div class="default">
                            <img src="{{ $frame->default_picture() }}">
                        </div>
                        <img src="{{ $frame->picture() }}" class="frame">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Chức Năng</h3>
                </div>
                <div class="box-body">
                    {{ Form::file('image',['class'=>'hidden','id'=>'image']) }}
                    <button class="btn btn-primary col-md-12 btn-upload"><i class="fa fa-upload"></i> Chọn ảnh</button>
                    <button class="btn btn-default col-md-6 btn-rotate-left"><i class="fa fa-undo"></i></button>
                    <button class="btn btn-default col-md-6 btn-rotate-right"><i class="fa fa-repeat"></i></button>
                    <button class="btn btn-default col-md-6 btn-zoom-in"><i class="fa fa-search-plus"></i></button>
                    <button class="btn btn-default col-md-6 btn-zoom-out"><i class="fa fa-search-minus"></i></button>
                    <button class="btn btn-default col-md-6 btn-flip-horizon"><i class="fa fa-arrows-h"></i></button>
                    <button class="btn btn-default col-md-6 btn-flip-vertical"><i class="fa fa-arrows-v"></i> </button>
                    <button class="btn btn-default col-md-12 btn-reset"><i class="fa fa-refresh"></i> Làm lại</button>
                    <button class="btn btn-success col-md-12 btn-download"><i class="fa fa-download"></i> Tải ảnh</button>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Hướng dẫn sử dụng</h3>
                </div>
                <div class="box-body">
                    <ol class="guide">
                        <li>Nhấn vào nút chọn ảnh và <span class="text-info">[ Chọn ảnh ]</span> của bạn.</li>
                        <li>Dùng các nút chức năng để chỉnh sửa hình ảnh.</li>
                        <li>Nhấn vào nút <span class="text-info">[ Tải về ]</span> để tải về máy của bạn.</li>
                    </ol>
                </div>
            </div>
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
    <style>
        .wrapper {
            position: relative;
        }

        .frame-hidden {
            visibility: hidden;
            max-width: 100%;
            min-width: 100%;
        }

        .default {
            position: absolute;
            width:100%;
            height:100%;
            top:0;
        }

        .frame {
            position: absolute;
            max-width: 100%;
            min-width: 100%;
            top: 0;
            z-index: 1;
        }

        .cropper-move {
            z-index:2;
        }

        .guide {
            font-size: 1.25em;
        }

    </style>
@endpush

@push('js')
    <script src="{{ asset('cropper/cropper.min.js') }}"></script>
    <script>
        $(function(){
            var cropzone = $('.default img');
            var scaleX = 1, scaleY = 1;
            var clickEvent = new MouseEvent("click", {
                "view": window,
                "bubbles": true,
                "cancelable": false
            });

            cropzone.cropper({
                dragMode:'move',
                center: false,
                guides: false,
                modal: false,
                cropBoxMovable: false,
                cropBoxResizable: false,
                minCropBoxWidth:80000,
                minCropBoxHeight:80000,
            });

            $('.btn-upload').click(function(){
                $('#image').click();
            });

            $('#image').change(function (e) {
                var file = e.target.files[0];
                if (!file) { return; }
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image_url = e.target.result;
                    cropzone.cropper('replace', image_url);
                };
                reader.readAsDataURL(file);
            });

            $('.btn-rotate-left').click(function () {
                cropzone.cropper('rotate', -90);
            });

            $('.btn-rotate-right').click(function () {
                cropzone.cropper('rotate', 90);
            });

            $('.btn-zoom-in').click(function () {
                cropzone.cropper('zoom', 0.1);
            });

            $('.btn-zoom-out').click(function () {
                cropzone.cropper('zoom', -0.1);
            });

            $('.btn-flip-horizon').click(function () {
                scaleX = -scaleX;
                cropzone.cropper('scaleX', scaleX);
            });

            $('.btn-flip-vertical').click(function () {
                scaleY = -scaleY;
                cropzone.cropper('scaleY', scaleY);
            });

            $('.btn-reset').click(function () {
                cropzone.cropper('reset');
                scaleX = 1;
                scaleY = 1;
            });

            $('.btn-download').click(function () {
                cropzone.cropper('getCroppedCanvas').toBlob(function (blob) {
                    var formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('image', blob);

                    $.ajax('{{ route('process_frame',[$frame->slug]) }}', {
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            if( res.image ) {
                                downloadURI( res.image , 'avatar.png' );
                            } else {
                                alert( res.message );
                            }
                        },
                        error: function () {
                            alert('Gặp lỗi trong quá trình xử lý ảnh. Vui lòng nhấn F5 đẻ tải lại trang và thử lại.');
                        }
                    });


                });
            });

            function downloadURI(uri, name) {
                var link = document.createElement("a");
                link.download = name;
                link.href = uri;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                delete link;
            }

        });
    </script>
@endpush