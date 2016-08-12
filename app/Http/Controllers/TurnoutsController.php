<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turnout;
use App\Http\Requests\VotePostRequest;

class TurnoutsController extends Controller
{
    /**x
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obtain =  Turnout::orderBy('id','DESC');
        //paginate()會將結果陣列，自動格式成他需要的樣子，而其不為JSON格式陣列，故無法成為物件陣列。get()則為一JSON格式之陣列，故可被JS的物件陣列使用。
        return view('pages.vote',['mainTitle' => '投票區','results' => $obtain->paginate(11) ,'obtainArr' => $obtain->get()]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VotePostRequest $request)
    {
        Turnout::create($request->except('_token')); 
        echo "<script>name = 0;</script>";
        return redirect()->route('vote');
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
        //
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
        Turnout::find($id)->update($request->except('_token'));
        return redirect()->route('vote');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Turnout::destroy($id);
        return redirect()->route('vote');
    }
}
