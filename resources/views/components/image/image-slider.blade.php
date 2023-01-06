<div class="col-lg-4 mb-4">
    @component('components.card')
        @slot('title')
            Images
        @endslot
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" style="height: 400px" src="{{ nft_image_url($nft->image->path) }}" alt="First slide">
              </div>
              @foreach ($images as $image)
                <div class="carousel-item">
                    <img class="d-block w-100" style="height: 400px; width: 10px" src="{{ $image }}" alt="Second slide">
                </div>
                @endforeach
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    @endcomponent
</div>
