<?php

namespace Source\Controllers;

use Source\Models\Delivery;

class Web
{
    public function filterDeliveries($data)
    {
        $data = filter_var_array($data, [
            "status_id" => FILTER_SANITIZE_NUMBER_INT,
            "motoboy_id" => FILTER_SANITIZE_NUMBER_INT
        ]);

        if ($data['status_id'] == 0 && $data['motoboy_id'] != 0) {
            $deliveriesFilter = (new Delivery())->find("motoboy_id = :m", "m={$data['motoboy_id']}")->fetch(true);
            if ($deliveriesFilter) {
                foreach ($deliveriesFilter as $value) {
                    $value->data()->user_name = $value->user_name();
                    $value->data()->motoboy_name = $value->motoboy_name();
                    $value->data()->status_name = $value->status_name();
                }
                echo json_encode(objectToArray($deliveriesFilter));
                return;
            }
            echo json_encode([]);
        }

        if ($data['motoboy_id'] == 0 && $data['status_id'] != 0) {
            $deliveriesFilter = (new Delivery())->find("status = :s", "s={$data['status_id']}")->fetch(true);
            if ($deliveriesFilter) {
                foreach ($deliveriesFilter as $value) {
                    $value->data()->user_name = $value->user_name();
                    $value->data()->motoboy_name = $value->motoboy_name();
                    $value->data()->status_name = $value->status_name();
                }
                echo json_encode(objectToArray($deliveriesFilter));
                return;
            }
            echo json_encode([]);
        }

        if ($data['motoboy_id'] == 0 && $data['status_id'] == 0) {
            $deliveriesFilter = (new Delivery())->find()->fetch(true);
            if ($deliveriesFilter) {
                foreach ($deliveriesFilter as $value) {
                    $value->data()->user_name = $value->user_name();
                    $value->data()->motoboy_name = $value->motoboy_name();
                    $value->data()->status_name = $value->status_name();
                }
                echo json_encode(objectToArray($deliveriesFilter));
                return;
            }
            echo json_encode([]);
        }

        if ($data['motoboy_id'] != 0 && $data['status_id'] != 0) {
            $deliveriesFilter = (new Delivery())->find("status = :s and motoboy_id = :m", "s={$data['status_id']}&m={$data['motoboy_id']}")->fetch(true);
            if ($deliveriesFilter) {
                foreach ($deliveriesFilter as $value) {
                    $value->data()->user_name = $value->user_name();
                    $value->data()->motoboy_name = $value->motoboy_name();
                    $value->data()->status_name = $value->status_name();
                }
                echo json_encode(objectToArray($deliveriesFilter));
                return;
            }
            echo json_encode([]);
        }
    }
}
