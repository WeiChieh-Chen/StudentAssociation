<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use Illuminate\Http\Request;
use App\Models\Turnout;
use App\Models\Item;
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
        if(Gate::denies('show', Auth::user())){
            return redirect()->route('home');
        }
     

        $vote = [];
        $obtain = Turnout::orderBy('id','DESC');

         //paginate()會將結果陣列，自動格式成他需要的樣子，而其不為JSON格式陣列，故無法成為物件陣列。get()則為一JSON格式之陣列，故可被JS的物件陣列使用。
        $obtainPag = $obtain->paginate(11);
        $obtainArr = $obtain->get();
        $itemCollect = Item::orderBy('itemOrder','ASC')->get();

        foreach($obtainArr as $item) { 
            $key = $item->id;
            $vote[$key] = Item::where('itemId',$key)->sum('votes');    
        }

        return view('pages.vote',[
            'mainTitle' => '投票區',
            'results' => $obtainPag,
            'obtainArr' => $obtainArr,
            'itemCollect' => $itemCollect,
            'votes' => $vote
        ]);
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
    public function store(VotePostRequest $request, $number = 0)
    {  
        if(Gate::denies('show', Auth::user())){
            return redirect()->route('home'); 
        }
        
        $newItem = Turnout::create(['item' => $request->item]);
      
        $number = intval($number);
        for($i = 1; $i <= $number; $i++) {
            if ($request->hasFile('fileName'.$i)) {                                     //有沒有這個檔案
                $file = $request->file('fileName'.$i);                                  //取得檔案
                $original_name = $file->getClientOriginalName();                        //Laravel會儲存檔案仍在暫存區時的名字，所以之後要把他更新成正確檔名。                                                          
                if($file->isValid()) {                                                  //檔案是否有效 
                    $file->move(storage_path('app/Filebase/'), $original_name);         //移動檔案     
                    Item::create([
                        'itemId' => $newItem->id,
                        'itemOrder' => $i,
                        'optionName' => $request['optionName'.$i],
                        'fileName' => $original_name
                    ]);
                }
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
        if(Gate::denies('show', Auth::user())){
            return redirect()->route('home');
        }

        return view('pages.static',[
            'get' => Turnout::find($id),
            'datus' => Item::where('itemId',$id)->orderBy('itemOrder','ASC')->get()
        ]);
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
        if(Gate::denies('show', Auth::user())){
            return redirect()->route('home');
        }

        // Turnouts 表先更新
        Turnout::find($id)->update(['item' => $request->item]);

        $itemCollect = Item::where('itemId',$id)->orderBy('itemOrder','ASC')->get();     // 先取得對照 id 的集合, 並依照 itemOder有小到大排列

        // 更新 Items表
        for($order = 1; !is_null($request['optionName'.$order]); $order++) {
            $item = Item::where(['itemId' => $id, 'itemOrder' => $order]);              // 先取得正確的row
            if($request->hasFile('fileName'.$order)) {                                  // 確認是否有檔案更新
                $old_file_name = $itemCollect[$order-1]->fileName;                      // 從舊集合裡取出該舊檔名
                $file = $request->file('fileName'.$order);                              // 取得檔案
                $filename = $file->getClientOriginalName();                             // 取得原始檔名
                if($file->isValid()){                                                   // 確認檔案室否有效
                    if(!empty($old_file_name))                                          // 如果舊檔名不為空， 表示該項目有舊檔案
                        Storage::delete('Filebase/'.$old_file_name);                    // 把舊檔刪除                 
                    $file->move(storage_path('app/Filebase/'),$filename);               // 將新檔移動過去
                    $item->update(['fileName' => $filename, 'optionName' => $request['optionName'.$order]]);        // 更新檔名， 更新該項項目名稱
                }
            }else $item->update(['optionName' => $request['optionName'.$order]]);       // 如果沒有檔案，更新項目名稱即可。
        }

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
        if(Gate::denies('show', Auth::user())){
            return redirect()->route('home');
        }

        //刪掉turnouts表的$id
        Turnout::destroy($id);

        $item = Item::where('itemId',$id);

        foreach($item->get() as $row) {
            if(!empty($row->fileName)){
            // 預設且真的會刪除的路徑為 storage/app/ ，故將資料夾放在這裡。
                Storage::delete('Filebase/'.$row->fileName);
            }
        }

        //刪掉items表符合 $id 的項目
        $item->delete();

        return redirect()->route('vote');
    }


    public function download($fileName)
    {
        if(Gate::denies('show', Auth::user())){
            return redirect()->route('home');
        }
        return response()->download(storage_path('app/Filebase/').$fileName);
    }
}
