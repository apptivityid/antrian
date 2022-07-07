@extends('layouts/contentLayoutMaster')

@section('title', 'Perusahaan')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- users list start -->
<!-- <section class="app-user-list">
  <div class="row">
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">21,459</h3>
            <span>Total Users</span>
          </div>
          <div class="avatar bg-light-primary p-50">
            <span class="avatar-content">
              <i data-feather="user" class="font-medium-4"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">4,567</h3>
            <span>Paid Users</span>
          </div>
          <div class="avatar bg-light-danger p-50">
            <span class="avatar-content">
              <i data-feather="user-plus" class="font-medium-4"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">19,860</h3>
            <span>Active Users</span>
          </div>
          <div class="avatar bg-light-success p-50">
            <span class="avatar-content">
              <i data-feather="user-check" class="font-medium-4"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">237</h3>
            <span>Pending Users</span>
          </div>
          <div class="avatar bg-light-warning p-50">
            <span class="avatar-content">
              <i data-feather="user-x" class="font-medium-4"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <!-- list and filter start -->

<div class="card">
    <div class="card-body border-bottom">
        <h4 class="card-title">Data Perusahaan</h4>
        <div class="row">
            <div class="col-md-4 user_role"></div>
            <div class="col-md-4 user_plan"></div>
            <div class="col-md-4 user_status"></div>
            <div class="col-md-12" align="right">
                <button class="add-new btn btn-primary" data-bs-toggle="modal" data-bs-target='#modals-slide-in'>Tambah
                    Perusahaan</button>
            </div>
        </div>
    </div>
    <div class="card-datatable table-responsive pt-0">
        {{-- <table class="user-list-table table"> --}}
            <table class="table" id="tabeldata">
                <thead class="table-light">
                    <tr>
                        <th width="5px">No</th>
                        <th>ID</th>
                        <th>Nama Perusahaan</th>
                        <th>Grup</th>
                        <th>Telp</th>
                        <th>Email</th>
                        <th>Fax</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $perusahaan as $index => $p)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $p-> nomor }}</td>
                        <td>{{ $p-> nama }}</td>
                        <td>{{ $p-> nogrup }}</td>
                        <td>{{ $p-> telp }}</td>
                        <td>{{ $p-> email }}</td>
                        <td>{{ $p-> fax }}</td>
                        <td>{{ $p-> alamat }}</td>
                        <td>
                            <button data-bs-toggle="modal" data-bs-target='#modals-slide-in2'
                                class="btn btn-warning btn-sm" href="/perusahaan/update/{{ $p-> nomor }}" data-toggle='modal' data-target='#form2'
                                data-id="{{ $p-> nomor }}"> <i class="fas fa-pencil-alt"></i></button>
                            <a class="btn btn-danger btn-sm"
                                onclick="return confirm('Menghapus ini akan menghilangkan data selamanya, Anda yakin?')"
                                href="/Perusahaan/delete/{{ $p-> nomor }}"> <i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    <!-- Modal to add new user starts-->
    <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
        <div class="modal-dialog">
            <form class=" modal-content pt-0" id="form1" method="post">
                @csrf
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Perusahaan</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">ID Perusahaan</label>
                        <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname"
                            placeholder="John Doe" name="id_perusahaan" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-uname">Nama Perusaahn</label>
                        <input type="text" id="basic-icon-default-uname" class="form-control dt-uname"
                            placeholder="Web Developer" name="nama_perusahaan" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="country">Grup</label>
                        <select id="country" name="nogrup" class="select2 form-select">
                            <option value="" selected disabled>Pilih Satu</option>
                            <option value="Australia">Sumatera</option>
                            <option value="Australia">Kalimantan</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-contact">Telp</label>
                        <input type="text" id="basic-icon-default-contact" class="form-control dt-contact"
                            placeholder="Telp" name="telp" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-email">Email</label>
                        <input type="text" id="basic-icon-default-email" class="form-control dt-email"
                            placeholder="Email" name="email" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-company">Faximile</label>
                        <input type="text" id="basic-icon-default-company" class="form-control dt-contact"
                            placeholder="Faximile" name="fax" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-company">Alamat</label>
                        <input type="text" id="basic-icon-default-company" class="form-control dt-contact"
                            placeholder="Alamat" name="alamat" />
                    </div>
                    <button type="button" class="btn btn-primary me-1" id="btnsubmit"> Submit</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal to add new user Ends-->
    <!-- Modal to update user starts-->
    <div class="modal modal-slide-in update-user-modal fade" id="modals-slide-in2">
        <div class="modal-dialog">
            <form class=" modal-content pt-0" id="form2" method="post">
                @csrf
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel2"><i class="fas fa-plus"></i> update Perusahaan</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        <label class="form-label" for="id_perusahaan2">ID Perusahaan</label>
                        <input type="text" class="form-control dt-full-name" id="id_perusahaan2" placeholder="John Doe"
                            name="id_perusahaan" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="nama-perusahaan2">Nama Perusaahn</label>
                        <input type="text" id="nama-perusahaan2" class="form-control dt-uname"
                            placeholder="Web Developer" name="nama_perusahaan" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="grup2">Grup</label>
                        <select id="grup2" name="nogrup" class="select2 form-select">
                            <option value="" selected disabled>Pilih Satu</option>
                            <option value="Australia">Sumatera</option>
                            <option value="Australia">Kalimantan</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="telp2">Telp</label>
                        <input type="text" id="telp2" class="form-control dt-contact" placeholder="Telp" name="telp" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="email2">Email</label>
                        <input type="text" id="email2" class="form-control dt-email" placeholder="Email" name="email" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="faximile">Faximile</label>
                        <input type="text" id="faximile2" class="form-control dt-contact" placeholder="Faximile"
                            name="fax" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="alamat2">Alamat</label>
                        <input type="text" id="alamat2" class="form-control dt-contact" placeholder="Alamat"
                            name="alamat" />
                    </div>
                    <button type="button" class="btn btn-primary me-1" id="btnupdate"> Update</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal to update user Ends-->
