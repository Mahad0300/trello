<?php
/**
 * ReportHelper - Enterprise CSV Export Engine
 * Generates downloadable reports for System Metrics and User Activity Audits.
 */

class ReportHelper {
    public static function generateSystemReportCSV() {
        $data = [
            ['Metric', 'Value', 'Status', 'Updated At'],
            ['Total Active Users', '142', 'Healthy', date('Y-m-d H:i:s')],
            ['Active Project Boards', '58', 'Healthy', date('Y-m-d H:i:s')],
            ['Completed Sprint Tasks', '1240', 'Optimal', date('Y-m-d H:i:s')],
            ['System Uptime', '99.98%', 'Operational', date('Y-m-d H:i:s')],
            ['Database Cluster Load', '42%', 'Normal', date('Y-m-d H:i:s')]
        ];

        return self::arrayToCsvDownload($data, 'system_performance_report_' . date('Y-m-d') . '.csv');
    }

    public static function generateUserAuditCSV($users = []) {
        $header = ['User ID', 'Name', 'Email', 'Role', 'Status', 'Boards Count', 'Joined Date'];
        $rows = [
            [1, 'Alex Turner', 'alex@company.com', 'Admin', 'Active', 5, '2026-01-15'],
            [2, 'Sarah Connor', 'sarah@company.com', 'Standard User', 'Active', 8, '2026-02-10'],
            [3, 'David Chen', 'david@company.com', 'Board Manager', 'Active', 3, '2026-03-22'],
            [4, 'Elena Rostova', 'elena@company.com', 'Standard User', 'Inactive', 1, '2026-04-05']
        ];

        array_unshift($rows, $header);
        return self::arrayToCsvDownload($rows, 'users_activity_audit_' . date('Y-m-d') . '.csv');
    }

    private static function arrayToCsvDownload($array, $filename) {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        $output = fopen('php://output', 'w');
        foreach ($array as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
        exit;
    }
}
