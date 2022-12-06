<x-app-layout>
    <x-slot name="header">Quizler</x-slot>
    <div class="card">
        <div class="card-body">
            <div class="card-title">

                <a href="{{route('quizzes.create')}}" class="btn btn-md btn-primary"><i
                        class="fa-solid fa-plus"></i>
                    Quiz Oluştur</a>

                <form action="" class="d-flex float-end" method="GET">

                    <div class="mb-3 mr-3">
                        <input type="search" class="form-control" id="exampleInputEmail1" name="title"
                               placeholder="Quiz Başlığı" value="{{request()->get('title')}}">
                    </div>

                    <div class="mb-3 mr-3">
                        <select class="form-select" aria-label="Default select example" name="status"
                                onchange="this.form.submit()">
                            <option value="" selected>Quiz Durumunu Seçiniz...</option>
                            <option @if(request()->get('status') === 'publish') selected @endif value="publish">Aktif
                            </option>
                            <option @if(request()->get('status') === 'passive') selected @endif value="passive">Pasif
                            </option>
                            <option @if(request()->get('status') === 'draft') selected @endif value="draft">Taslak
                            </option>
                        </select>
                    </div>

                    @if(request()->get('title') || request()->get('status'))
                        <div class="mb-3 mr-3">
                            <a href="{{route('quizzes.index')}}" class="btn btn-secondary btn-md">Sıfırla</a>
                        </div>
                    @endif

                </form>

            </div>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Quiz</th>
                    <th scope="col">Soru Sayısı</th>
                    <th scope="col">Durum</th>
                    <th scope="col">Bitiş Tarihi</th>
                    <th scope="col">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($quizzes as $quiz)
                    <tr>
                        <td>{{$quiz->title}}</td>
                        <td>{{$quiz->questions_count}}</td>
                        <td>
                            @switch($quiz->status)
                                @case('publish')
                                @if(!$quiz->finished_at)
                                    <span class="badge rounded-pill bg-success">Aktif</span>
                                @elseif($quiz->finished_at > now())
                                    <span class="badge rounded-pill bg-success">Aktif</span>
                                @else
                                    <span class="badge rounded-pill bg-secondary">Tarihi Dolmuş</span>
                                @endif
                                @break
                                @case('passive')
                                <span class="badge rounded-pill bg-danger">Pasif</span>
                                @break
                                @case('draft')
                                <span class="badge rounded-pill bg-warning text-dark">Taslak</span>
                                @break
                            @endswitch
                        </td>
                        <td>
                            <span title="{{$quiz->finished_at}}">
                                {{$quiz->finished_at ? $quiz->finished_at->diffForHumans() : '-'}}
                            </span>
                        </td>
                        <td>
                            <a href="{{route('quizzes.details', $quiz->id)}}" class="btn btn-sm btn-secondary">
                                <i class="fa-solid fa-info"></i>
                            </a>
                            <a href="{{route('questions.index', $quiz->id)}}" class="btn btn-sm btn-primary"><i
                                    class="fa-solid fa-question"></i></a>
                            <a href="{{route('quizzes.edit', $quiz->id)}}" class="btn btn-sm btn-warning"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{route('quizzes.destroy',$quiz->id)}}" class="btn btn-sm btn-danger"><i
                                    class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$quizzes->withQueryString()->links()}}
        </div>
    </div>
</x-app-layout>
