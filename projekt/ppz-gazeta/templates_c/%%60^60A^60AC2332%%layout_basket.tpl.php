<?php /* Smarty version 2.6.26, created on 2013-04-27 10:18:36
         compiled from layout_basket.tpl */ ?>
<?php echo '
    <script>

        
         function Zlacz_Artykuly() {
            var myCheckboxes  = new Array();
            var tbName =  document.getElementById("newFileName").value;
            var sumaCeny = document.getElementById("sumaCeny").innerText;//value;
            
            $("input:checked").each(function() {
               myCheckboxes.push($(this).val());
            });
            
            if( (tbName==="") || (myCheckboxes.length < 1 )){
                alert("B��d: Nie podano nazwy pliku, b�dz nie wybrano artyku��w.");
                document.getElementById("newFileName").focus();
                return false;
            }

              $.post(
                    \'koszyk-ajax.php\',
                    {tab_artykuly: myCheckboxes,
                     newName: tbName,
                     cena: sumaCeny},
                    function(){
                                
                               var i=1;
                              $("input:checked").each(function() {
                                 if($(this).attr("checked")){ 
                                     $("#wnetrze"+i).css("background-color","lightgreen");
                                     $("#removelink"+i).replaceWith("<span style=\'color:#191970;\'>z��czono</span>");
                                }
                                 i+=1;
                              });
                                
                             //odznacz checked
                              $("input:checked").each(function() {
                                 $(this).removeAttr("checked");
                              });
                            
                             $(\'#laczenie\').html(\'  <td colspan="4" style=" border-width:2px;" > z��czono wybrane</td>     <td colspan="3" style=" border-width:2px;"><input type="button" value="     PayPal     " /></td>\');
                            // window.location.reload(true);
                    }
                );

        return false;   
    }
    </script>
'; ?>


<?php    
   $nr=1;
   $sumaCeny=0.0;
 ?>  
         <form>
          <table  class="tableWydanieKoszyk" >
              <tr style=" background-color: #B0C4DE; font-weight: bold;"><td colspan="2" style="text-align:left; width:20px;">Lp.</td> <td>Nazwa</td> <td>Data dodania</td> <td colspan="2" style=" text-align:left;">Cena</td></tr>
             <?php $_from = $this->_tpl_vars['pokaz_koszyk']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a']):
?>
               <?php if ($this->_tpl_vars['pokaz_koszyk'] == null): ?> <tr ><td colspan="6" style=" background-color:#DF6F6F; text-align:center; color:white;  font-weight:bold; ">Koszyk jest pusty</td></tr><?php endif; ?>
                    <tr <?php echo "id='wnetrze".$nr."'"; ?>>
                        <td  style="width:20px; text-align:left;"><?php echo $nr.'.'; ?></td>
                        <td  style="width:20px; text-align:left;"> <input type="checkbox"  name="artykuly[]" value=<?php echo $this->_tpl_vars['a']['Sciezka']; ?>
 checked="checked" /> </td>
                        <td ><?php echo $this->_tpl_vars['a']['Tytul']; ?>
</td> 
                        <td ><?php echo $this->_tpl_vars['a']['data']; ?>
</td>
                        <td style="text-align:left;"><?php echo $this->_tpl_vars['a']['Cena']; ?>
 z�</td>
                        <?php $this->assign('tmp', $this->_tpl_vars['a']['Cena']); ?>
                        <td style="text-align:center;"> <a <?php echo "id='removelink".$nr."'"; ?> href="basket_removeorder.php">usu�</a></td>
                    </tr>
                   <?php 
                        $nr+=1;
                        $sumaCeny+= $this->get_template_vars('tmp');
                    ?>
                
             <?php endforeach; endif; unset($_from); ?>
               
               
                    <tr>
                        <td colspan="4" align="right" style="  font-weight: bold; color:red;">Razem:</td>
                         <td colspan="3" style="text-align:left; color:red; "><span id="sumaCeny"><?php echo $sumaCeny; ?></span> z�</td>
                    </tr>
                     <tr id="laczenie">
                         <td colspan="4" style=" border-width:2px;" > <a href="#" style="margin-right:40px; font-weight: bold;" onclick=" Zlacz_Artykuly()">Z��cz wybrane</a>    Nadaj nazw�:<input type="text" id="newFileName" name="newFileName" size="25" maxlength="25"/></td>
                         <td colspan="3" style=" border-width:2px;"><input type="button" value="     PayPal     " /></td>
                    </tr>
               
           </table>
          <form>
           <br/>
