<div id="top">
    <h2>DATA BANK</h2>
    <div class="kolom3">
        <fieldset><legend>Tambah Data Bank</legend>
            <div id="form-input">
                <form method="POST" action="<?php echo URL . 'admin/addBank' ?>" name="myform" onsubmit="return(validate())">
                    <div class="kiri">
                        <div id="warningnama"></div>
                        <label>Nama</label><input type="text" name="nama" id="nama_bank" size="30">
                        <label>Keterangan</label><textarea type="text" name="keterangan" id="keterangan" rows="8"></textarea>
                        <ul class="inline tengah">
                            <li><input class="normal" type="submit" onclick="window.location.href='<?php echo URL . "admin/list_bank"; ?>'" value="BATAL"></li>
                            <li><input class="sukses" type="submit" name="submit" value="SIMPAN"></li>
                        </ul>
                    </div>
                </form>
            </div>
        </fieldset>
    </div>
    <div class="kolom4" id="table">
        <fieldset><legend>Daftar Data Bank</legend>
            <div id="table-title"></div>
            <div id="table-content">
                <table class="table-bordered zebra scroll">
                    <thead>
                    <th>No</th>
                    <th width="200">Nama Bank</th>
                    <th width="400">Keterangan</th>
                    <th width="50">Aksi</th>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($this->data as $value) {
                            echo '<tr>';
                            echo '<td>' . $i . '</td>';
                            echo '<td>' . $value->get_nama() . '</td>';
                            echo '<td>' . $value->get_keterangan() . '</td>';
                            echo
                            '<td>
                            <a href="' . URL . 'admin/deleteBank/' . $value->get_id() . '" onclick="return del()"><i class="icon-trash"></i></a>
                            <a href="' . URL . 'admin/editBank/' . $value->get_id() . '"><i class="icon-pencil"></i></a>
                            </td>';
                            echo '</tr>';
                            $i++;
                        }
                        ?>            
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
</div>

<script type="text/javascript">
    function del(){
        if(confirm('Apakah Anda yakin akan menghapus data ini?'))
            return true;
        else return false
    }
    
    $('#nama_bank').keyup(function() {
        if(document.getElementById('nama_bank').value !=''){$('#warningnama').fadeOut(200);}                 
    })
    
    function validate (){
        if( document.myform.nama.value == "" )
        {
            var warning = 'nama bank harus diisi';
            $('#warningnama').fadeIn(0);
            $('#warningnama').html(warning);
            $('#warningnama').addClass('error');
            return false;
        }
    }
    //-->
</script>

