<li><a href="<?php echo getConfig('base_url');?>index1">Beranda</a></li>
<li><a href="<?php echo getConfig('base_url');?>tambahdatatransaksi">Transaksi Laundry</a></li>
<li><a href="<?php echo getConfig('base_url');?>transaksi">Data Transaksi</a></li>
<li><a href="<?php echo getConfig('base_url');?>pakaian">Data Pakaian</a></li>
<li><a href="<?php echo getConfig('base_url');?>pelanggan">Data Pelanggan</a></li>
<li><a href="<?php echo getConfig('base_url');?>harga">Data Harga</a></li>
<?php
if($_SESSION['role_id'] == 1) {
    ?>
<li><a href="<?php echo getConfig('base_url');?>profit">Data Profit</a></li> 
<li><a href="<?php echo getConfig('base_url');?>user">User Management</a></li> 
<?php } ?>
