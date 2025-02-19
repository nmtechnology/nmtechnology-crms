<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\WorkOrder;

class GrokController extends Controller
{
    public function solutions(Request $request)
    {
        $query = $request->input('solutions');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('env.grok.api_key'),
                'Content-Type' => 'application/json',
            ])->post('https://api.x.ai/v1/chat/completions', [
                        'model' => 'grok-2-latest',
                        'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are an alarm system knowledge base.'
                    ],
                    [
                        'role' => 'user',
                        'content' => 'Testing. Just say hi and hello world and nothing else.'
                    ]
                ],
                        'model' => 'grok-2-latest',
                        'max_tokens' => 1000,
                        'stop' => ['\n'],
                        'prompt' => 'You are an alarm system knowledge base.',
                        'logprobs' => 0,
                        'echo' => false,
                        'stop_sequence' => null,
                        'temperature' => 0
            ]);

            if ($response->failed()) {
                throw new \Exception('Groq API request failed: ' . $response->body());
            }

            // Fetch work orders
            $workOrders = WorkOrder::all();

            return response()->json([
                'response' => $response->json('choices.0.message.content'),
                'work_orders' => $workOrders
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}