@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="alert alert-secondary mx-4" role="alert">
            <span class="text-white" name="message" id="txtmessage">
                function not configure yet
            </span>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">Event List</h5>
                            </div>
                            <a href={{ route('event.create') }} class="btn bg-gradient-primary btn-sm mb-0"
                                type="button">+&nbsp;
                                New Event</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Event ID
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Event Theme
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Event Name
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Organizer
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Event Start Date
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">3</p>
                                        </td>
                                        <td>
                                            <div>
                                                <img src="/assets/img/team-3.jpg" class="avatar avatar-sm me-3">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Member</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">member@softui.com</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Member</p>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">23/06/20</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="route(event.add)" class="mx-3" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit user">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>

                                            <a href="route(event.add)" class="mx-3" data-bs-toggle="tooltip"
                                                data-bs-original-title="Delete event">

                                                <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </a>

                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
