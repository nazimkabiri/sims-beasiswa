<div id="top">
    <h2>DATA BANK</h2>
    <div class="kolom3">
        <fieldset><legend>Ubah Data Bank</legend>
            <div id="form-input">           
                <form method="POST" name="myform" action="<?php echo URL . 'admin/updateBank'; ?>" onsubmit="return validate()">
                    <label></label><input type="hidden" name="id" id="id" value="<?php echo $this->data->get_id(); ?>" size="30">
                    <div class="kiri">
                        <div id="warningnama"></div>
                        <label>Nama</label><input type="text" name="nama" id="nama_bank" value="<?php echo $this->data->get_nama(); ?>" size="30">
                        <label>Keterangan</label><textarea type="text" rows="8" name="keterangan" id="keterangan" value="" size="50"><?php echo $this->data->get_keterangan(); ?></textarea>
                        <ul class="inline tengah">
                            <li><input class="normal" type="reset" onclick="window.location.href='<?php echo URL . "admin/list_bank"; ?>'" value="BATAL"></li>
                            <li><input class="sukses" type="submit" name="submit" value="SIMPAN"></li>
                        </ul>
                    </div> <!--end class kiri-->
                </form>
            </div>
        </fieldset>
    </div> <!--end kolom3-->

    <div class="kolom4" id="table">
        <fieldset><legend>Daftar Bank</legend>
            <div id="table-title"></div>
            <div id="table-content">
                <table class="table-bordered zebra scroll">
                    <thead>
                    <th>No</th>
                    <th width="40%">Nama</th>
                    <th width="60%">Keterangan</th>

                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($this->data2 as $val) {
                            echo '<tr>';
                            echo '<td>' . $no . '</td>';
                            echo '<td>' . $val->get_nama() . '</td>';
                            echo '<td>' . $val->get_keterangan() . '</td>';
                            $no++;
                        }
                        ?>                          
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
</div> <!--end top-->
<script type="text/javascript">
    
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
