@extends('frontend.layouts.master')



@section('meta')

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name='copyright' content=''>

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta name="keywords" content="online shop, purchase, cart, ecommerce site, best online shopping">

	<meta name="description" content="{{$product_detail->summary}}">

	<meta property="og:url" content="{{route('product-detail',$product_detail->slug)}}">

	<meta property="og:type" content="article">

	<meta property="og:title" content="{{$product_detail->title}}">

	<meta property="og:image" content="{{$product_detail->photo}}">

	<meta property="og:description" content="{{$product_detail->description}}">

@endsection

@section('title','MUSH-PK || PRODUCT DETAIL')

@section('main-content')
		<!-- Breadcrumbs -->

		<div class="breadcrumbs">

			<div class="container">

				<div class="row">

					<div class="col-12">

						<div class="bread-inner">

							<ul class="bread-list">

								<li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>

								<li class="active"><a href="">Shop Details</a></li>

							</ul>

						</div>

					</div>

				</div>

			</div>

		</div>

		<!-- End Breadcrumbs -->

				

		<!-- Shop Single -->

		<section class="shop single section">

					<div class="container">

						<div class="row"> 

							<div class="col-12">

								<div class="row">

									<div class="col-lg-6 col-12">

										<!-- Product Slider -->

										<div class="product-gallery">

											<!-- Images slider -->

											<div class="flexslider-thumbnails">

												<ul class="slides">

													@php 

														$photo=explode(',',$product_detail->photo);

													// dd($photo);

													@endphp

													@foreach($photo as $data)

														<li data-thumb="{{asset($data)}}" rel="adjustX:10, adjustY:">

															<img src="{{asset($data)}}" alt="{{asset($data)}}">

														</li>

													@endforeach

												</ul>

											</div>

											<!-- End Images slider -->

										</div>

										<!-- End Product slider -->

									</div>

									<div class="col-lg-6 col-12">

										<div class="product-des">

											<!-- Description -->

											<div class="short">

												<h4>{{$product_detail->title}}</h4>

												

                                                @php 

                                                    $after_discount=($product_detail->price-(($product_detail->price*$product_detail->discount)/100));

                                                @endphp

												<p class="price"><span class="discount">Rs.{{number_format($after_discount,2)}}</span>
												</p>

												<p class="description m-1 p-1">{!!($product_detail->summary)!!}</p>

											</div>

											<div class="product-buy mt-3">
											    <form action="{{route('single-add-to-cart')}}" method="POST">
											        @csrf 
											        <input type="hidden" name="slug" value="{{$product_detail->slug}}">

													
													@if($product_detail->color)
													<div class="color">
													    <h4>Available Color   <span class="selected-color-name">sdfasfd</span></h4>
													    <ul class="color-list">
													        @if($product_detail->color)
													            @php 
													                $colors = explode(',', $product_detail->color);
													            @endphp
													            @foreach($colors as $color)
													                <li>
													                    @php
													                        $colorClass = strtolower(str_replace(' ', '-', $color));
													                    @endphp
													                    <div class="color-option {{ $colorClass }}" 
													                         data-color="{{ $color }}" 
													                         data-toggle="tooltip"
													                         title="{{ $color }}">
													                        <i class="ti-check"></i>
													                    </div>
													                </li>
													            @endforeach
													        @endif
													    </ul>
													    <!-- Optional: Add hidden input for form submission -->
													    <input type="hidden" name="selected_color" value="">
													    <!-- Optional: Add span to show selected color name -->
														  
													</div>
													@endif

														{{-- Size Selection - Only show for specific categories --}}
												    @php
												        $categories_with_size = ['Bags']; 
												        // Add your categories that need size
												        $show_size = in_array($product_detail->cat_info['title'], $categories_with_size);
												    @endphp

											        @if($show_size && $product_detail->size)
											        <div class="size-selection mb-4">
													    <div class="size-label-group">
													        <h6 class="d-inline-block">Size :</h6>
													        <select name="size" class="nice-select" required>
													            <option value="">Select Size</option>
													            @php 
													                $sizes=explode(',',$product_detail->size);
													            @endphp
													            @foreach($sizes as $size)
													                <option value="{{$size}}">{{$size}}</option>
													            @endforeach
													        </select>
													    </div>
													</div>

											        <!-- Size Guide with Tabs -->
															<!-- <div class="size-guide-section mb-4">
											            <h6>Size Guide</h6>
											            
											            <ul class="nav nav-tabs size-guide-tabs" role="tablist">
											                <li class="nav-item">
											                    <a class="nav-link active" data-toggle="tab" href="#tops" role="tab">Tops</a>
											                </li>
											                <li class="nav-item">
											                    <a class="nav-link" data-toggle="tab" href="#pants" role="tab">Pants</a>
											                </li>
											            </ul>

											            <div class="tab-content">
											                <div class="tab-pane active" id="tops" role="tabpanel">
											                    <div class="table-responsive">
											                        <table class="table table-sm table-bordered">
											                            <thead>
											                                <tr>
											                                    <th>EU</th>
											                                    <th>Size</th>
											                                    <th>Underbust</th>
											                                    <th>Length</th>
											                                </tr>
											                            </thead>
											                            <tbody>
											                                <tr>
											                                    <td>36</td>
											                                    <td>S</td>
											                                    <td>64-86</td>
											                                    <td>13</td>
											                                </tr>
											                                <tr>
											                                    <td>38</td>
											                                    <td>M</td>
											                                    <td>68-90</td>
											                                    <td>14</td>
											                                </tr>
											                                <tr>
											                                    <td>40/42</td>
											                                    <td>L</td>
											                                    <td>72-94</td>
											                                    <td>15</td>
											                                </tr>
											                                <tr>
											                                    <td>44</td>
											                                    <td>XL</td>
											                                    <td>76-98</td>
											                                    <td>16</td>
											                                </tr>
											                            </tbody>
											                        </table>
											                    </div>
											                </div>

											                <div class="tab-pane" id="pants" role="tabpanel">
											                    <div class="table-responsive">
											                        <table class="table table-sm table-bordered">
											                            <thead>
											                                <tr>
											                                    <th>EU</th>
											                                    <th>Size</th>
											                                    <th>Waist</th>
											                                    <th>Length</th>
											                                </tr>
											                            </thead>
											                            <tbody>
											                                <tr>
											                                    <td>36</td>
											                                    <td>S</td>
											                                    <td>60-70</td>
											                                    <td>95</td>
											                                </tr>
											                                <tr>
											                                    <td>38</td>
											                                    <td>M</td>
											                                    <td>64-74</td>
											                                    <td>96</td>
											                                </tr>
											                                <tr>
											                                    <td>40/42</td>
											                                    <td>L</td>
											                                    <td>68-78</td>
											                                    <td>97</td>
											                                </tr>
											                                <tr>
											                                    <td>44</td>
											                                    <td>XL</td>
											                                    <td>72-82</td>
											                                    <td>98</td>
											                                </tr>
											                            </tbody>
											                        </table>
											                    </div>
											                </div>
											            </div>
											            <small class="text-muted">*This data was obtained from manually measuring the product, it may be off by 1-2 CM.</small>
											        </div> -->
											        @endif

											        <div class="quantity mb-4">
											            <h6 class="d-inline-block">Quantity :</h6>
											            <div class="input-group d-inline-flex ml-2">
											                <div class="button minus">
											                    <button type="button" class="btn btn-number" data-type="minus" data-field="quant[1]">
											                        <i class="ti-minus"></i>
											                    </button>
											                </div>
											                <input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000" value="1" id="quantity">
											                <div class="button plus">
											                    <button type="button" class="btn btn-number" data-type="plus" data-field="quant[1]">
											                        <i class="ti-plus"></i>
											                    </button>
											                </div>
											            </div>
											        </div>

											        <div class="add-to-cart mt-4">
											            <button type="submit" class="btn" {{ $product_detail->stock <= 0 ? 'disabled' : '' }}>Add to cart</button>
											         <!--    <a href="{{route('add-to-wishlist',$product_detail->slug)}}" class="btn min"><i class="ti-heart"></i></a> -->
											        </div>
											    </form>
											</div>
										</div>

									</div>

								</div>

								<div class="row">

									<div class="col-12">

										<div class="product-info">

											<div class="nav-main">

												<!-- Tab Nav -->

												<ul class="nav nav-tabs" id="myTab" role="tablist">

													<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a></li>

													<!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews</a></li> -->

												</ul>

												<!--/ End Tab Nav -->

											</div>

											<div class="tab-content" id="myTabContent">

												<!-- Description Tab -->

												<div class="tab-pane fade show active" id="description" role="tabpanel">

													<div class="tab-single">

														<div class="row">

															<div class="col-12">

																<div class="single-des">

																	<p>{!! ($product_detail->description) !!}</p>

																</div>

															</div>

														</div>

													</div>

												</div>

												<!--/ End Description Tab -->

												<!-- Reviews Tab -->

												<div class="tab-pane fade" id="reviews" role="tabpanel">

													<div class="tab-single review-panel">

														<div class="row">

															<div class="col-12">

																

																<!-- Review -->

																<div class="comment-review">

																	<div class="add-review">

																		<h5>Add A Review</h5>

																		<p>Your email address will not be published. Required fields are marked</p>

																	</div>

																	<h4>Your Rating <span class="text-danger">*</span></h4>

																	<div class="review-inner">

																			<!-- Form -->

																@auth

																<form class="form" method="post" action="{{route('review.store',$product_detail->slug)}}">

                                                                    @csrf

                                                                    <div class="row">

                                                                        <div class="col-lg-12 col-12">

                                                                            <div class="rating_box">

                                                                                  <div class="star-rating">

                                                                                    <div class="star-rating__wrap">

                                                                                      <input class="star-rating__input" id="star-rating-5" type="radio" name="rate" value="5">

                                                                                      <label class="star-rating__ico fa fa-star-o" for="star-rating-5" title="5 out of 5 stars"></label>

                                                                                      <input class="star-rating__input" id="star-rating-4" type="radio" name="rate" value="4">

                                                                                      <label class="star-rating__ico fa fa-star-o" for="star-rating-4" title="4 out of 5 stars"></label>

                                                                                      <input class="star-rating__input" id="star-rating-3" type="radio" name="rate" value="3">

                                                                                      <label class="star-rating__ico fa fa-star-o" for="star-rating-3" title="3 out of 5 stars"></label>

                                                                                      <input class="star-rating__input" id="star-rating-2" type="radio" name="rate" value="2">

                                                                                      <label class="star-rating__ico fa fa-star-o" for="star-rating-2" title="2 out of 5 stars"></label>

                                                                                      <input class="star-rating__input" id="star-rating-1" type="radio" name="rate" value="1">

																					  <label class="star-rating__ico fa fa-star-o" for="star-rating-1" title="1 out of 5 stars"></label>

																					  @error('rate')

																						<span class="text-danger">{{$message}}</span>

																					  @enderror

                                                                                    </div>

                                                                                  </div>

                                                                            </div>

                                                                        </div>

																		<div class="col-lg-12 col-12">

																			<div class="form-group">

																				<label>Write a review</label>

																				<textarea name="review" rows="6" placeholder="" ></textarea>

																			</div>

																		</div>

																		<div class="col-lg-12 col-12">

																			<div class="form-group button5">	

																				<button type="submit" class="btn">Submit</button>

																			</div>

																		</div>

																	</div>

																</form>

																@else 

																<p class="text-center p-5">

																	You need to <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">Login</a> OR <a style="color:blue" href="{{route('register.form')}}">Register</a>



																</p>

																<!--/ End Form -->

																@endauth

																	</div>

																</div>

															

																<div class="ratting-main">

																	<div class="avg-ratting">

																		{{-- @php 

																			$rate=0;

																			foreach($product_detail->rate as $key=>$rate){

																				$rate +=$rate

																			}

																		@endphp --}}

																		<h4>{{ceil($product_detail->getReview->avg('rate'))}} <span>(Overall)</span></h4>

																		<span>Based on {{$product_detail->getReview->count()}} Comments</span>

																	</div>

																	@foreach($product_detail['getReview'] as $data)

																	<!-- Single Rating -->

																	<div class="single-rating">

																		<div class="rating-author">

																			@if($data->user_info['photo'])

																			<img src="{{asset($data->user_info['photo'])}}" alt="{{asset($data->user_info['photo'])}}">

																			@else 

																			<img src="{{asset('backend/img/avatar.png')}}" alt="Profile.jpg">

																			@endif

																		</div>

																		<div class="rating-des">

																			<h6>{{$data->user_info['name']}}</h6>

																			<div class="ratings">



																				<ul class="rating">

																					@for($i=1; $i<=5; $i++)

																						@if($data->rate>=$i)

																							<li><i class="fa fa-star"></i></li>

																						@else 

																							<li><i class="fa fa-star-o"></i></li>

																						@endif

																					@endfor

																				</ul>

																				<div class="rate-count">(<span>{{$data->rate}}</span>)</div>

																			</div>

																			<p>{{$data->review}}</p>

																		</div>

																	</div>

																	<!--/ End Single Rating -->

																	@endforeach

																</div>

																

																<!--/ End Review -->

																

															</div>

														</div>

													</div>

												</div>

												<!--/ End Reviews Tab -->

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

					</div>

		</section>

		<!--/ End Shop Single -->

		

		<!-- Start Most Popular -->

	<div class="product-area most-popular related-product section">

        <div class="container">

            <div class="row">

				<div class="col-12">

					<div class="section-title">

						<h2>Related Products</h2>

					</div>

				</div>

            </div>

            <div class="row">

                {{-- {{$product_detail->rel_prods}} --}}

                <div class="col-12">

                    <div class="owl-carousel popular-slider">

                        @foreach($product_detail->rel_prods as $data)

                            @if($data->id !==$product_detail->id)

                                <!-- Start Single Product -->

                                <div class="single-product">

                                    <div class="product-img">

										<a href="{{route('product-detail',$data->slug)}}">

											@php 

												$photo=explode(',',$data->photo);

											@endphp

                                            <img class="default-img" src="{{asset($photo[0])}}" alt="{{asset($photo[0])}}">

                                            <img class="hover-img" src="{{asset($photo[0])}}" alt="{{asset($photo[0])}}">

                                            <span class="price-dec">{{$data->discount}} % Off</span>

                                                {{-- <span class="out-of-stock">Hot</span> --}}

                                        </a>

                                        <div class="button-head">

                                            <div class="product-action">

                                                <a data-toggle="modal" data-target="#modelExample" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>

                                                <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>

                                                <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>

                                            </div>

                                            <div class="product-action-2">

                                                <a title="Add to cart" href="#">Add to cart</a>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="product-content">

                                        <h3><a href="{{route('product-detail',$data->slug)}}">{{$data->title}}</a></h3>

                                        <div class="product-price">

                                            @php 

                                                $after_discount=($data->price-(($data->discount*$data->price)/100));

                                            @endphp

                                            <!-- <span class="old">Rs.{{number_format($data->price,2)}}</span> -->

                                            <span>Rs.{{number_format($after_discount,2)}}</span>

                                        </div>

                                      

                                    </div>

                                </div>

                                <!-- End Single Product -->

                                	

                            @endif

                        @endforeach

                    </div>

                </div>

            </div>

        </div>

    </div>

	<!-- End Most Popular Area -->

	



  <!-- Modal -->

  <div class="modal fade" id="modelExample" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>

            </div>

            <div class="modal-body">

                <div class="row no-gutters">

                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                        <!-- Product Slider -->

                            <div class="product-gallery">

                                <div class="quickview-slider-active">

                                    <div class="single-slider">

                                        <img src="images/modal1.png" alt="#">

                                    </div>

                                    <div class="single-slider">

                                        <img src="images/modal2.png" alt="#">

                                    </div>

                                    <div class="single-slider">

                                        <img src="images/modal3.png" alt="#">

                                    </div>

                                    <div class="single-slider">

                                        <img src="images/modal4.png" alt="#">

                                    </div>

                                </div>

                            </div>

                        <!-- End Product slider -->

                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                        <div class="quickview-content">

                            <h2>Flared Shift Dress</h2>

                            <div class="quickview-ratting-review">

                                <div class="quickview-ratting-wrap">

                                    <div class="quickview-ratting">

                                        <i class="yellow fa fa-star"></i>

                                        <i class="yellow fa fa-star"></i>

                                        <i class="yellow fa fa-star"></i>

                                        <i class="yellow fa fa-star"></i>

                                        <i class="fa fa-star"></i>

                                    </div>

                                    <a href="#"> (1 customer review)</a>

                                </div>

                                <div class="quickview-stock">

                                    <span><i class="fa fa-check-circle-o"></i> in stock</span>

                                </div>

                            </div>

                            <h3>$29.00</h3>

                            <div class="quickview-peragraph">

                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam.</p>

                            </div>

                            <div class="size">

                                <div class="row">

                                    <div class="col-lg-6 col-12">

                                        <h5 class="title">Size</h5>

                                        <select>

                                            <option selected="selected">s</option>

                                            <option>m</option>

                                            <option>l</option>

                                            <option>xl</option>

                                        </select>

                                    </div>

                                    <div class="col-lg-6 col-12">

                                        <h5 class="title">Color</h5>

                                        <select>

                                            <option selected="selected">orange</option>

                                            <option>purple</option>

                                            <option>black</option>

                                            <option>pink</option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="quantity">

                                <!-- Input Order -->

                                <div class="input-group">

                                    <div class="button minus">

                                        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">

                                            <i class="ti-minus"></i>

                                        </button>

									</div>

                                    <input type="text" name="qty" class="input-number"  data-min="1" data-max="1000" value="1">

                                    <div class="button plus">

                                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">

                                            <i class="ti-plus"></i>

                                        </button>

                                    </div>

                                </div>

                                <!--/ End Input Order -->

                            </div>

                            <div class="add-to-cart">

                                <a href="#" class="btn">Add to cart</a>

                                <a href="#" class="btn min"><i class="ti-heart"></i></a>

                                <a href="#" class="btn min"><i class="fa fa-compress"></i></a>

                            </div>

                            <div class="default-social">

                                <h4 class="share-now">Share:</h4>

                                <ul>

                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>

                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>

                                    <li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>

                                    <li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Add this modal for Size Guide -->
