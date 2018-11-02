<?php
    session_start();
?>

<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}

.scroll{
  height: 200px;
  
  padding: 10px;
  overflow: scroll;
  height: 300px;
  
  /*script tambahan khusus untuk IE */
  scrollbar-face-color: #CE7E00; 
  scrollbar-shadow-color: #FFFFFF; 
  scrollbar-highlight-color: #6F4709; 
  scrollbar-3dlight-color: #11111; 
  scrollbar-darkshadow-color: #6F4709; 
  scrollbar-track-color: #FFE8C1; 
  scrollbar-arrow-color: #6F4709;
}
</style>

<body>
<h2>Menu</h2>



<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Food')">Food</button>
  <button class="tablinks" onclick="openCity(event, 'Drink')">Drink</button>
  
</div>
<form method="post" action="" class="form-order">
<select name="meja">
    <option value="">-- Meja --</option>
    <option value="Meja 1">Meja 1</option>
    <option value="Meja 2">Meja 2</option>
    <option value="Meja 3">Meja 3</option>
    <option value="Meja 4">Meja 4</option>
</select>
<input type="submit" value="Submit" class="order">
<div id="Food" class="tabcontent scroll">
  <div class="row" >
      <?php for($i=1;$i<=10;$i++){?>
          <div class="col-sm-3 myItemFood" id="<?php echo "food-".$i; ?>" style="margin:10px 0">
            <img src="../assets/img/<?php echo $i?>.jpg" class="rounded mx-auto d-block" alt="gambar1" style=" Height:150px;">
            <input type="checkbox" name="makanan[]" value="makanan<?php echo $i;  ?>">
            <figcaption align="center">Makanan <?php echo $i ?> </figcaption>
            <figcaption align="center"><b>IDR : .......</b> <?php ?> </figcaption>
          </div>
         
      <?php }?>
  </div>
</div>

<div id="Drink" class="tabcontent scroll">
    <div class="row">
        <?php for($i=1;$i<=10;$i++){?>
            <div class="col-sm-3 myItemDrink" style="margin:10px 0">
                <img src="../assets/img/d<?php echo $i?>.jpg" class="rounded mx-auto d-block" alt="gambar1" style="Height:150px;">
                <input type="checkbox" name="minuman[]" value="minuman<?php echo $i;  ?>">
                <figcaption align="center">Minuman <?php echo $i?> </figcaption>
                <figcaption align="center"><b>IDR : .......</b> <?php ?> </figcaption>
            </div>
            
        <?php }?>
    </div>
</div>

</form>
    <div class="tampil-orderan"></div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <input type="hidden" class="form-control" id="id_food" name="id_food">
        </div>
        <div class="form-group">
            <label for="qty">Qty:</label>
            <input type="number" class="form-control" id="qty">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<?php include('../layout/footercasier.php'); ?>
<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

$(document).ready(function(){
    $(".myItemFood").click(function(){
        var id=$(this).attr('id').split("-")[1];
        $("#id_food").val(id);
        $("#exampleModal").modal('show');
        
    });

    $(".order").click(function(){
        var data = $(".form-order").serialize();
        
        $.ajax({
            type:'POST',
            url:'../process/proses.php',
            data:data,
            success: function(){
                alert("alhamadulliha sukses");
            }
        })
    });
})

</script>


<?php include("../layout/footercasier.php");?>