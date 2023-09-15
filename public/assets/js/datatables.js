$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function setDataTable(_URL,_COLUMNS){
    // loadingFormStart();
    return $('#data').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url : _URL
        },
        language:{
            searchPlaceholder: "Cari",
            search: ""
        },
        columns: _COLUMNS,
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: [0,-1]
            },
        ],
        "paging": true,
        "lengthChange": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        order: [[1, 'asc']],
        // dom: 'Bfrtip',
        // buttons: [
        //     {
        //         text: '{!!icons("c-plush")!!} Tambah',
        //         className:'btn btn-primary float-end mb-3',
        //         action: function ( e, dt, node, config ) {
                    
        //         }
        //     }
        // ],
        // initComplete:function(){
        //     loadingFormStop();
        // }
    });
}
function setDataTableMultiple(_TABLE,_URL,_COLUMNS){
    // loadingFormStart();
    return _TABLE.DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url : _URL
        },
        language:{
            searchPlaceholder: "Cari",
            search: ""
        },
        columns: _COLUMNS,
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: [0,-1]
            },
        ],
        "paging": true,
        "lengthChange": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        order: [[1, 'asc']],

    });
}
$.extend(true, $.fn.dataTable.defaults, {
    responsive: {
        details: {
            renderer: function ( api, rowIdx ) {
                // Select hidden columns for the given row
                var data = api.cells( rowIdx, ':hidden' ).eq(0).map( function ( cell ) {
                    var header = $( api.column( cell.column ).header() );

                    return '<tr style="border-style:hidden;">'+
                            '<th class="text-dark">'+
                                header.text()+':'+
                            '</th> '+
                            '<td>'+
                                api.cell( cell ).data()+
                            '</td>'+
                        '</tr>';
                } ).toArray().join('');

                return data ?
                    $('<table/>').append( data ) :
                    false;
            }
        }
    }
});