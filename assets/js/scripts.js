$(document).ready(function () {
    // Fetch data from controller
    $.ajax({
        url: "Exoda/getCurrentMonthExoda",
        type: "GET",
        dataType: "json",
        success: function (data) {
            // Populate DataTable with fetched data
            $('#myTable').DataTable({
                "language": {
                    "emptyTable": "No Expenses found for this Month"
                },
                data: data,
                columns: [{
                    data: 'ID',
                    searchable: false,
                    orderable: true
                },
                {
                    data: 'Description',
                    searchable: true,
                    orderable: true
                },
                {
                    data: 'Price',
                    searchable: false,
                    orderable: true
                },
                {
                    data: 'ExodoMonth',
                    render: function (data) {
                        return new Date(2000, data - 1).toLocaleString('EN', { month: 'long' });
                    },
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'ExodoYear',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'dateCreated',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'Repeated',
                    render: function (data) {
                        return data === '0' ? 'True' : 'False';
                    },
                    searchable: false,
                },
                {
                    data: 'AutoRenew',
                    render: function (data) {
                        return data === '0' ? 'True' : 'False';
                    },
                    searchable: false,
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<button class="btn btn-primary btn-sm btn-edit" onclick="openEditModal(' + row.ID + ')">Edit</button>' +
                            '<button class="btn btn-danger btn-sm btn-delete" onclick="confirmDelete(' + row.ID + ')">Delete</button>';
                    }
                },
                ]
            });

            let totalSum = 0;
            // Loop through data to calculate total sum
            data.forEach(function(item) {
                totalSum += parseFloat(item.Price);
            });

            // Display total sum
            $('#monthSum').text("Total Expenses of the Month is " + totalSum.toFixed(2) + " Euros"); // Assuming two decimal places
        }
    });
});

// Function to open the insert Exoda modal
window.openInsertModal = function () {
    // Show insert modal
    $('#insertExodaModal').modal('show');
}

//function to open the edit Exoda modal
window.openEditModal = function (ID) {
    // Show edit modal
    $('#UpdateExodaModal').modal('show');

    // Fetch data from controller
    $.ajax({
        url: "Exoda/putExoda",
        type: "GET",
        data: {
            ID: ID
        },
        success: function (data) {
            // Populate the edit modal with fetched data
            document.getElementById("UpdateExodaModalLabel").innerText = 'Edit ' + data.Description;
            $('#ID').val(data.ID);
            $('#updateDescription').val(data.Description);
            $('#updatePrice').val(data.Price);
            $('#updateExodoMonth').val(data.ExodoMonth);
            $('#updateExodoYear').val(data.ExodoYear);
            $('#updateRepeated').val(data.Repeated);
            $('#updateAutoRenew').val(data.AutoRenew);
        }
    });
}

//previous month expenses
window.chooseMonthandYear = function () {
    $('#chooseMonthYearModal').modal('show');
    $('#ChooseMonthandYearBtn').click(function () {
        if ($('#ChooseMonthandYear').val() == '-' || $('#YearSelector').val() == '-') {
           alert("Please select a month and a year");
        }else {
            var selectedMonth = $('#MonthSelector').val();
            var selectedYear = $('#YearSelector').val();
            $('#chooseMonthYearModal').modal('hide');
            showExpensesByMonthandYear(selectedMonth, selectedYear)
        }
    });
};

// Function to confirm deletion
window.confirmDelete = function (ID) {
    // Show confirmation modal
    $('#deleteConfirmationModal').modal('show');

    // Handle confirmation
    $('#confirmDeleteButton').click(function () {
        $.ajax({
            url: "Exoda/deleteExoda",
            type: "POST",
            data: {
                ID: ID
            },
            success: function () {
                $('#deleteConfirmationModal').modal('hide');
                // Reload the page
                location.reload();
            }
        });
    });

    //Optionally handle cancellation
    $('#cancelDeleteButton').click(function () {
        $('#deleteConfirmationModal').modal('hide');
    });
};

$('#showCurrentMonth').click(function () {
    currentMonth = new Date().getMonth();
    showExpensesByMonth(currentMonth);
});

function showExpensesByMonthandYear(selectedMonth, selectedYear) {
    $.ajax({
        url: "Exoda/getExpensesbyMonthandYear",
        type: "GET",
        data: {
            selectedMonth: selectedMonth,
            selectedYear: selectedYear
        },
        dataType: "json",
        success: function (data) {
            // Populate DataTable with fetched data
            $('#myTable').DataTable().clear().rows.add(data).draw();
            
            // Update footer sum after redrawing table
            updateMonthSum(data);
        }
        // Footer callback to calculate sum
    });

    var monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    //update text
    $('#cMonth').text("Current Month : " + monthNames[selectedMonth - 1]);
}

function updateMonthSum(data) {
    let totalSum = 0;

    // Calculate total sum
    data.forEach(function(item) {
        totalSum += parseFloat(item.Price);
    });
    
    // Update footer with total sum
    if (totalSum == 0) {
        $('#monthSum').text("No Expenses found for this Month");
    }else {
        $('#monthSum').text("Total Expenses of the Month is " + totalSum.toFixed(2) + " Euros"); // Assuming two decimal places

    }
}
