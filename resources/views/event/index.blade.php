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
                            <div class="card mb-4 mx-6">
                                <a href={{ route('event.create') }} class="btn bg-gradient-primary btn-sm mb-0"
                                    type="button">+&nbsp;
                                    New Event</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-2 pt-2 pb-2">

                        <livewire:event-table />

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
