<script>

  $(document).ready(function()
  {
    $('[data-toggle="tooltip"]').tooltip(); 

    document.getElementById("myForm").reset();
    $("#login").click(function()
    {
      $(".login-section,.instruction-section").remove();
      $(".question-section").css("display","inline-block");
    });
  }); 

  //Con esta funcion evitamos que el alumno pueda darle al boton de atras 
  function nobackbutton()
  {
     window.location.hash="no-back-button";
     window.location.hash="Again-No-back-button" //chrome
     window.onhashchange=function(){window.location.hash="no-back-button";}
  }

  function exit()
  {
    if (confirm('if you press accept the exam data will not be saved')) 
    {
        window.location.href='<?php echo site_url('main/');?>';
    }
  }

</script>

<body onload="nobackbutton();">

<div class="containermenu" >

  <ol class="breadcrumb">
   <li><a href="<?php echo site_url();?>main/">Menu</a></li>
   <li><a href="<?php echo site_url();?>chat/">Mode Menu</a></li>
   <li class="active">Final test</li>
  </ol>

  <div class="dq-test-outer-wrapper">
    <div class="dq-test-title">Final test</div>

    <div id="testContent">
  

      <?php if($num_preguntas != 0) { ?>
      <div class="half-width  login-section" style="margin:60px 0px;">
        <input type="button" id="login" value="Start" class="btn btn-primary btn-lg"" />
      </div>

      <div class="half-width instruction-section" style="margin:30px 0px;background:#f0f0f0;border-radius:5px;">
       
        <div style="font-size: 20px;font-weight:bold;margin-bottom: 10px;text-decoration:underline;">Instructions</div>


        <div id="testMeta" class="left">Number of questions : <?php echo $num_preguntas?></div>
        <div id="instruction" class="left alert">Do not refresh the page or press the backwards button in order to not lose the results </div>
      </div>
      <?php } else { ?>

      <div style="font-size: 20px;font-weight:bold;margin:30px 30px;">There are no questions available right now</div>
      
      <input class="btn btn-primary btn-md" style="margin:30px 30px;" type="submit" value="Go back to mode menu" onclick="location.href='<?php echo site_url('chat');?>/'" >  
      <?php } ?>



      <div class="question-section display-none">

        <form autocomplete="off" id="myForm" method="post" action="<?php echo site_url();?>chat/resultdisplay_final">

          <?php $num = 1; ?>

          <!--/////////////////////////////// DISORDERED QUESTIONS ///////////////////////////////-->
          <?php foreach($disordered_questions as $row) { ?>

            <!-- Muestra el numero de la pregunta y el enunciado -->
            <h4><?=$num?>. <?php echo $enun_disordered?></h4>  
                
            <!-- Muestra la frase ordenada -->
            <p class="option question-tbl"> <?=$row->disordered?></p>
            
            <input autocomplete="off" class="col-xs-12" type="input" name="quizid<?=$num?>" required size="100"><br>

            <!-- Se guarda el id, el tipo y la categoria de la frase -->
            <input type="hidden" value="<?=$row->id?>" name="id<?=$num?>">
            <input type="hidden" value="disordered" name="type<?=$num?>">
            <input type="hidden" value="<?=$row->id_category?>" name="categoria">

            <?php $num++;?>
          <?php } ?>
          

          <!--/////////////////////////////// TRUE-FALSE QUESTIONS ///////////////////////////////-->
          <?php foreach($tf_questions as $row) { ?>

            <!-- Creamos un array y almacenamos la frase verdadera y la falsa. Luego se mezclan para que aparezcan en un orden aleatorio-->
            <?php $ans_array = array($row->true_statement, $row->false_statement);
            shuffle($ans_array); ?>

            <!-- Muestra el numero de la pregunta y el enunciado -->
            <h4><?=$num?>. <?=$enun_tf?></h4>
            
            <!-- Muestra la frase verdadera y la falsa(en orden aleatorio)-->
            <input  type="radio" name="quizid<?=$num?>" value="<?=htmlspecialchars($ans_array[0], ENT_QUOTES)?>" required>  <?=$ans_array[0]?><br>
            <input type="radio" name="quizid<?=$num?>" value="<?=htmlspecialchars($ans_array[1], ENT_QUOTES)?>">   <?=$ans_array[1]?><br>
            
            <!-- Se guarda el id, el tipo y la categoria de la frase -->
            <input type="hidden" value="<?=$row->id_category?>" name="categoria">
            <input type="hidden" value="truefalse" name="type<?=$num?>">
            <input type="hidden" value="<?=$row->id?>" name="id<?=$num?>">

            <?php $num++;?>
          <?php } ?>


          <!--///////////////////////////////  AUDIO-WRITE QUESTIONS ///////////////////////////////-->
          <?php foreach($audio_questions as $row) { ?> 
         
            <!-- Muestra el numero de la pregunta, el enunciado y la pista de audio -->
            <h4><?=$num?>. <?=$enun_audio_write?>:&nbsp;&nbsp;
            <?php $url= site_url()."audio_uploads/".$row->audio; ?>
            <audio controls>
                  <source src="<?=$url?>" type="audio/ogg">
                  <source src="<?=$url?>" type="audio/mpeg">
                      Your browser does not support the audio element.
            </audio>
            </h4> 

            <input autocomplete="off" class="col-xs-12" type="input" name="quizid<?=$num?>" required size="100" ><br>
            
            <!-- Se guarda el id, el tipo y la categoria de la frase -->
            <input type="hidden" value="<?=$row->id?>" name="id<?=$num?>">
            <input type="hidden" value="audio_write" name="type<?=$num?>"> 
            <input type="hidden" value="<?=$row->id_category?>" name="categoria">

            <?php $num++; ?> 
          <?php } ?>
          

          <!--/////////////////////////////  QUESTION - ANSWER    ///////////////////////////////-->
          <?php foreach($question_answer as $row) { ?> 

            <!-- Muestra el numero y el enunciado de las preguntas true/false-->
            <h4><?=$num?>. <?=$enun_q_a?> <?=$row->statement?></h4> 

            <input autocomplete="off" class="col-xs-12 " type="input" name="quizid<?=$num?>" required size="100"><br>

            <!-- Se guarda el id, el tipo y la categoria de la frase -->
            <input type="hidden" value="<?=$row->id?>" name="id<?=$num?>">
            <input type="hidden" value="question_answer" name="type<?=$num?>"> 
            <input type="hidden" value="<?=$row->id_category?>" name="categoria">
            
            <?php $num++; ?> 
          <?php } ?>

      
          <div class="col-md-12 text-center margincolum">

            <table class="table table-bordered">
              <thead >
                <tr class="active">
                  <th>How do you feel about your test performance? (1: very easy and 5: very difficult).</th>
                </tr>
              </thead>

              <tbody>
                <tr class="active">
            
                <td><label class="radio-inline"><input type="radio" id="inlineRadio1" name="optradio" value="1" required>1</label>
                <label class="radio-inline"><input type="radio" id="inlineRadio2" name="optradio" value="2" required>2</label>
                <label class="radio-inline"><input type="radio" id="inlineRadio3" name="optradio" value="3" required>3</label>
                <label class="radio-inline"><input type="radio" id="inlineRadio4" name="optradio" value="4" required>4</label>
                <label class="radio-inline"><input type="radio" id="inlineRadio5" name="optradio" value="5" required>5</label></td> 

                </tr>
              </tbody>
            </table>

          </div>

          
          <input type="hidden" value="<?=$num_preguntas?>" name="cantidad">
          <br><br>
          <input type="submit" value="Finish" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Finish and correct">
          <input onclick = "exit()" style="margin: 15px;" value="Exit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Exit without saving">

        </form>

      </div> <!-- question-section -->
    </div> <!-- testContent -->
  </div> <!-- dq-test-outer-wrapper -->

</div> <!-- containermenu -->