@extends('layouts.app')

@section('content')
    <h1>Support</h1>

    <form method="post" action="tickets/add">
        @csrf
        <div class="form-group">
            <label for="ticket_name">Name*:</label>
            <input id="ticket_name" class="form-control" name="ticket_name" type="text" required>
        </div>

        <div class="form-group">
            <label for="ticket_subject">Subject*:</label>
            <input id="ticket_subject" class="form-control" name="ticket_subject" type="text" required>
        </div>

        <div class="form-group">
            <label for="ticket_email">E-mail*:</label>
            <input id="ticket_email" class="form-control" name="ticket_email" type="email" required>
        </div>

        <div class="form-group">
            <label for="ticket_message">Message*:</label>
            <textarea id="ticket_message" class="form-control" name="ticket_message" required></textarea>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Send Message">
        </div>

    </form>
@endsection
