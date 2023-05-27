<?php

namespace App\Helper;

use Illuminate\Support\Str;

trait TokenGenarate
{
    protected $token_protect;
    public function generateToken() {
        $token = Str::random(60);
        $this->token_protect = $token;

        return $this->token_protect;
    }
}
