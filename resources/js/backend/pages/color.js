if(document.getElementById('colors-datatable')) {
    $(function() {
        const colorsTable = $('#colors-datatable')
        const colorsDataTable = colorsTable.DataTable({
            dom: '<r<"dt_top"<"dt_length"l><"dt_info"><"dt_search"f>><"dt_table"t><"dt_bottom"<"dt_info"i><"dt_pagination"p>>>',
            pagingType: "full_numbers",
            stateSave: true,
            processing: true,
            serverSide: true,
            rowId: 'id',
            columns: [
                {data: 'name'},
                {data: 'slug'},
                {data: 'combination', searchable: false, orderable: false},
                {data: 'options', searchable: false, orderable: false},
            ]
        });
    });
}
