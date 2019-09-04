<?php

namespace Prettus\Repository\Traits;

use Illuminate\Support\Arr;
use Prettus\Repository\Contracts\PresenterInterface;

/**
 * Class PresentableTrait
 * @package Prettus\Repository\Traits
 * @author Anderson Andrade <contato@andersonandra.de>
 */
trait PresentableTrait
{

    /**
     * @var PresenterInterface
     */
    protected $presenterInstance = null;

    /**
     * @return bool
     */
    protected function hasPresenter()
    {
        return isset($this->presenter) && $this->presenterInstance instanceof PresenterInterface;
    }

    /**
     * @return $this|mixed
     */
    public function presenter()
    {
        if (! $this->presenter) {
            return null;
        }

        if (! $this->hasPresenter()) {
            $this->presenterInstance = new $this->presenter($this);
        }

        return $this->presenterInstance;
    }
}
