<table>
    <thead>
    <th>NO</th>
    <th>NIP</th>
    <th>Nama</th>
    <th>Status</th>
    <th>aksi</th>
</thead>
<?php
$i = 1;
$status = new Status();
//var_dump($this->penerima_biaya);
foreach ($this->penerima_biaya as $val) {
    //echo $val->kd_penerima_beasiswa;
    $this->penerima->set_kd_pb($val->kd_penerima_beasiswa);
    //var_dump($this->penerima->get_kd_pb());
    $penerima = $this->penerima->get_penerima_by_id($this->penerima);
    //var_dump($penerima);
    $status_pb = $status->get_by_id($penerima->get_status());
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $penerima->get_nip(); ?></td>
        <td><?php echo $penerima->get_nama(); ?></td>
        <td><?php echo $status_pb->nm_status; ?></td>
        <td>
            <a href="#" onClick="del_tagihan_pb(<?php echo $val->kd_penerima_biaya; ?>); return false;"><i class="icon-trash"></i></a>
        </td>
    </tr> 
    <?php
    $i++;
}
?>
</table>

<script>
    
    function del_tagihan_pb(id){
        if(confirm('Apakah Anda yakin akan menghapus data ini?')){
            $.ajax({
                type:"POST",
                url: "<?php echo URL; ?>kontrak/delTagihanPb",
                data: {kd_penerima_biaya: id},
                cache: false,
                success: function(){
                    displayTabelBiayaPb();
                    $("<div>Data berhasil dihapus.</div>").dialog({
                        modal: true,
                        buttons: {
                            Ok: function() {
                                $( this ).dialog( "close" );
                            }
                        }
                    }); 
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {                          
                    alert('tidak dapat memproses saat ini.');
                }
            });
                       
        } else {return false}  
    }
    
</script>