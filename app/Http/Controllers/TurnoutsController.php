<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turnout;
use App\Http\Requests\VotePostRequest;
use Illuminate\Support\Facades\Input;
use Storage;

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
        for ($i=1 ; $request->hasFile('fileName'.$i) ; $i++) {               //有沒有這個檔案
            $file = $request->file('fileName'.$i);                          //取得檔案
            $original_name = $file->getClientOriginalName();                //Laravel會儲存當案仍在暫存區時的名字，所以之後要把他更斤成正確檔名。                                                          
            if($file->isValid()) {                                          //檔案是否有效 
                $file->move(storage_path('app/Filebase/'), $original_name);  //移動檔案     
                Turnout::all()->last()->update(['fileName'.$i => $original_name]); //更新
            }
        }
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
        // Turnout::destroy($id);

        $item = Turnout::find($id);
        for ($i=1 ; !empty($item['fileName'.$i]) ; $i++) {
            // 預設且真的會刪除的路徑為 storage/app/ ，故將資料夾放在這裡。
            Storage::delete('Filebase/'.$item['fileName'.$i]);       
        }
        $item->delete();
        return redirect()->route('vote');
    }


    public function download($fileName)
    {
        return response()->download(storage_path('app/Filebase/').$fileName);
    }
}
