<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        
        $transactions = DB::table('transactions as t')
            ->join('customers as c', 't.customer_id', '=', 'c.id')
            ->select([
                't.id',
                'c.name as customer_name',
                't.galon_out',
                't.galon_in',
                't.transaction_date',
                't.total_price'
            ])
            ->where('t.is_active', true)
            ->orderBy('t.transaction_date', 'desc')
            ->paginate($perPage);

        $customers = DB::table('customers')
            ->where('is_active', true)
            ->get();

        return view('transactions.index', compact('transactions', 'customers', 'perPage', 'page'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'customer_id' => 'required',
                'galon_out' => 'required|numeric',
                'galon_in' => 'required|numeric',
                'transaction_date' => 'required|date',
                'total_price' => 'required|numeric'
            ]);

            DB::table('transactions')->insert([
                'customer_id' => $request->customer_id,
                'galon_out' => $request->galon_out,
                'galon_in' => $request->galon_in,
                'transaction_date' => $request->transaction_date,
                'total_price' => $request->total_price,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Transaction added successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $transaction = DB::table('transactions')
            ->where('id', $id)
            ->where('is_active', true)
            ->first();

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        return response()->json($transaction);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'customer_id' => 'required',
                'galon_out' => 'required|numeric',
                'galon_in' => 'required|numeric',
                'transaction_date' => 'required|date',
                'total_price' => 'required|numeric'
            ]);

            $result = DB::table('transactions')
                ->where('id', $id)
                ->where('is_active', true)
                ->update([
                    'customer_id' => $request->customer_id,
                    'galon_out' => $request->galon_out,
                    'galon_in' => $request->galon_in,
                    'transaction_date' => $request->transaction_date,
                    'total_price' => $request->total_price,
                    'updated_at' => now()
                ]);

            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Transaction updated successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction not found'
                ], 404);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $result = DB::table('transactions')
                ->where('id', $id)
                ->where('is_active', true)
                ->update(['is_active' => false]);

            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Transaction deleted successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction not found'
                ], 404);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
    public function exportPdf()
    {
        $transactions = DB::table('transactions as t')
            ->join('customers as c', 't.customer_id', '=', 'c.id')
            ->select([
                't.id',
                'c.name as customer_name',
                't.galon_out',
                't.galon_in',
                't.transaction_date',
                't.total_price'
            ])
            ->where('t.is_active', true)
            ->orderBy('t.transaction_date', 'desc')
            ->get();

        $pdf = Pdf::loadView('transactions.pdf', ['transactions' => $transactions]);

        return $pdf->download('transactions.pdf');
    } 
}
