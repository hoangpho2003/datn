@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <!-- Header -->
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Update User Status</h3>
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
                        <a href="{{ route('admin.users') }}">
                            <div class="text-tiny">Users</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Update Status</div>
                    </li>
                </ul>
            </div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="wg-box">
                    <fieldset class="mb-24">
                        <div class="body-title mb-10">User Name</div>
                        <input class="form-control" type="text" value="{{ $user->name }}" disabled>
                    </fieldset>

                    <fieldset class="mb-24">
                        <div class="body-title mb-10">Email</div>
                        <input class="form-control" type="text" value="{{ $user->email }}" disabled>
                    </fieldset>

                    <fieldset class="mb-24">
                        <div class="body-title mb-10">
                            Account Status <span class="tf-color-1">*</span>
                        </div>
                        <select class="form-control" name="status" required>
                            <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                            <option value="banned" {{ $user->status === 'banned' ? 'selected' : '' }}>
                                Banned
                            </option>
                        </select>
                        @error('status')
                            <span class="text-danger text-tiny">{{ $message }}</span>
                        @enderror
                    </fieldset>

                    <div class="flex items-center justify-end gap10">
                        <a href="{{ route('admin.users') }}" class="tf-button style-2 w150">
                            Cancel
                        </a>

                        <button type="submit" class="tf-button style-1 w150">
                            <i class="icon-save"></i> Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
