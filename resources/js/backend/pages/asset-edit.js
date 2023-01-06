if(document.getElementById('assetimages-datatable')) {
    $(function() {
        const assetImagesTable = $('#assetimages-datatable')
        const assetImagesDataTable = assetImagesTable.DataTable({
            dom: '<r<"dt_top"<"dt_length"l><"dt_info"><"dt_search"f>><"dt_table"t><"dt_bottom"<"dt_info"i><"dt_pagination"p>>>',
            pagingType: "full_numbers",
            stateSave: true,
            processing: true,
            serverSide: true,
            rowId: 'id',
            columns: [
                {data: 'name'},
                {data: 'options', searchable: false, orderable: false},
            ]
        });
    });
}

if(document.getElementById('assetrental-datatable')) {
    $(function() {
        const assetRentalsTable = $('#assetrental-datatable')
        const assetRentalsDataTable =assetRentalsTable.DataTable({
            dom: '<r<"dt_top"<"dt_length"l><"dt_info"><"dt_search"f>><"dt_table"t><"dt_bottom"<"dt_info"i><"dt_pagination"p>>>',
            pagingType: "full_numbers",
            stateSave: true,
            processing: true,
            serverSide: true,
            rowId: 'id',
            columns: [
                {data: 'from'},
                {data: 'to'},
                {data: 'price'},
                {data: 'value'},
                {data: 'options', searchable: false, orderable: false},
            ]
        });
    });
}