<div class="modal fade" id="sizeGuideModal" tabindex="-1" role="dialog" aria-labelledby="sizeGuideModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sizeGuideModalLabel">Size Guide</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Size Guide Tabs -->
                <ul class="nav nav-tabs mb-3" id="sizeGuideTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tops-tab" data-toggle="tab" href="#tops" role="tab">Tops</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pants-tab" data-toggle="tab" href="#pants" role="tab">Pants</a>
                    </li>
                </ul>
                <div class="tab-content" id="sizeGuideTabContent">
                    <!-- Tops Table -->
                    <div class="tab-pane fade show active" id="tops" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>EU</th>
                                        <th>Size</th>
                                        <th>Underbust</th>
                                        <th>Length</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>36</td>
                                        <td>S</td>
                                        <td>64-86</td>
                                        <td>13</td>
                                    </tr>
                                    <tr>
                                        <td>38</td>
                                        <td>M</td>
                                        <td>68-90</td>
                                        <td>14</td>
                                    </tr>
                                    <tr>
                                        <td>40/42</td>
                                        <td>L</td>
                                        <td>72-94</td>
                                        <td>15</td>
                                    </tr>
                                    <tr>
                                        <td>44</td>
                                        <td>XL</td>
                                        <td>76-98</td>
                                        <td>16</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p class="small text-muted">*This data was obtained from manually measuring the product, it may be off by 1-2 CM.</p>
                    </div>
                    
                    <!-- Pants Table -->
                    <div class="tab-pane fade" id="pants" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>EU</th>
                                        <th>Size</th>
                                        <th>Waist</th>
                                        <th>Length</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>36</td>
                                        <td>S</td>
                                        <td>60-70</td>
                                        <td>95</td>
                                    </tr>
                                    <tr>
                                        <td>38</td>
                                        <td>M</td>
                                        <td>64-74</td>
                                        <td>96</td>
                                    </tr>
                                    <tr>
                                        <td>40/42</td>
                                        <td>L</td>
                                        <td>68-78</td>
                                        <td>97</td>
                                    </tr>
                                    <tr>
                                        <td>44</td>
                                        <td>XL</td>
                                        <td>72-82</td>
                                        <td>98</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal end -->



