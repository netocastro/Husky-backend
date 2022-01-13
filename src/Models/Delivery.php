<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class Delivery extends DataLayer 
{
    public function __construct()
    {
        parent::__construct('deliveries',['user_id','status','collection_address','destination_address'],'id',true);
    }
}
