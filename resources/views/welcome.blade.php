<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Event Calendar</title>

    {{--srcipt--}}{{--jquery--}}
    <script src="{{asset('js/app.js')}}" defer></script>

    {{--bootstrap--}}{{--style--}}
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <style>

        .form-check {
            margin: 4px;
        }

    </style>

</head>
<body>
<div class="content">
    <div class="card">
        <div class="card-header">
            <h3>Simple Event Calendar Exam (Appetiser)</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h4>My Event</h4>
                    <div class="row form-group">
                        <div class="col-md-12">

                            <label class="label" for="event_title">Title:</label>
                            <input id="event_title" class="form-control" type="text" placeholder="Title here">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label class="label" for="date_from">From:</label>
                            <input id="date_from" class="form-control" type="date">
                        </div>
                        <div class="col-md-6">
                            <label class="label" for="date_to">To:</label>
                            <input id="date_to" class="form-control" type="date">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input check_day" id="mon">
                                <label class="form-check-label" for="mon">Mon</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input check_day" id="tues">
                                <label class="form-check-label" for="tues">Tues</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input check_day" id="wed">
                                <label class="form-check-label" for="wed">Wed</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input check_day" id="thurs">
                                <label class="form-check-label" for="thurs">Thurs</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input check_day" id="fri">
                                <label class="form-check-label" for="fri">Fri</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input check_day" id="sat">
                                <label class="form-check-label" for="sat">Sat</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input check_day" id="sun">
                                <label class="form-check-label" for="sun">Sun</label>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end">
                            <button class="btn btn-solid btn-primary" id="btn_save_event">Save Event</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <h4>Calendar</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <h3><label id="date_label">Date</label></h3>
                            <table class="table table-bordered" id="date_table">
                                <tbody id="date_table_body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</body>

<script src="{{asset('jscript/calendar.js')}}" defer></script>

</html>
