<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{route('quiz.result',$quiz->slug)}}">
                @csrf
                <ol class="list-group list-group-numbered">
                    @foreach($quiz->questions as $question)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">{{$question->question}}</div>
                                @if($question->image)
                                    <img src="{{asset($question->image)}}" class="img-fluid"
                                         alt="{{$question->question}}" width="25%">
                                @endif

                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="{{$question->id}}"
                                           id="quiz{{$question->id}}1" value="answer1" required>
                                    <label class="form-check-label" for="quiz{{$question->id}}1">
                                        {{$question->answer1}}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="{{$question->id}}"
                                           id="quiz{{$question->id}}2" value="answer2" required>
                                    <label class="form-check-label" for="quiz{{$question->id}}2">
                                        {{$question->answer2}}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="{{$question->id}}"
                                           id="quiz{{$question->id}}3" value="answer3" required>
                                    <label class="form-check-label" for="quiz{{$question->id}}3">
                                        {{$question->answer3}}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="{{$question->id}}"
                                           id="quiz{{$question->id}}4" value="answer4" required>
                                    <label class="form-check-label" for="quiz{{$question->id}}4">
                                        {{$question->answer4}}
                                    </label>
                                </div>

                            </div>
                        </li>
                    @endforeach
                    <button type="submit" class="btn btn-outline-success btn-md">Sınavı Bitir</button>
                </ol>
            </form>

        </div>
    </div>

</x-app-layout>
