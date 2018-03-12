<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$baseUrl = $this->config->item('base_url');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Marshall Developer">

    <title>Laju Utama Motor</title>

    <style type="text/css">
    .error{
        color: #FF0000;
    }
    </style>
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

</head>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= $baseUrl ?>">Laju Utama Motor v1.0</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?= $baseUrl ?>user/profile"><i class="fa fa-user fa-fw"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?= $baseUrl ?>user/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?= $baseUrl ?>barang"><i class="fa fa-database fa-fw"></i> Barang</a>
                        </li>
                        <li>
                            <a href="<?= $baseUrl ?>pegawai"><i class="fa fa-users fa-fw"></i> Pegawai</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-book fa-fw"></i> Pembelian<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= $baseUrl ?>pembelian/create">Mulai Pembelian</a>
                                </li>
                                <li>
                                    <a href="<?= $baseUrl ?>pembelian/view">Daftar Pembelian</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-book fa-fw"></i> Penjualan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= $baseUrl ?>penjualan/create">Mulai Penjualan</a>
                                </li>
                                <li>
                                    <a href="<?= $baseUrl ?>penjualan/view">Daftar Penjualan</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-book fa-fw"></i> Pengeluaran<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= $baseUrl ?>pengeluaran/tipe">Daftar Jenis Pengeluaran</a>
                                </li>
                                <li>
                                    <a href="<?= $baseUrl ?>pengeluaran/view">Daftar Pengeluaran</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-book fa-fw"></i> Keuangan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= $baseUrl ?>transaksi/non_tunai">Non Tunai</a>
                                </li>
                                <li>
                                    <a href="<?= $baseUrl ?>transaksi/tunai">Tunai</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-folder fa-fw"></i> Laporan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= $baseUrl ?>laporan/laba_bersih">Laba Bersih</a>
                                    <a href="<?= $baseUrl ?>laporan/omset">Omset</a>
                                    <a href="<?= $baseUrl ?>laporan/penjualan_harian">Penjualan Harian</a>
                                    <a href="<?= $baseUrl ?>laporan/pengeluaran_bulanan">Pengeluaran Bulanan</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
