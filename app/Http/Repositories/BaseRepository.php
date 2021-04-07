<?php

namespace App\Http\Repositories;

use Ramsey\Uuid\Uuid;

class BaseRepository {

    public function generateUuId(){
        return Uuid::uuid4()->toString();
    }

}