</div>
  <!-- list and filter end -->
</section>
<!-- users list ends -->
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
@endsection


@section('page-script')
{{-- Page js files --}}
<script src="{{ asset(mix('js/scripts/pages/app-user-list.js')) }}"></script>
<script>
    $(document).ready(function() {
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $("#btnsubmit").click(function(e){
     e.preventDefault();

    var data = $("#form1").serialize();
    // console.log(data);
    var url = '{{ route('create') }}';

    $.ajax({
    url:url,
    method:'POST',
    data:data,
    beforeSend: function () {
    $("#btnsubmit").attr('disabled', true).html("Processing...");
    },
    "dataSrc": "",
    success:function(response){
    if(response.success){
    alert(response.message), //Message come from controller
    $('#tabeldata').DataTable().ajax.reload();
    }else{
    alert("Error")
    }
    },
    error:function(error){
    console.log(error)
    }
    });
    });

    // pop up update

    $(document).delegate("[data-target='#form2']", "click", function() {
        var employeeId = $(this).attr('data-id');
        $.get('/perusahaan/edit/'+ employeeId, function (data) {
        console.log(data);
        $("#id_perusahaan2").val(data.data.nomor)
        $("#nama-perusahaan2").val(data.data.nama)
        $("#grup2").val(data.data.nogrup)
        $("#telp2").val(data.data.telp)
        $("#email2").val(data.data.email)
        $("#faximile2").val(data.data.fax)
        $("#alamat2").val(data.data.alamat)
        })

    });

    $("#btnupdate").click(function(e){
    e.preventDefault();

    var data = $("#form2").serialize();
    // console.log(data);
    var url = '{{ route('update') }}';

    $.ajax({
    url:url,
    method:'POST',
    data:data,
    beforeSend: function () {
    $("#btnupdate").attr('disabled', true).html("Processing...");
    },
    "dataSrc": "",
    success:function(response){
    if(response.success){
    alert(response.message), //Message come from controller
    $('#tabeldata').DataTable().ajax.reload();
    }else{
    alert("Error")
    }
    },
    error:function(error){
    console.log(error)
    }
    });
    });

    });
</script>
@endsection

