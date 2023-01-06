<?php

namespace App\View\Components\Image;

use App\Models\Crypto\Nft;
use App\Models\Asset\Asset;
use App\Models\File\ModelFile;
use Illuminate\View\Component;

class ImageSlider extends Component
{
    public $images = [];
    public $nft;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($nftId)
    {
        $this->nft = Nft::find($nftId);
        $asset = Asset::where('nft_id', '=', $nftId)->first();
        foreach(ModelFile::where(['model_class' => Asset::class, 'model_id' => $asset->id])->get() as $file)
        {
            $this->images[] = $file->file->file;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.image.image-slider');
    }
}
