<?php

namespace Source\Controllers;

use Source\Models\Status;
use Stonks\Router\Router;

class StatusController
{
    private Router $route;

    public function __construct(Router $route)
    {
        $this->route = $route;
    }

    public function index(): void
    {
        echo json_encode(objectToArray((new Status())->find()->fetch(true)));
    }

    public function store(array $data): void
    {
        $status = new Status();
        $status->name = filter_var($data['name'], FILTER_SANITIZE_STRING);
        $status->save();

        if ($status->fail()) {
            echo json_encode($status->fail()->getMessage());
            return;
        }

        echo json_encode("Status salvo!");
    }

    public function show(array $data): void
    {
        $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);
        echo json_encode(objectToArray((new Status())->findById($id)));
    }

    public function update(array $data): void
    {
        $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);

        $status = (new Status())->findById($id);
        $status->name = filter_var($data['name'], FILTER_SANITIZE_STRING);
        $status->change()->save();

        if ($status->fail()) {
            echo json_encode($status->fail()->getMessage());
            return;
        }

        echo json_encode("Status atualizado!");
    }

    public function delete(array $data): void
    {
        $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);

        $status = (new Status())->findById($id);
        if ($status) {
            $status->destroy();
            echo json_encode("Status deletado!");
        }else{
            echo json_encode("Status inválido.");
        }

        
    }
}
