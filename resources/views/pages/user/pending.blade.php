@extends('layouts.app')

@section('content')
<div class="card mb-5 mb-xl-10">
    <div class="card-body border-top p-9">
      <form id="filter-form" class="mb-3">
        <div class="row mb-3">
          <div class="col">
            <input type="text" class="form-control form-control-solid" name="q" placeholder="Search" />
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <select id="kecamatan" class="form-select form-select-solid" data-control="select2" name="district" data-placeholder="Pilih Kecamatan">
              <option></option>
              @if (Auth::user()->role == 'kecamatan')
                <option value="{{ Auth::user()->district->id }}" data-id="{{ Auth::user()->district->code }}">{{ Auth::user()->district->name }}</option>
              @else
                @foreach ($district as $item)
                <option value="{{ $item->id }}" data-id="{{ $item->code }}">{{ $item->name }}</option>
                @endforeach
              @endif
            </select>
          </div>
          <div class="col">
            <select name="village" id="kelurahan" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Kelurahan">
              <!-- Populate this select with options dynamically based on the district selected -->
            </select>
          </div>
        </div>
        <div class="flex justify-content-end text-end">
          <button type="button" class="btn btn-light-primary" id="reset-button">
            <i class="ki-duotone ki-arrows-circle fs-3">
              <span class="path1"></span>
              <span class="path2"></span>
            </i>
            Reset
          </button>
          <button type="submit" class="btn btn-primary"><i class="ki-outline ki-filter fs-3"></i> Terapkan</button>
        </div>
      </form>
      <div class="table-responsive position-relative">
        <div id="loading-spinner" class="position-absolute top-50 start-50 translate-middle" role="status" style="display: none;">
          <span class="badge badge-light shadow fs-6 p-5">Loading...</span>
          </div>
        <table id="users-table" class="table table-row-dashed fs-6 gy-5">
          <thead>
            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
              <th>Pengguna</th>
              <th>Kecamatan</th>
              <th>Kelurahan</th>
              <th>Role</th>
              <th>Created At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Table body will be populated by AJAX -->
          </tbody>
        </table>
      </div>
      <div class="d-md-flex justify-content-lg-between text-center align-items-center my-3">
        <div class="fs-6 fw-semibold text-gray-700 my-5 my-md-0" id="pagination-info">
            <!-- Pagination info will be updated by AJAX -->
        </div>
        <ul class="pagination" id="pagination-links">
            <!-- Pagination links will be updated by AJAX -->
        </ul>
      </div>
    </div>
</div>

<div class="modal" id="confirm" data-bs-backdrop="static">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content shadow rounded ">
      <div class="modal-body p-4 text-center py-8">
        <h5 class="mb-2">Konfirmasi!!</h5>
        <p class="mb-0">Kamu yakin ingin menghapus data ini?</p>
      </div>
      <div class="modal-footer flex-nowrap p-0">
        <button type="button" class="confirm-ok btn btn-lg btn-secondary bg-transparent text-dark fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" >Hapus</button>
        <button type="button" class="btn btn-lg btn-secondary bg-transparent text-dark fs-6 text-decoration-none col-6 m-0 rounded-0" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    document.body.addEventListener('click', function(event) {
      if (event.target.classList.contains('btn-confirm')) {
        var link = event.target.id;
        var myModal = new bootstrap.Modal(document.getElementById('confirm'));
        myModal.show();
        document.querySelector('.confirm-ok').addEventListener('click', function() {
          window.location.replace(link);
        });
      }
    });
  });
