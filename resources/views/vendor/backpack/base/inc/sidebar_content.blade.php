{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('product-category') }}"><i class="nav-icon la la-list"></i>Kategori Produk</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('product') }}"><i class="nav-icon la la-box"></i>Produk</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('shopping-cart') }}"><i class="nav-icon la la-cart-arrow-down"></i>Keranjang Belanja</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('shipping') }}"><i class="nav-icon la la-user"></i>Kurir</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('sales-invoice') }}"><i class="nav-icon la la-receipt"></i>Faktur Penjualan</a></li>