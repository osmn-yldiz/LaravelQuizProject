<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\QuizCreateRequest;
use App\Http\Requests\QuizUpdateRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $quizzes = Quiz::withCount('questions')->OrderBy('id', 'Desc');

        if (request()->get('title')) {
            $quizzes = $quizzes->where('title', 'LIKE', "%" . request()->get('title') . "%");
        }
        if (request()->get('status')) {
            $quizzes = $quizzes->where('status', request()->get('status'));
        }

        $quizzes = $quizzes->paginate(5);

        //Paginator::useBootstrap();
        //$quizzes = DB::table('quizzes')->select("*")->orderBy('id', 'desc')->take(5)->get();
        //$quizzes = Quiz::paginate(5);

        //$quizzes = Quiz::latest()->simplePaginate(5);
        return view("admin.quiz.list", compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(QuizCreateRequest $request)
    {
        //return $request->post();

        /*$quiz = new Quiz();
        $quiz->title = $request->title;
        $quiz->description = $request->description;
        $quiz->finished_at = $request->finished_at;
        $quiz->save();*/

        Quiz::create($request->post());
        return redirect()->route('quizzes.index')->withSuccess('Quiz Başarıyla Oluşturuldu');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $quiz = Quiz::with('topTen.user', 'results.user')->withCount('questions')->find($id) ?? abort(404, 'Quiz Bulunamadı');
        return view('admin.quiz.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $quiz = Quiz::withCount('questions')->find($id) ?? abort(404, 'Quiz Bulunamadı');
        return view('admin.quiz.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizUpdateRequest $request, $id)
    {
        $quiz = Quiz::find($id) ?? abort(404, 'Quiz Bulunamadı');
        Quiz::where('id', $id)->first()->update($request->except(['_method', '_token']));
        //Quiz::find($id)->update($request->except(['_method', '_token']));
        return redirect()->route('quizzes.index')->withSuccess('Quiz Güncelleme İşlemi Başarıyla Gerçekleşti');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id) ?? abort(404, 'Quiz Bulunamadı');
        $quiz->delete();
        return redirect()->route('quizzes.index')->withSuccess('Quiz Silme İşlemi Başarıyla Gerçekleşti');
    }
}
