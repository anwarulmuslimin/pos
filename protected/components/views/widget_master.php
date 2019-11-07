<li class="treeview">
    <a href="#"><i class="fa fa-database"></i><span>MASTER</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
    <li><a href="<? echo Yii::app()->createUrl('kategori/supplier');?>"><i class="fa fa-exchange"></i> <span>Data Suplier</span></a></li>
    <!--li><a href="<? echo Yii::app()->createUrl('kategori/index'); ?>"><i class="fa fa-database"></i><span>Kategori</span></a></li>
    <li><a href="<? echo Yii::app()->createUrl('jenis'); ?>"><i class="fa fa-database"></i><span>Jenis</span></a></li-->
    <li><a href="<? echo Yii::app()->createUrl('items'); ?>"><i class="fa fa-cubes"></i><span>Barang</span></a></li>
    <li><a href="<? echo Yii::app()->createUrl('kategori/mutasi'); ?>"><i class="fa fa-exchange"></i><span>Perpindahan Barang</span></a></li>
    </ul>
</li>
<li class="treeview">
    <a href="#"><i class="fa fa-tags"></i><span>DISKON</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<? echo Yii::app()->createUrl('diskon'); ?>"><i class="fa fa-gear"></i> Seting Diskon</a></li>
        <li><a href="<? echo Yii::app()->createUrl('diskon/tampil_daftar'); ?>"><i class="fa fa-list"></i> Daftar Diskon</a></li>
    </ul>
</li>
<li class="treeview">
    <a href="#"><i class="fa fa-money"></i><span>TRANSAKSI</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<? echo Yii::app()->createUrl('transaksi'); ?>"><i class="fa fa-list"></i> Penjualan</a></li>
        <li><a href="<? echo Yii::app()->createUrl('transaksi/pembelian'); ?>"><i class="fa fa-gear"></i> Pembelian</a></li>
        <li><a href="<? echo Yii::app()->createUrl('transaksi/retur',array('id'=>1)); ?>"><i class="fa fa-list"></i> Retur Penjualan</a></li>
        <li><a href="<? echo Yii::app()->createUrl('transaksi/retur',array('id'=>2)); ?>"><i class="fa fa-list"></i> Retur Pembelian</a></li>
    </ul>
</li>
<li class="treeview">
    <a href="#"><i class="fa fa-bar-chart"></i><span>LAPORAN</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<? echo Yii::app()->createUrl('laporan/laporan_barang'); ?>"><i class="fa fa-book"></i> Laporan Barang</a></li>
        <li><a href="<? echo Yii::app()->createUrl('laporan/laporan_penjualan'); ?>"><i class="fa fa-book"></i> Laporan Penjualan</a></li>
        <li><a href="<? echo Yii::app()->createUrl('laporan/laporan_pembelian'); ?>"><i class="fa fa-book"></i> Laporan Pembelian</a></li>
        <li><a href="<? echo Yii::app()->createUrl('laporan/retur_barang'); ?>"><i class="fa fa-book"></i> Retur Barang</a></li>
    </ul>
</li>