</script>
<script>
  $(document).ready(function() {
    function fetchUsers(page = 1) {
      $('#loading-spinner').show();
      let formData = $('#filter-form').serializeArray();
      formData.push({ name: 'page', value: page });

      $.ajax({
        url: '{{ route('user.pending.data') }}',
        data: formData,
        success: function(response) {
          updateTable(response);
          $('#loading-spinner').hide();
        },
        error: function(xhr) {
          console.error("Request failed: " + xhr.status);
          $('#loading-spinner').hide();
        }
      });
    }

    function updateTable(data) {
      let tbody = $('#users-table tbody');
      tbody.empty();

      if (data.data.length === 0) {
        tbody.append('<tr><td colspan="6" class="text-center">No data available in table</td></tr>');
      } else {
        $.each(data.data, function(index, user) {
            let approveUrl = '{{ route('user.pending.approve', ':id') }}'.replace(':id', user.id);
            tbody.append(`
                <tr>
                    <td class="align-middle">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-45px symbol-circle me-3" data-bs-toggle="tooltip" title="${user.name}">
                                <img src="https://ui-avatars.com/api/?bold=true&name=${user.name}" alt="">
                            </div>
                            <div class="d-flex flex-column">
                                <span class="text-gray-800 fw-bold mb-1">${user.name}</span>
                                <span class="text-muted fs-7">${user.email}</span>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle">${user.district ? user.district.name : '-'}</td>
                    <td class="align-middle">${user.village ? user.village.name : '-'}</td>
                    <td class="align-middle">
                        <div class="badge badge-light fw-bold">${user.role}</div>
                    </td>
                    <td class="align-middle">
                        ${new Date(user.created_at).toLocaleString('en-GB', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: false
                        })}
                    </td>
                    <td class="align-middle">
                        <a href="#" id="${approveUrl}" class="btn-confirm btn btn-light-success btn-icon btn-sm">
                            <i id="${approveUrl}" class="btn-confirm ki-duotone ki-check fs-2"></i>
                        </a>
                    </td>
                </tr>
            `);
        });
      }

      let paginationInfo = `Showing ${data.from} to ${data.to} of ${data.total} records`;
      $('#pagination-info').text(paginationInfo);

      let paginationLinks = '';
      let currentPage = data.current_page;
      let lastPage = data.last_page;

      let startPage = Math.max(currentPage - 1, 1);
      let endPage = Math.min(startPage + 2, lastPage);

      if (startPage > 1) {
        paginationLinks += `
          <li class="page-item">
            <a class="page-link" href="#" data-page="1">First</a>
          </li>
          <li class="page-item disabled"><span class="page-link">...</span></li>
        `;
      }

      for (let page = startPage; page <= endPage; page++) {
        paginationLinks += `
          <li class="page-item${page === currentPage ? ' active' : ''}">
            <a class="page-link" href="#" data-page="${page}">${page}</a>
          </li>
        `;
      }

      if (endPage < lastPage) {
        paginationLinks += `
          <li class="page-item disabled"><span class="page-link">...</span></li>
          <li class="page-item">
            <a class="page-link" href="#" data-page="${lastPage}">Last</a>
          </li>
        `;
      }

      $('#pagination-links').html(paginationLinks);
    }

    $('#filter-form').on('submit', function(e) {
      e.preventDefault();
      fetchUsers();
    });

    $('#pagination-links').on('click', 'a', function(e) {
      e.preventDefault();
      let page = $(this).data('page');
      fetchUsers(page);
    });

    $('#reset-button').on('click', function() {
      $('#filter-form')[0].reset();
      $('#kecamatan').val(null).trigger('change');
      $('#kelurahan').val(null).trigger('change');
      fetchUsers();
    });

    // Handle kecamatan change
    $('#kecamatan').on('change', function() {
      let district_code = $(this).find(':selected').data('id');
      $.ajax({
        url: `/api/kecamatan/${district_code}`,
        method: "GET",
        success: function(response) {
          let $kelurahan = $('#kelurahan');
          $kelurahan.empty().append('<option value="">Pilih Kelurahan</option>');
          $.each(response.data, function(index, item) {
            $kelurahan.append(`<option value="${item.id}">${item.name}</option>`);
          });
          $kelurahan.select2({
            placeholder: "Pilih Kelurahan"
          });
        },
        error: function(xhr) {
          console.error("Request failed: " + xhr.status);
        }
      });
    });

    // Initialize Select2 for the elements
    $('#kecamatan').select2({
      placeholder: "Pilih Kecamatan"
    });
    $('#kelurahan').select2({
      placeholder: "Pilih Kecamatan terlebih dahulu"
    });

    // Initial fetch
    fetchUsers();
  });
</script>
@endsection
