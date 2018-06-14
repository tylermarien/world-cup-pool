@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <section class="details bg-primary" id="details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="blue">{{ __('Name') }} <small class="red">{{ __('Points') }} pts</small></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h2 class="blue"><small><i class="fas fa-flag"></i></small> {{ __('Teams') }}</h2>
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <td>{{ __('Team') }}</td>
                            <td>{{ __('Points') }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <h2 class="blue"><small><i class="far fa-futbol"></i></small> {{ __('Players') }}</h2>
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <td>{{ __('Player') }}</td>
                            <td>{{ __('Points') }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
@endsection
