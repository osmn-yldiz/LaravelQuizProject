<x-app-layout>
    <x-slot name="header">Quiz Güncelle</x-slot>
    <div class="card">
        <div class="card-body">
            <div class="float-end mb-2"><a href="{{route('quizzes.index')}}" class="btn btn-primary btn-md"><i
                        class="fa-solid fa-arrow-left"></i> Geri
                    Dön</a></div>
            <form method="POST" action="{{route('quizzes.update',$quiz->id)}}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Quiz Başlığı</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="title"
                           value="{{$quiz->title}}">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Quiz Açıklaması</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                              name="description">{{$quiz->description}}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Quiz Durumu</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option selected>Quiz Durumunu Seçiniz...</option>
                        <option @if($quiz->questions_count < 4) disabled @endif @if($quiz->status === 'publish') selected @endif value="publish">Aktif
                        </option>
                        <option @if($quiz->status === 'passive') selected @endif value="passive">Pasif
                        </option>
                        <option @if($quiz->status === 'draft') selected @endif value="draft">Taslak
                        </option>
                    </select>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="isFinished"
                           @if($quiz->finished_at) checked @endif>
                    <label class="form-check-label" for="exampleCheck1">Bitiş Tarihi Olacak Mı?</label>
                </div>

                <div id="finishedInput" class="mb-3" @if(!$quiz->finished_at) style="display: none" @endif>
                    <label class="form-label">Bitiş Tarihi</label>
                    <input type="datetime-local" class="form-control" name="finished_at"
                           @if($quiz->finished_at) value="{{$quiz->finished_at}}" @endif>
                </div>

                <div class="d-grid gap-2 col-2 mx-auto">
                    <button class="btn btn-success btn-md" style="background-color: #198754" type="submit">Quiz Güncelle
                    </button>
                </div>

            </form>
        </div>
    </div>

    <x-slot name="js">
        <script>
            $('#isFinished').change(function () {
                if ($('#isFinished').is(':checked')) {
                    $('#finishedInput').show();
                } else {
                    $('#finishedInput').hide();
                }
            });
        </script>
    </x-slot>

</x-app-layout>
