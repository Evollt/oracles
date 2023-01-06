<?php
namespace App\Virtual;
/**
 * @OA\Schema(
 *      title="Scam post request",
 *      description="Scam post request body data",
 *      type="object",
 *      required={"title", "text", "category", "images"}
 * )
 */
class ScamPost
{
    /**
     * @OA\Property(
     *      title="title",
     *      description="Title",
     *      example="Project X is a rug project"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="text",
     *      description="Text",
     *      example="As seen in the images we can see that the Owner is a serial rugger"
     * )
     *
     * @var string
     */
    public $text;

    /**
     * @OA\Property(
     *      title="category",
     *      description="Scam category",
     *      example="rug"
     * )
     *
     * @var string
     */
    public $category;

    /**
     * @OA\Property(
     *      title="images",
     *      description="Subscribe",
     *      @OA\Items(
     *          example="image-link"
     *      ),
     * )
     *
     * @var array
     */
    public $images;
}
