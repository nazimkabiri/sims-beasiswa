<link href="../../../public/css/style.css" rel="stylesheet" media="screen">
<body>
 
  <div id="top">
  <!--level1: Profil Penerima Beasiswa-->
	<h1>PROFIL PENERIMA BEASISWA</h1>
	<fieldset><legend>Profil Penerima Beasiswa</legend>
		<div class="foto">
			<img class="frame" src="../../public/img/home.png" width="185" height="220">
			</div>
		<form action="#" method="post">
			<label class="isian">NIP :</label>
			<input class="utama" type="text" id="NIP" name="NIP" disabled />
			
			<label class="isian">Nama :</label>
			<input class="utama" type="text" id="nama" name="nama" disabled />

			<label class="isian">Jenis Kelamin :</label>
			<input class="utama" type="text" id="jenis_kelamin" name="jenis_kelamin" disabled />
			
			<label class="isian">Pangkat/Gol :</label>
			<input class="utama" type="text" id="pangkat" name="pangkat" disabled />
			
			<label class="isian">Unit Asal :</label>
			<input class="utama" type="text" id="asal" name="asal" disabled />
			
			<label class="isian">Alamat :</label>
			<textarea class="utama" type="text" id="alamat" name="alamat" disabled /></textarea>
			
			<label class="isian">Email :</label>
			<input class="utama" type="email" id="email" name="email" disabled />
			
			<label class="isian">No. HP :</label>
			<input class="utama" type="text" id="hp" name="hp" disabled />
			
			<label class="isian">Bank Penerima</label>
			<input class="utama" type="text" id="bank" name="bank" disabled />
			
			<label class="isian">No Rekening</label>
			<input class="utama" type="text" id="rekening" name="rekening" disabled />
	</fieldset>
	
	<!--level2: Profil Beasiswa & Riwayat Pembayaran-->
	<div class="kolom1">
		<fieldset><legend>Profil Beasiswa</legend>
			<label class="isian">No. Surat Tugas (ST) :</label>
			<input type="text" id="st" name="st" disabled />
			
			<label class="isian">Tanggal ST :</label>
			<input type="text" id="tgl_st" name="tanggal_st" disabled />

			<label class="isian">Tanggal Mulai ST :</label>
			<input type="text" id="tgl_mulai_st" name="tgl_mulai_st" disabled />
			
			<label class="isian">Tanggal Akhir ST :</label>
			<input type="text" id="tgl_akhir_st" name="tgl_akhir_st" disabled />
			
			<label class="isian">Jenis Beasiswa :</label>
			<input type="text" id="jenis_beasiswa" name="jenis_beasiswa" disabled />
			
			<label class="isian">Universitas :</label>
			<input type="text" id="universitas" name="universitas" disabled />
			
			<label class="isian">Jurusan :</label>
			<input type="text" id="jurusan" name="jurusan"disabled />
			
			<label class="isian">Tahun Masuk :</label>
			<input type="text" id="th_masuk" name="th_masuk" disabled />
			
			<label class="isian">Status Tugas Belajar (TB) :</label>
			<input type="text" id="status_tb" name="status_tb" disabled />
			<!--row berikut hanya muncul jika status TB: lulus dan/atau tidak lulus -->
			
			<label class="isian">Tanggal Akhir TB :</label>
			<!--input type="file" id="skl" name="skl" /-->
			<ul class="inline">
				<li><input class="unggah" type="text" id="tgl_akhir_tb" disabled /></li>
				<li><input type="button" value="Lihat" id="fileSKL"/><!--View file SKL-->
				</li>
			</ul>
			
			<label class="isian">Tanggal Lapor Selesai TB :</label>
			<ul class="inline">
				<li><input class="unggah" type="text" id="tgl_lapor" disabled /></li>
				<li><input type="button" value="Lihat" id="fileSKL"/><!--View file SPMT-->
				</li>
			</ul>
	</fieldset>
