<x-app-layout>
    <x-slot name="header">{{$question->question}} Soru Düzenle</x-slot>
    <div class="card">
        <div class="card-body">
            <div class="float-end mb-2"><a href="{{route('questions.index', $question->quiz_id)}}"
                                           class="btn btn-primary btn-md"><i
                        class="fa-solid fa-arrow-left"></i> Geri
                    Dön</a></div>
            <form method="POST" action="{{route('questions.update', [$question->quiz_id,$question->id])}}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Soru</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                              name="question">{{$question->question}}</textarea>
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Fotoğraf</label>
                    @if($question->image)
                        <a href="{{asset($question->image)}}" target="_blank">
                            <img src="{{asset($question->image)}}" class="img-responsive" style="width: 200px;">
                        </a>
                    @endif
                    <input class="form-control" type="file" id="formFile" name="image">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">1. Cevap</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"
                                      name="answer1">{{$question->answer1}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">2. Cevap</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"
                                      name="answer2">{{$question->answer2}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">3. Cevap</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"
                                      name="answer3">{{$question->answer3}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">4. Cevap</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"
                                      name="answer4">{{$question->answer4}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Doğru Cevap</label>
                    <select class="form-select" aria-label="Default select example" name="correct_answer">
                        <option selected>Doğru Seçeneği Seçiniz...</option>
                        <option @if($question->correct_answer === 'answer1') selected @endif value="answer1">1. Cevap
                        </option>
                        <option @if($question->correct_answer === 'answer2') selected @endif value="answer2">2. Cevap
                        </option>
                        <option @if($question->correct_answer === 'answer3') selected @endif value="answer3">3. Cevap
                        </option>
                        <option @if($question->correct_answer === 'answer4') selected @endif value="answer4">4. Cevap
                        </option>
                    </select>
                </div>

                <div class="d-grid gap-2 col-2 mx-auto">
                    <button class="btn btn-success btn-md" style="background-color: #198754" type="submit">Soru
                        Güncelle
                    </button>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>
