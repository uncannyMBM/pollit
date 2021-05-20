@extends('layouts.app')
@section('page_title', 'Home')
@section('content')
    <div class="container" id="poll-app">
        <div class="row mt-5">
            <div class="col-md-5 offset-md-4">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="errorAnswer" v-cloak>
                    <strong>oOps!</strong> @{{ hasErrors.answer }}
                </div>
                <div class="card">
                    <div class="card-header bg-primary">
                        <h5 class="text-white">Answer the question</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text mb-1">What is the meaning of life to you?</p>
                        <div class="form-group">
                            <input type="radio" class="form-check-input" id="exampleCheck1" value="Happiness"
                                   v-model="poll.answer">
                            <label class="form-check-label" for="exampleCheck1">Happiness</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" class="form-check-input" id="exampleCheck2" value="Love"
                                   v-model="poll.answer">
                            <label class="form-check-label" for="exampleCheck2">Love</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" class="form-check-input" id="exampleCheck3" value="Money"
                                   v-model="poll.answer">
                            <label class="form-check-label" for="exampleCheck3">Money</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" class="form-check-input" id="exampleCheck4" value="Peace"
                                   v-model="poll.answer">
                            <label class="form-check-label" for="exampleCheck4">Peace</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" class="form-check-input" id="exampleCheck5" value="Travel"
                                   v-model="poll.answer">
                            <label class="form-check-label" for="exampleCheck5">Travel</label>
                        </div>

                        <button type="button" class="btn btn-primary mt-2" @click.prevent="proceedVote">Vote
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="userInfo" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">About yourself</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" v-model="poll.name" placeholder="Enter your name">
                            <span class="text-danger" v-cloak>@{{ hasErrors.name }}</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="email" class="form-control" v-model="poll.email"
                                   placeholder="Enter your email address">
                            <span class="text-danger" v-cloak>@{{ hasErrors.email }}</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click.prevent="pollSubmission">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var newApp = new Vue({
            el: "#poll-app",
            data: {
                errorAnswer: false,
                poll: {answer: '', name: '', email: ''},
                hasErrors: {answer: '', name: '', email: ''},
            },
            methods: {
                proceedVote(){
                   if(this.poll.answer.length > 0){
                      this.errorAnswer = false;
                      $('#userInfo').modal('show');
                   }else{
                       this.hasErrors.answer = 'You need to mark an answer to complete the survey.';
                       this.errorAnswer = true;
                       $('#userInfo').modal('hide');
                   }
                },
                pollSubmission() {
                    let _this = this;
                    axios.post("{{ route('poll.submission') }}", _this.poll)
                        .then(function (response) {
                            if (response.data.status) {
                                location.href = response.data.url;
                            } else {
                                _this.errorAnswer = true;
                                _this.hasErrors.answer = response.data.message;
                                $('#userInfo').modal('hide');
                            }
                        })
                        .catch(function (response) {
                            let errors = response.response.data.errors;
                            for (let error in errors) {
                                _this.hasErrors[error] = errors[error].toString();
                            }
                        })
                },
            },
            watch: {
                'poll.answer'(value) {
                    if (value.length > 0) {
                        this.errorAnswer = false,
                        this.hasErrors.answer = '';
                    }
                },
                'poll.name'(value) {
                    if (value.length > 0) {
                        this.hasErrors.name = '';
                    }
                },
                'poll.email'(value) {
                    if (value.length > 0) {
                        this.hasErrors.email = '';
                    }
                }
            }
        });
    </script>
@endsection