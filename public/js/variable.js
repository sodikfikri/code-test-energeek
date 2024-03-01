$(document).ready(function() {
    let state = {
        table: {
            list: null
        },
        detail_id: null
    }

    let Component = {}

    Component.active = function() {
        Component.API.List()
        Component.API.GetLabel()
        Component.EVENT.active()
    }

    Component.API = {
        List: function() {
            state.table.list = $('#t-variable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "destroy": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "ajax": {
                    "url": "/api/variable/list",
                    "data": {
                        "cats": type
                    },
                    "type": "Get",
                    "datatype": "json"
                },
                "columnDefs": [
                    {
                        "targets": 0, // Kolom pertama (indeks 0)
                        "orderable": false, // Agar tidak dapat diurutkan
                        "searchable": false, // Agar tidak dapat dicari
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).text(row + 1);
                        }
                    },
                ],
                "columns": [
                    { data: 'id', orderable: false, className: 'text-center' },
                    { data: 'label_name', className: 'text-left' },
                    { 
                        data: function(data) {
                            let price = 0
                            if (data.range_start) {
                                price = new Intl.NumberFormat().format(data.range_start)
                            }
                            return `<span>${type == 1 ? 'Rp. '+price : price}</span>`
                        }, 
                        className: 'text-right' 
                    },
                    { 
                        data: function(data) {
                            let price = 0
                            if (data.range_end) {
                                price = new Intl.NumberFormat().format(data.range_end)
                            }
                            return `<span>${type == 1 ? 'Rp. '+price : price}</span>`
                        }, 
                        className: 'text-right'  
                    },
                    { data: 'value', className: 'text-left' },
                    {
                        data: function(data, type) {
                            return `<button class="btn btn-info btn-sm btn-detail" data-id="${data.id}"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm btn-delete" data-id="${data.id}"><i class="fas fa-trash"></i></button>`
                        },
                        className: 'text-center'
                    }
                ]
            })
        },
        GetLabel: function() {
            $.ajax({
                url: '/api/variable/get-label',
                method: 'GET',
                data: {
                    cats: type
                },
                success: function(resp) {
                    if (resp.meta.code == 200) {
                        $.each(resp.data, function(key, val) {
                            $('#master-label').append(
                                `<option value="${val.id}">${val.label_name}</option>`
                            )
                        })
                    }
                }
            })
        },
        Store: function(params) {
            $.ajax({
                url: '/api/variable/store',
                method: 'POST',
                data: params,
                success: function(resp) {
                    $('#exampleModal').modal('hide')
                    state.table.list.ajax.reload()
                    if (resp.meta.code == 201) {
                        Toast.fire({
                            icon: 'success',
                            title: resp.meta.message,
                        })
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: resp.meta.message,
                        })
                    }
                },
                complete: function() {
                    $('#master-label').val('')
                    $('#range-start').val('')
                    $('#range-end').val('')
                    $('#value').val('')
                }
            })
        },
        Detail: function(params) {
            $.ajax({
                url: '/api/variable/find',
                method: 'GET',
                data: params,
                success: function(resp) {
                    if (resp.meta.code == 200) {
                        $('#master-label').val(resp.data.master_label)
                        $('#range-start').val(resp.data.range_start)
                        $('#range-end').val(resp.data.range_end)
                        $('#value').val(resp.data.value)
                    }
                    $('#exampleModal').modal('show')
                }
            })
        },
        Update: function(params) {
            $.ajax({
                url: '/api/variable/update',
                method: 'PUT',
                data: params,
                success: function(resp) {
                    if (resp.meta.code == 200) {
                        $('#exampleModal').modal('hide')
                        state.table.list.ajax.reload()
                        if (resp.meta.code == 200) {
                            Toast.fire({
                                icon: 'success',
                                title: resp.meta.message,
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: resp.meta.message,
                            })
                        }
                    }
                },
                complete: function() {
                    $('#master-label').val('')
                    $('#range-start').val('')
                    $('#range-end').val('')
                    $('#value').val('')
                }
            })
        },
        Delete: function(idx) {
            $.ajax({
                url: '/api/variable/delete',
                method: 'DELETE',
                data: {
                    id: idx
                },
                success: function(resp) {
                    state.table.list.ajax.reload()
                    if (resp.meta.code == 200) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }
                }
            })
        }
    }

    Component.EVENT = {
        active: function() {
            $('#btn-save-data').on('click', function() {
                if ($('#action').val() == 'create') {
                    let params = {
                        cats: type,
                        master_label: $('#master-label').val(),
                        range_start: $('#range-start').val(),
                        range_end: $('#range-end').val(),
                        value: $('#value').val()
                    }
    
                    Component.API.Store(params)  
                } else {
                    let params = {
                        id: state.detail_id,
                        cats: type,
                        master_label: $('#master-label').val(),
                        range_start: $('#range-start').val(),
                        range_end: $('#range-end').val(),
                        value: $('#value').val()
                    }

                    Component.API.Update(params)
                }
            })

            $('#t-variable tbody').on('click', '.btn-detail', function() {
                $('#action').val('update')
                state.detail_id = $(this).data('id')

                let parmas = {
                    cats: type,
                    id: $(this).data('id')
                }

                Component.API.Detail(parmas)
            })

            $('#t-variable tbody').on('click', '.btn-delete', function() {
                let idx = $(this).data('id')
                Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Component.API.Delete(idx)
                    }
                });
            })
            
        }
    }

    Component.active()
})