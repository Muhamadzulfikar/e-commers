<!-- Products -->

<div class="row">
    @foreach($products as $product)
        <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card my-2 shadow-0">
            <a href={{url("product/{$product->id}")}} class="">
                <div class="mask" style="height: 50px;">
                    <div class="d-flex justify-content-start align-items-start h-100 m-2">
                        <h6><span class="badge bg-danger pt-1">New</span></h6>
                    </div>
                </div>
                <img src="{{ asset('storage/product/'.$product->image_product) }}"
                     class="card-img-top rounded-2" style="aspect-ratio: 1 / 1"/>
            </a>
            <div class="card-body p-0 pt-3">
                <a href="#!" class="btn btn-light border px-2 pt-2 float-end icon-hover"><i
                            class="fas fa-heart fa-lg px-1 text-secondary"></i></a>
                <h5 class="card-title">{{$product->product_price}}</h5>
                <p class="card-text mb-0">{{$product->product_name}}</p>
                <p class="text-muted">
                    {{$product->short_description}}
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- Products -->
