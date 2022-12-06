<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <ul class="list-group">
                        @if($quiz->my_rank)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Sıralama
                                <span class="badge bg-primary rounded-pill">#{{$quiz->my_rank}}</span>
                            </li>
                        @endif
                        @if($quiz->my_result)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Puan
                                <span class="badge bg-primary rounded-pill">{{$quiz->my_result->point}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Doğru / Yanlış Sayısı
                                <div class="float-end">
                                    <span
                                        class="badge bg-success rounded-pill">{{$quiz->my_result->correct}} Doğru</span>
                                    <span class="badge bg-danger rounded-pill">{{$quiz->my_result->wrong}} Yanlış</span>
                                </div>
                            </li>
                        @endif
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
                    <div class="d-grid gap-2 mt-2">
                        @if($quiz->my_result)
                            <a href="{{route('quiz.join',$quiz->slug)}}" class="btn btn-outline-warning btn-md"
                               style="background-color: #ffc107; color: #000000;">Quiz'i Görüntüle</a>
                        @elseif($quiz->finished_at > now())
                            <a href="{{route('quiz.join',$quiz->slug)}}" class="btn btn-outline-primary btn-md"
                               style="background-color: #0d6efd; color: #ffffff;">Quiz'e Katıl</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
