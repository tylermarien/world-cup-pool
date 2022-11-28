@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <section class="details bg-primary" id="details">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    @include('entry.compare.dropdown', ['entries' => $entries, 'left' => $left, 'right' => $right, 'side' => 'left'])
                    @include('entry.compare.teams', ['entry' => $left, 'comparison' => $right])
                    @if ($left->players->isNotEmpty())
                        @include('entry.compare.players', ['entry' => $left, 'comparison' => $right])
                    @endif
                </div>

                <div class="col-md-6">
                    @include('entry.compare.dropdown', ['entries' => $entries, 'left' => $left, 'right' => $right, 'side' => 'right'])
                    @include('entry.compare.teams', ['entry' => $right, 'comparison' => $left])
                    @if ($right->players->isNotEmpty())
                        @include('entry.compare.players', ['entry' => $right, 'comparison' => $left])
                    @endif
                </div>
            </div>
    </section>
@endsection
