<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="float-end mb-2"><a href="{{route('quizzes.index')}}" class="btn btn-primary btn-md"><i
                            class="fa-solid fa-arrow-left"></i> Geri
                        Dön</a></div>
                <div class="col-md-4">
                    <ul class="list-group">
                        @if($quiz->finished_at)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Son Katılım Tarihi
                                <span title="{{$quiz->finished_at}}"
                                      class="badge bg-secondary rounded-pill">{{$quiz->finished_at->diffForHumans()}}</span>
                            </li>
                        @endif
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Soru Sayısı
                            <span class="badge bg-secondary rounded-pill">{{$quiz->questions_count}}</span>
                        </li>
                        @if($quiz->details)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Katılımcı Sayısı
                                <span class="badge bg-secondary rounded-pill">{{$quiz->details['join_count']}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ortalama Puan
                                <span class="badge bg-secondary rounded-pill">{{$quiz->details['average']}}</span>
                            </li>
                        @endif
                    </ul>

                    @if(count($quiz->topTen) > 0)
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">İlk 10</h5>
                                <ol class="list-group list-group-numbered">
                                    @foreach($quiz->topTen as $result)
                                        <li class="list-group-item">
                                            <span
                                                @if(auth()->user()->id === $result->user_id) class="text-bg-success text-light" @endif>{{$result->user->name}}</span>
                                            <div class="float-end">
                                                <span
                                                    class="badge bg-success rounded-pill">{{$result->point}} Puan</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="col-md-8">
                    <p class="card-text">{{$quiz->description}}</p>
                    <table class="table table-bordered mt-3">
                        <thead>
                        <tr>
                            <th scope="col">Ad Soyad</th>
                            <th scope="col">Puan</th>
                            <th scope="col">Doğru</th>
                            <th scope="col">Yanlış</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($quiz->results as $result)
                            <tr>
                                <td>{{$result->user->name}}</td>
                                <td>{{$result->point}}</td>
                                <td>{{$result->correct}}</td>
                                <td>{{$result->wrong}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
