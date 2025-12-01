<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderReportService;
use DB;

class AdminController extends Controller
{
    public function index(OrderReportService $report)
    {
        $orders = Order::orderBy('created_at', 'desc')->get()->take(10);
        $dashboardDatas = (object) [
            'TotalAmount' => Order::sum('total'),
            'TotalOrderedAmount' => Order::ordered()->sum('total'),
            'TotalDeliveredAmount' => Order::delivered()->sum('total'),
            'TotalCanceledAmount' => Order::canceled()->sum('total'),

            'Total' => Order::count(),
            'TotalOrdered' => Order::ordered()->count(),
            'TotalDelivered' => Order::delivered()->count(),
            'TotalCanceled' => Order::canceled()->count(),
        ];

        $monthlyReport = $report->getMonthlyReport();
        $yearlyReport = $report->getYearlyReport();

        $reportData = [
            'monthly' => $monthlyReport,
            'yearly' => $yearlyReport,
            'chart' => [
                'amount' => implode(',', $monthlyReport->pluck('amount')->toArray()),
                'ordered' => implode(',', $monthlyReport->pluck('ordered_amount')->toArray()),
                'delivered' => implode(',', $monthlyReport->pluck('delivered_amount')->toArray()),
                'canceled' => implode(',', $monthlyReport->pluck('canceled_amount')->toArray()),
            ]
        ];

        return view('admin.index', compact('orders', 'dashboardDatas', 'reportData'));
    }
}
