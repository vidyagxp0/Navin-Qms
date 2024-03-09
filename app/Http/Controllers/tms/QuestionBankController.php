<?php

namespace App\Http\Controllers\tms;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionBank;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = QuestionBank::where('trainer_id',Auth::user()->id)->orderByDesc('id')->paginate('10');
        return view('frontend.TMS.question-bank',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
public function questiondata(){
    dd('asdfasdf');
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = new QuestionBank();
        $question->trainer_id = Auth::user()->id;
        $question->title = $request->title;
        $question->description = $request->description;
        $question->status = $request->status;
        $question->save();
        toastr()->success('Question bank created successfully !!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Question::where('trainer_id', Auth::user()->id)->paginate('10');
        $question = QuestionBank::find($id);
        return view('frontend.TMS.manage-question-bank',compact('question','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

       $question = QuestionBank::find($id);
       if(empty($question->questions)){
        $this->validate($request,[
            'questions'=>'required',
          ]);
       }
       if($request->questions){
       $question->questions = implode(',', $request->questions);
       }
       $question->update();
       toastr()->success('Submit successfully.');
       return redirect()->route('question-bank.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = QuestionBank::find($id);
        $data->delete();
        toastr()->success('Deleted successfully');
        return back();
    }

    public function datag($id){
        $questions = QuestionBank::find($id);
        if(!empty($questions->questions)){
            $data = explode(',',$questions->questions);

            $array = [];
            for($i=0; $i<count($data); $i++){
             $question = Question::find($data[$i]);
             array_push($array,$question);
            }

            $array = $this->paginate($array);
            $htmls =[];
            $html ='';
          foreach($array as $temp){
            $html =
            '
        <tr data-item="'.$temp->id.'">
            <td>'.$temp->question.'</td>
            <td>'.$temp->type.'</td>
            <td><button id="button" type="button">Delete</button></td>
            <input type="hidden" name="questions[]" value="'.$temp->id.'">
        </tr>';
        array_push($htmls,$html);
          }



            $response['htmls'] = $htmls;

            return response()->json($response);
        }
        else{
            $htmls = "";
            $response['htmls'] = $htmls;

            return response()->json($response);
        }

    }

    public function paginate($items, $perPage = 10, $page = null, $options = ['path' => 'mytaskdata'])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
