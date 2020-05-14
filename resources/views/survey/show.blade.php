@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1> {{ $questionnaire->title }}</h1>
            <form action="{{ route('surveys.store' ,[ $questionnaire->id ,Str::slug($questionnaire->title)])}}" method="post">
               @csrf
                @foreach($questionnaire->questions as $key => $question)
                <div class="card mt-2" >
                    <div class="card-header"><strong>{{ $key +1 }}.</strong>  {{ $question->question }}</div>
                    <div class="card-body">
                        @error('responses.'. $key . '.answer_id' )
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <ul class="list-group">
                            @foreach( $question->answers as $answer)
                                <label for="answer{{ $answer->id}}">
                                    <li class="list-group-item">   
                                        <input type="radio" name="responses[{{ $key }}][answer_id]" id="answer{{ $answer->id }}"
                                       
                                         class="mr-2" value="{{ $answer->id }}">
                                        {{ $answer->answer}}
                                        <input type="hidden"name="responses[{{ $key }}][question_id]" value="{{ $question->id}}">
                                    </li>
                                </label>
                            @endforeach
                        </ul>
                        
                    </div> 
                </div>
                @endforeach  

                <div class="card mt-2" >
                    <div class="card-header">Your Information</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" >Your Name</label>
                            <input type="text" name="survey[name]" class="form-control" id="name"  placeholder="Enter Name">
                            @error('name')
                                <small class="text-danger">{{ $message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Purpose</label>
                            <input type="email" name="survey[email]" class="form-control" id="email"  placeholder="Enter Email">
                            @error('email')
                                <small class="text-danger">{{ $message}}</small>
                            @enderror
                        </div>
                        <button class="btn btn-dark mt-4" type="submit">Complete Survey</button>
                    </div> 
                </div>
            </form>    
        </div>
    </div>
</div>
@endsection
