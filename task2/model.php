<?php
class TableModel {
    public static function fetchData() {
        $data = file_get_contents(__DIR__ . '../assets/data.json');
        return json_decode($data, true);
    }

    public static function sortData($data, $sortKey, $sortOrder) {
        usort($data, function($a, $b) use ($sortKey, $sortOrder) {
            if ($a[$sortKey] == $b[$sortKey]) {
                return 0;
            }
            if ($sortOrder == 'asc') {
                return ($a[$sortKey] < $b[$sortKey]) ? -1 : 1;
            } else {
                return ($a[$sortKey] > $b[$sortKey]) ? -1 : 1;
            }
        });
        return $data;
    }

    public static function filterData($data, $filter) {
        return array_filter($data, function($row) use ($filter) {
            return stripos($row['Name'], $filter) === 0;
        });
    }

    public static function paginateData($data, $page, $pageSize) {
        $startIndex = ($page - 1) * $pageSize;
        return array_slice($data, $startIndex, $pageSize);
    }
}
?>

