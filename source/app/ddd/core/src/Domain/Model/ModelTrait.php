<?php declare(strict_types=1);


namespace AppCore\Domain\Model;


trait ModelTrait
{
    /** @var bool */
    private $new = true;

    /** @var array */
    private $dirties = [];

    /**
     * @param bool|null $new
     *
     * @return bool
     */
    public function isNew(?bool $new = null): bool
    {
        if ($new === null) {
            return $this->new;
        }

        return $this->new = $new;
    }

    /**
     * @return bool
     */
    public function isDirty(): bool
    {
        return ! empty($this->dirties);
    }

    /**
     * @return array
     */
    public function getDirtyPropertyNames(): array
    {
        return array_keys($this->dirties);
    }

    /**
     * @param array $array
     *
     * @return self
     */
    public function modify(array $array): self
    {
        $obj = clone $this;
        foreach ($array as $key => $value) {
            if ($value === '') {
                $value = null;
            }
            if ( ! property_exists($obj, $key)) {
                continue;
            }
            if ( ! is_object($value) && $obj->$key === $value) {
                continue;
            }
            $obj->$key          = $value;
            $obj->dirties[$key] = true;
        }

        return $obj;
    }

    /**
     * @param string $property_name
     *
     * @return string|int|\DateTimeImmutable|null
     */
    public function getter($property_name)
    {
        $suffix = str_replace([' ', '-', '_'], '', ucwords($property_name, ' -_'));

        $method_name = 'get' . $suffix;
        if (method_exists($this, $method_name)) {
            return $this->$method_name();
        }

        $method_name = 'is' . $suffix;
        if (method_exists($this, $method_name)) {
            return $this->$method_name();
        }

        return null;
    }
}