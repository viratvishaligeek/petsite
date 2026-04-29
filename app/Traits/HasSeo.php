<?php

namespace App\Traits;

trait HasSeo
{
    public function saveSeo($data)
    {
        return $this->seo()->updateOrCreate(
            [],
            $data
        );
    }
}
