$(document).ready(function () {

    var first_load = true;
    var arr_check = [];

    function get_save_event(event_title, date_start, date_end, first_load, arr_check) {

        var btn = $('#btn_save_event');

        $.ajax({
            url: 'calendar/event_save',
            data: {
                'event_title': event_title,
                'date_start': date_start,
                'date_end': date_end,
                'first_load': first_load,
                'mon': arr_check[0],//monday
                'tues': arr_check[1],//tuesday
                'wed': arr_check[2],//wednesday
                'thurs': arr_check[3],//thursday
                'fri': arr_check[4],//friday
                'sat': arr_check[5],//saturday
                'sun': arr_check[6] //sunday
            },
            type: 'get',
            beforeSend: function () {
                console.log('Please wait..');
                $('#date_table').hide();
                btn.html('Please wait..');
                btn.attr('disabled', 'disabled');
            },
            success: function (data) {
                console.log(data);

                var date_month_year_start = data['date_month_year_start'];
                var date_month_year_end = data['date_month_year_end'];
                var date_year_to_be_show = '';
                var event_title = data['event_title'];
                var day_of_the_week = data['day_of_the_week'];
                var status = data['status'];

                if (date_month_year_start === date_month_year_end) {
                    date_year_to_be_show = date_month_year_start;
                }
                else {
                    date_year_to_be_show = date_month_year_start + ' - ' + date_month_year_end;
                }

                if (status === 'no_data_yet') {
                    $('#date_label').html('Date');
                }
                else {
                    $('#date_label').html(date_year_to_be_show + ' : ' + event_title);
                }

                $('#date_table_body').html('');

                $.each(day_of_the_week, function (index, value) {

                    var $splitted = value.split(':');

                    if ($splitted[1] === 'true') {
                        $('#date_table_body').append('<tr class="table-primary"><td>' + $splitted[0] + '</td></tr>');
                    }
                    else {
                        $('#date_table_body').append('<tr><td>' + $splitted[0] + '</td></tr>');
                    }

                });

                if(status === 'loaded'){
                    alert('Successfully Loaded');
                }else if(status === 'save_loaded'){
                    alert('Event Successfully Saved and Loaded');
                }

            },
            error: function (e) {
                alert(e.responseText);
                console.log(e.responseText);
            },
            complete: function () {
                first_load = false;
                $('#date_table').show();
                btn.html('Save Event');
                btn.removeAttr('disabled');
            }
        })

    }

    //triggers on reload or first load of interface
    get_save_event('', '', '', first_load, arr_check);


    $('#btn_save_event').click(function () {

        var event_title = $('#event_title').val();
        var date_start = $('#date_from').val();
        var date_end = $('#date_to').val();
        arr_check = [];

        if (date_start === '' || date_end === '') {
            alert('Please Select Date.');
        }
        else if (event_title === '') {
            alert('Please Enter Title..');
        }
        else {
            $('.check_day').each(function () {

                if ($(this).is(':checked')) {
                    arr_check.push('1');
                }
                else {
                    arr_check.push('0');
                }
            });

            get_save_event(event_title, date_start, date_end, false, arr_check);
        }

    });

});