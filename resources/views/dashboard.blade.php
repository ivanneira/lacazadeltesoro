@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="container-fluid px-0">

        <div class="row gutters-tiny">
            <!-- Row #6 -->

            <div class="col-md-6 col-xl-3">
                <a class="block block-transparent" href="javascript:void(0)">
                    <div class="block-content block-content-full bg-elegance text-center">
                        <div class="item item-2x item-circle bg-black-op-10 mx-auto mb-20">
                            <i class="fa fa-map text-elegance-lighter"></i>
                        </div>
                        <div class="font-size-h3 font-w600 text-white">+</div>
                        <div class="font-size-sm font-w600 text-uppercase text-elegance-lighter">Comienza una caza! </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a class="block block-transparent" href="{{ url('rutinas') }}">
                    <div class="block-content block-content-full bg-gd-leaf text-center">
                        <div class="item item-2x item-circle bg-black-op-10 mx-auto mb-20">
                            <i class="fa fa-calendar text-white-op"></i>
                        </div>
                        <div class="font-size-h3 font-w600 text-white">6</div>
                        <div class="font-size-sm font-w600 text-uppercase text-white-op">Partidas en curso</div>
                    </div>
                </a>
            </div>

            <br>

            

            <div class="col-md-6">
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default border-b">
                        <h3 class="block-title">Cazas finalizadas</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 100px;">número</th>
                                    <th class="d-none d-sm-table-cell">Ganador</th>
                                    <th class="text-right">Puntaje</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <a class="font-w600" href="be_pages_ecom_order.html">1851</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <a href="{{ url('rutinas') }}">Helen Jacobs</a>
                                    </td>
                                    <td class="text-right">
                                        <span class="text-black">810</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="font-w600" href="be_pages_ecom_order.html">1850</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <a href="{{ url('rutinas') }}">Barbara Scott</a>
                                    </td>
                                    <td class="text-right">
                                        <span class="text-black">940</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="font-w600" href="be_pages_ecom_order.html">1849</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <a href="{{ url('rutinas') }}">Marie Duncan</a>
                                    </td>
                                    <td class="text-right">
                                        <span class="text-black">331</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="font-w600" href="be_pages_ecom_order.html">1848</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <a href="{{ url('rutinas') }}">Carol Ray</a>
                                    </td>
                                    <td class="text-right">
                                        <span class="text-black">969</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="font-w600" href="be_pages_ecom_order.html">1847</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <a href="{{ url('rutinas') }}">Justin Hunt</a>
                                    </td>
                                    <td class="text-right">
                                        <span class="text-black">268</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="font-w600" href="be_pages_ecom_order.html">1846</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <a href="{{ url('rutinas') }}">Adam McCoy</a>
                                    </td>
                                    <td class="text-right">
                                        <span class="text-black">213</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="font-w600" href="be_pages_ecom_order.html">1845</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <a href="{{ url('rutinas') }}">Barbara Scott</a>
                                    </td>
                                    <td class="text-right">
                                        <span class="text-black">778</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="font-w600" href="be_pages_ecom_order.html">1844</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <a href="{{ url('rutinas') }}">Albert Ray</a>
                                    </td>
                                    <td class="text-right">
                                        <span class="text-black">272</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="font-w600" href="be_pages_ecom_order.html">1843</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <a href="{{ url('rutinas') }}">Alice Moore</a>
                                    </td>
                                    <td class="text-right">
                                        <span class="text-black">567</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="font-w600" href="be_pages_ecom_order.html">1842</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <a href="{{ url('rutinas') }}">Carl Wells</a>
                                    </td>
                                    <td class="text-right">
                                        <span class="text-black">545</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
            <!-- END Row #6 -->
        </div>
    </div>
    <!-- END Page Content -->
@endsection
