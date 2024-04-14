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
                    @foreach($bannerSlider as $item)
                    <div class="item">
                        <a href="">
                            <img src="{{ asset('storage/images/banner/' . basename($item->image)) }}" alt="" />
                        </a>
                    </div>
                    @endforeach
                    
                </div>
                <div class="Banner_slider_right">
                    {{-- <div class="Banner-hp-right video_intro_wrapper">
                        <img src="{{asset('client/img/HomePage/banner1.jpeg')}}" alt="" />
                    </div>
                    <a class="Banner-hp-right" href="">
                        <img src="{{asset('client/img/HomePage/banner2.jpeg')}}" alt="" />
                    </a> --}}
                    @foreach($right_banner_slider as $item)
                    <div class="Banner-hp-right video_intro_wrapper">
                        <img src="{{ asset('storage/images/banner/' . basename($item->image)) }}" alt="" />
                    </div>
                    @endforeach
                </div>
                <div class="Banner_slider_bottom">
                    @foreach($bottom_banner_slider as $item)
                    <a href="" class="img_banner_bottom_wrapper">
                        <img class="img_banner_bottom" src="{{asset('storage/images/banner/'. basename($item->image))}}" alt=""/>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="homebottom_banner">
            <a class="link_images" href="">
                <img class="img_banner_bottom_hp" src="{{asset('client/img/HomePage/Banner_iPhoneSale.webp')}}" alt="IphoneSale" />
            </a>
        </div>
    </div>
    <!-- CATEGORY PRODUCT HOT SALE -->
    <div class="container cate_product_sale">
        <div class="item-collection">
          <div class="owl-carousel owl-theme product_slider_cell">
            <div class="item">
              <div class="link_card_product">
                <div class="content_p_wrapper">
                  <a href="" class="p_img">
                    <img src="{{asset('client/img/products/p4.jpeg')}}" alt="" />
                  </a>
                  <div class="vote_pcode">
                    <div class="star_vote">
                      <img
                        src="{{asset('client/img/HomePage/star_0.png')}}"
                        alt=""
                      />
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
                      <i class="bi bi-check"></i>
                      Sẵn hàng
                    </p>
                    <a href="" class="p_buy">
                      <i class="bi bi-cart3"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="link_card_product">
                <div class="content_p_wrapper">
                  <a href="" class="p_img">
                    <img src="{{asset('client/img/products/p0.jpeg')}}" alt="" />
                  </a>
                  <div class="vote_pcode">
                    <div class="star_vote">
                      <img
                        src="{{asset('client/img/HomePage/star_0.png')}}"
                        alt=""
                      />
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
                      <i class="bi bi-check"></i>
                      Sẵn hàng
                    </p>
                    <a href="" class="p_buy">
                      <i class="bi bi-cart3"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="link_card_product">
                <div class="content_p_wrapper">
                  <a href="" class="p_img">
                    <img src="{{asset('client/img/products/p3.jpeg')}}" alt="" />
                  </a>
                  <div class="vote_pcode">
                    <div class="star_vote">
                      <img
                        src="{{asset('client/img/HomePage/star_0.png')}}"
                        alt=""
                      />
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
                      <i class="bi bi-check"></i>
                      Sẵn hàng
                    </p>
                    <a href="" class="p_buy">
                      <i class="bi bi-cart3"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="item-collection">
          <div class="owl-carousel owl-theme product_slider_cell">
            <div class="item">
              <div class="link_card_product">
                <div class="content_p_wrapper">
                  <a href="" class="p_img">
                    <img src="{{asset('client/img/products/p4.jpeg')}}" alt="" />
                  </a>
                  <div class="vote_pcode">
                    <div class="star_vote">
                      <img
                        src="{{asset('client/img/HomePage/star_0.png')}}"
                        alt=""
                      />
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
                      <i class="bi bi-check"></i>
                      Sẵn hàng
                    </p>
                    <a href="" class="p_buy">
                      <i class="bi bi-cart3"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="link_card_product">
                <div class="content_p_wrapper">
                  <a href="" class="p_img">
                    <img src="{{asset('client/img/products/p5.jpeg')}}" alt="" />
                  </a>
                  <div class="vote_pcode">
                    <div class="star_vote">
                      <img
                        src="{{asset('client/img/HomePage/star_0.png')}}"
                        alt=""
                      />
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
                      <i class="bi bi-check"></i>
                      Sẵn hàng
                    </p>
                    <a href="" class="p_buy">
                      <i class="bi bi-cart3"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="link_card_product">
                <div class="content_p_wrapper">
                  <a href="" class="p_img">
                    <img src="{{asset('client/img/products/p6.jpeg')}}" alt="" />
                  </a>
                  <div class="vote_pcode">
                    <div class="star_vote">
                      <img
                        src="{{asset('client/img/HomePage/star_0.png')}}"
                        alt=""
                      />
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
                      <i class="bi bi-check"></i>
                      Sẵn hàng
                    </p>
                    <a href="" class="p_buy">
                      <i class="bi bi-cart3"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="item-collection">
          <div class="owl-carousel owl-theme product_slider_cell">
            <div class="item">
              <div class="link_card_product">
                <div class="content_p_wrapper">
                  <a href="" class="p_img">
                    <img src="{{asset('client/img/products/p6.jpeg')}}" alt="" />
                  </a>
                  <div class="vote_pcode">
                    <div class="star_vote">
                      <img
                        src="{{asset('client/img/HomePage/star_0.png')}}"
                        alt=""
                      />
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
                      <i class="bi bi-check"></i>
                      Sẵn hàng
                    </p>
                    <a href="" class="p_buy">
                      <i class="bi bi-cart3"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="link_card_product">
                <div class="content_p_wrapper">
                  <a href="" class="p_img">
                    <img src="{{asset('client/img/products/p7.jpeg')}}" alt="" />
                  </a>
                  <div class="vote_pcode">
                    <div class="star_vote">
                      <img
                        src="{{asset('client/img/HomePage/star_0.png')}}"
                        alt=""
                      />
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
                      <i class="bi bi-check"></i>
                      Sẵn hàng
                    </p>
                    <a href="" class="p_buy">
                      <i class="bi bi-cart3"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="link_card_product">
                <div class="content_p_wrapper">
                  <a href="" class="p_img">
                    <img src="{{asset('client/img/products/p8.jpeg')}}" alt="" />
                  </a>
                  <div class="vote_pcode">
                    <div class="star_vote">
                      <img
                        src="{{asset('client/img/HomePage/star_0.png')}}"
                        alt=""
                      />
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
                      <i class="bi bi-check"></i>
                      Sẵn hàng
                    </p>
                    <a href="" class="p_buy">
                      <i class="bi bi-cart3"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="item-collection">
          <div class="owl-carousel owl-theme product_slider_cell">
            <div class="item">
              <div class="link_card_product">
                <div class="content_p_wrapper">
                  <a href="" class="p_img">
                    <img src="{{asset('client/img/products/p9.jpeg')}}" alt="" />
                  </a>
                  <div class="vote_pcode">
                    <div class="star_vote">
                      <img
                        src="{{asset('client/img/HomePage/star_0.png')}}"
                        alt=""
                      />
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
                      <i class="bi bi-check"></i>
                      Sẵn hàng
                    </p>
                    <a href="" class="p_buy">
                      <i class="bi bi-cart3"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="link_card_product">
                <div class="content_p_wrapper">
                  <a href="" class="p_img">
                    <img src="{{asset('client/img/products/p10.png')}}" alt="" />
                  </a>
                  <div class="vote_pcode">
                    <div class="star_vote">
                      <img
                        src="{{asset('client/img/HomePage/star_0.png')}}"
                        alt=""
                      />
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
                      <i class="bi bi-check"></i>
                      Sẵn hàng
                    </p>
                    <a href="" class="p_buy">
                      <i class="bi bi-cart3"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="link_card_product">
                <div class="content_p_wrapper">
                  <a href="" class="p_img">
                    <img src="{{asset('client/img/products/p0.jpeg')}}" alt="" />
                  </a>
                  <div class="vote_pcode">
                    <div class="star_vote">
                      <img
                        src="{{asset('client/img/HomePage/star_0.png')}}"
                        alt=""
                      />
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
                      <i class="bi bi-check"></i>
                      Sẵn hàng
                    </p>
                    <a href="" class="p_buy">
                      <i class="bi bi-cart3"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
                                <img src="{{asset('client/img/HomePage/star_0.png')}}" alt="" />
                            </div>
                            <div class="p_code">Mã: <span>LDAHP1762</span></div>
                        </div>
                        <div class="p_infor">
                            <a href="/show/product{{$data2->id}}" class="p_name">
                                {{$data2->name}}
                            </a>
                            <span class="p_old_price">
                            {{ number_format($data2->price, 0, ',', '.') }} đ
                            </span>
                            <span class="p_discount"> (Tiết kiệm: {{$data2->sale}}% )</span>
                            <span class="p_price">
                                {{ number_format($data2->price - ($data2->price * $data2->sale)/100, 0, ',', '.') }} đ
                            </span>
                        </div>
                        <div class="p_action">
                            <p class="p_qty">
                                <i class="bi bi-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="bi bi-cart3"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- CATEGORY FEATURES PRODUCTS -->
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
                                <img src="{{asset('client/img/HomePage/star_0.png')}}" alt="" />
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
                                <i class="bi bi-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="bi bi-cart3"></i>
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
                                <img src="{{asset('client/img/HomePage/star_0.png')}}" alt="" />
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
                                <i class="bi bi-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="bi bi-cart3"></i>
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
                                <img src="{{asset('client/img/HomePage/star_0.png')}}" alt="" />
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
                                <i class="bi bi-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="bi bi-cart3"></i>
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
                                <img src="{{asset('client/img/HomePage/star_0.png')}}" alt="" />
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
                                <i class="bi bi-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="bi bi-cart3"></i>
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
                                <img src="{{asset('client/img/HomePage/star_0.png')}}" alt="" />
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
                                <i class="bi bi-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="bi bi-cart3"></i>
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
                                <img src="{{asset('client/img/HomePage/star_0.png')}}" alt="" />
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
                                <i class="bi bi-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="bi bi-cart3"></i>
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
                                <img src="{{asset('client/img/HomePage/star_0.png')}}" alt="" />
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
                                <i class="bi bi-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="bi bi-cart3"></i>
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
                                <img src="{{asset('client/img/HomePage/star_0.png')}}" alt="" />
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
                                <i class="bi bi-check"></i>
                                Sẵn hàng
                            </p>
                            <a href="" class="p_buy">
                                <i class="bi bi-cart3"></i>
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