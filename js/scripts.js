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
        let newdate = day + '/' + month + '/' + year;
        let dayOfWeek = date.toLocaleString('en-US', { weekday: 'long' });

        return [formattedDate, dayOfWeek, newdate];
    }

    // Routes Submition Form
    $('.form').on('submit', function (event) {
        event.preventDefault();
        var from = $('#from').val();
        var to = $('#to').val();
        var date = $('#date').val();
        var day = $('.day').val();

        routeValidation(from, to, date, day);
    });

    // Route Validation Function
    function routeValidation(from, to, date, day) {
        var mydate = new Date(date);
        let today = new Date();
        let valid = true;
        today.setHours(0, 0, 0, 0);
        mydate.setHours(0, 0, 0, 0);

        if ($('#to').val() == "0") {
            $('#to').addClass('is-invalid');
            valid = false;
            return;
        } else {
            $('#to').removeClass('is-invalid');
        }

        if ($('#from').val() == "0") {
            $('#from').addClass('is-invalid');
            valid = false;
            return;
        } else {
            $('#from').removeClass('is-invalid');
        }
        if (!from || !to || isNaN(mydate)) {
            alert("Please fill all fields correctly.");
            valid = false;
            return;
        }

        if (mydate < today) {
            alert("Choose valid Date");
            $('#date').addClass('is-invalid');
            valid = false;
            return;
        } else {
            $('#date').removeClass('is-invalid');
        }
        if (valid) {
            let datef = new Date(date);
            let formatdate = getTodayDate(datef)
            $('.bbt').removeClass('d-none');
            $('.inp').addClass('d-none');
            $('.fro').text('');
            $('.fro').text(from);
            $('.ot').text('');
            $('.ot').text(to);
            $('.dy').text('');
            $('.dy').text(formatdate[1]);
            $('.dat').text('');
            $('.dat').text(formatdate[2]);
            $('.form.sector').removeClass('d-none');


            $.ajax({
                url: 'api/fetch_bus_list.php',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    // response = JSON.parse(response);
                    from = from.toLowerCase();
                    to = to.toLowerCase();
                    // alert(from + ' ' + to)
                    let filteredData = response.filter(item => item.origin.toLowerCase() == from && item.destination.toLowerCase() == to);
                    console.log(filteredData);
                    populateBusListin(filteredData)
                }
            });
        }

    }

    function populateBusListin(businfo) {

        $('.bus-container').addClass('d-none');
        $('.em-e').addClass('d-none');
        const busContainer = $('.bus-container');
        const busTemplate = document.getElementById('buslists').content;
        busContainer.empty();

        if (businfo.length > 0) {

            businfo.forEach(info => {

                const busClone = document.importNode(busTemplate, true);
                busClone.querySelector('.bus-name').textContent = info.busName;
                busClone.querySelector('.f-rom').textContent = info.origin;
                busClone.querySelector('.t-o').textContent = info.destination;
                busClone.querySelector('.bus-no').textContent = info.busNo;
                busClone.querySelector('.seatType').textContent = info.seatTypeName;
                busClone.querySelector('.bus-model').textContent = info.busModel;
                busClone.querySelector('.pickLocation').textContent = ' ' + info.pickupLocation;
                busClone.querySelector('.dropLocation').textContent = ' ' + info.dropLocation;
                busClone.querySelector('.depart strong').textContent = info.DepartureTime;
                busClone.querySelector('.time small').textContent = '';
                busClone.querySelector('.availb-seat .seat').textContent = info.seatCapacity + ' ';
                busClone.querySelector('.price strong').textContent = info.Price;
                busClone.querySelector('.bookg').id = info.id;
                // busClone.querySelector('.bookg').id="openModalButton"
                busClone.querySelector('.destiniy strong').textContent = info.ETA;

                busContainer.append(busClone);
            });
        } else {
            $('#alert').removeClass('d-none');
            // console.log()
        }
        $('.bus-container').removeClass('d-none');
        setTimeout(() => {

            $('.bbt').addClass('d-none');
            $('.inp').removeClass('d-none');
        }, 3000);
    }

    $(document).on('click', '.bookg', function (e) {
        e.preventDefault();
        let btn = $(this);
        let id = btn.attr('id');
    });
});
