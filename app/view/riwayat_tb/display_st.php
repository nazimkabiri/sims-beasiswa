<?php 
//var_dump($this->data);
if($this->file!='' AND file_exists('files/st/'.$this->file)) {?>
<div class="vlamp"><iframe  width= 800 height= 500 src="<?php echo URL;?>files/st/<?php echo $this->file;?>">
    <?php }else{
        echo "</br></br></br></br></br><h2 align=center>File Transkrip Belum Ada</h2>";
    } ?>
    
    <p align="center">Mohon segera upload file surat yang bersangkutan</p>
</iframe></div>