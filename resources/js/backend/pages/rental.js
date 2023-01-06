$(document).on('submit', 'form.advanced-rentals-search', function (e) {
    return false;
});
if(document.getElementById('rental-index-datatable')) {
    $(function() {
        const rentalTable = $('#rental-index-datatable')
        const rentalDataTable = rentalTable.DataTable({
            dom: '<r<"dt_top"<"dt_length"l><"dt_info"><"dt_search"f>><"dt_table"t><"dt_bottom"<"dt_info"i><"dt_pagination"p>>>',
            pagingType: "full_numbers",
            stateSave: true,
            processing: true,
            serverSide: true,
            rowId: 'id',
            columns: [
                {data: 'asset_id'},
                {data: 'manager_id'},
                {data: 'txn'},
                {data: 'coin_price'},
                {data: 'rental_status_id'},
                {data: 'options', searchable: false, orderable: false},
            ]
        });
        $(document).on('submit', 'form.advanced-rentals-search', function () {
            rentalDataTable.ajax.url(`${rentalTable.data('ajax')}?${$('[name^="filter"]').serialize()}`).load();
        })
    });
}
