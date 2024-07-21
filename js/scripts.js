$(document).ready(function () {
    let today = new Date();
    let formattedDate = getTodayDate(today);
    $('#date').val(formattedDate[0]);
    $('.day').text(formattedDate[1]);
    $('#date').val(formattedDate[0]);
    // console.log(formattedDate[0]);

    $('#date').on('change', function () {
        let today = new Date($(this).val());
        let formattedDate = getTodayDate(today);
        $('#date').val(formattedDate[0]);
        $('.day').text(formattedDate[1]);
        $('#date').val(formattedDate[0]);
        console.log(formattedDate[0]);
        console.log(formattedDate[1]);
    });

    // get date function
    function getTodayDate(date) {
        let month = date.getMonth() + 1; 
        let day = date.getDate();
        let year = date.getFullYear();

        if (month < 10) {
            month = '0' + month;
        }
        if (day < 10) {
            day = '0' + day;
        }

        let formattedDate = year + '-' + month + '-' + day;
        let dayOfWeek = date.toLocaleString('en-US', { weekday: 'long' });

        return [formattedDate, dayOfWeek];
    }

    // Routes Submition Form
    $('.form').on('submit', function (event) {
        event.preventDefault(); 
        var from = $('#from').val().trim();
        var to = $('#to').val().trim();
        var date = $('#date').val().trim();

        alert(from);
        alert(to);
        alert(date);

        routeValidation(from, to, date);
    });

    // Route Validation Function
    function routeValidation(from, to, date) {
        var mydate = new Date(date);
        let day = mydate.getDay();

        // Add your validation logic here
        if (!from || !to || isNaN(mydate)) {
            alert("Please fill all fields correctly.");
        } else {
            alert("Validation successful!");
        }
    }
});
