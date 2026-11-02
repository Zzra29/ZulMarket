@extends('templates.layoutApp')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tabulator-tables@6.6.1/dist/css/
tabulator_bootstrap5.min.css"
crossorigin="anonymous" />
@endpush

@section('content')
 <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Starter Page</h1>
              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Starter Page</li>
                  </ol>
                </nav>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-12">
                <!--begin::Card-->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Starter Card</h3>

                    <div class="card-tools">
                      <button
                        type="button"
                        class="btn btn-tool"
                        data-lte-toggle="card-collapse"
                        aria-label="Collapse card"
                      >
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                      <button
                        type="button"
                        class="btn btn-tool"
                        data-lte-toggle="card-remove"
                        aria-label="Remove card"
                      >
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                <div class="d-flex gap-2 mb-3">
                  <button id="export-csv" type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-filetype-csv me-1" aria-hidden="true"></i>
                    Export CSV
                  </button>
                  <button id="export-json" type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-filetype-json me-1" aria-hidden="true"></i>
                    Export JSON
                  </button>
                  <button id="print-table" type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-printer me-1" aria-hidden="true"></i>
                    Print
                  </button>
                </div>
                <div id="users-table" aria-label="Users"></div>
                <div
                  id="table-pagination"
                  class="d-flex flex-wrap gap-2 justify-content-end mt-2"
                ></div>
              </div>
                  <!-- /.card-body -->
                  <div class="card-footer">The footer of the card</div>
                  <!-- /.card-footer -->
                </div>
                <!--end::Card-->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
@endsection

<script
      src="https://cdn.jsdelivr.net/npm/tabulator-tables@6.6.1/dist/js/tabulator.min.js"
      crossorigin="anonymous"
    ></script>
    <script>
      const statusBadge = (cell) => {
        const value = cell.getValue();
        const map = { Active: 'success', Invited: 'info', Suspended: 'secondary' };
        const color = map[value] || 'secondary';
        return `<span class="badge text-bg-${color}">${value}</span>`;
      };

      document.addEventListener('DOMContentLoaded', () => {
        const data = [
          {
            id: 1,
            name: 'Olivia Bennett',
            email: 'olivia@example.com',
            role: 'Admin',
            status: 'Active',
            joined: '2024-03-12',
          },
          {
            id: 2,
            name: 'Liam Carter',
            email: 'liam@example.com',
            role: 'Editor',
            status: 'Active',
            joined: '2024-04-08',
          },
          {
            id: 3,
            name: 'Emma Dawson',
            email: 'emma@example.com',
            role: 'Viewer',
            status: 'Invited',
            joined: '2024-06-21',
          },
          {
            id: 4,
            name: 'Noah Evans',
            email: 'noah@example.com',
            role: 'Editor',
            status: 'Suspended',
            joined: '2024-07-15',
          },
          {
            id: 5,
            name: 'Ava Foster',
            email: 'ava@example.com',
            role: 'Admin',
            status: 'Active',
            joined: '2024-08-30',
          },
          {
            id: 6,
            name: 'Ethan Grant',
            email: 'ethan@example.com',
            role: 'Viewer',
            status: 'Active',
            joined: '2024-09-14',
          },
          {
            id: 7,
            name: 'Sophia Hayes',
            email: 'sophia@example.com',
            role: 'Editor',
            status: 'Active',
            joined: '2024-10-02',
          },
          {
            id: 8,
            name: 'Mason Ingram',
            email: 'mason@example.com',
            role: 'Viewer',
            status: 'Invited',
            joined: '2024-11-19',
          },
          {
            id: 9,
            name: 'Isabella Jones',
            email: 'isabella@example.com',
            role: 'Admin',
            status: 'Active',
            joined: '2025-01-05',
          },
          {
            id: 10,
            name: 'Lucas Klein',
            email: 'lucas@example.com',
            role: 'Viewer',
            status: 'Suspended',
            joined: '2025-02-18',
          },
          {
            id: 11,
            name: 'Mia Lopez',
            email: 'mia@example.com',
            role: 'Editor',
            status: 'Active',
            joined: '2025-03-22',
          },
          {
            id: 12,
            name: 'Logan Moore',
            email: 'logan@example.com',
            role: 'Viewer',
            status: 'Active',
            joined: '2025-04-09',
          },
          {
            id: 13,
            name: 'Charlotte Nelson',
            email: 'charlotte@example.com',
            role: 'Admin',
            status: 'Active',
            joined: '2025-04-27',
          },
          {
            id: 14,
            name: 'Henry Owens',
            email: 'henry@example.com',
            role: 'Editor',
            status: 'Invited',
            joined: '2025-05-11',
          },
          {
            id: 15,
            name: 'Amelia Price',
            email: 'amelia@example.com',
            role: 'Viewer',
            status: 'Active',
            joined: '2025-05-17',
          },
        ];

        const table = new Tabulator('#users-table', {
          data: data,
          layout: 'fitColumns',
          pagination: true,
          paginationElement: document.getElementById('table-pagination'),
          paginationSize: 10,
          paginationSizeSelector: [10, 25, 50, 100],
          movableColumns: true,
          columns: [
            { title: '#', field: 'id', width: 60, headerSort: true },
            {
              title: 'Name',
              field: 'name',
              headerFilter: 'input',
              headerFilterParams: { elementAttributes: { 'aria-label': 'Filter by name' } },
            },
            {
              title: 'Email',
              field: 'email',
              headerFilter: 'input',
              headerFilterParams: { elementAttributes: { 'aria-label': 'Filter by email' } },
            },
            {
              title: 'Role',
              field: 'role',
              headerFilter: 'list',
              headerFilterParams: {
                values: ['', 'Admin', 'Editor', 'Viewer'],
                elementAttributes: { 'aria-label': 'Filter by role' },
              },
              width: 120,
            },
            {
              title: 'Status',
              field: 'status',
              formatter: statusBadge,
              headerFilter: 'list',
              headerFilterParams: {
                values: ['', 'Active', 'Invited', 'Suspended'],
                elementAttributes: { 'aria-label': 'Filter by status' },
              },
              width: 130,
              hozAlign: 'center',
            },
            { title: 'Joined', field: 'joined', sorter: 'date', width: 130 },
          ],
        });

        table.on('tableBuilt', () => {
          // Keep the scroll region keyboard reachable inside a valid grid.
          // Pagination lives outside the grid so its buttons are not grid rows.
          const grid = document.getElementById('users-table');
          grid.removeAttribute('aria-owns');
          grid.querySelector('.tabulator-tableholder').setAttribute('role', 'rowgroup');
          grid.querySelector('.tabulator-table').setAttribute('role', 'presentation');
        });

        table.on('renderComplete', () => {
          document.querySelectorAll('#table-pagination button').forEach((button) => {
            button.classList.add('btn', 'btn-sm', 'btn-outline-secondary');
          });
        });

        document.getElementById('table-filter').addEventListener('input', (e) => {
          const value = e.target.value;
          if (value) {
            table.setFilter([
              [
                { field: 'name', type: 'like', value: value },
                { field: 'email', type: 'like', value: value },
              ],
            ]);
          } else {
            table.clearFilter();
          }
        });

        document
          .getElementById('export-csv')
          .addEventListener('click', () => table.download('csv', 'users.csv'));
        document
          .getElementById('export-json')
          .addEventListener('click', () => table.download('json', 'users.json'));
        document
          .getElementById('print-table')
          .addEventListener('click', () => table.print(false, true));
      });
    </script>