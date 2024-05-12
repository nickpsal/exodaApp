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
                    data: 'ID'
                },
                {
                    data: 'Description'
                },
                {
                    data: 'Price'
                },
                {
                    data: 'ExodoMonth',
                    render: function (data) {
                        return new Date(2000, data - 1).toLocaleString('EN', { month: 'long' });
                    }
                },
                {
                    data: 'ExodoYear'
                },
                {
                    data: 'dateCreated'
                },
                {
                    data: 'Repeated',
                    render: function (data) {
                        return data === '0' ? 'True' : 'False';
                    }
                },
                {
                    data: 'AutoRenew',
                    render: function (data) {
                        return data === '0' ? 'True' : 'False';
                    }
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
    let currentMonth = new Date().getMonth();
    var monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    //update text
    $('#cMonth').text("Current Month : " + monthNames[currentMonth]); 
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
            document.getElementById("UpdateExodaModalLabel").innerText = 'Edit ' + data['Description'];
            $('#ID').val(data.ID);
            $('#updateDescription').val(data['Description']);
            $('#updatePrice').val(data['Price']);
            $('#updateExodoMonth').val(data['ExodoMonth']);
            $('#updateExodoYear').val(data['ExodoYear']);
            $('#updateRepeated').val(data['Repeated']);
            $('#updateAutoRenew').val(data['AutoRenew']);
            var AutoPay = data['Autopay'];
            console.log(AutoPay);
            $('#updateAutoPay').val(ΑutoPay);
        }
    });
}

//previous month expenses
window.chooseMonth = function () {
    $('#chooseMonthModal').modal('show');
    // document.getElementById('MonthSelector').addEventListener('change', function () {
    //     if ($('#MonthSelector').val() != '-') {
    //         var selectedMonth = $('#MonthSelector').val();
    //         $('#myTable').DataTable().destroy();
    //         showExpensesByMonth(selectedMonth);
    //         $('#chooseMonthModal').modal('hide');
    //     }
    $('#ChooseMonthandYear').click(function () {
        if ($('#ChooseMonthandYear').val() != '-' && $('#YearSelector').val() != '-') {
            var selectedMonth = $('#MonthSelector').val();
            var selectedYear = $('#YearSelector').val();
            showExpensesByMonthandYear(selectedMonth, selectedYear)
            $('#deleteConfirmationModal').modal('hide');
        }else {
            alert("Please select a month and a year");
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
    selectedMonth = parseInt(selectedMonth);

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
    $('#monthSum').text("Total Expenses of the Month is " + totalSum.toFixed(2) + " Euros"); // Assuming two decimal places
}
