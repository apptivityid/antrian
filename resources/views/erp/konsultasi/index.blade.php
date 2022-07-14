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
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}">
@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

@section('content')
<!-- Konsultasi Start -->
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
                                    <th>No. KTP</th>
                                    <th>Nama Pasien</th>
                                    <th>Tanggal Berobat</th>
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

<!-- Modal to add new Konsultasi Starts-->
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
                        <label class="form-label" for="no_ktp"><font style="color: red">*</font> Pasien</label>
                        <select class="select2 form-select" name="id_pasien" id="id_pasien">
                            <option value="">Pilih</option>
                            @foreach ( $pasien as $p)
                            <option value="{{ $p->id }}">{{ $p->no_ktp }} | {{ $p->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="tanggal"><font style="color: red">*</font> Tanggal Berobat</label>
                        <input class="form-control" id="tanggal" type="date" name="tanggal" aria-describedby="tanggal" autofocus="" tabindex="1" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="keterangan">Konsultasi</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="resep">Resep</label>
                        <textarea class="form-control" name="resep" id="resep" cols="30" rows="10"></textarea>
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
<!-- Modal to add new Konsultasi Ends-->


<!-- Modal to edit Konsultasi Starts-->
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
<!-- Modal to edit Konsultasi Ends-->

<!-- Modal to view Konsultasi Starts-->
<div class="modal fade" id="exampleModalScrollable3" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content pt-0">
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Detail @yield('title')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body flex-grow-1">
                <div id="ViewModal">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal to view Konsultasi Ends-->
</section>
<!-- Konsultasi Ends -->
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
            ajax: "{{ url('konsultasi') }}",
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
                    data: 'no_ktp',
                    name: 'no_ktp'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
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
                url: "{{ route('konsultasi.store') }}",
                method: 'post',
                data: {
                    id_pasien: $('#id_pasien').val(),
                    tanggal: $('#tanggal').val(),
                    keterangan: $('#keterangan').val(),
                    resep: $('#resep').val()
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

        // Get single data in View Model
        $('.btn-close').on('click', function () {
            $('#exampleModalScrollable3').modal("hide");
        });
        $('body').on('click', '#getViewKonsultasi', function (e) {
            // e.preventDefault();
            id = $(this).data('id');
            $.ajax({
                url: "konsultasi/" + id + "/edit",
                type: 'GET',
                // data: {
                //     id: id,
                // },
                success: function (result) {
                    $('#ViewModal').html(result.html2);
                    $('#exampleModalScrollable3').modal("show");
                }
            });
        });

        // Get single data in Edit Model
        $('.btn-close').on('click', function () {
            $('#exampleModalScrollable2').modal("hide");
        });
        $('body').on('click', '#getEditKonsultasi', function (e) {
            // e.preventDefault();
            id = $(this).data('id');
            $.ajax({
                url: "konsultasi/" + id + "/edit",
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
                url: "konsultasi/" + id,
                method: 'PUT',
                data: {
                    id_pasien: $('#editid_pasien').val(),
                    tanggal: $('#edittanggal').val(),
                    keterangan: $('#editketerangan').val(),
                    resep: $('#editresep').val()
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
        $(document).on('click', '#getDeleteKonsultasi', function (e) {
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
                        url: "konsultasi/" + id,
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
