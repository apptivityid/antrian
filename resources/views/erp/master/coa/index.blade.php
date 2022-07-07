@extends('layouts/contentLayoutMaster')
@section('title', $breadcrumbs[1]['name'])

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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

@section('content')
<!-- users list start -->
  <!-- list and filter start -->
  <div class="card">
    <div class="card-body border-bottom">
      <h4 class="card-title">List Data</h4>
      <div class="row">
        <div class="button">
            <button class="add-new btn btn-primary" data-bs-toggle="modal" data-bs-target='#modals-slide-in'>
              <i data-feather="plus-circle" class="me-25"></i>
              <span>Tambah Data</span>
            </button>
            <button class="add-new btn btn-danger" data-bs-toggle="modal" data-bs-target='#modals-slide-in'>
              <i data-feather="minus-circle" class="me-25"></i>  
              <span>Hapus Data</span>
            </button>
        </div>
      </div>
    </div>
    <div class="card-datatable table-responsive pt-0">
      <div class="row" id="basic-table">
        <div class="col-12">
          <div class="card">
            <div class="">
              <table class="table">
                <thead>
                  <tr>
                    <th class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="select_all">
                        <label class="form-check-label" for="select_all"></label>
                      </div>
                    </th>
                    <th>No</th>
                    <th>Nama @yield('title')</th>
                    <th>Nomor Grup COA</th>
                    <th>Nomor Tipe Tanaman</th>
                    <th>Nomor Status Lahan</th>
                    <th>Kategori COA</th>
                    <th>Nomor Tipe Akun</th>
                    <th>Nomor Posisi Keuangan</th>
                    <th>Nomor Laba Rugi</th>
                    <th>Kepemilikan COA</th>
                    <th>Satuan</th>
                    <th>Tanggal</th>
                    <th>Penambah</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($datas as $data)
                    <tr>
                      <td class=" dt-checkboxes-cell">
                        <div class="form-check">
                          <input class="form-check-input dt-checkboxes child" type="checkbox" value="" id="checkbox100">
                          <label class="form-check-label" for="checkbox100"></label>
                        </div>
                      </td>
                      <td>{{$no++}}</td>
                      <td>
                        <span class="fw-bold">{{$data->nama}}</span>
                      </td>
                      <td>
                        <span class="fw-bold">{{$data->nomorgrupcoa}}</span>
                      </td>
                      <td>
                        <span class="fw-bold">{{$data->nomortipetanaman}}</span>
                      </td>
                      <td>
                        <span class="fw-bold">{{$data->nomorstatuslahan}}</span>
                      </td>
                      <td>
                        <span class="fw-bold">{{$data->kategoricoa}}</span>
                      </td>
                      <td>
                        <span class="fw-bold">{{$data->nomortipeakun}}</span>
                      </td>
                      <td>
                        <span class="fw-bold">{{$data->nomorposisikeuangan}}</span>
                      </td>
                      <td>
                        <span class="fw-bold">{{$data->nomorlabarugi}}</span>
                      </td>
                      <td>
                        <span class="fw-bold">{{$data->kepemilikancoa}}</span>
                      </td>
                      <td>
                        <span class="fw-bold">{{$data->satuan}}</span>
                      </td>
                      <td>{{$data->tglditambah}}</td>
                      <td>
                        <div class="avatar-group">
                          <div
                            data-bs-toggle="tooltip"
                            data-popup="tooltip-custom"
                            data-bs-placement="top"
                            class="avatar pull-up my-0"
                            title="{{$data->penambah}}"
                          >
                            <img
                              src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                              alt="Avatar"
                              height="26"
                              width="26"
                            />
                          </div>
                        </div>
                      </td>
                      <td>
                        @if($data->aktif=="Y")
                          <span class="badge rounded-pill badge-light-primary me-1">Aktif</span>
                        @else
                          <span class="badge rounded-pill badge-light-danger me-1">Non-Aktif</span>
                        @endif
                      </td>
                      <td>
                        <div class="demo-inline-spacing">
                          <form method="post" action="{{route('grupcoa-delete', $data->nomor)}}">
                              @method('delete')
                              @csrf
                              <button type="button" class="btn btn-icon btn-icon rounded-circle btn-primary">
                                <i data-feather="edit-2"></i>
                              </button>
                              <button type="submit" class="btn btn-icon btn-icon rounded-circle btn-danger">
                                <i data-feather="trash"></i>
                              </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- list and filter end -->
  
    <!-- Modal to add new user starts-->
    <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form class="modal-content pt-0" method="POST" action="{{route('grupcoa-store')}}">
          @csrf
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">Add @yield('title')</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="mb-1">
              <label class="form-label" for="basic-icon-default-fullname">Nomor @yield('title')</label>
              <input
                type="text"
                class="form-control dt-full-name"
                id="basic-icon-default-fullname"
                placeholder="John Doe"
                name="nomor"
              />
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-icon-default-fullname">Nama @yield('title')</label>
              <input
                type="text"
                class="form-control dt-full-name"
                id="basic-icon-default-fullname"
                placeholder="John Doe"
                name="nama"
              />
            </div>
            <div class="mb-1">
              <label class="form-label" for="country">Grup Coa</label>
              <select id="country" class="select2 form-select" name="grupcoa">
                  @foreach($grupcoas as $grupcoa)
                    <option value="{{$grupcoa->nomor}}">{{strtoupper($grupcoa->nama)}}</option>
                  @endforeach
              </select>
            </div>
            <div class="mb-1">
              <label class="form-label" for="country">Aktif</label>
              <select id="country" class="form-select" name="aktif">
                <option value="Y">Ya</option>
                <option value="T">Tidak</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to add new user Ends-->
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
@endsection

<script>
$(document).ready(function() {
  // Check All Start
  $("#select_all").click(function() {
    $(".child").prop("checked", this.checked);
  });

  $('.child').click(function() {
    if ($('.child:checked').length == $('.child').length) {
      $('#select_all').prop('checked', true);
    } else {
      $('#select_all').prop('checked', false);
    }
  });
  // Check All End


});
</script>