if(document.getElementById('subscriber-datatable')) {
    $(function() {
        const SubscriberTable = $('#subscriber-datatable')
        const SubscriberDataTable = SubscriberTable.DataTable({
            dom: '<r<"dt_top"<"dt_length"l><"dt_info"><"dt_search"f>><"dt_table"t><"dt_bottom"<"dt_info"i><"dt_pagination"p>>>',
            pagingType: "full_numbers",
            stateSave: true,
            processing: true,
            serverSide: true,
            rowId: 'id',
            columns: [
                {data: 'id'},
                {data: 'user_id'},
                {data: 'receive_message'},
                {data: 'options', searchable: false, orderable: false},
            ]
        });
    });
}
