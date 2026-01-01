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
                        <div class="text-tiny">Edit Brand</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <form id="brandForm" class="form-new-product form-style-1" action="{{ route('admin.brands.update') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $brand->id }}">
                    <fieldset class="name">
                        <div class="body-title">Brand Name <span class="tf-color-1">*</span></div>
                        <input type="text" name="name" class="flex-grow" placeholder="Brand name"
                            value="{{ $brand->name }}" required>
                    </fieldset>
                    @error('name')
                        <span class="alert alert-danger">{{ $message }}</span>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title">Brand Slug <span class="tf-color-1">*</span></div>
                        <input type="text" name="slug" class="flex-grow" placeholder="Brand slug"
                            value="{{ $brand->slug }}" required>
                    </fieldset>
                    @error('slug')
                        <span class="alert alert-danger">{{ $message }}</span>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title">Category <span class="tf-color-1">*</span></div>
                        <select name="category_id" class="flex-grow" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $brand->categories->contains($category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </fieldset>
                    @error('category_id')
                        <span class="alert alert-danger">{{ $message }}</span>
                    @enderror

                    <fieldset>
                        <div class="body-title">Upload Image <span class="tf-color-1">*</span></div>
                        <div class="upload-image flex-grow">
                            @if ($brand->image)
                                <div class="item" id="imgpreview">
                                    <img src="{{ asset('uploads/brands') }}/{{ $brand->image }}" class="effect8"
                                        alt="Preview">
                                </div>
                            @endif
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
                title: '📝 Confirm update brand?',
                text: 'Please review the information before saving.',
                confirmText: '✅ Update Brand',
                cancelText: '❌ Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
