<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use App\Models\Order;

class AsaasController extends Controller
{
    public function webhookPix(Request $request) {
        // Obter os dados do webhook
        $payload = json_decode($request->getContent());

        // Verificar se a decodificação foi bem-sucedida
        if ($payload === null) {
            // Se a decodificação falhou, retorne um erro
            return response()->json(['error' => 'Erro ao decodificar JSON'], 400);
        }

        // Verificar o evento do webhook
        if($payload->event == "PAYMENT_RECEIVED") {
            // Procurar o pedido com base no ID do pagamento
            $order = Order::where('payment_id', $payload->payment->id)->first();

            // Verificar se o pedido foi encontrado
            if($order !== null ) {
                try {
                    // Atualizar o status do pedido com base no status do pagamento
                    $order->update([
                        'status' => $payload->payment->status
                    ]);

                    Cache::put('payment_received', true);

                    return response()->json([
                        'message' => 'Webhook processado com sucesso'
                    ], 200);
                } catch (\Exception $e) {
                    // Se houver algum erro ao atualizar o pedido, retorne um erro interno do servidor
                    return response()->json(['error' => 'Erro interno do servidor'], 500);
                }
            } else {
                // Se o pedido não foi encontrado, retorne um erro
                return response()->json(['error' => 'Pedido não encontrado'], 404);
            }
        } else if($payload->event == "PAYMENT_CREATED"){
            return response()->json([
                'message' => 'Webhook processado com sucesso'
            ], 200);
        }
    }
}

