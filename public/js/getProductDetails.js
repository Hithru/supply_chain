$(document).ready(function() {
    dailyDetailTable = $('#tblViewProducts').DataTable({
        "paging": true,
        "displayLength": 10,
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],

        "order": [[ 2, 'asc' ]],
        "ajax": {
            "url" : `http://localhost/supply_chain/public/CustomerController/getProductDetails`,
            "dataSrc" : ""
        },
        "columns" : [
            {"data" : null, className: "com_date text-center align-middle"},
            {"data" : "item_id", className: "com_date text-center align-middle"},
            {"data" : "name", className: "com_name text-center align-middle"},

        ],
    });

    dailyDetailTable.on( 'order.dt search.dt', function () {
        dailyDetailTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

});

const request = new XMLHttpRequest();