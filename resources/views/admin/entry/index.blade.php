@extends('layouts.admin')

@section('title', 'Entries')

@section('content')
    <div class="container">
        <h1>Entries</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Entry</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entries as $entry)
                <tr>
                    <td>
                        <a href="{{ route('admin.entries.edit', ['entry' => $entry]) }}">
                            {{ $entry->name }}
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
