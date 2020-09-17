@extends('layouts.app')

@section('content')
    <h1>Tickets</h1>

    <table id="tickets" class="display" style="width:100%">
        <thead>
        <tr>
            <th>Name</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Created At</th>
            <th>Due Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tickets as $key => $ticket)
            <tr>
                <td>{{$ticket['customer']['name']}}</td>
                <td>{{$ticket['subject']}}</td>
                <td>{{$ticket['message']}}</td>
                <td>{{date('Y.m.d H:i:s',strtotime($ticket['created_at']))}}</td>
                <td>{{date('Y.m.d H:i:s',strtotime($ticket['due_date']))}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
