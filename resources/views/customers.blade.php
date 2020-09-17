@extends('layouts.app')

@section('content')
    <h1>Customers</h1>

    <table id="customers" class="display" style="width:100%">
        <thead>
        <tr>
            <th>Name</th>
            <th>E-mail</th>
            <th>Created At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $key => $customer)
            <tr>
                <td>{{$customer['name']}}</td>
                <td>{{$customer['email']}}</td>
                <td>{{date('Y.m.d H:i:s',strtotime($customer['created_at']))}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
