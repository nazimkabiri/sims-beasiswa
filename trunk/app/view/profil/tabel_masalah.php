<table class="table-bordered zebra" style="width:100%;margin-left: 0px;padding-left: 0px;">
				<thead>
					<th>No</th>
					<th>Uraian</th>
					<th>Sumber</th>
                                        <th>Aksi</th>
				</thead>
				<tbody>
                                    <?php 
                                        $no=1;
                                        foreach ($this->d_mas as $v){
                                   ?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $v->get_uraian();?></td>
						<td><?php echo $v->get_sumber_masalah();?></td>
                                                <td><a href="<?php echo URL;?>penerima/delmas/<?php echo $v->get_kode().'/'.$this->d_pb->get_kd_pb().'/'.$this->url; ?>"><i class="icon-trash" onClick="return del_mas('<?php echo $this->d_pb->get_nama();?>')"></i></a>
                                                    </td>
					</tr>
                                    <?php 
                                            $no++;
                                        }
                                     ?>
				</tbody>
			</table>
<script>
function del_mas(nama_pb){
    var txt = "Yakin data masalah an "+nama_pb+" akan dihapus!"
    if(confirm(txt)){
        return true;
    }else{
        return false;
    }
}
</script>