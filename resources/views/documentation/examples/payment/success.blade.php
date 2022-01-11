@extends('layouts.app')

@section('header')
    @include('partials.sections.header', ['fixedHeader' => false])
@endsection

@section('sidebar')
    @include('partials.content.content-sidebar-shop')
    @include('partials.content.content-sidebar-primary')
@endsection

@section('content')
    <div class="page page-checkout-data">
        <div class="maincontent">
            <div class="woocommerce container">
                @if(user_can_manage_shop())
                    <?php
                    $order = get_user_first_order();
                    ?>
                    @include('woocommerce.checkout.thankyou')
                @endif
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('partials.sections.footer')
@endsection
