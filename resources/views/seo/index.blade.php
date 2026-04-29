@extends('backend.include.layout')
@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="">SEO Plugin</a>
            </li>
            <li class="breadcrumb-item active">{{ $pageName }}</li>
        </ol>
    </nav>
    <div class="mb-9">
        <div class="row g-3 mb-4">
            <div class="col-auto">
                <h2 class="mb-0">{{ ucfirst($pageName) }}</h2>
            </div>
        </div>
        <div class="mb-4">
            <div class="row g-3">
                <div class="col-auto">
                    <div class="search-box">
                        <form class="position-relative" action="">
                            <input class="form-control search-input search" type="search" name="string"
                                placeholder="Search orders" aria-label="Search" value="{{ request()->string }}" />
                            <span class="fas fa-search search-box-icon"></span>
                        </form>
                    </div>
                </div>
                <div class="col-auto scrollbar overflow-hidden-y flex-grow-1">
                    <div class="btn-group position-static" role="group">
                        <div class="btn-group position-static text-nowrap" role="group">
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="">Action</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">Another action</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">Something else here</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">Separated link</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
            <div class="table-responsive scrollbar mx-n1 px-1">
                <table id="dataTable" class="table fs-9 mb-0">
                    <thead>
                        <tr>
                            <th class="white-space-nowrap align-middle fs-9 ">Sr. No</th>
                            <th class="white-space-nowrap align-middle">Title</th>
                            <th class="white-space-nowrap align-middle ">Tenant </th>
                            <th class="white-space-nowrap align-middle ">Status</th>
                            <th class="white-space-nowrap align-middle ">Created At</th>
                            <th class="white-space-nowrap align-middle ">Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $seo)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $seo->name }}</td>
                                <td class="align-middle">{{ $seo->tenant->name ?? 'N/A' }}</td>
                                <td class="align-middle">
                                    <span class="badge badge-phoenix fs-10 badge-phoenix-success">Active</span>
                                </td>
                                <td class="align-middle">{{ $seo->created_at->format('d-m-Y') }}</td>
                                <td class="align-middle white-space-nowrap">
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('admin.seo-plugin.edit', ['type' => $type, 'id' => $seo->id]) }}"><i
                                            class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
@section('script')
    @include('backend.partial.datatable-scripts')

    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: false,
                dom: 'Bt<"d-flex flex-between-center py-3"ip>',
                language: {
                    paginate: {
                        previous: '<span class="fas fa-chevron-left"></span>',
                        next: '<span class="fas fa-chevron-right"></span>'
                    }
                }
            });
        });
    </script>
@endsection
