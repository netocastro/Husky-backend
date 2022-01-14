<?php

namespace Source\Controllers;

use Source\Models\Delivery;

/**
 * @OA\Info(title="Controller Delivery", version="1.0")
 */
class DeliveryController
{
    /** 
     * @OA\Get(path="/delivery", tags={"delivery"},
     * @OA\Response (response="200", description="Success"),
     * @OA\Response (response="404", description="Not found"),
     * )
     */
    public function index(): void
    {
        $devilery = (new Delivery())->find()->fetch(true);

        foreach ($devilery as $value) {
            $value->data()->user_name = $value->user_name();
            $value->data()->motoboy_name = $value->motoboy_name();
            $value->data()->status_name = $value->status_name();
        }

        echo json_encode(objectToArray($devilery));
    }

    public function store(array $data): void
    {
        //echo json_encode($data);
        //exit;
        $motoboyId = null;
        if (isset($data['motoboy_id'])) {
            $motoboyId = filter_var($data['motoboy_id'], FILTER_SANITIZE_NUMBER_INT);
        }

        $delivery = new Delivery();
        $delivery->user_id = filter_var($data['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $delivery->motoboy_id = $motoboyId;
        $delivery->collection_address = filter_var($data['collection_address'], FILTER_SANITIZE_STRIPPED);
        $delivery->destination_address = filter_var($data['destination_address'], FILTER_SANITIZE_STRIPPED);
        $delivery->status = 1;

        $delivery->save();

        if ($delivery->fail()) {
            echo json_encode($delivery->fail()->getMessage());
            return;
        }
        echo json_encode(["success" => "salvo com sucesso"]);
    }

    public function show(array $data): void
    {
        $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);

        /** @var $delivery Delivery */
        $delivery = (new Delivery())->findById($id);
        if ($delivery) {
            $delivery->data()->user_name = $delivery->user_name();
            $delivery->data()->motoboy_name = $delivery->motoboy_name();
            $delivery->data()->status_name = $delivery->status_name();
            echo json_encode(objectToArray($delivery));
        } else {
            echo json_encode("Entrega não cadastrada");
        }
    }

    public function update(array $data): void
    {
        $data = filter_var_array($data, [
            "id" => FILTER_SANITIZE_NUMBER_INT,
            "user_id" => FILTER_SANITIZE_NUMBER_INT,
            "status" => FILTER_SANITIZE_NUMBER_INT,
            "motoboy_id" => FILTER_SANITIZE_NUMBER_INT,
            "collection_address" => FILTER_SANITIZE_STRIPPED,
            "destination_address" => FILTER_SANITIZE_STRIPPED,
        ]);

        $delivery = (new Delivery())->findById($data['id']);

        $delivery->user_id = $data['user_id'];
        $delivery->motoboy_id = $data['motoboy_id'];
        $delivery->collection_address = $data['collection_address'];
        $delivery->destination_address = $data['destination_address'];
        $delivery->status = $data['status'];

        $delivery->change()->save();

        if ($delivery->fail()) {
            echo json_encode($delivery->fail()->getMessage());
            return;
        }
        echo json_encode("Delivery atualizado!");
    }

    public function delete(array $data): void
    {
        $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);

        $delivery = (new Delivery())->findById($id);

        if ($delivery) {
            $delivery->destroy();
            echo json_encode("Delivery deletado!");
        } else {
            echo json_encode("Delivery inválido.");
        }
    }

    /** Site */
    public function status(array $data): void
    {
        $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);
        $delivery = (new Delivery())->find("status = :s", "s={$id}")->fetch(true);
        if ($delivery) {
            echo json_encode(objectToArray($delivery));
        } else {
            echo json_encode("entrega não caadstrada");
        }
    }
}
