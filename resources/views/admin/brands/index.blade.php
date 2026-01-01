@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Brands</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Brands</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name"
                                    tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.brands.create') }}"><i class="icon-plus"></i>Add
                        new</a>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Category</th>
                                    <th>Products</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="pname">
                                            <div class="image">
                                                <img src="{{ asset('uploads/brands/' . $brand->image) }}"
                                                    alt="{{ $brand->name }}" class="image">
                                            </div>
                                            <div class="name">
                                                <a href="#" class="body-title-2">{{ $brand->name }}</a>
                                            </div>
                                        </td>
                                        <td>{{ $brand->slug }}</td>
                                        <td>
                                            @if ($brand->categories->count() > 0)
                                                @foreach ($brand->categories as $category)
                                                    <span class="badge bg-primary">{{ $category->name }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">No category</span>
                                            @endif
                                        </td>
                                        <td>{{ $brand->products->count() }}</td>
                                        <td>
                                            <div class="list-icon-function d-flex gap-2">
                                                <a href="{{ route('admin.brands.edit', $brand->id) }}">
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                </a>
                                                <form action="{{ route('admin.brands.delete', $brand->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="item text-danger delete border-0 bg-transparent p-0">
                                                        <i class="icon-trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                        {{ $brands->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('lib.widgets.confirm')
    @include('lib.widgets.notification')
    <script>
        $((function() {
            $('.delete').on('click', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                showConfirmPopup({
                    title: '🗑️ Confirm delete brand?',
                    text: 'This action cannot be undone.',
                    type: 'warning',
                    confirmText: '✅ Delete Brand',
                    cancelText: '❌ Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        }));
    </script>
@endpush
