<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends Auth_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Category_model');
        $this->load->model('Monitoring_model');
        $this->load->model('Master_informasi_model');
    }

    public function index() {
        $userModel = $this->User_model;
        $categoryModel = $this->Category_model;
        $monitoringModel = $this->Monitoring_model;
        $masterModel = $this->Master_informasi_model;

        $selectedYear = $this->input->get('year') !== NULL ? (int)$this->input->get('year') : (int)date('Y');
        $selectedTriwulan = $this->input->get('triwulan') !== NULL ? (int)$this->input->get('triwulan') : (int)ceil(date('m') / 3);
        $db = $this->db;

        $pjFilter = "";
        $queryParams = [$selectedYear, $selectedTriwulan];
        if (session()->get('role') === 'karyawan') {
            $pjFilter = " AND m.pj = ?";
            $queryParams[] = session()->get('nama');
        }

        // 1. Core counters
        $queryTotal = $db->query("
            SELECT COUNT(mi.id) as total
            FROM master_informasi mi
            LEFT JOIN monitoring m ON m.master_id = mi.id AND m.year = ? AND m.triwulan = ?
            WHERE (m.is_deleted = 0 OR m.is_deleted IS NULL) $pjFilter
        ", $queryParams);
        $data['totalMonitoring'] = $queryTotal->row()->total;

        $queryCompleted = $db->query("
            SELECT COUNT(mi.id) as total
            FROM master_informasi mi
            LEFT JOIN monitoring m ON m.master_id = mi.id AND m.year = ? AND m.triwulan = ?
            WHERE m.status = 'completed' AND (m.is_deleted = 0 OR m.is_deleted IS NULL) $pjFilter
        ", $queryParams);
        $data['statusCompleted'] = $queryCompleted->row()->total;

        $queryProgress = $db->query("
            SELECT COUNT(mi.id) as total
            FROM master_informasi mi
            LEFT JOIN monitoring m ON m.master_id = mi.id AND m.year = ? AND m.triwulan = ?
            WHERE m.status = 'progress' AND (m.is_deleted = 0 OR m.is_deleted IS NULL) $pjFilter
        ", $queryParams);
        $data['statusProgress'] = $queryProgress->row()->total;

        $queryPending = $db->query("
            SELECT COUNT(mi.id) as total
            FROM master_informasi mi
            LEFT JOIN monitoring m ON m.master_id = mi.id AND m.year = ? AND m.triwulan = ?
            WHERE (m.status = 'pending' OR m.status IS NULL) AND (m.is_deleted = 0 OR m.is_deleted IS NULL) $pjFilter
        ", $queryParams);
        $data['statusPending'] = $queryPending->row()->total;

        if ($data['totalMonitoring'] > 0) {
            $data['tingkatKepatuhan'] = round(($data['statusCompleted'] / $data['totalMonitoring']) * 100);
        } else {
            $data['tingkatKepatuhan'] = 0;
        }

        // 2. Trend Kepatuhan per Triwulan for the selected year
        $trendData = [];
        for ($t = 1; $t <= 4; $t++) {
            $qParamsTrend = [$selectedYear, $t];
            if (session()->get('role') === 'karyawan') {
                $qParamsTrend[] = session()->get('nama');
            }

            $qTotal = $db->query("
                SELECT COUNT(mi.id) as total
                FROM master_informasi mi
                LEFT JOIN monitoring m ON m.master_id = mi.id AND m.year = ? AND m.triwulan = ?
                WHERE (m.is_deleted = 0 OR m.is_deleted IS NULL) $pjFilter
            ", $qParamsTrend)->row()->total;

            $qCompleted = $db->query("
                SELECT COUNT(mi.id) as total
                FROM master_informasi mi
                LEFT JOIN monitoring m ON m.master_id = mi.id AND m.year = ? AND m.triwulan = ?
                WHERE m.status = 'completed' AND (m.is_deleted = 0 OR m.is_deleted IS NULL) $pjFilter
            ", $qParamsTrend)->row()->total;

            if ($qTotal > 0) {
                $trendData[] = round(($qCompleted / $qTotal) * 100);
            } else {
                $trendData[] = 0;
            }
        }
        $data['trendChart'] = $trendData;

        // 3. Detailed Data (Item Belum Diupdate)
        $queryRecentPending = $db->query("
            SELECT mi.name as master_name, m.custom_name, IFNULL(m.custom_name, mi.name) as title, 
                   c.name as category_name, IFNULL(m.status, 'pending') as status, m.description, mi.timeline, m.pj
            FROM master_informasi mi
            LEFT JOIN categories c ON c.id = mi.category_id
            LEFT JOIN monitoring m ON m.master_id = mi.id AND m.year = ? AND m.triwulan = ?
            WHERE (m.status != 'completed' OR m.status IS NULL) 
              AND (m.is_deleted = 0 OR m.is_deleted IS NULL) $pjFilter
            ORDER BY mi.id ASC
        ", $queryParams);
        $data['pendingItems'] = $queryRecentPending->result_array();

        // 4. Detailed Data (Item Sudah Diupdate)
        $queryRecentCompleted = $db->query("
            SELECT mi.name as master_name, m.custom_name, IFNULL(m.custom_name, mi.name) as title, 
                   c.name as category_name, m.status, m.description, m.updated_at
            FROM master_informasi mi
            LEFT JOIN categories c ON c.id = mi.category_id
            JOIN monitoring m ON m.master_id = mi.id AND m.year = ? AND m.triwulan = ?
            WHERE m.status = 'completed'
              AND (m.is_deleted = 0 OR m.is_deleted IS NULL) $pjFilter
            ORDER BY m.updated_at DESC
        ", $queryParams);
        $data['completedItems'] = $queryRecentCompleted->result_array();

        // 5. Detail Monitoring (Semua Data)
        $queryAll = $db->query("
            SELECT mi.name as master_name, m.custom_name, IFNULL(m.custom_name, mi.name) as title, 
                   c.name as category_name, IFNULL(m.status, 'pending') as status, m.description, m.pj, m.updated_at
            FROM master_informasi mi
            LEFT JOIN categories c ON c.id = mi.category_id
            LEFT JOIN monitoring m ON m.master_id = mi.id AND m.year = ? AND m.triwulan = ?
            WHERE (m.is_deleted = 0 OR m.is_deleted IS NULL) $pjFilter
            ORDER BY mi.id ASC
        ", $queryParams);
        $data['allItems'] = $queryAll->result_array();

        $data['selectedYear'] = $selectedYear;
        $data['selectedTriwulan'] = $selectedTriwulan;
        $data['title'] = 'Laporan Monitoring';
        $data['extra_css'] = ['css/laporan.css'];
        $data['extra_js'] = ['js/laporan.js'];
        $data['content_view'] = 'laporan/index';
        $this->load->view('layouts/admin', $data);
    }
}
