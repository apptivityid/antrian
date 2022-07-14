@extends('layouts/contentLayoutMaster')

@section('title', $breadcrumbs[1]['name'])

@section('vendor-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
<link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}">
@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

@section('content')
<!-- dokter start -->
<!-- list and filter start -->
<div class="card">
    <div class="card-body border-bottom">
        <h4 class="card-title">List Data</h4>
        <div class="button">
            <button class="add-new btn btn-primary" data-bs-toggle="modal" data-bs-target='#exampleModalScrollable'>
                <i data-feather="plus-circle" class="me-25"></i>
                <span>Tambah Data</span>
            </button>
        </div>
    </div>
    <!-- Ajax Sourced Server-side -->
    <section id="ajax-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-datatable">
                        <table class="datatables-ajax table table-responsive" id="posts-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Aksi</th>
                                    <th>Nama</th>
                                    <th>Spesialis</th>
                                    <th>Alamat</th>
                                    <th>No. Telp</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Ajax Sourced Server-side -->
</div>
<!-- list and filter end -->

<!-- Modal to add new dokter starts-->
<div class="scrolling-inside-modal">
    <!-- Modal -->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-content pt-0" method="POST" id="postForm">
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah @yield('title')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Nama @yield('title')</label>
                        <input type="text" class="form-control dt-full-name" id="nama" name="nama" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Spesialis</label>
                        <input type="text" class="form-control dt-full-name" id="spesialis" name="spesialis" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Nomor Telpon</label>
                        <input type="text" class="form-control dt-full-name" id="no_telp" name="no_telp" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Email</label>
                        <input type="text" class="form-control dt-full-name" id="email" name="email" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Password</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input class="form-control form-control-merge" id="password" type="password"
                                name="password" placeholder="············" aria-describedby="password"
                                tabindex="3" required />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Alamat</label>
                        <input type="text" class="form-control dt-full-name" id="alamat" name="alamat" />
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary me-1 data-submit" id="SubmitData">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal to add new dokter Ends-->


<!-- Modal to edit dokter starts-->
<div class="modal fade" id="exampleModalScrollable2" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content pt-0">
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Edit @yield('title')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body flex-grow-1">
                <div id="EditModal">

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary me-1 data-submit" id="UpdateData">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal to edit dokter Ends-->
</section>
<!-- dokter ends -->
@endsection

@section('vendor-script')
{{-- Vendor js files --}}
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection

@section('page-script')
{{-- Page js files --}}
<script src="{{ asset(mix('js/scripts/pages/app-user-list.js')) }}"></script>
@endsection

<script>
    $(document).ready(function () {
        var id;
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "showMethod": 'fadeIn',
            "hideMethod": 'fadeOut',
            "timeOut": 2000
        };

        var _url = "settings";
        // Show data server side method Start
        var table = $('#posts-table').DataTable({
            "oLanguage": {
                "sUrl": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json"
            },
            processing: true,
            serverSide: true,
            dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            ajax: "{{ url('dokter') }}",
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    sClass: 'text-center'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'spesialis',
                    name: 'spesialis'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'no_telp',
                    name: 'no_telp'
                },
                {
                    data: 'email',
                    name: 'email'
                }
            ]
        });
        // Show data server side method End

        // Create data Ajax request.
        $('#SubmitData').click(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('dokter.store') }}",
                method: 'post',
                data: {
                    nama: $('#nama').val(),
                    spesialis: $('#spesialis').val(),
                    alamat: $('#alamat').val(),
                    no_telp: $('#no_telp').val(),
                    email: $('#email').val()
                },
                success: function (result) {
                    if (result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function (key, value) {
                            toastr.error(result.errors);
                        });
                    } else {
                        $('#exampleModalScrollable').modal('hide');
                        toastr.success(result.success);
                        $('.datatable').DataTable().ajax.reload();
                    }
                }
            });
        });

        // Get single data in Edit Model
        $('.btn-close').on('click', function () {
            $('#exampleModalScrollable2').modal("hide");
        });
        $('body').on('click', '#getEditDokter', function (e) {
            // e.preventDefault();
            id = $(this).data('id');
            $.ajax({
                url: "dokter/" + id + "/edit",
                type: 'GET',
                // data: {
                //     id: id,
                // },
                success: function (result) {
                    $('#EditModal').html(result.html);
                    $('#exampleModalScrollable2').modal("show");
                }
            });
        });

        // Update data Ajax request.
        $('#UpdateData').click(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "dokter/" + id,
                method: 'PUT',
                data: {
                    nama: $('#editnama').val(),
                    spesialis: $('#editspesialis').val(),
                    alamat: $('#editalamat').val(),
                    no_telp: $('#editno_telp').val(),
                    email: $('#editemail').val()
                },
                success: function (result) {
                    if (result.errors) {
                        $.each(result.errors, function (key, value) {
                            toastr.error(result.errors);
                        });
                    } else {
                        $('#exampleModalScrollable2').modal('hide');
                        toastr.success(result.success);
                        $('.datatable').DataTable().ajax.reload();
                    }
                }
            });
        });

        // Delete data Ajax request.
        $(document).on('click', '#getDeleteDokter', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const url = $(this).attr('href');
            Swal.fire({
                title: 'Apakah anda yakin akan menghapus data ini?',
                // text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus data',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        data: {
                            id: id
                        },
                        url: "dokter/" + id,
                        method: 'DELETE',
                        success: function (result) {
                            Swal.fire({
                                icon: 'success',
                                // text: 'Dihapus!',
                                title: result.success,
                                customClass: {
                                    confirmButton: 'btn btn-success'
                                }
                            });
                            $('.datatable').DataTable().ajax.reload();
                        }
                    });
                }
            });
        })
    });

</script>
