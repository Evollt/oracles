<?php
namespace App\Virtual;
/**
 * @OA\Schema(
 *      title="Subscribe request",
 *      description="Subscribe request body data",
 *      type="object",
 *      required={"discord_id", "name", "discriminator", "subscribe"}
 * )
 */
class Subscribe
{
    /**
     * @OA\Property(
     *      title="discord_id",
     *      description="Discord id",
     *      example="123456789123456789"
     * )
     *
     * @var integer
     */
    public $discord_id;

    /**
     * @OA\Property(
     *      title="name",
     *      description="Name",
     *      example="Test"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="discriminator",
     *      description="Discriminator",
     *      example=0001
     * )
     *
     * @var integer
     */
    public $discriminator;

    /**
     * @OA\Property(
     *      title="subscribe",
     *      description="Subscribe",
     *      example=true
     * )
     *
     * @var bool
     */
    public $subscribe;
}
