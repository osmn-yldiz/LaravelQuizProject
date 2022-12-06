<x-app-layout>
    <x-slot name="header">{{$quiz->title}} Sonucu</x-slot>

    <div class="card">
        <div class="card-body">

            <p class="fs-1">Puan: <span class="fw-bold">{{$quiz->my_result->point}}</span></p>

            <div class="alert bg-light" role="alert">
                <i class="fa-solid fa-circle-dot text-dark"></i> İşaretlediğin Şık<br>
                <i class="fa-solid fa-check text-success"></i> Doğru Cevap<br>
                <i class="fa-solid fa-xmark text-danger"></i> Yanlış Cevap
            </div>

            <ol class="list-group list-group-numbered">
                @foreach($quiz->questions as $question)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">

                            <div class="d-inline-flex">
                                <div class="fw-bold">{{$question->question}}</div>

                                @if($question->correct_answer === $question->my_answer->answer)
                                    <i class="fa-solid fa-check fa-2x text-success ml-2"></i>
                                @else
                                    <i class="fa-solid fa-xmark fa-2x text-danger ml-2"></i>
                                @endif
                            </div>

                            @if($question->image)
                                <img src="{{asset($question->image)}}" class="img-fluid"
                                     alt="{{$question->question}}" width="25%">
                            @endif

                            <br>
                            <small class="text-capitalize text-dark text-bg-light">Bu soruya <strong
                                    class="text-decoration-underline">%{{$question->true_percent}}</strong>
                                oranında doğru cevap verildi.</small>

                            <div class="form-check mt-2">
                                @if("answer1" === $question->correct_answer)
                                    <i class="fa-solid fa-check text-success"></i>
                                @elseif("answer1" === $question->my_answer->answer)
                                    <i class="fa-solid fa-circle-dot"></i>
                                @endif
                                <label class="form-check-label" for="quiz{{$question->id}}1">
                                    {{$question->answer1}}
                                </label>
                            </div>

                            <div class="form-check">
                                @if("answer2" === $question->correct_answer)
                                    <i class="fa-solid fa-check text-success"></i>
                                @elseif("answer2" === $question->my_answer->answer)
                                    <i class="fa-solid fa-circle-dot"></i>
                                @endif
                                <label class="form-check-label" for="quiz{{$question->id}}2">
                                    {{$question->answer2}}
                                </label>
                            </div>

                            <div class="form-check">
                                @if("answer3" === $question->correct_answer)
                                    <i class="fa-solid fa-check text-success"></i>
                                @elseif("answer3" === $question->my_answer->answer)
                                    <i class="fa-solid fa-circle-dot"></i>
                                @endif
                                <label class="form-check-label" for="quiz{{$question->id}}3">
                                    {{$question->answer3}}
                                </label>
                            </div>

                            <div class="form-check">
                                @if("answer4" === $question->correct_answer)
                                    <i class="fa-solid fa-check text-success"></i>
                                @elseif("answer4" === $question->my_answer->answer)
                                    <i class="fa-solid fa-circle-dot"></i>
                                @endif
                                <label class="form-check-label" for="quiz{{$question->id}}4">
                                    {{$question->answer4}}
                                </label>
                            </div>

                        </div>
                    </li>
                @endforeach
            </ol>

        </div>
    </div>

</x-app-layout>
