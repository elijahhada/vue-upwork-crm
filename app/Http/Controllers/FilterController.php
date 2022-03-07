<?php

namespace App\Http\Controllers;

use App\Jobs\AttachCustomKeyWordToJobs;
use App\Jobs\AttachExceptionWordToJobs;
use App\Models\CustomKeyWord;
use App\Models\ExceptionWord;
use App\Models\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $exceptionWordsIds = [];
            if(!empty($request->exception_words_ids)) {
                $exceptionWords = explode(',', $request->exception_words_ids);
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
            }
            $customKeyWordsIds = [];
            if(!empty($request->custom_key_words_ids)) {
                $customKeyWords = explode(',', $request->custom_key_words_ids);
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
            }
            $filters = new Filter();
            $filters->user_id = $request->user_id;
            $filters->title = $request->title;
            $filters->countries_ids = $request->countries_ids;
            $filters->categories_ids = $request->categories_ids;
            $filters->key_words_ids = $request->key_words_ids;
            $filters->exception_words_ids = !empty($exceptionWordsIds) ? implode(',', $exceptionWordsIds) : null;
            $filters->custom_key_words_ids = !empty($customKeyWordsIds) ? implode(',', $customKeyWordsIds) : null;
            $filters->is_hourly = $request->is_hourly;
            $filters->hourly_min = $request->hourly_min;
            $filters->hourly_max = $request->hourly_max;
            $filters->is_fixed = $request->is_fixed;
            $filters->fixed_min = $request->fixed_min;
            $filters->fixed_max = $request->fixed_max;
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
            $exceptionWordsIds = [];
            if(!empty($request->exception_words_ids)) {
                $exceptionWords = explode(',', $request->exception_words_ids);
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
            }
            $customKeyWordsIds = [];
            if(!empty($request->custom_key_words_ids)) {
                $customKeyWords = explode(',', $request->custom_key_words_ids);
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
            }
            $filters = Filter::find($request->id);
            $filters->user_id = $request->user_id;
            $filters->title = $request->title;
            $filters->countries_ids = $request->countries_ids;
            $filters->categories_ids = $request->categories_ids;
            $filters->key_words_ids = $request->key_words_ids;
            $filters->exception_words_ids = !empty($exceptionWordsIds) ? implode(',', $exceptionWordsIds) : null;
            $filters->custom_key_words_ids = !empty($customKeyWordsIds) ? implode(',', $customKeyWordsIds) : null;
            $filters->is_hourly = $request->is_hourly;
            $filters->hourly_min = $request->hourly_min;
            $filters->hourly_max = $request->hourly_max;
            $filters->is_fixed = $request->is_fixed;
            $filters->fixed_min = $request->fixed_min;
            $filters->fixed_max = $request->fixed_max;
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
        $exceptionWordsIdsAsArray = explode(',', $filter->exception_words_ids);
        DB::table('exception_word_job')->whereIn('exception_word_id', $exceptionWordsIdsAsArray)->delete();
        ExceptionWord::whereIn('id', $exceptionWordsIdsAsArray)->delete();
        $customWordsIdsAsArray = explode(',', $filter->custom_key_words_ids);
        DB::table('custom_key_word_job')->whereIn('custom_key_word_id', $customWordsIdsAsArray)->delete();
        CustomKeyWord::whereIn('id', $customWordsIdsAsArray)->delete();
        $keyWordsIdsAsArray = explode(',', $filter->key_words_ids);
        DB::table('key_word_job')->whereIn('key_word_id', $keyWordsIdsAsArray)->delete();
        $filter->delete();

        return response()->json([
            'success' => true,
            'message' => 'Filter was removed successfully'
        ], 204);
    }

    public function copy(Request $request)
    {
        $filter = Filter::find($request->id);
        $newFilter = new Filter();
        $newFilter->user_id = $request->user_id;
        $newFilter->title = $request->title;
        $newFilter->countries_ids = $filter->countries_ids;
        $newFilter->categories_ids = $filter->categories_ids;
        $newFilter->key_words_ids = $filter->key_words_ids;
        $newFilter->exception_words_ids = $filter->exception_words_ids;
        $newFilter->custom_key_words_ids = $filter->custom_key_words_ids;
        $newFilter->is_hourly = $filter->is_hourly;
        $newFilter->hourly_min = $filter->hourly_min;
        $newFilter->hourly_max = $filter->hourly_max;
        $newFilter->is_fixed = $filter->is_fixed;
        $newFilter->fixed_min = $filter->fixed_min;
        $newFilter->fixed_max = $filter->fixed_max;
        $newFilter->save();

        return response()->json([
            'success' => true,
            'message' => 'Filter was copied successfully'
        ], 204);
    }
}
