@extends('layouts.app')

@section('content')
<div class="container">
    <!-- BANNER -->
    <div class="all-banner-hp">
        <div class="hometop-banner">
            <div class="homepage_menu_left">
                <ul class="ul_menu">
                    @foreach($cate_p_data as $item)
                    <li class="js_hover_menu">
                        <a href="">{{$item->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="homepage_slider_right">
                <div class="owl-carousel owl-theme slider_banner_homepage">
                    <div class="item">
                        <a href="">
                            <img src="{{asset('client/img/HomePage/sliderBanner1.jpeg')}}" alt="" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="">
                            <img src="{{asset('client/img/HomePage/sliderBanner8.jpeg')}}"alt="" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="">
                            <img src="{{asset('client/img/HomePage/sliderBanner7.jpeg')}}"alt="" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="">
                            <img src="{{asset('client/img/HomePage/sliderBanner3.jpeg')}}"alt="" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="">
                            <img src="{{asset('client/img/HomePage/sliderBanner4.png')}}"alt="" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="">
                            <img src="{{asset('client/img/HomePage/sliderBanner5.jpeg')}}"alt="" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="">
                            <img src="{{asset('client/img/HomePage/sliderBanner6.jpeg')}}"alt="" />
                        </a>
                    </div>
                </div>
                <div class="Banner_slider_right">
                    <div class="Banner-hp-right video_intro_wrapper">
                        <img src="{{asset('client/img/HomePage/banner1.jpeg')}}" alt="" />
                    </div>
                    <a class="Banner-hp-right" href="">
                        <img src="{{asset('client/img/HomePage/banner2.jpeg')}}" alt="" />
                    </a>
                </div>
                <div class="Banner_slider_bottom">
                    <a href="" class="img_banner_bottom_wrapper"><img src="{{asset('client/img/HomePage/banner3.jpeg')}}" alt=""
                            class="img_banner_bottom" /></a>
                    <a href="" class="img_banner_bottom_wrapper"><img src="{{asset('client/img/HomePage/banner4.jpeg')}}" alt=""
                            class="img_banner_bottom" /></a>
                    <a href="" class="img_banner_bottom_wrapper"><img src="{{asset('client/img/HomePage/banner5.jpeg')}}" alt=""
                            class="img_banner_bottom" /></a>
                </div>
            </div>
        </div>
        <div class="homebottom_banner">
            <a class="link_images" href="">
                <img class="img_banner_bottom_hp" src="{{asset('client/img/HomePage/Banner_iPhoneSale.webp')}}" alt="IphoneSale" />
            </a>
        </div>
    </div>
    <!-- CATEGORY PRODUCT 1 -->
    <div class="cate_product_1">
        <div class="heading_cate_product">
            <p class="title_heading_cate">LAPTOP, MACBOOK, SURFACE</p>
            <div class="sub_cat_title"></div>
            <a href="" class="view_all">
                Xem tất cả
                <i class="fa-solid fa-arrow-right-long"></i>
            </a>
        </div>
        <div class="product_cate1_slider owl-carousel owl-theme">

            @foreach($p_data as $data2)
            <div class="p_component item">
                <div class="link_card_product">
                    <div class="content_p_wrapper">
                        <a href="/show/product{{$data2->id}}" class="p_img">
                            <img src="{{ asset('storage/uploads/'.$data2->img_preview) }}" alt="" />

                        </a>
                        <div class="vote_pcode">
                            <div class="star_vote">
                                <img src="/images/HomePage/star_0.png" alt="" />
                            </div>
                            <div class="p_code">Mã: <span>LDAHP1762</span></div>
                        </div>
                        <div class="p_infor">
                            <a href="/show/product{{$data2->id}}" class="p_name">
                                {{$data2->name}}
                            </a>
                            <span class="p_old_price">
                                {{$data2->price}}
                            </span>
                            <span class="p_discount"> (Tiết kiệm: {{$data2->sale}}% )</span>
                            <span class="p_price">
                                {{ number_format($data2->price - ($data2->price * $data2->sale)/100, 0, ',', '.') }} đ
                            </span>
                        </div>
                        <div class="p_action">
                            <p class="p_qty">
                                <i class="fa-solid fa-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="fa-solid fa-cart-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- CATEGORY PRODUCT 2 -->
    <div class="cate_product_1">
        <div class="heading_cate_product">
            <p class="title_heading_cate">LAPTOP, MACBOOK, SURFACE</p>
            <div class="sub_cat_title"></div>
            <a href="" class="view_all">
                Xem tất cả
                <i class="fa-solid fa-arrow-right-long"></i>
            </a>
        </div>
        <div class="product_cate1_slider owl-carousel owl-theme">
            <div class="p_component item">
                <div class="link_card_product">
                    <div class="content_p_wrapper">
                        <a href="" class="p_img">
                            <img src="{{asset('client/img/products/p0.jpeg')}}" alt="" />
                        </a>
                        <div class="vote_pcode">
                            <div class="star_vote">
                                <img src="/images/HomePage/star_0.png" alt="" />
                            </div>
                            <div class="p_code">Mã: <span>LTGI039</span></div>
                        </div>
                        <div class="p_infor">
                            <a href="" class="p_name">
                                Laptop Gigabyte G5 (KF-E3VN333SH) (i5 12500H/8GB RAM/512GB
                                SSD/RTX4060)
                            </a>
                            <span class="p_old_price">26.799.000₫ </span>
                            <span class="p_discount"> (Tiết kiệm: 13% )</span>
                            <span class="p_price">23.299.000₫ </span>
                        </div>
                        <div class="p_action">
                            <p class="p_qty">
                                <i class="fa-solid fa-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="fa-solid fa-cart-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p_component item">
                <div class="link_card_product">
                    <div class="content_p_wrapper">
                        <a href="" class="p_img">
                            <img src="{{asset('client/img/products/p0.jpeg')}}" alt="" />
                        </a>
                        <div class="vote_pcode">
                            <div class="star_vote">
                                <img src="/images/HomePage/star_0.png" alt="" />
                            </div>
                            <div class="p_code">Mã: <span>LTGI039</span></div>
                        </div>
                        <div class="p_infor">
                            <a href="" class="p_name">
                                Laptop Gigabyte G5 (KF-E3VN333SH) (i5 12500H/8GB RAM/512GB
                                SSD/RTX4060)
                            </a>
                            <span class="p_old_price">26.799.000₫ </span>
                            <span class="p_discount"> (Tiết kiệm: 13% )</span>
                            <span class="p_price">23.299.000₫ </span>
                        </div>
                        <div class="p_action">
                            <p class="p_qty">
                                <i class="fa-solid fa-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="fa-solid fa-cart-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p_component item">
                <div class="link_card_product">
                    <div class="content_p_wrapper">
                        <a href="" class="p_img">
                            <img src="{{asset('client/img/products/p0.jpeg')}}" alt="" />
                        </a>
                        <div class="vote_pcode">
                            <div class="star_vote">
                                <img src="/images/HomePage/star_0.png" alt="" />
                            </div>
                            <div class="p_code">Mã: <span>LTGI039</span></div>
                        </div>
                        <div class="p_infor">
                            <a href="" class="p_name">
                                Laptop Gigabyte G5 (KF-E3VN333SH) (i5 12500H/8GB RAM/512GB
                                SSD/RTX4060)
                            </a>
                            <span class="p_old_price">26.799.000₫ </span>
                            <span class="p_discount"> (Tiết kiệm: 13% )</span>
                            <span class="p_price">23.299.000₫ </span>
                        </div>
                        <div class="p_action">
                            <p class="p_qty">
                                <i class="fa-solid fa-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="fa-solid fa-cart-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p_component item">
                <div class="link_card_product">
                    <div class="content_p_wrapper">
                        <a href="" class="p_img">
                            <img src="{{asset('client/img/products/p0.jpeg')}}" alt="" />
                        </a>
                        <div class="vote_pcode">
                            <div class="star_vote">
                                <img src="/images/HomePage/star_0.png" alt="" />
                            </div>
                            <div class="p_code">Mã: <span>LTGI039</span></div>
                        </div>
                        <div class="p_infor">
                            <a href="" class="p_name">
                                Laptop Gigabyte G5 (KF-E3VN333SH) (i5 12500H/8GB RAM/512GB
                                SSD/RTX4060)
                            </a>
                            <span class="p_old_price">26.799.000₫ </span>
                            <span class="p_discount"> (Tiết kiệm: 13% )</span>
                            <span class="p_price">23.299.000₫ </span>
                        </div>
                        <div class="p_action">
                            <p class="p_qty">
                                <i class="fa-solid fa-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="fa-solid fa-cart-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p_component item">
                <div class="link_card_product">
                    <div class="content_p_wrapper">
                        <a href="" class="p_img">
                            <img src="{{asset('client/img/products/p0.jpeg')}}" alt="" />
                        </a>
                        <div class="vote_pcode">
                            <div class="star_vote">
                                <img src="/images/HomePage/star_0.png" alt="" />
                            </div>
                            <div class="p_code">Mã: <span>LTGI039</span></div>
                        </div>
                        <div class="p_infor">
                            <a href="" class="p_name">
                                Laptop Gigabyte G5 (KF-E3VN333SH) (i5 12500H/8GB RAM/512GB
                                SSD/RTX4060)
                            </a>
                            <span class="p_old_price">26.799.000₫ </span>
                            <span class="p_discount"> (Tiết kiệm: 13% )</span>
                            <span class="p_price">23.299.000₫ </span>
                        </div>
                        <div class="p_action">
                            <p class="p_qty">
                                <i class="fa-solid fa-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="fa-solid fa-cart-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p_component item">
                <div class="link_card_product">
                    <div class="content_p_wrapper">
                        <a href="" class="p_img">
                            <img src="{{asset('client/img/products/p0.jpeg')}}" alt="" />
                        </a>
                        <div class="vote_pcode">
                            <div class="star_vote">
                                <img src="/images/HomePage/star_0.png" alt="" />
                            </div>
                            <div class="p_code">Mã: <span>LTGI039</span></div>
                        </div>
                        <div class="p_infor">
                            <a href="" class="p_name">
                                Laptop Gigabyte G5 (KF-E3VN333SH) (i5 12500H/8GB RAM/512GB
                                SSD/RTX4060)
                            </a>
                            <span class="p_old_price">26.799.000₫ </span>
                            <span class="p_discount"> (Tiết kiệm: 13% )</span>
                            <span class="p_price">23.299.000₫ </span>
                        </div>
                        <div class="p_action">
                            <p class="p_qty">
                                <i class="fa-solid fa-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="fa-solid fa-cart-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p_component item">
                <div class="link_card_product">
                    <div class="content_p_wrapper">
                        <a href="" class="p_img">
                            <img src="{{asset('client/img/products/p0.jpeg')}}" alt="" />
                        </a>
                        <div class="vote_pcode">
                            <div class="star_vote">
                                <img src="/images/HomePage/star_0.png" alt="" />
                            </div>
                            <div class="p_code">Mã: <span>LTGI039</span></div>
                        </div>
                        <div class="p_infor">
                            <a href="" class="p_name">
                                Laptop Gigabyte G5 (KF-E3VN333SH) (i5 12500H/8GB RAM/512GB
                                SSD/RTX4060)
                            </a>
                            <span class="p_old_price">26.799.000₫ </span>
                            <span class="p_discount"> (Tiết kiệm: 13% )</span>
                            <span class="p_price">23.299.000₫ </span>
                        </div>
                        <div class="p_action">
                            <p class="p_qty">
                                <i class="fa-solid fa-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="fa-solid fa-cart-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p_component item">
                <div class="link_card_product">
                    <div class="content_p_wrapper">
                        <a href="" class="p_img">
                            <img src="{{asset('client/img/products/p0.jpeg')}}" alt="" />
                        </a>
                        <div class="vote_pcode">
                            <div class="star_vote">
                                <img src="/images/HomePage/star_0.png" alt="" />
                            </div>
                            <div class="p_code">Mã: <span>LTGI039</span></div>
                        </div>
                        <div class="p_infor">
                            <a href="" class="p_name">
                                Laptop Gigabyte G5 (KF-E3VN333SH) (i5 12500H/8GB RAM/512GB
                                SSD/RTX4060)
                            </a>
                            <span class="p_old_price">26.799.000₫ </span>
                            <span class="p_discount"> (Tiết kiệm: 13% )</span>
                            <span class="p_price">23.299.000₫ </span>
                        </div>
                        <div class="p_action">
                            <p class="p_qty">
                                <i class="fa-solid fa-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="fa-solid fa-cart-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CATEGORY PRODUCT 3 -->
    
    <!-- CATEGORY PRODUCT 4 -->
    
</div>

@endsection

@section('script')
<script src="{{ asset('admin/assets/js/public-js.js') }}"></script>

<script>

</script>
@endsection