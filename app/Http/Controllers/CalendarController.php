<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function save_event(Request $request)
    {
        if ($request->first_load == 'true') // get_only
        {

            $calendar = CalendarEvent::find(1);

            if ($calendar == null) {

                return response()->json(
                    [
                        'status' => 'no_data_yet',
                        'event_title' => 'Title',
                        'date_month_year_start' => 'Date:',
                        'date_month_year_end' => 'Date',
                        'day_of_the_week' => []
                    ]);
            } else {
                $event_title = $calendar->event_title;
                $date_start = $calendar->start_date;
                $date_end = $calendar->end_date;


                $date_range = CarbonPeriod::create($calendar->start_date, $calendar->end_date);
                $date_array = explode(',', (implode(', ', ($date_range)->toArray())));

                $get_month_year_start = Carbon::parse($date_start)->isoFormat('MMMM YYYY');
                $get_month_year_end = Carbon::parse($date_end)->isoFormat('MMMM YYYY');

                $array_date_carbon = [];

                $day_to_be_check_in_db = array(
                    $calendar->monday,
                    $calendar->tuesday,
                    $calendar->wednesday,
                    $calendar->thursday,
                    $calendar->friday,
                    $calendar->saturday,
                    $calendar->sunday
                );

                $day_to_be_check = array(
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday',
                    'Sunday'
                );

                foreach ($date_array as $single_date) {
                    $date_of_day_carbon = Carbon::create($single_date)->isoFormat('D dddd');
                    $checker = explode(' ', $date_of_day_carbon)[1];
                    $find_true = 0;

                    for ($ctr = 0; $ctr < 7; $ctr++) {
                        if ($day_to_be_check[$ctr] === $checker && $day_to_be_check_in_db[$ctr] == '1') {
                            $find_true = 1;
                        }
                    }

                    if ($find_true === 1) {
                        $date_of_day_carbon = $date_of_day_carbon . ":true";
                    } else {
                        $date_of_day_carbon = $date_of_day_carbon . ":false";
                    }

                    array_push($array_date_carbon, $date_of_day_carbon);
                }

                return response()->json(
                    [
                        'status' => 'loaded',
                        'event_title' => $event_title,
                        'date_month_year_start' => $get_month_year_start,
                        'date_month_year_end' => $get_month_year_end,
                        'day_of_the_week' => $array_date_carbon
                    ]);
            }


        } else// save and get
        {
            $event_title = $request->event_title;
            $date_start = $request->date_start;
            $date_end = $request->date_end;

            $calendar = CalendarEvent::firstOrNew(['id' => 1]);
            $calendar->event_title = $event_title;
            $calendar->start_date = $date_start;
            $calendar->end_date = $date_end;
            $calendar->monday = $request->mon;
            $calendar->tuesday = $request->tues;
            $calendar->wednesday = $request->wed;
            $calendar->thursday = $request->thurs;
            $calendar->friday = $request->fri;
            $calendar->saturday = $request->sat;
            $calendar->sunday = $request->sun;

            $calendar->save();

            $date_range = CarbonPeriod::create($calendar->start_date, $calendar->end_date);
            $date_array = explode(',', (implode(', ', ($date_range)->toArray())));

            $array_date_carbon = [];

            $get_month_year_start = Carbon::parse($date_start)->isoFormat('MMMM YYYY');
            $get_month_year_end = Carbon::parse($date_end)->isoFormat('MMMM YYYY');

            $day_to_be_check_in_db = array(
                $calendar->monday,
                $calendar->tuesday,
                $calendar->wednesday,
                $calendar->thursday,
                $calendar->friday,
                $calendar->saturday,
                $calendar->sunday
            );

            $day_to_be_check = array(
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday'
            );

            foreach ($date_array as $single_date) {
                $date_of_day_carbon = Carbon::create($single_date)->isoFormat('D dddd');

                $checker = explode(' ', $date_of_day_carbon)[1];

                $find_true = 0;

                for ($ctr = 0; $ctr < 7; $ctr++) {
                    if ($day_to_be_check[$ctr] === $checker && $day_to_be_check_in_db[$ctr] == '1') {
                        $find_true = 1;
                    }
                }

                if ($find_true === 1) {
                    $date_of_day_carbon = $date_of_day_carbon . ":true";
                } else {
                    $date_of_day_carbon = $date_of_day_carbon . ":false";
                }

                array_push($array_date_carbon, $date_of_day_carbon);
            }


            return response()->json(
                [
                    'status' => 'save_loaded',
                    'event_title' => $calendar->event_title,
                    'date_month_year_start' => $get_month_year_start,
                    'date_month_year_end' => $get_month_year_end,
                    'day_of_the_week' => $array_date_carbon
                ]);
        }
    }
}
