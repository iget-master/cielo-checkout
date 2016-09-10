<?php
/**
 * Created by PhpStorm.
 * User: esoares
 * Date: 10/09/16
 * Time: 16:07
 */

namespace Iget\CieloCheckout\Order;

use Illuminate\Contracts\Support\Arrayable;

class Customer implements Arrayable
{
    /**
     * @var int|null
     */
    private $identity;

    /**
     * @var string|null
     */
    private $fullName;

    /**
     * @var string|null
     */
    private $email;

    /**
     * @var int|null
     */
    private $phone;

    /**
     * Customer constructor.
     * @param int|null $identity
     * @param string|null $fullName
     * @param string|null $email
     * @param int|null $phone
     */
    public function __construct(int $identity = null, string $fullName = null, string $email = null, int $phone = null)
    {

        $this->identity = $identity;
        $this->fullName = $fullName;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'Identity' => $this->identity,
            'FullName' => $this->fullName,
            'Email' => $this->email,
            'Phone' => $this->phone,
        ];
    }

    /**
     * @param int|null $identity
     * @return Customer
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;

        return $this;
    }

    /**
     * @param null|string $fullName
     * @return Customer
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * @param null|string $email
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param int|null $phone
     * @return Customer
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }
}