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
<!-- Grup Perusahaan start -->
<!-- list and filter start -->
<div class="card">
    <div class="card-body border-bottom">
        <h4 class="card-title">List Data</h4>
        <div class="button" align="right">
            <button class="add-new btn btn-primary" data-bs-toggle="modal" data-bs-target='#modals-slide-in'>
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
                                    <th>Kode</th>
                                    <th>Nama Grup</th>
                                    <th>Telp</th>
                                    <th>Email</th>
                                    <th>Fax</th>
                                    <th>Alamat</th>
                                    <th>Aktif</th>
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

<!-- Modal to add new Grup Perusahaan starts-->
<div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
    <div class="modal-dialog">
        <form class="modal-content pt-0" method="POST" id="postForm">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Tambah @yield('title')</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Kode @yield('title')</label>
                    <input type="text" class="form-control dt-full-name" id="kode" {{-- placeholder="John Doe" --}}
                        name="kode" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Nama @yield('title')</label>
                    <input type="text" class="form-control dt-full-name" id="nama" {{-- placeholder="John Doe" --}}
                        name="nama" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Telepon</label>
                    <input type="text" class="form-control dt-full-name" id="telp" {{-- placeholder="John Doe" --}}
                        name="telp" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Email</label>
                    <input type="text" class="form-control dt-full-name" id="email" {{-- placeholder="John Doe" --}}
                        name="email" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Fax</label>
                    <input type="text" class="form-control dt-full-name" id="fax" {{-- placeholder="John Doe" --}}
                        name="fax" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Alamat</label>
                    <input type="text" class="form-control dt-full-name" id="alamat" {{-- placeholder="John Doe" --}}
                        name="alamat" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="country">Aktif</label>
                    <select class="select2 form-select" name="aktif" id="aktif">
                        <option value="Y">Ya</option>
                        <option value="T">Tidak</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary me-1 data-submit" id="SubmitData">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
<!-- Modal to add new Grup Perusahaan Ends-->


<!-- Modal to edit Grup Perusahaan starts-->
<div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in2">
    <div class="modal-dialog">
        <div class="modal-content pt-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Edit @yield('title')</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div id="EditModal">

                </div>
                <button type="submit" class="btn btn-primary me-1 data-submit" id="UpdateData">Update</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal to edit Grup Perusahaan Ends-->
</section>
<!-- Grup Perusahaan ends -->
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
            ajax: "{{ url('master/grup-perusahaan') }}",
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
                    data: 'kode',
                    name: 'kode'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'telp',
                    name: 'telp'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'fax',
                    name: 'fax'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'aktif',
                    name: 'aktif'
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
                url: "{{ route('grup-perusahaan.store') }}",
                method: 'post',
                data: {
                    kode: $('#kode').val(),
                    nama: $('#nama').val(),
                    telp: $('#telp').val(),
                    alamat: $('#alamat').val(),
                    email: $('#email').val(),
                    fax: $('#fax').val(),
                    aktif: $('#aktif').val(),
                },
                success: function (result) {
                    if (result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function (key, value) {
                            toastr.error(result.errors);
                        });
                    } else {
                        $('#modals-slide-in').modal('hide');
                        toastr.success(result.success);
                        $('.datatable').DataTable().ajax.reload();
                    }
                }
            });
        });

        // Get single data in Edit Model
        $('.btn-close').on('click', function () {
            $('#modals-slide-in2').modal("hide");
        });
        $('body').on('click', '#getEditGrupPerusahaan', function (e) {
            // e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: "grup-perusahaan/" + id + "/edit",
                type: 'GET',
                // data: {
                //     id: id,
                // },
                success: function (result) {
                    $('#EditModal').html(result.html);
                    $('#modals-slide-in2').modal("show");
                }
            });
        });

        // Update data Ajax request.
        $('#UpdateData').click(function (e) {
            var id = $('#editkode').val();
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "grup-perusahaan/" + id,
                method: 'PUT',
                data: {
                    kode: $('#editkode').val(),
                    nama: $('#editnama').val(),
                    telp: $('#edittelp').val(),
                    fax: $('#editfax').val(),
                    email: $('#editemail').val(),
                    alamat: $('#editalamat').val(),
                    aktif: $('#editaktif').val()
                },
                success: function (result) {
                    if (result.errors) {
                        $.each(result.errors, function (key, value) {
                            toastr.error(result.errors);
                        });
                    } else {
                        $('#modals-slide-in2').modal('hide');
                        toastr.success(result.success);
                        $('.datatable').DataTable().ajax.reload();
                    }
                }
            });
        });

        // Delete data Ajax request.
        $(document).on('click', '#getDeleteGrupPerusahaan', function (e) {
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
                            kode: id
                        },
                        url: "grup-perusahaan/" + id,
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
