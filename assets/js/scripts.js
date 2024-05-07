$(document).ready(function() {
    // Fetch data from controller
    $.ajax({
        url: "Exoda/getAllExoda",
        type: "GET",
        dataType: "json",
        success: function(data) {
            // Populate DataTable with fetched data
            $('#myTable').DataTable({
                data: data,
                columns: [{
                        data: 'ID'
                    },
                    {
                        data: 'Description'
                    },
                    {
                        data: 'RenewType'
                    },
                    {
                        data: 'ValidUntil'
                    },
                    {
                        data: 'Price'
                    },
                    {
                        data: 'Autopay',
                        render: function(data) {
                            return data === '0' ? 'Yes' : 'No';
                        }
                    },
                    {
                        data: 'dateCreated'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<a href="exoda/edit/' + row.ID + '" class="btn btn-primary btn-sm">Edit</a>' +
                                   '<a href="exoda/delete/' + row.ID + '" class="btn btn-danger btn-sm">Delete</a>';
                        }
                    }
                ]
            });
        }
    });
});