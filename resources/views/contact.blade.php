@extends('layouts.app')

@section('content')
    <h1>Support</h1>

    <form method="post" action="contact/submit">
        @csrf
        <div class="form-group">
            <label for="contact_name">Name*:</label>
            <input id="contact_name" class="form-control" name="contact_name" type="text" required>
        </div>

        <div class="form-group">
            <label for="contact_subject">Subject*:</label>
            <input id="contact_subject" class="form-control" name="contact_subject" type="text" required>
        </div>

        <div class="form-group">
            <label for="contact_email">E-mail*:</label>
            <input id="contact_email" class="form-control" name="contact_email" type="email" required>
        </div>

        <div class="form-group">
            <label for="contact_message">Message*:</label>
            <textarea id="contact_message" class="form-control" name="contact_message" required></textarea>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Send Message">
        </div>

    </form>
@endsection
