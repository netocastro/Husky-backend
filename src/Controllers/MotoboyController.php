<?php

namespace Source\Controllers;

use Source\Models\Motoboy;

class MotoboyController
{
    public function index(): void
    {
        echo json_encode(objectToArray((new Motoboy())->find()->fetch(true)));
    }

    public function store(array $data): void
    {
        $motoboy = new Motoboy();
        $motoboy->name = filter_var($data['name'], FILTER_SANITIZE_STRING);
        $motoboy->save();

        if ($motoboy->fail()) {
            echo json_encode($motoboy->fail()->getMessage());
            return;
        }

        echo json_encode("Motoboy salvo!");
    }

    public function show(array $data): void
    {
        $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);
        echo json_encode(objectToArray((new Motoboy())->findById($id)));
    }

    public function update(array $data): void
    {
        $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);

        $motoboy = (new Motoboy())->findById($id);
        $motoboy->name = filter_var($data['name'], FILTER_SANITIZE_STRING);
        $motoboy->change()->save();

        if ($motoboy->fail()) {
            echo json_encode($motoboy->fail()->getMessage());
            return;
        }

        echo json_encode("Motoboy atualizado!");
    }

    public function delete(array $data): void
    {
        $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);

        $motoboy = (new Motoboy())->findById($id);
        if ($motoboy) {
            $motoboy->destroy();
            echo json_encode("Motoboy deletado!");
        }else{
            echo json_encode("Motoboy inválido.");
        }
    }
}
