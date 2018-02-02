<title>Hospital de Traumatología | “Dr. Victorio de la Fuente Narváez”</title>
<div style="margin-top: 0px;font-size: 30px;margin-left: -20px">
    <center>
        <p style="text-align: center;font-size: 18px;margin-left: -20px"><b>TRIAGE & URGENCIAS</b></p>
        
        <b style="text-align: center;font-size: 11px;margin-left: -20px;margin-top: -7px">Hospital de Traumatología </b>
        
        <p style="text-align: center;font-size: 11px;margin-left: -25px;margin-top: 0px">“Dr. Victorio de la Fuente Narváez”</p>
        <p style="text-align: center;font-size: 10px;margin-left: -20px;margin-top: -2px"><b>HORA EMISIÓN : <?= date('d/m/Y')?> <?= date('H:i')?></b></p>
        
        <img class="code128" style="margin-left:-20px "><br><br>
        <div style="width: 150px">
            <p style="text-align:  center;font-size: 8px;margin-left: -30px;line-height: 1">
                Av. Colector 15 S/N esq. Av. Instituto Politécnico Nacional, Col. Magdalena de las Salinas. Del. Gustavo a. Madero
            </p>
        </div>
    </center>
</div>
<script src="<?=  base_url()?>assets/libs/jquery/jquery/dist/jquery.js"></script>
<script src="<?= base_url('assets/js/os/barcode/jquery-barcode.js')?>" type="text/javascript"></script>
<script>
    $(document).ready(function (e){
        JsBarcode(".code128", "<?=$info['triage_id']?>",{
            displayValue: true,
            height: 50,
            width: 1
        });
        print(true);
        window.top.close();
    })

</script>