@extends('main')

@section('title', '| Contact')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <h1>Contact Me</h1>
                <hr>
                <form action="{{ url('contact') }}" method="POST">
                    <div class="form-group">
                        <label name = "email">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label name = "subject">Subject</label>
                        <input type="subject" name="subject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label name = "message">Message</label>
                        <textarea type="message" name="message" class="form-control">Type Your Message here...</textarea>
                    </div>
                    <input type="submit" value="Send Message" class="btn btn-success">

                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    @endsection