@endsection

@push('styles')

<style>

		/* Rating */

		.rating_box {

		display: inline-flex;

		}



		.star-rating {

		font-size: 0;

		padding-left: 10px;

		padding-right: 10px;

		}



		.star-rating__wrap {

		display: inline-block;

		font-size: 1rem;

		}



		.star-rating__wrap:after {

		content: "";

		display: table;

		clear: both;

		}



		.star-rating__ico {

		float: right;

		padding-left: 2px;

		cursor: pointer;

		color: #F7941D;

		font-size: 16px;

		margin-top: 5px;

		}



		.star-rating__ico:last-child {

		padding-left: 0;

		}



		.star-rating__input {

		display: none;

		}



		.star-rating__ico:hover:before,

		.star-rating__ico:hover ~ .star-rating__ico:before,

		.star-rating__input:checked ~ .star-rating__ico:before {

		content: "\F005";

		}

		.size-guide .btn-link {
    text-decoration: none;
    color: #333;
    font-weight: 500;
}

.size-guide .btn-link:hover {
    color: #F7941D;
}

#sizeGuideModal .nav-tabs .nav-link {
    color: #666;
    font-weight: 500;
}

#sizeGuideModal .nav-tabs .nav-link.active {
    color: #F7941D;
    border-color: #F7941D;
}

