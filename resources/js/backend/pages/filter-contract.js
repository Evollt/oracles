if(document.getElementById('filtercontract-datatable')) {
    $(function() {
        const filtercontractTable = $('#filtercontract-datatable')
        const filtercontractDataTable = filtercontractTable.DataTable({
            dom: '<r<"dt_top"<"dt_length"l><"dt_info"><"dt_search"f>><"dt_table"t><"dt_bottom"<"dt_info"i><"dt_pagination"p>>>',
            pagingType: "full_numbers",
            stateSave: true,
            processing: true,
            serverSide: true,
            rowId: 'id',
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'address'},
                {data: 'is_asset'},
                {data: 'options', searchable: false, orderable: false},
            ]
        });
    });
}
