@extends('layouts.app')

@section('content')
    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@latest/main.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.5/main.min.css"
        integrity="sha512-1P/SRFqI1do4eNtBsGIAqIZIlnmOQkaY7ESI2vkl+q+hl9HSXmdPqotN0McmeZVyR4AWV+NvkP6pKOiVdY/V5A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"
        integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .container{
                background-color: red;
            }
            </style>
    @endpush

    <h1>First Page</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.js"
        integrity="sha512-R2ktoX0ULWEVnA5+oE1kuNEl3KZ9SczXbJk4aT7IgPNfbgTqMG7J14uVqPsdQmZfyTjh0rddK9sG/Mlj97TMEw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css">
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.js"></script>
        <script>
           document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                // Your calendar options go here
            });
            calendar.render();
        });

        </script>
    @endpush
@endsection
