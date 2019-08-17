<?php

namespace Bankin\Model;

class Bank extends Resource
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $group;

    /**
     * @var array|null
     */
    private $form;

    /**
     * @var string|null
     */
    private $countryCode;

    /**
     * @var bool
     */
    private $automaticRefresh;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->group = $data['group'] ?? null;
        $this->form = $data['form'] ?? null;
        $this->countryCode = $data['country_code'] ?? null;
        $this->automaticRefresh = $data['automatic_refresh'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return array|null
     */
    public function getForm(): ?array
    {
        return $this->form;
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @return bool
     */
    public function isAutomaticRefresh(): bool
    {
        return $this->automaticRefresh;
    }
}