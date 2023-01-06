if(document.getElementById('transaction-datatable')) {
    $(function() {
        const assetsTable = $('#transaction-datatable')
        const assetsDataTable = assetsTable.DataTable({
            dom: '<r<"dt_top"<"dt_length"l><"dt_info"><"dt_search"f>><"dt_table"t><"dt_bottom"<"dt_info"i><"dt_pagination"p>>>',
            pagingType: "full_numbers",
            stateSave: true,
            processing: true,
            serverSide: true,
            rowId: 'id',
            columns: [
                {data: 'from', searchable: true, orderable: false},
                {data: 'to', searchable: true, orderable: false},
                {data: 'value'},
                {data: 'date'},
            ]
        });
    });
}
