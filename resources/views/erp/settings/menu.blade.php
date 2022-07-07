@extends('layouts/contentLayoutMaster')

@section('title', 'Settings')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel='stylesheet' href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
  <link rel='stylesheet' href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

@section('content')
<div class="row">
  <div class="col-12">
    <ul class="nav nav-pills mb-2">
      <!-- Account -->
      <li class="nav-item">
        <a class="nav-link" href="{{asset('page/account-settings-account')}}">
          <i data-feather="user" class="font-medium-3 me-50"></i>
          <span class="fw-bold">Web</span>
        </a>
      </li>
      <!-- security -->
      <li class="nav-item">
        <a class="nav-link active" href="{{asset('settings/menu')}}">
          <i data-feather="menu" class="font-medium-3 me-50"></i>
          <span class="fw-bold">Menu</span>
        </a>
      </li>
      <!-- billing and plans -->
      <li class="nav-item">
        <a class="nav-link" href="{{asset('page/account-settings-billing')}}">
          <i data-feather="bookmark" class="font-medium-3 me-50"></i>
          <span class="fw-bold">Billings &amp; Plans</span>
        </a>
      </li>
      <!-- notification -->
      <li class="nav-item">
        <a class="nav-link" href="{{asset('page/account-settings-notifications')}}">
          <i data-feather="bell" class="font-medium-3 me-50"></i>
          <span class="fw-bold">Notifications</span>
        </a>
      </li>
      <!-- connection -->
      <li class="nav-item">
        <a class="nav-link" href="{{asset('page/account-settings-connections')}}">
          <i data-feather="link" class="font-medium-3 me-50"></i>
          <span class="fw-bold">Connections</span>
        </a>
      </li>
    </ul>

    <!-- Menu start -->
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
                                        <th>Nama</th>
                                        <th>URL</th>
                                        <th>Icon</th>
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

    <!-- Modal to add new menu starts-->
    <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
        <div class="modal-dialog">
            <form class="modal-content pt-0" method="POST" id="postForm">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Nama Menu</label>
                        <input type="text" class="form-control dt-full-name" id="name" name="name" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Icon</label>
                        <select class="select2 form-select" name="icon" id="icon">
                            @foreach ( $icons as $i)
                            <option value="{{ $i->nama }}" data-icon="{{ $i->nama }}">{{ $i->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">URL</label>
                        <input type="text" class="form-control dt-full-name" id="url" name="url" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Class</label>
                        <select class="select2 form-select" name="class" id="class">
                            <option value="nav-item">Item</option>
                            <option value="navigation-header">Header</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Parent Menu</label>
                        <select class="select2 form-select" name="parent" id="parent">
                            <option value="Y">Ya</option>
                            <option value="T">Tidak</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Parent Code</label>
                        <input type="text" class="form-control dt-full-name" id="parent_code" name="parent_code" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Sequence</label>
                        <input type="text" class="form-control dt-full-name" id="sequence" name="sequence" />
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
    <!-- Modal to add new menu Ends-->


    <!-- Modal to edit menu starts-->
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
    <!-- Modal to edit Menu Ends-->
    </section>
    <!-- Menu ends -->
    <!--/ menu -->
  </div>
</div>
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>

@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/page-account-settings-account.js')) }}"></script>
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

        var select = $('#icon');

        // Select With Icon
        select.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                dropdownAutoWidth: true,
                width: '100%',
                // minimumResultsForSearch: Infinity,
                dropdownParent: $this.parent(),
                templateResult: iconFormat,
                templateSelection: iconFormat,
                escapeMarkup: function (es) {
                    return es;
                }
            });
        });

        // Format icon
        function iconFormat(icon) {
            var originalOption = icon.element;
            if (!icon.id) {
                return icon.text;
            }

            var $icon = feather.icons[$(icon.element).data('icon')].toSvg() + icon.text;

            return $icon;
        }

        // Show data server side method Start
        var table = $('#posts-table').DataTable({
            "oLanguage": {
                "sUrl": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json"
            },
            processing: true,
            serverSide: true,
            dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            ajax: "{{ url('settings/menu') }}",
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'url',
                    name: 'url'
                },
                {
                    data: 'icon',
                    name: 'icon',
                    render: function (data) {
                        return "<span class='text-truncate align-middle'>" + feather.icons[data].toSvg({ class: 'font-medium-3 text-primary me-50' }) + data + '</span>';
                    }
                },
                {
                    data: 'active',
                    name: 'active'
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
                url: "{{ route('storeMenu') }}",
                method: 'post',
                data: {
                    name: $('#name').val(),
                    url: $('#url').val(),
                    icon: $('#icon').val(),
                    class: $('#class').val(),
                    parent: $('#parent').val(),
                    parent_code: $('#parent_code').val(),
                    sequence: $('#editsequence').val(),
                    active: $('#aktif').val()
                },
                success: function (result) {
                    if (result.errors) {
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
        $('body').on('click', '#getEditMenu', function (e) {
            // e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: "menu/" + id + "/editMenu",
                type: 'GET',
                // data: {
                //     id: id,
                // },
                success: function (result) {
                    $('#EditModal').html(result.html);
                    $('#modals-slide-in2').modal("show");
                    // Select With Icon
                    $('#editicon').each(function () {
                        var $this = $(this);
                        $this.wrap('<div class="position-relative"></div>');
                        $this.select2({
                            dropdownAutoWidth: true,
                            width: '100%',
                            // minimumResultsForSearch: Infinity,
                            dropdownParent: $this.parent(),
                            templateResult: iconFormat,
                            templateSelection: iconFormat,
                            escapeMarkup: function (es) {
                                return es;
                            }
                        });
                    });
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
                url: "menu/" + id,
                method: 'PUT',
                data: {
                    name: $('#editname').val(),
                    url: $('#editurl').val(),
                    icon: $('#editicon').val(),
                    class: $('#editclass').val(),
                    parent: $('#editparent').val(),
                    parent_code: $('#editparent_code').val(),
                    sequence: $('#editsequence').val(),
                    active: $('#editaktif').val()
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
        $(document).on('click', '#getDeleteMenu', function (e) {
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
                        url: "destroyMenu/" + id,
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
