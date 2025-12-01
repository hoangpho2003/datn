<?php

namespace App\Services;

use App\Models\Order;

class OrderReportService
{
    public function getMonthlyReport($year = null)
    {
        $year = $year ?? now()->year;
        $monthlyData = [];

        for ($m = 1; $m <= 12; $m++) {
            $orders = Order::whereYear('created_at', $year)
                ->whereMonth('created_at', $m);

            $monthlyData[$m] = [
                'month' => $m,
                'amount' => $orders->sum('total'),
                'ordered_amount' => (clone $orders)->where('status', 'ordered')->sum('total'),
                'delivered_amount' => (clone $orders)->where('status', 'delivered')->sum('total'),
                'canceled_amount' => (clone $orders)->where('status', 'canceled')->sum('total'),
                'total' => $orders->count(),
                'ordered' => (clone $orders)->where('status', 'ordered')->count(),
                'delivered' => (clone $orders)->where('status', 'delivered')->count(),
                'canceled' => (clone $orders)->where('status', 'canceled')->count(),
            ];
        }

        return collect($monthlyData);
    }

    public function getYearlyReport($year = null)
    {
        $year = $year ?? now()->year;
        $orders = Order::whereYear('created_at', $year);

        return [
            'amount' => $orders->sum('total'),
            'ordered_amount' => (clone $orders)->where('status', 'ordered')->sum('total'),
            'delivered_amount' => (clone $orders)->where('status', 'delivered')->sum('total'),
            'canceled_amount' => (clone $orders)->where('status', 'canceled')->sum('total'),
            'total' => $orders->count(),
            'ordered' => (clone $orders)->where('status', 'ordered')->count(),
            'delivered' => (clone $orders)->where('status', 'delivered')->count(),
            'canceled' => (clone $orders)->where('status', 'canceled')->count(),
        ];
    }
}
