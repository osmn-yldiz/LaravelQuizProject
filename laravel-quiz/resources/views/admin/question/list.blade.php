<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}} Quizine ait Sorular
    </x-slot>
    <div class="card">
        <div class="card-body">
            <div class="card-title">

                <a href="{{route('questions.create',$quiz->id)}}" class="btn btn-md btn-primary"><i
                        class="fa-solid fa-plus"></i>
                    Soru Oluştur</a>

                <div class="float-end mb-2"><a href="{{route('quizzes.index')}}" class="btn btn-primary btn-md"><i
                            class="fa-solid fa-arrow-left"></i> Geri
                        Dön</a></div>
            </div>

            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th scope="col">Soru</th>
                    <th scope="col">Fotoğraf</th>
                    <th scope="col">1. Cevap</th>
                    <th scope="col">2. Cevap</th>
                    <th scope="col">3. Cevap</th>
                    <th scope="col">4. Cevap</th>
                    <th scope="col">Doğru Cevap</th>
                    <th scope="col" style="width: 80px;">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($quiz->questions as $question)
                    <tr>
                        <td>{{$question->question}}</td>
                        <td>
                            @if($question->image)
                                <a href="{{asset($question->image)}}" class="btn btn-sm btn-light" target="_blank">Görüntüle</a>
                            @endif
                        </td>
                        <td>{{$question->answer1}}</td>
                        <td>{{$question->answer2}}</td>
                        <td>{{$question->answer3}}</td>
                        <td>{{$question->answer4}}</td>
                        <td><span class="badge rounded-pill bg-success text-light">{{Str::substr($question->correct_answer, -1)}}. Cevap</span></td>
                        <td>
                            <a href="{{route('questions.edit',[$quiz->id,$question->id])}}"
                               class="btn btn-sm btn-warning"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{route('questions.destroy', [$quiz->id, $question->id])}}" class="btn btn-sm btn-danger"><i
                                    class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
