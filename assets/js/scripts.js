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
                            return '<button class="btn btn-primary btn-sm btn-edit" onclick="openEditModal(' + row.ID + ')">Edit</button>' +
                                   '<button class="btn btn-danger btn-sm btn-delete" onclick="confirmDelete(' + row.ID + ')">Delete</button>';
                        }
                    }
                ]
            });
        }
    });
});

//function to open the edit Exoda modal
window.openEditModal = function(ID) {
    // Show edit modal
    $('#UpdateExodaModal').modal('show');

    // Fetch data from controller
    $.ajax({
        url: "Exoda/putExoda",
        type: "GET",
        data: {
            ID: ID
        },
        success: function(data) {
            // Populate the edit modal with fetched data
            document.getElementById("UpdateExodaModalLabel").innerText = 'Edit ' + data['Description'];
            $('#ID').val(data.ID);
            $('#updateDescription').val(data['Description']);
            $('#updateRenewType').val(data['RenewType']);
            $('#updateValidUntil').val(data['ValidUntil']);
            $('#updatePrice').val(data['Price']);
            var AutoPay = data['Autopay'];
            console.log(AutoPay);
            if (AutoPay === '0') {
                $('#updateAutoPay').val('True');
            } else {
                $('#updateAutoPay').val('False');
            }
        }
    });
}


// Function to confirm deletion
window.confirmDelete = function(ID) {
    // Show confirmation modal
    $('#deleteConfirmationModal').modal('show');

    // Handle confirmation
    $('#confirmDeleteButton').click(function() {
        $.ajax({
            url: "Exoda/deleteExoda",
            type: "POST",
            data: {
                ID: ID
            },
            success: function() {
                $('#deleteConfirmationModal').modal('hide');
                // Reload the page
                location.reload();
            }
        });
    });

    //Optionally handle cancellation
    $('#cancelDeleteButton').click(function() {
        $('#deleteConfirmationModal').modal('hide');
    });
};