<?php
class BaseModelHelper {
    public static function getPaginationData($model) {
        $count = $model->getTotalRecords();
        $limit = $model->limit;
        return ceil($count / $limit);
    }

    public static function getSearchData($model, $columns) {
        if (isset($_GET['q']) && $_GET['q'] !== "") {
            $q = esc($_GET['q']);
            return $model->getDataSearch($columns, $q);
        }
        return $model->findAll();
    }

    public static function handleSorting($model) {
        if (isset($_GET['col']) && $_GET['col'] !== "") {
            $model->order_column = esc($_GET['col']);
        }
        if (isset($_GET['order']) && $_GET['order'] !== "") {
            $model->order_type = esc($_GET['order']);
        }
    }

    public static function handleMessage($result, $successMessage, $failureMessage, $redirect) {
        $message = $result ? $successMessage : $failureMessage;
        redirect($redirect . '?msg=' . urlencode($message));
    }
}
