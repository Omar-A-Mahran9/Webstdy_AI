@extends('dashboard.partials.master')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">

            <div class="d-flex flex-column gap-5 gap-lg-10">
                <!--begin::Contact Card-->
                <div class="card card-flush">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">
                            <h2>{{ __('Contact Message Details') }}</h2>
                        </div>

                        @if (!$contact->reply)
                            <span class="badge badge-light-warning fs-6 px-4 py-2">
                                {{ __('Pending Reply') }}
                            </span>
                        @else
                            <span class="badge badge-light-success fs-6 px-4 py-2">
                                {{ __('Replied') }}
                            </span>
                        @endif

                    </div>

                    <div class="card-body">
                        <div class="row">
                            <!--begin::Details-->
                            <div class="col-md-12">
                                <table class="table table-row-bordered align-middle">
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="text-muted">{{ __('Full Name') }}</td>
                                            <td class="text-end">{{ $contact->full_name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('Email') }}</td>
                                            <td class="text-end">{{ $contact->email }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('Phone') }}</td>
                                            <td class="text-end">{{ $contact->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('Country') }}</td>
                                            <td class="text-end">{{ $contact->country->name_en ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('Service') }}</td>
                                            <td class="text-end">{{ $contact->service->name_en ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('Message') }}</td>
                                            <td class="text-end">{{ $contact->description }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('Reply') }}</td>
                                            <td class="text-end">
                                                @if ($contact->reply)
                                                    {{ $contact->reply }}
                                                    <br>
                                                    <small class="text-muted">{{ __('Replied at') }}:
                                                        {{ $contact->replied_at ? $contact->replied_at : '-' }}</small>
                                                @else
                                                    <span
                                                        class="badge badge-light-warning">{{ __('Not Replied Yet') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{ __('Created At') }}</td>
                                            <td class="text-end">{{ $contact->created_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Details-->
                        </div>
                    </div>
                </div>
                <!--end::Contact Card-->
                @if (!$contact->reply)
                    <div class="card mt-5">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Send a Reply') }}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('dashboard.contact.reply', $contact->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group mb-3">
                                    <label for="reply" class="form-label">{{ __('Reply Message') }}</label>
                                    <textarea name="reply" id="reply" rows="5" class="form-control" required>{{ old('reply') }}</textarea>
                                    @error('reply')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> {{ __('Send Reply') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
