$(document).on('submit', 'form.advanced-scam-search', function (e) {
    return false;
});

if(document.getElementById('scam-datatable')) {
    $(function() {
        const ScamTable = $('#scam-datatable')
        const ScamDataTable = ScamTable.DataTable({
            dom: '<r<"dt_top"<"dt_length"l><"dt_info"><"dt_search"f>><"dt_table"t><"dt_bottom"<"dt_info"i><"dt_pagination"p>>>',
            pagingType: "full_numbers",
            stateSave: true,
            processing: true,
            serverSide: true,
            rowId: 'id',
            columns: [
                {data: 'id'},
                {data: 'old_title'},
                {data: 'scam_status_id'},
                {data: 'scam_status_id'},
                {data: 'options', searchable: false, orderable: false},
            ]
        });

        $(document).on('submit', 'form.advanced-scam-search', function () {
            ScamDataTable.ajax.url(`${ScamTable.data('ajax')}?${$('[name^="filter"]').serialize()}`).load();
        })
    });
}
