$(document).ready(function () {
    let today = new Date();
    let formattedDate = getTodayDate(today);
    $('#date').val(formattedDate[0]);
    $('.day').text(formattedDate[1]);

    $('#date').on('change', function () {
        let selectedDate = new Date($(this).val());
        let formattedDate = getTodayDate(selectedDate);
        $('#date').val(formattedDate[0]);
        $('.day').text(formattedDate[1]);
    });

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

        let formattedDate = `${year}-${month}-${day}`;
        let newdate = `${day}/${month}/${year}`;
        let dayOfWeek = date.toLocaleString('en-US', { weekday: 'long' });

        return [formattedDate, dayOfWeek, newdate];
    }

    $('.form').on('submit', function (event) {
        event.preventDefault();
        let from = $('#from').val();
        let to = $('#to').val();
        let date = $('#date').val();

        routeValidation(from, to, date);
    });

    function routeValidation(from, to, date) {
        let selectedDate = new Date(date);
        let today = new Date();
        let valid = true;
        today.setHours(0, 0, 0, 0);
        selectedDate.setHours(0, 0, 0, 0);

        if ($('#to').val() === "0") {
            $('#to').addClass('is-invalid');
            valid = false;
        } else {
            $('#to').removeClass('is-invalid');
        }

        if ($('#from').val() === "0") {
            $('#from').addClass('is-invalid');
            valid = false;
        } else {
            $('#from').removeClass('is-invalid');
        }

        if (!from || !to || isNaN(selectedDate)) {
            alert("Please fill all fields correctly.");
            valid = false;
        }

        if (selectedDate < today) {
            alert("Choose a valid Date");
            $('#date').addClass('is-invalid');
            valid = false;
        } else {
            $('#date').removeClass('is-invalid');
        }

        if (valid) {
            let datef = new Date(date);
            let formatdate = getTodayDate(datef);
            $('.bbt').removeClass('d-none');
            $('.inp').addClass('d-none');
            $('.fro').text(from);
            $('.ot').text(to);
            $('.dy').text(formatdate[1]);
            $('.dat').text(formatdate[2]);
            $('.form.sector').removeClass('d-none');

            $.ajax({
                url: 'api/fetch_bus_list.php',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    from = from.toLowerCase();
                    to = to.toLowerCase();
                    let filteredData = response.filter(item => item.origin.toLowerCase() === from && item.destination.toLowerCase() === to);
                    populateBusListin(filteredData, date);
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }
    }

    function populateBusListin(businfo, travelDate) {
        $('.bus-container').addClass('d-none');
        $('.em-e').addClass('d-none');
        const busContainer = $('.bus-container');
        const busTemplate = document.getElementById('buslists').content;
        busContainer.empty();

        if (businfo.length > 0) {
            businfo.forEach(info => {
                const busClone = document.importNode(busTemplate, true);
                const price = parseFloat(info.Price);
                const priceInTshs = new Intl.NumberFormat('sw-TZ', {
                    style: 'currency',
                    currency: 'TZS'
                }).format(price);

                const departureDateTime = new Date(`${travelDate}T${info.DepartureTime}`);
                const arrivalDateTime = new Date(`${travelDate}T${info.ETA}`);

                if (isNaN(departureDateTime) || isNaN(arrivalDateTime)) {
                    console.error('Invalid date:', info.DepartureTime, info.ETA);
                } else {
                    const timeDifference = Math.abs(arrivalDateTime - departureDateTime);
                    const hoursUsed = Math.floor(timeDifference / (1000 * 60 * 60));
                    const minutesUsed = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));

                    busClone.querySelector('.bus-name').textContent = info.busName;
                    busClone.querySelector('.f-rom').textContent = info.origin;
                    busClone.querySelector('.t-o').textContent = info.destination;
                    busClone.querySelector('.bus-no').textContent = info.busNo;
                    busClone.querySelector('.seatType').textContent = info.seatTypeName;
                    busClone.querySelector('.bus-model').textContent = info.busModel;
                    busClone.querySelector('.pickLocation').textContent = ' ' + info.pickupLocation;
                    busClone.querySelector('.dropLocation').textContent = ' ' + info.dropLocation;
                    busClone.querySelector('.depart strong').textContent = departureDateTime.toLocaleTimeString();
                    busClone.querySelector('.time small').textContent = `${hoursUsed}h ${minutesUsed}m`;
                    busClone.querySelector('.availb-seat .seat').textContent = info.seatCapacity + ' ';
                    busClone.querySelector('.price strong').textContent = priceInTshs;
                    busClone.querySelector('.bookg').id = info.id;
                    busClone.querySelector('.destiniy strong').textContent = arrivalDateTime.toLocaleTimeString();

                    busContainer.append(busClone);
                }
            });
        } else {
            $('#alert').removeClass('d-none');
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
        console.log('Selected bus ID:', id);
    });
});
