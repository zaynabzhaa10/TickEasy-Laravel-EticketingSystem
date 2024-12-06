@extends('layouts.master')

@section('content')
    <h1 class="text-3xl font-semibold">Ticket Sales Reports</h1>

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Event</th>
                <th class="px-4 py-2">Total Tickets Sold</th>
                <th class="px-4 py-2">Total Revenue</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salesData as $data)
                <tr>
                    <td class="px-4 py-2">{{ $data['event']->name }}</td>
                    <td class="px-4 py-2">{{ $data['total_tickets_sold'] }}</td>
                    <td class="px-4 py-2">{{ number_format($data['total_revenue'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
