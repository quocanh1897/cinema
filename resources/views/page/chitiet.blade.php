@extends('master') @section('content')

<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">White Blouse Armani</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="shop-category.html">Ladies</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="shop-category.html">Tops</a>
                    </li>
                    <li class="breadcrumb-item active">White Blouse Armani</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row bar">
            <!-- LEFT COLUMN _________________________________________________________-->
            <div class="col-lg-9">
                <p class="lead">Built purse maids cease her ham new seven among and. Pulled coming wooded tended it answer remain me be.
                    So landlord by we unlocked sensible it. Fat cannot use denied excuse son law. Wisdom happen suffer common
                    the appear ham beauty her had. Or belonging zealously existence as by resources.</p>
                <p class="goToDescription">
                    <a href="#details" class="scroll-to text-uppercase">Scroll to product details, material & care and sizing</a>
                </p>
                <div id="productMain" class="row">
                    <div class="col-sm-6">
                        <div data-slider-id="1" class="owl-carousel shop-detail-carousel">
                            <div>
                                <img src="sources/img/detailbig1.jpg" alt="" class="img-fluid">
                            </div>
                            <div>
                                <img src="img/detailbig2.jpg" alt="" class="img-fluid">
                            </div>
                            <div>
                                <img src="img/detailbig3.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="box">
                            <form>
                                <div class="sizes">
                                    <h3>Available sizes</h3>
                                    <select class="bs-select">
                                        <option value="small">Small</option>
                                        <option value="medium">Medium</option>
                                        <option value="large">Large</option>
                                        <option value="x-large">X Large</option>
                                    </select>
                                </div>
                                <p class="price">$124.00</p>
                                <p class="text-center">
                                    <button type="submit" class="btn btn-template-outlined">
                                        <i class="fa fa-shopping-cart"></i> Add to cart</button>
                                    <button type="submit" data-toggle="tooltip" data-placement="top" title="Add to wishlist" class="btn btn-default">
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                </p>
                            </form>
                        </div>
                        <div data-slider-id="1" class="owl-thumbs">
                            <button class="owl-thumb-item">
                                <img src="img/detailsquare.jpg" alt="" class="img-fluid">
                            </button>
                            <button class="owl-thumb-item">
                                <img src="img/detailsquare2.jpg" alt="" class="img-fluid">
                            </button>
                            <button class="owl-thumb-item">
                                <img src="img/detailsquare3.jpg" alt="" class="img-fluid">
                            </button>
                        </div>
                    </div>
                </div>
                <div id="details" class="box mb-4 mt-4">
                    <p></p>
                    <h4>Product details</h4>
                    <p>White lace top, woven, has a round neck, short sleeves, has knitted lining attached</p>
                    <h4>Material & care</h4>
                    <ul>
                        <li>Polyester</li>
                        <li>Machine wash</li>
                    </ul>
                    <h4>Size & Fit</h4>
                    <ul>
                        <li>Regular fit</li>
                        <li>The model (height 5'8 "and chest 33") is wearing a size S</li>
                    </ul>
                    <blockquote class="blockquote">
                        <p class="mb-0">
                            <em>Define style this season with Armani's new range of trendy tops, crafted with intricate details.
                                Create a chic statement look by teaming this lace number with skinny jeans and pumps.</em>
                        </p>
                    </blockquote>
                </div>
                <div id="product-social" class="box social text-center mb-5 mt-5">
                    <h4 class="heading-light">Show it to your friends</h4>
                    <ul class="social list-inline">
                        <li class="list-inline-item">
                            <a href="#" data-animate-hover="pulse" class="external facebook">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" data-animate-hover="pulse" class="external gplus">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" data-animate-hover="pulse" class="external twitter">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" data-animate-hover="pulse" class="email">
                                <i class="fa fa-envelope"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="box text-uppercase mt-0 mb-small">
                            <h3>You may also like these products</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="product">
                            <div class="image">
                                <a href="#">
                                    <img src="img/product2.jpg" alt="" class="img-fluid image1">
                                </a>
                            </div>
                            <div class="text">
                                <h3 class="h5">
                                    <a href="shop-detail.html">Fur coat</a>
                                </h3>
                                <p class="price">$143</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="product">
                            <div class="image">
                                <a href="#">
                                    <img src="img/product3.jpg" alt="" class="img-fluid image1">
                                </a>
                            </div>
                            <div class="text">
                                <h3 class="h5">
                                    <a href="shop-detail.html">Fur coat</a>
                                </h3>
                                <p class="price">$143</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="product">
                            <div class="image">
                                <a href="#">
                                    <img src="img/product1.jpg" alt="" class="img-fluid image1">
                                </a>
                            </div>
                            <div class="text">
                                <h3 class="h5">
                                    <a href="shop-detail.html">Fur coat</a>
                                </h3>
                                <p class="price">$143</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="box text-uppercase mt-0 mb-small">
                            <h3>Products viewed recently</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="product">
                            <div class="image">
                                <a href="#">
                                    <img src="img/product3.jpg" alt="" class="img-fluid image1">
                                </a>
                            </div>
                            <div class="text">
                                <h3 class="h5">
                                    <a href="shop-detail.html">Fur coat</a>
                                </h3>
                                <p class="price">$143</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="product">
                            <div class="image">
                                <a href="#">
                                    <img src="img/product1.jpg" alt="" class="img-fluid image1">
                                </a>
                            </div>
                            <div class="text">
                                <h3 class="h5">
                                    <a href="shop-detail.html">Fur coat</a>
                                </h3>
                                <p class="price">$143</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="product">
                            <div class="image">
                                <a href="#">
                                    <img src="img/product2.jpg" alt="" class="img-fluid image1">
                                </a>
                            </div>
                            <div class="text">
                                <h3 class="h5">
                                    <a href="shop-detail.html">Fur coat</a>
                                </h3>
                                <p class="price">$143</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <!-- MENUS AND FILTERS-->
                <div class="panel panel-default sidebar-menu">
                    <div class="panel-heading">
                        <h3 class="h4 panel-title">Categories</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-pills flex-column text-sm category-menu">
                            <li class="nav-item">
                                <a href="shop-category.html" class="nav-link d-flex align-items-center justify-content-between">
                                    <span>Men </span>
                                    <span class="badge badge-secondary">42</span>
                                </a>
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                        <a href="shop-category.html" class="nav-link">T-shirts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="shop-category.html" class="nav-link">Shirts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="shop-category.html" class="nav-link">Pants</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="shop-category.html" class="nav-link">Accessories</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="shop-category.html" class="nav-link active d-flex align-items-center justify-content-between">
                                    <span>Ladies </span>
                                    <span class="badge badge-light">123</span>
                                </a>
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                        <a href="shop-category.html" class="nav-link">T-shirts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="shop-category.html" class="nav-link">Skirts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="shop-category.html" class="nav-link">Pants</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="shop-category.html" class="nav-link">Accessories</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="shop-category.html" class="nav-link d-flex align-items-center justify-content-between">
                                    <span>Kids </span>
                                    <span class="badge badge-secondary">11</span>
                                </a>
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                        <a href="shop-category.html" class="nav-link">T-shirts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="shop-category.html" class="nav-link">Skirts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="shop-category.html" class="nav-link">Pants</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="shop-category.html" class="nav-link">Accessories</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel panel-default sidebar-menu">
                    <div class="panel-heading d-flex align-items-center justify-content-between">
                        <h3 class="h4 panel-title">Brands</h3>
                        <a href="#" class="btn btn-sm btn-danger">
                            <i class="fa fa-times-circle"></i>
                            <span class="d-none d-md-inline-block">Clear</span>
                        </a>
                    </div>
                    <div class="panel-body">
                        <form>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Armani (10)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Versace (12)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Carlo Bruni (15)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Jack Honey (14)
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-template-outlined">
                                <i class="fa fa-pencil"></i> Apply</button>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default sidebar-menu">
                    <div class="panel-heading d-flex align-items-center justify-content-between">
                        <h3 class="h4 panel-titlen">Colours</h3>
                        <a href="#" class="btn btn-sm btn-danger">
                            <i class="fa fa-times-circle"></i>
                            <span class="d-none d-md-inline-block">Clear</span>
                        </a>
                    </div>
                    <div class="panel-body">
                        <form>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">
                                        <span class="colour white"></span> White (14)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">
                                        <span class="colour blue"></span> Blue (10)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">
                                        <span class="colour green"></span> Green (20)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">
                                        <span class="colour yellow"></span> Yellow (13)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">
                                        <span class="colour red"></span> Red (10)
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-template-outlined">
                                <i class="fa fa-pencil"></i> Apply</button>
                        </form>
                    </div>
                </div>
                <div class="banner">
                    <a href="shop-category.html">
                        <img src="img/banner.jpg" alt="sales 2014" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection