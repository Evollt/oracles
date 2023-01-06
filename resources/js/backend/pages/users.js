$(document).on('submit', 'form.advanced-users-search', function (e) {
    return false;
});
if(document.getElementById('users-datatable')) {
    $(function() {
        const usersTable = $('#users-datatable')
        const usersDataTable = usersTable.DataTable({
            dom: '<r<"dt_top"<"dt_length"l><"dt_info"><"dt_search"f>><"dt_table"t><"dt_bottom"<"dt_info"i><"dt_pagination"p>>>',
            pagingType: "full_numbers",
            stateSave: true,
            processing: true,
            serverSide: true,
            rowId: 'id',
            columns: [
                {data: 'id'},
                {data: 'discord'},
                {data: 'email'},
                {data: 'role', orderable: false},
                {data: 'options', searchable: false, orderable: false},
            ]
        });

        $(document).on('submit', 'form.advanced-users-search', function () {
            usersDataTable.ajax.url(`${usersTable.data('ajax')}?${$('[name^="filter"]').serialize()}`).load();
        })
    });
}
