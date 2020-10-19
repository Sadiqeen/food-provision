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

        if ($order->status_id < 2) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route(auth()->user()->position . '.order.index');
        }

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

    /**
     * Print delivery order
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function print_delivery_order($id)
    {
        $host = Setting::first();
        $order = Order::with('product.category', 'statusDate', 'user', 'customer.user')->find($id);

        if ($order->status_id < 6) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route(auth()->user()->position . '.order.index');
        }

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

    /**
     * Print purchase order file
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function get_purchase_order_file($id)
    {
        $order = Order::find($id);

        if ($order->status_id < 4) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route(auth()->user()->position . '.order.index');
        }

        return response()->file($order->purchase_order_file);
    }

    /**
     * Print list product of order to each supplier
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function get_order_supplier_list($id)
    {
        $order = Order::with('customer')->find($id);

        if ($order->status_id < 4) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route(auth()->user()->position . '.order.index');
        }

        return (new SupplierOrderListExport($id))
            ->download(  $order->customer->name . '-' . $order->order_number . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    /**
     * Print invoice
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function print_invoice($id)
    {
        $host = Setting::first();
        $order = Order::with(['product.category', 'user', 'customer.user', 'statusDate' => function ($query) {
                                $query->where('statuses.id', 7);
                            }])->find($id);


        if ($order->status_id < 7 || $order->status_id > 8) {
            alert()->error(__('Error'), __('No data that you request'));
            return redirect()->route(auth()->user()->position . '.order.index');
        }

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

        return $pdf->stream($order->invoice_number . '.pdf');
    }
}
