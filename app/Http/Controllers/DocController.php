<?php

namespace App\Http\Controllers;

use App\Exports\SupplierOrderListExport;
use App\Order;
use App\Setting;
use App\Supplier;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class DocController extends Controller
{

    /**
     * Print quotation
     *
     * @param $id
     * @return mixed
     */
    public function print_quotation($id)
    {
        $host = Setting::first();
        $order = Order::with('product.category', 'statusDate', 'user', 'customer.user')->find($id);

        $pdf = \PDF::loadView('pdf.quotation', [
            'host' => $host,
            'order' => $order,
        ]);

        $pdf->setPaper('a4');

        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(
            $canvas->get_width() - 70,
            $canvas->get_height() - 30,
            "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);


        return $pdf->stream($order->quotation_number . '.pdf');
    }

    public function print_delivery_order($id)
    {
        $host = Setting::first();
        $order = Order::with('product.category', 'statusDate', 'user', 'customer.user')->find($id);

        $pdf = \PDF::loadView('pdf.delivery_order', [
            'host' => $host,
            'order' => $order,
        ]);
        $pdf->setPaper('a4');

        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(
            $canvas->get_width() - 70,
            $canvas->get_height() - 30,
            "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);

        return $pdf->stream($order->do_number . '.pdf');
    }

    public function get_purchase_order_file($id)
    {
        $order = Order::find($id);
        return response()->file($order->purchase_order_file);
    }

    public function get_order_supplier_list($id)
    {
        $order = Order::with('customer')->find($id);
        return (new SupplierOrderListExport($id))
            ->download(  $order->customer->name . '-' . $order->order_number . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function print_invoice($id)
    {
        $host = Setting::first();
        $order = Order::with('product.category', 'statusDate', 'user', 'customer.user')->find($id);

        $pdf = \PDF::loadView('pdf.invoice', [
            'host' => $host,
            'order' => $order,
        ]);

        $pdf->setPaper('a4');

        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(
            $canvas->get_width() - 70,
            $canvas->get_height() - 30,
            "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);

        return $pdf->stream($order->quotation_number . '.pdf');
    }
}
