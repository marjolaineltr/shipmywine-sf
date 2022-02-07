<?php

namespace App\Data;

use App\Entity\Appellation;
use App\Entity\Color;
use App\Entity\Type;

class SearchData
{

    /**
     * @var int
     */
    public $page = 1;


    /**
     * @var string| null
     */
    public ?string $q = '';

    /**
     * @var Appellation[]
     */
    public array $appellation = [];

    /**
     * @var Color[]
     */
    public array $color = [];

    /**
     * @var Type[]
     */
    public array $type = [];

    /**
     * @var null|integer
     */
    public ?int $max;

    /**
     * @var null|integer
     */
    public ?int $min;


}