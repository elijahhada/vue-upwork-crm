<?php

namespace App\Http\Controllers;

use App\Jobs\AttachCustomKeyWordToJobs;
use App\Jobs\AttachExceptionWordToJobs;
use App\Models\CustomKeyWord;
use App\Models\ExceptionWord;
use App\Models\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
//     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $exceptionWords = explode(',', $request->exception_words_ids);
            $exceptionWordsIds = [];
            foreach ($exceptionWords as $word){
                $item = ExceptionWord::where('title', strtolower($word))->first();
                if($item){
                    array_push($exceptionWordsIds, $item->id);
                }else{
                    $newExceptionWord = new ExceptionWord();
                    $newExceptionWord->title = strtolower($word);
                    $newExceptionWord->save();
                    array_push($exceptionWordsIds, $newExceptionWord->id);
                }
            }
            AttachExceptionWordToJobs::dispatch($exceptionWords);

            $customKeyWords = explode(',', $request->custom_key_words_ids);
            $customKeyWordsIds = [];
            foreach ($customKeyWords as $word){
                $item = CustomKeyWord::where('title', strtolower($word))->first();
                if($item){
                    array_push($customKeyWordsIds, $item->id);
                }else{
                    $newCustomKeyWord = new CustomKeyWord();
                    $newCustomKeyWord->title = strtolower($word);
                    $newCustomKeyWord->save();
                    array_push($customKeyWordsIds, $newCustomKeyWord->id);
                }
            }
            AttachCustomKeyWordToJobs::dispatch($customKeyWords);
            $filters = new Filter();
            $filters->user_id = $request->user_id;
            $filters->title = $request->title;
            $filters->countries_ids = $request->countries_ids;
            $filters->categories_ids = $request->categories_ids;
            $filters->key_words_ids = $request->key_words_ids;
            $filters->exception_words_ids = implode(',', $exceptionWordsIds);
            $filters->custom_key_words_ids = implode(',', $customKeyWordsIds);
            $filters->save();
            return response()->json(['data' => 'all ok']);
        } catch (\Exception $exception) {
            return response()->json(['data' => $exception->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function show(Filter $filter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function edit(Filter $filter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Filter  $filter
//     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filter $filter)
    {
        try {
            $exceptionWords = explode(',', $request->exception_words_ids);
            $exceptionWordsIds = [];
            foreach ($exceptionWords as $word){
                $item = ExceptionWord::where('title', strtolower($word))->first();
                if($item){
                    array_push($exceptionWordsIds, $item->id);
                }else{
                    $newExceptionWord = new ExceptionWord();
                    $newExceptionWord->title = strtolower($word);
                    $newExceptionWord->save();
                    array_push($exceptionWordsIds, $newExceptionWord->id);
                }
            }
            AttachExceptionWordToJobs::dispatch($exceptionWords);

            $customKeyWords = explode(',', $request->custom_key_words_ids);
            $customKeyWordsIds = [];
            foreach ($customKeyWords as $word){
                $item = CustomKeyWord::where('title', strtolower($word))->first();
                if($item){
                    array_push($customKeyWordsIds, $item->id);
                }else{
                    $newCustomKeyWord = new CustomKeyWord();
                    $newCustomKeyWord->title = strtolower($word);
                    $newCustomKeyWord->save();
                    array_push($customKeyWordsIds, $newCustomKeyWord->id);
                }
            }
            AttachCustomKeyWordToJobs::dispatch($customKeyWords);

            $filters = Filter::find($request->id);
            $filters->user_id = $request->user_id;
            $filters->title = $request->title;
            $filters->countries_ids = $request->countries_ids;
            $filters->categories_ids = $request->categories_ids;
            $filters->key_words_ids = $request->key_words_ids;
            $filters->exception_words_ids = implode(',', $exceptionWordsIds);
            $filters->custom_key_words_ids = implode(',', $customKeyWordsIds);
            $filters->save();

            return response()->json(['data' => 'all ok']);
        } catch (\Exception $exception) {
            return response()->json(['data' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Request $request)
    {
        if($request->user_id !== Auth::id()) {
            abort(403);
        }
        $filter = Filter::find($request->id);
        $filter->delete();

        return response()->json([
            'success' => true,
            'message' => 'Filter was removed successfully'
        ], 204);
    }
}
