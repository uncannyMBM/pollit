@extends('layouts.app')
@section('page_title', 'Home')
@section('content')
    <div class="container" id="poll-app">
        <div class="row mt-5">
            <div class="col-md-5 offset-md-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h5 class="text-white">What is the meaning of life to you?</h5>
                    </div>
                    <div class="card-body">
                        <li class="{{ $myAnswer->answer == 'Happiness' ? 'correct' : '' }}">
                            <span class="perc-back" style="width:{{ $answer['Happiness'] }}%"></span>
                            <label class="poll-result-label">Happiness</label>
                            <span class="perc-number">{{ $answer['Happiness'] }}%</span>
                        </li>
                        <li class="{{ $myAnswer->answer == 'Love' ? 'correct' : '' }}">
                            <span class="perc-back" style="width:{{ $answer['Love'] }}%"></span>
                            <label class="poll-result-label">Love</label>
                            <span class="perc-number">{{ $answer['Love'] }}%</span>
                        </li>
                        <li class="{{ $myAnswer->answer == 'Money' ? 'correct' : '' }}">
                            <span class="perc-back" style="width:{{ $answer['Money'] }}%"></span>
                            <label class="poll-result-label">Money</label>
                            <span class="perc-number">{{ $answer['Money'] }}%</span>
                        </li>
                        <li class="{{ $myAnswer->answer == 'Peace' ? 'correct' : '' }}">
                            <span class="perc-back" style="width:{{ $answer['Peace'] }}%"></span>
                            <label class="poll-result-label">Peace</label>
                            <span class="perc-number">{{ $answer['Peace'] }}%</span>
                        </li>
                        <li class="{{ $myAnswer->answer == 'Travel' ? 'correct' : '' }}">
                            <span class="perc-back" style="width:{{ $answer['Travel'] }}%"></span>
                            <label class="poll-result-label">Travel</label>
                            <span class="perc-number">{{ $answer['Travel'] }}%</span>
                        </li>
                        <a type="button" class="btn btn-dark mt-2" href="{{ url('/') }}" style="float: right">Poll Again</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection