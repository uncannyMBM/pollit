<?php

namespace App\Http\Controllers;

use App\Models\PollAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PollController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function pollSubmission(Request $request)
    {
        $this->validate($request, [
            'answer' => 'required|string|max:20',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:100',
        ], [
           'answer.required' => 'You need to mark an answer to complete the survey.'
            ]);
        DB::beginTransaction();
        try {
            $user = User::firstOrNew(['email' => $request->email]);
            $user->name = $request->name;
            $userResponse = $user->save();

            throw_if(!$userResponse, 'Unexpected error! Please try again.');

            $poll = $user->poll()->firstOrNew(['user_id' => $user->id]);
            $poll->answer = $request->answer;
            $poll->trx = Str::random(5);
            $pollResponse = $poll->save();

            if (!$pollResponse) {
                DB::rollBack();
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Poll has been answered successfully.',
                'url' => route('poll.result', $poll->trx)
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ], $exception->getCode());
        }
        return response()->json($request->all());
    }

    public function pollResult($trx)
    {
        $myAnswer = PollAnswer::where('trx', $trx)->firstOrFail(['answer']);
        $answer = collect(PollAnswer::query()
            ->selectRaw('ROUND((count(CASE WHEN answer = "Happiness"  THEN answer END) / count(answer)) * 100, 2) AS Happiness')
            ->selectRaw('ROUND((count(CASE WHEN answer = "Love"  THEN answer END) / count(answer)) * 100, 2) AS Love')
            ->selectRaw('ROUND((count(CASE WHEN answer = "Money"  THEN answer END) / count(answer)) * 100, 2) AS Money')
            ->selectRaw('ROUND((count(CASE WHEN answer = "Peace"  THEN answer END) / count(answer)) * 100, 2) AS Peace')
            ->selectRaw('ROUND((count(CASE WHEN answer = "Travel"  THEN answer END) / count(answer)) * 100, 2) AS Travel')
            ->get()
            ->toArray())
            ->collapse();
        return view('result', compact('answer', 'myAnswer'));
    }
}
