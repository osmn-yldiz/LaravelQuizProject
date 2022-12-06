<x-app-layout>
    <x-slot name="header">Quiz Oluştur</x-slot>
    <div class="card">
        <div class="card-body">
            <div class="float-end mb-2"><a href="{{route('quizzes.index')}}" class="btn btn-primary btn-md"><i
                        class="fa-solid fa-arrow-left"></i> Geri
                    Dön</a></div>
            <form method="POST" action="{{route('quizzes.store')}}">
                @csrf

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Quiz Başlığı</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="title"
                           value="{{old('title')}}">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Quiz Açıklaması</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                              name="description">{{old('description')}}</textarea>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="isFinished"
                           @if(old('finished_at')) checked @endif>
                    <label class="form-check-label" for="exampleCheck1">Bitiş Tarihi Olacak Mı?</label>
                </div>

                <div id="finishedInput" class="mb-3" @if(!old('finished_at')) style="display: none" @endif>
                    <label class="form-label">Bitiş Tarihi</label>
                    <input type="datetime-local" class="form-control" name="finished_at" value="{{old('finished_at')}}">
                </div>

                <div class="d-grid gap-2 col-2 mx-auto">
                    <button class="btn btn-success btn-md" style="background-color: #198754" type="submit">Quiz
                        Oluştur
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