#sizeGuideModal .table th {
    background-color: #f8f9fa;
}

.model-info {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 4px;
}

.model-info h6 {
    margin-bottom: 5px;
}

@media (max-width: 576px) {
    #sizeGuideModal .modal-dialog {
        margin: 0.5rem;
    }
}


/* Size and Quantity Label Alignment */
select.nice-select {
    display: none !important;
}

.nice-select {
    float: none;
    display: inline-block;
    margin-left: 10px;
}
.size-label-group,
.quantity {
    display: flex;
    align-items: center;
    gap: 10px;
}

.size-label-group h6,
.quantity h6 {
    margin: 0;
    min-width: 70px;
}

.size-label-group select {
    flex: 1;
    max-width: 200px;
}

/* Size Guide Tabs */
.size-guide-section {
    margin-top: 20px;
}

.size-guide-tabs {
    border-bottom: 1px solid #dee2e6;
    margin-bottom: 15px;
}

.size-guide-tabs .nav-link {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
    border: none;
    color: #666;
}

.size-guide-tabs .nav-link.active {
    color: #F7941D;
    border-bottom: 2px solid #F7941D;
    background: none;
}

/* Table Styles */
.size-guide-section .table {
    font-size: 0.85rem;
    margin-bottom: 0.5rem;
}

