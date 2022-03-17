<?php 
if(isset($_POST['signaturesubmit'])){ 
    $signature = $_POST['signature'];
    $signatureFileName = uniqid().'.png';
    $signature = str_replace('data:image/png;base64,', '', $signature);
    $signature = str_replace(' ', '+', $signature);
    $data = base64_decode($signature);
    $file = 'signatures/'.$signatureFileName;
    file_put_contents($file, $data);
    // $msg = "<div class='alert alert-success'>Signature Uploaded</div>";
} 
?>
<div class="wrapper container-fluid">
  
<div class="wrapper">
  <!-- <img src="https://preview.ibb.co/jnW4Qz/Grumpy_Cat_920x584.jpg" width=400 height=200 /> -->
  <canvas id="signature-pad" class="signature-pad" width=600 height=620></canvas>
<div class="wrapper" style="object-position: center; background-position: center;">
  <button id="save"  class="btn btn-sm btn-success">Save</button>
  <button id="clear" class="btn btn-sm btn-danger">Clear</button>

  <form id="signatureform" action="<?php echo base_url('pekerjaan/new_new_kirim_minggu_pengawas')?>" style="display:none" method="post">
    <input type="hidden" id="signature" name="signature">
    <input type="hidden" id="idminggu" name="idminggu" value="<?= $idminggu ?>">
    <input type="hidden" name="signaturesubmit" value="1">
  </form>

</div>


</div>

<style type="text/css">
	.wrapper {
  position: relative;
  width: 600px;
  height: 620px;
  -moz-user-select: none;
  -webkit-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

img {
  position: absolute;
  left: 0;
  top: 0;
}

.signature-pad {
  /*position: absolute;*/
  /*left: 0;
  top: 0;*/
  width: 600px;
  /*height: 200px;*/

  position: relative;
  border: 2px dashed grey;
  height:620px;
}

</style>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script type="text/javascript">
var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
  backgroundColor: 'rgba(255, 255, 255, 0)',
  penColor: 'rgb(0, 0, 0)'
});
var saveButton = document.getElementById('save');
var cancelButton = document.getElementById('clear');

saveButton.addEventListener('click', function(event) {
  var data = signaturePad.toDataURL('image/png');

	anchor = $("#signature");
	anchor.val(data);
	$("#signatureform").submit();

  // Send data to server instead...
  // window.open(data);
});

cancelButton.addEventListener('click', function(event) {
  signaturePad.clear();
});

// $(document).on('click', '#save', function() {
//             var mycanvas = document.getElementById('signature-pad');
//             var img = mycanvas.toDataURL("image/png");
//             // window.open(img);
//             anchor = $("#signature");
//             anchor.val(img);
//             $("#signatureform").submit();
//         });
</script>