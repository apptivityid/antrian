
<audio id="suarabel" src="{{ asset(mix('rekaman/Airport_Bell.mp3')) }}" ></audio>
<audio id="suarabelnomorurut" src="{{ asset(mix('rekaman/nomor-urut.wav')) }}"  ></audio>
<audio id="suarabelsuarabelloket" src="{{ asset(mix('rekaman/loket.wav')) }}"  ></audio>
<audio id="suaraA" src="{{ asset(mix('rekaman/'.session()->get('idloket').'.mp3')) }}"  ></audio>

<audio id="belas" src="{{ asset(mix('rekaman/belas.wav')) }}"  ></audio>
<audio id="sebelas" src="{{ asset(mix('rekaman/sebelas.wav')) }}"  ></audio>
<audio id="puluh" src="{{ asset(mix('rekaman/puluh.wav')) }}"  ></audio>
<audio id="sepuluh" src="{{ asset(mix('rekaman/sepuluh.wav')) }}"  ></audio>
<audio id="ratus" src="{{ asset(mix('rekaman/ratus.wav')) }}"  ></audio>
<audio id="seratus" src="{{ asset(mix('rekaman/seratus.wav')) }}"  ></audio>

@for ($i=0; $i < $panjang; $i++)
    <audio id="suarabel{{ $i }}" src="{{ asset(mix('rekaman/'.substr($nomorurut,$i,1).'.wav')) }}"  ></audio>
@endfor

<script type="text/javascript">
    function mulai(){
        //MAINKAN SUARA BEL PADA SAAT AWAL
        document.getElementById('suarabel').pause();
        document.getElementById('suarabel').currentTime=0;
        document.getElementById('suarabel').play();

        //SET DELAY UNTUK MEMAINKAN REKAMAN NOMOR URUT

        //totalwaktu=document.getElementById('suarabel').duration*1000;
		totalwaktu=8*1000;

        //MAINKAN SUARA NOMOR URUT
        setTimeout(function() {
            document.getElementById('suarabelnomorurut').pause();
            document.getElementById('suarabelnomorurut').currentTime=0;
            document.getElementById('suarabelnomorurut').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+2000;

        // setTimeout(function() {
        //     document.getElementById('suaraA').pause();
        //     document.getElementById('suaraA').currentTime=0;
        //     document.getElementById('suaraA').play();
        // }, totalwaktu);
        //         totalwaktu=totalwaktu+1000;

        <?php
            //JIKA KURANG DARI 10 MAKA MAIKAN SUARA ANGKA1
            if($nomorurut < 10){
        ?>

        setTimeout(function() {
            document.getElementById('suarabel0').pause();
            document.getElementById('suarabel0').currentTime=0;
            document.getElementById('suarabel0').play();
        }, totalwaktu);

        totalwaktu=totalwaktu+1000;
        <?php
            }elseif($nomorurut == 10){
                //JIKA 10 MAKA MAIKAN SUARA SEPULUH
        ?>
        setTimeout(function() {
            document.getElementById('sepuluh').pause();
            document.getElementById('sepuluh').currentTime=0;
            document.getElementById('sepuluh').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        <?php
            }elseif($nomorurut == 11){
                //JIKA 11 MAKA MAIKAN SUARA SEBELAS
        ?>
        setTimeout(function() {
            document.getElementById('sebelas').pause();
            document.getElementById('sebelas').currentTime=0;
            document.getElementById('sebelas').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        <?php
            }elseif($nomorurut < 20){
                //JIKA 12-20 MAKA MAIKAN SUARA ANGKA2+"BELAS"
        ?>
        setTimeout(function() {
            document.getElementById('suarabel1').pause();
            document.getElementById('suarabel1').currentTime=0;
            document.getElementById('suarabel1').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('belas').pause();
            document.getElementById('belas').currentTime=0;
            document.getElementById('belas').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        <?php
                    }elseif($nomorurut < 100){
                        //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
                ?>
        setTimeout(function() {
            document.getElementById('suarabel0').pause();
            document.getElementById('suarabel0').currentTime=0;
            document.getElementById('suarabel0').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('puluh').pause();
            document.getElementById('puluh').currentTime=0;
            document.getElementById('puluh').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabel1').pause();
            document.getElementById('suarabel1').currentTime=0;
            document.getElementById('suarabel1').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        <?php
}elseif($nomorurut ==100){
    //JIKA 100 MAKA MAIKAN SUARA SEratus
?>
        setTimeout(function() {
            document.getElementById('seratus').pause();
            document.getElementById('seratus').currentTime=0;
            document.getElementById('seratus').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        <?php
            }elseif($nomorurut < 110){
                //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
        ?>

        setTimeout(function() {
            document.getElementById('seratus').pause();
            document.getElementById('seratus').currentTime=0;
            document.getElementById('seratus').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabel2').pause();
            document.getElementById('suarabel2').currentTime=0;
            document.getElementById('suarabel2').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        <?php
    }elseif($nomorurut == 110){
        //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
?>
        setTimeout(function() {
            document.getElementById('seratus').pause();
            document.getElementById('seratus').currentTime=0;
            document.getElementById('seratus').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('sepuluh').pause();
            document.getElementById('sepuluh').currentTime=0;
            document.getElementById('sepuluh').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        <?php
        //JIKA KURANG DARI 10 MAKA MAIKAN SUARA ANGKA1
        }elseif($nomorurut == 111){
    ?>

        setTimeout(function() {
            document.getElementById('seratus').pause();
            document.getElementById('seratus').currentTime=0;
            document.getElementById('seratus').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('sebelas').pause();
            document.getElementById('sebelas').currentTime=0;
            document.getElementById('sebelas').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        <?php
    }elseif($nomorurut < 120){
        //JIKA 12-20 MAKA MAIKAN SUARA ANGKA2+"BELAS"
?>
        setTimeout(function() {
            document.getElementById('seratus').pause();
            document.getElementById('seratus').currentTime=0;
            document.getElementById('seratus').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabel2').pause();
            document.getElementById('suarabel2').currentTime=0;
            document.getElementById('suarabel2').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('belas').pause();
            document.getElementById('belas').currentTime=0;
            document.getElementById('belas').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        <?php
                    }elseif($nomorurut < 200){
                        //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
                ?>
        setTimeout(function() {
            document.getElementById('seratus').pause();
            document.getElementById('seratus').currentTime=0;
            document.getElementById('seratus').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabel1').pause();
            document.getElementById('suarabel1').currentTime=0;
            document.getElementById('suarabel1').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('puluh').pause();
            document.getElementById('puluh').currentTime=0;
            document.getElementById('puluh').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabel2').pause();
            document.getElementById('suarabel2').currentTime=0;
            document.getElementById('suarabel2').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        <?php
               }elseif($nomorurut ==200){
                   //JIKA 100 MAKA MAIKAN SUARA SEratus
           ?>
        setTimeout(function() {
            document.getElementById('suarabel0').pause();
            document.getElementById('suarabel0').currentTime=0;
            document.getElementById('suarabel0').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('ratus').pause();
            document.getElementById('ratus').currentTime=0;
            document.getElementById('ratus').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        <?php
                    }elseif($nomorurut < 210){
                        //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
                ?>
        setTimeout(function() {
            document.getElementById('suarabel0').pause();
            document.getElementById('suarabel0').currentTime=0;
            document.getElementById('suarabel0').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('ratus').pause();
            document.getElementById('ratus').currentTime=0;
            document.getElementById('ratus').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabel2').pause();
            document.getElementById('suarabel2').currentTime=0;
            document.getElementById('suarabel2').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        <?php
    }elseif($nomorurut == 210){
        //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
?>
        setTimeout(function() {
            document.getElementById('suarabel0').pause();
            document.getElementById('suarabel0').currentTime=0;
            document.getElementById('suarabel0').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('ratus').pause();
            document.getElementById('ratus').currentTime=0;
            document.getElementById('ratus').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('sepuluh').pause();
            document.getElementById('sepuluh').currentTime=0;
            document.getElementById('sepuluh').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        <?php
        //JIKA KURANG DARI 10 MAKA MAIKAN SUARA ANGKA1
        }elseif($nomorurut == 211){
    ?>
        setTimeout(function() {
            document.getElementById('suarabel0').pause();
            document.getElementById('suarabel0').currentTime=0;
            document.getElementById('suarabel0').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('ratus').pause();
            document.getElementById('ratus').currentTime=0;
            document.getElementById('ratus').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('sebelas').pause();
            document.getElementById('sebelas').currentTime=0;
            document.getElementById('sebelas').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        <?php
    }elseif($nomorurut < 220){
        //JIKA 12-20 MAKA MAIKAN SUARA ANGKA2+"BELAS"
?>
        setTimeout(function() {
            document.getElementById('suarabel0').pause();
            document.getElementById('suarabel0').currentTime=0;
            document.getElementById('suarabel0').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('ratus').pause();
            document.getElementById('ratus').currentTime=0;
            document.getElementById('ratus').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabel2').pause();
            document.getElementById('suarabel2').currentTime=0;
            document.getElementById('suarabel2').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('belas').pause();
            document.getElementById('belas').currentTime=0;
            document.getElementById('belas').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        <?php
                    }elseif($nomorurut < 1000){
                        //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
                ?>
        setTimeout(function() {
            document.getElementById('suarabel0').pause();
            document.getElementById('suarabel0').currentTime=0;
            document.getElementById('suarabel0').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('ratus').pause();
            document.getElementById('ratus').currentTime=0;
            document.getElementById('ratus').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabel1').pause();
            document.getElementById('suarabel1').currentTime=0;
            document.getElementById('suarabel1').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('puluh').pause();
            document.getElementById('puluh').currentTime=0;
            document.getElementById('puluh').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabel2').pause();
            document.getElementById('suarabel2').currentTime=0;
            document.getElementById('suarabel2').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;

        <?php
            }else{
                //JIKA LEBIH DARI 100
                //Karena aplikasi ini masih sederhana maka logina konversi hanya sampai 100
                //Selebihnya akan langsung disebutkan angkanya saja
                //tanpa kata "RATUS", "PULUH", maupun "BELAS"
        ?>

        <?php
            for($i=0;$i<$panjang;$i++){
        ?>

        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabel<?php echo $i; ?>').pause();
            document.getElementById('suarabel<?php echo $i; ?>').currentTime=0;
            document.getElementById('suarabel<?php echo $i; ?>').play();
        }, totalwaktu);
        <?php
            }
            }
        ?>


        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabelsuarabelloket').pause();
            document.getElementById('suarabelsuarabelloket').currentTime=0;
            document.getElementById('suarabelsuarabelloket').play();
        }, totalwaktu);

        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabelloket2').pause();
            document.getElementById('suarabelloket2').currentTime=0;
            document.getElementById('suarabelloket2').play();
        }, totalwaktu);

        totalwaktu=totalwaktu+500;
        setTimeout(function() {
            document.getElementById('suaraA').pause();
            document.getElementById('suaraA').currentTime=0;
            document.getElementById('suaraA').play();
        }, totalwaktu);


    }
</script>


<script type="text/javascript">
    mulai();
</script>
