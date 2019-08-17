<?php

namespace Bankin\Model;

class BankGroups extends Resources
{
    /**
     * @var BankGroup[]|array
     */
    protected $resources;

    /**
     * User constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        foreach ($data['resources'] as $country)
        {
            foreach ($country['parent_banks'] as $group) {
                $group['country_code'] = $country['country_code'];
                $this->resources[] = new BankGroup($group);
            }
        }
    }

    /**
     * @return BankGroup[]
     */
    public function all()
    {
        return $this->resources;
    }

    /**
     * @return BankGroup|null
     */
    public function first()
    {
        return $this->resources[0] ?? null;
    }
}