</div>
<div class="kolom2">
	<fieldset><legend>Riwayat Pembayaran</legend>
		
			<table class="table-bordered zebra scroll">
				<thead>
					<th>No</th>
					<th width="300">Keterangan Pembayaran</th>
					<th>Jumlah (Rp)</th>
				</thead>
				<tbody>
				<tr>
					<td>1</td>
					<td>qwertyui</td>
					<td align="right">
						<?php $harga=10000000;
						echo number_format($harga,2,',','.'); ?>
					</td>
				</tr>
				<tr>
					<td>2</td>
					<td>qwertyui</td>
					<td align="right">
						<?php $harga=100000;
						echo number_format($harga,2,',','.'); ?>
					</td>
				</tr>
				</tbody>
			</table>
	
		</fieldset>
	</div>
	
	<!--level3: Riwayat Perkembangan Studi-->
	<div id="fitur">
  
	<fieldset><legend>Riwayat Perkembangan Studi</legend>
		<div class="kolom5">
		
			<label class="isian2">Judul Skripsi :</label>
			<textarea class="midi" type="text"></textarea>
			<label class="isian2">Permasalahan Tugas Belajar :</label>
			<textarea class="midi" type="text" rows="8"></textarea>
			
		</div>
		
			<label class="isian">IPK :</label>
			<input type="text" id="IPK" name="IPK" />
			
			<label class="isian">Unggah Transkrip:</label>
			<ul class="inline">
				<li><input type="file" id="IPK" name="fileipk" style="display: none" onChange="IPKchange();"/>
				<input class="unggah" type="text" id="namafileipk" disabled /></li>
				<li><input type="button" value="Pilih..." id="fakeBrowse" onclick="Pilih();"/>
				</li>
			</ul>
			
			<table class="table-bordered zebra">
				<thead>
					<th>No</th>
					<th>Keterangan</th>
					<th>IP</th>
					<th>File</th>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td><input class="keterangan" type="text" id="ket" name="ket" /></td>
						<td><input class="mini" type="text" id="IP" name="IP" /></td>
						<td><input type="button" value="Pilih..." id="uplod_ip" name="uplod_ip" /></td>
					</tr>
					<tr>
						<td>2</td>
						<td><input class="keterangan" type="text" id="ket" name="ket" /></td>
						<td><input class="mini" type="text" id="IP" name="IP" /></td>
						<td><input type="button" value="Pilih..." id="uplod_ip" name="uplod_ip" /></td>
					</tr>
				</tbody>
			</table>
		
		</fieldset>
	</div>
<!--level4 Riwayat Cuti-->
<div id="fitur">
	<fieldset><legend>Riwayat Cuti</legend>
		
		<table class="table-bordered zebra" style="display: block">
				<thead>
					<th>No</th>
					<th width="100">No. Surat Cuti</th>
					<th width="150">Tanggal Surat Cuti</th>
					<th width="150">Periode Awal Cuti</th>
					<th width="150">Periode Akhir Cuti</th>
					<th width="200">Jenis Cuti</th>
					<th width="100">File</th>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>1</td>
					</tr>
				</tbody>
		</table>
		
	</fieldset>
</div> <!--div level 4-->

<!--level5 Riwayat Penerimaan Beasiswa-->
<div id="fitur">
	<fieldset><legend>Riwayat Penerimaan Beasiswa</legend>
		
		<table class="table-bordered zebra" style="display: block">
				<thead>
					<th>No</th>
					<th width="100">No. Surat Tugas</th>
					<th width="100">Strata</th>
					<th width="200">Universitas</th>
					<th width="100">Jurusan</th>
					<th width="100">Tahun Masuk</th>
					<th width="200">Status TB</th>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>Lulus dengan perpanjangan 2</td>
					</tr>
				</tbody>
		</table>
		
	</fieldset>
</div> <!--div level 4-->
<input class="sukses" type="submit" value="UBAH" style="font-size: 130%; margin-top:20px"/>


</div> <!--top-->
</body>

<script language="JavaScript" type="text/javascript">
function HandleBrowseClick()
{
    var fileinput = document.getElementById("SKL");
    fileinput.click();
}
function Handlechange()
{
var fileinput = document.getElementById("SKL");
var textinput = document.getElementById("filename");
textinput.value = fileinput.value;
}

function BrowseClick()
{
    var file = document.getElementById("SPMT");
    file.click();
}
function Change()
{
var file = document.getElementById("SPMT");
var text = document.getElementById("namafile");
text.value = file.value;
}

function BrowseFoto()
{
    var fotoinput = document.getElementById("foto");
    fotoinput.click();
}
function FotoChange()
{
var fotoinput = document.getElementById("foto");
var foto = document.getElementById("filefoto");
foto.value = fotoinput.value;
}

function Pilih()
{
    var fileipk = document.getElementById("IPK");
    fileipk.click();
}
function IPKchange()
{
var fileipk = document.getElementById("IPK");
var filenya = document.getElementById("namafileipk");
filenya.value = fileipk.value;
}
</script>