.size-guide-section .table th {
    background-color: #f8f9fa;
    font-weight: 500;
    padding: 0.4rem;
}

.size-guide-section .table td {
    padding: 0.4rem;
}

.size-guide-section .text-muted {
    font-size: 0.75rem;
}

/* Quantity Input Styles */
.quantity .input-group {
    width: auto;
    align-items: center;
    border: 1px solid #ddd;
    border-radius: 4px;
    max-width: 200px;
}

.quantity .btn-number {
    background: none;
    border: none;
    padding: 8px 12px;
    font-size: 14px;
}

.quantity .input-number {
    width: 60px;
    text-align: center;
    border: none;
    padding: 8px;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .size-guide-section .table {
        font-size: 0.75rem;
    }
    
    .size-guide-section .table td,
    .size-guide-section .table th {
        padding: 0.3rem;
    }
    
    .size-label-group,
    .quantity {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .size-label-group select,
    .quantity .input-group {
        margin-left: 0;
        margin-top: 5px;
    }
}
/* Color Seciton  */
.color-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    padding: 0;
    list-style: none;
    margin: 15px 0;
}

.color-option {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    cursor: pointer;
    border: 2px solid #ddd;
    transition: all 0.2s;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.color-option:hover {
    transform: scale(1.1);
}

.color-option.selected {
    border-color: #F7941D;
}

.color-option i {
    display: none;
    color: #fff;
    font-size: 12px;
    text-shadow: 0 0 2px rgba(0,0,0,0.5);
}

.color-option.selected i {
    display: block;
}

/* For light colored options */
.color-option.white i,
.color-option.yellow i,
.color-option.khaki i,
.color-option.apricot i,
.color-option.baby-pink i,
.color-option.beige i {
    color: #333;
    text-shadow: none;
}

.selected-color-name {
    display: block;
    margin-top: 10px;
    font-size: 14px;
    color: #666;
}

/* Color definitions (same as before) */
.red { background-color: #ff0000; }
.blue { background-color: #0000ff; }
.black { background-color: #000000; }
.white { background-color: #ffffff; }
.green { background-color: #008000; }
.yellow { background-color: #ffff00; }
.purple { background-color: #800080; }
.orange { background-color: #ffa500; }
.grey { background-color: #808080; }
.brown { background-color: #a52a2a; }
.chocolate-brown { background-color: #d2691e; }
.coffee-brown { background-color: #6f4e37; }
.multicolour { background: linear-gradient(45deg, red, blue, green, yellow); }
.hot-pink { background-color: #ff69b4; }
.navy-blue { background-color: #000080; }
.khaki { background-color: #f0e68c; }
.lilac-purple { background-color: #c8a2c8; }
.apricot { background-color: #fbceb1; }
.maroon { background-color: #800000; }
.dark-grey { background-color: #404040; }
.baby-pink { background-color: #f4c2c2; }
.yellow-gold { background-color: #ffd700; }
.silver { background-color: #c0c0c0; }
.gold { background-color: #ffd700; }
.burgundy { background-color: #800020; }
.beige { background-color: #f5f5dc; }
</style>


@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Color selection handling
    $('.color-option').on('click', function() {
        // Remove selected class from all options
        $('.color-option').removeClass('selected');
        // Add selected class to clicked option
        $(this).addClass('selected');
        
        // Get the selected color
        var selectedColor = $(this).data('color');
        
        // Optional: You can add additional functionality here
        // For example, updating a hidden input for form submission
        $('input[name="selected_color"]').val(selectedColor);
        
        // Optional: Show selected color name
        $('.selected-color-name').text(selectedColor);
    });

    // Initialize tooltips if you're using Bootstrap
    $('[data-toggle="tooltip"]').tooltip();
    
    // Optional: Initialize first color as selected
    $('.color-option:first').trigger('click');
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
{{-- <script>

        $('.cart').click(function(){

            var quantity=$('#quantity').val();

            var pro_id=$(this).data('id');

            // alert(quantity);

            $.ajax({

                url:"{{route('add-to-cart')}}",

                type:"POST",

                data:{

                    _token:"{{csrf_token()}}",

                    quantity:quantity,

                    pro_id:pro_id

                },

                success:function(response){

                    console.log(response);

					if(typeof(response)!='object'){

						response=$.parseJSON(response);

					}

					if(response.status){

						swal('success',response.msg,'success').then(function(){

							document.location.href=document.location.href;

						});

					}

					else{

                        swal('error',response.msg,'error').then(function(){

							document.location.href=document.location.href;

						});

                    }

                }

            })

        });

    </script> --}}
@endpush