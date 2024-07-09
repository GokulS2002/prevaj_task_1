<?php
require_once 'model.php';

class TableController {
    public static function getTableData() {
        $data = TableModel::fetchData();
        $sortKey = $_GET['sortBy'] ?? 'S.No';
        $sortOrder = $_GET['order'] ?? 'asc';
        $filter = $_GET['filter'] ?? '';
        $page = intval($_GET['page'] ?? 1);
        $pageSize = intval($_GET['pageSize'] ?? 7);

        if ($filter) {
            $data = TableModel::filterData($data, $filter);
        }

        $data = TableModel::sortData($data, $sortKey, $sortOrder);
        $pagedData = TableModel::paginateData($data, $page, $pageSize);

        include 'view.php';
    }
}
?>
