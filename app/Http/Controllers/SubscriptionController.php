<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        // Mengatur konfigurasi API Key Xendit setiap kali controller ini dipanggil
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));
    }

    // 1. Menampilkan halaman penawaran paket (Pricing Page)
    public function index()
    {
        return view('subscription'); // Kita akan buat file view-nya setelah ini
    }

    // 2. Memproses pembuatan tagihan/invoice ke Xendit
    public function checkout(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        // Parameter tagihan untuk Xendit
        $params = [
            'external_id' => 'exprosa-pro-' . $user->id . '-' . Str::random(5), // ID unik untuk sistem kita
            'payer_email' => $user->email,
            'description' => 'Langganan Exprosa Lab - Paket Pro (1 Bulan)',
            'amount' => 99000, // Harga paket Pro, misalnya Rp 99.000
            'success_redirect_url' => route('dashboard'), // Jika sukses, arahkan ke dashboard
            'failure_redirect_url' => route('subscription.index'), // Jika gagal, kembali ke halaman harga
        ];

        try {
            // Memanggil API Xendit untuk membuat Invoice
            $apiInstance = new InvoiceApi();
            $invoice = $apiInstance->createInvoice($params);

            // Xendit akan membalas dengan memberikan URL halaman pembayaran
            $paymentUrl = $invoice['invoice_url'];

            // Arahkan user ke halaman pembayaran Xendit
            return redirect($paymentUrl);
        } catch (\Exception $e) {
            // Jika terjadi error saat menghubungi Xendit
            return back()->with('error', 'Gagal membuat tagihan: ' . $e->getMessage());
        }
    }
}
