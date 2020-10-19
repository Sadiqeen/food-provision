<?php

namespace App\Http\Controllers;

use App\Order;

class GraphController extends Controller
{

    protected $color = [
        '#3490dc',
        '#6574cd',
        '#9561e2',
        '#f66d9b',
        '#e3342f',
        '#f6993f',
        '#ffed4a',
        '#38c172',
        '#4dc0b5',
        '#6cb2eb',
    ];

    /**
     * Generate graph of Most spendors
     *
     * @return mixed
     */
    public function get_most_spendors()
    {
        $top_spendors_result = Order::select(\DB::raw('customer_id'), \DB::raw('sum(total_price) as total'))
            ->with('customer')
            ->where('status_id', 8)
            ->groupBy('customer_id')
            ->orderBy('total', 'DESC')
            ->limit('10')
            ->get();

        $top_spendors = [];
        $top_spendors_label = [];
        $top_spendors['label'] = __('Top Companies in Purchase');
        $color = $this->random_color();

        foreach ($top_spendors_result as $key => $item) {

            $top_spendors_label[] = $item->customer->name;
            $top_spendors['backgroundColor'][] = $color[$key];
            $top_spendors['hoverBackgroundColor'][] = $color[$key];
            $top_spendors['data'][] = $item->total;

        }


        return app()->chartjs
            ->name('most_spendors')
            ->type('bar')
            ->labels($top_spendors_label)
            ->size(['width' => 500, 'height' => 400])
            ->datasets([$top_spendors])
            ->optionsRaw("{
                'responsive': true,
                'legend': {
                    'onClick': 'e.stopPropagation()',
                },
                'scales': {
                    'yAxes': [{
                        'ticks': {
                            'beginAtZero': true,
                            'callback': function(value, index, values) {
                                if (parseInt(value) >= 1000) {
                                    return \"฿ \" + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, \",\");
                                } else {
                                    return \"฿ \" + value;
                                }
                            },
                        },
                    }],
                },
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                            var label = data.datasets[tooltipItem.datasetIndex].label || ''

                            if (label) {
                              label += ': '
                            }

                            if (parseInt(tooltipItem.yLabel) >= 1000) {
                                label += \"฿ \" + tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, \",\");
                            } else {
                                label += \"฿ \" + tooltipItem.yLabel;
                            }

                            return label
                        },
                    },
                },
            }");
    }

    /**
     * Generate graph of sale result
     *
     * @return mixed
     */
    public function get_sale_result_average()
    {
        $success = Order::where('status_id', 8)->count();
        $admin_cancel = Order::where('status_id', 9)->count();
        $customer_cancel = Order::where('status_id', 10)->count();
        $vessel_cancel = Order::where('status_id', 11)->count();

        return app()->chartjs
            ->name('sale_result_average')
            ->type('pie')
            ->size(['width' => 500, 'height' => 400])
            ->labels([
                __('Success'),
                __('Cancel by administrator'),
                __('Cancel by customer'),
                __('Cancel by vessel'),
            ])
            ->datasets([
                [
                    'backgroundColor' => [
                        '#38c172',
                        '#e3342f',
                        '#ff7f7f',
                        '#eb5f5b',
                    ],
                    'hoverBackgroundColor' => [
                        '#38c172',
                        '#e3342f',
                        '#ff7f7f',
                        '#eb5f5b',
                    ],
                    'data' => [
                        $success,
                        $admin_cancel,
                        $customer_cancel,
                        $vessel_cancel,
                    ]
                ]
            ])
            ->options([]);
    }

    private function random_color()
    {
        $color = $this->color;
        shuffle($color);
        return $color;
    }
}
