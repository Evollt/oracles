if(document.getElementById('inputfields-datatable')) {
    $(function() {
        const inputFieldsTable = $('#inputfields-datatable')
        const inputFieldsDataTable = inputFieldsTable.DataTable({
            dom: '<r<"dt_top"<"dt_length"l><"dt_info"><"dt_search"f>><"dt_table"t><"dt_bottom"<"dt_info"i><"dt_pagination"p>>>',
            pagingType: "full_numbers",
            stateSave: true,
            processing: true,
            serverSide: true,
            rowId: 'id',
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'slug'},
                {data: 'input_field_type'},
                {data: 'options', searchable: false, orderable: false},
            ]
        });
    });
}
