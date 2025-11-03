@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Brand Information</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <a href="{{ route('admin.brands') }}">
                            <div class="text-tiny">Brands</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <div class="text-tiny">New Brand</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <form id="brandForm" class="form-new-product form-style-1" action="{{ route('admin.brands.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Brand Name <span class="tf-color-1">*</span></div>
                        <input type="text" name="name" class="flex-grow" placeholder="Brand name"
                            value="{{ old('name') }}" required>
                    </fieldset>
                    @error('name')
                        <span class="alert alert-danger">{{ $message }}</span>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title">Brand Slug <span class="tf-color-1">*</span></div>
                        <input type="text" name="slug" class="flex-grow" placeholder="Brand slug"
                            value="{{ old('slug') }}" required>
                    </fieldset>
                    @error('slug')
                        <span class="alert alert-danger">{{ $message }}</span>
                    @enderror

                    <fieldset>
                        <div class="body-title">Upload Image <span class="tf-color-1">*</span></div>
                        <div class="upload-image flex-grow">
                            <div class="item" id="imgpreview" style="display:none">
                                <img src="" class="effect8" alt="Preview">
                            </div>
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon"><i class="icon-upload-cloud"></i></span>
                                    <span class="body-text">Drop your image here or <span class="tf-color">click to
                                            browse</span></span>
                                    <input type="file" id="myFile" name="image" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    @error('image')
                        <span class="alert alert-danger">{{ $message }}</span>
                    @enderror

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('lib.widgets.confirm')
    @include('lib.widgets.notification')
    <script>
        $(document).ready(function() {
            $("#myFile").on("change", function() {
                const [file] = this.files;
                if (file) {
                    $("#imgpreview img").attr('src', URL.createObjectURL(file));
                    $("#imgpreview").show();
                } else {
                    $("#imgpreview").hide();
                }
            });
        });

        $("input[name='name']").on("input", function() {
            $("input[name='slug']").val(stringToSlug($(this).val()));
        });

        function stringToSlug(str) {
            return str.toLowerCase().trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-');
        }

        const form = document.getElementById('brandForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            showConfirmPopup({
                title: '📝 Confirm adding new brand?',
                text: 'Please review the information before saving.',
                confirmText: '✅ Create Brand',
                cancelText: '❌ Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
