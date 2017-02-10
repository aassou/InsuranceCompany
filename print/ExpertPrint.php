<?php
    require('../app/classLoad.php');
    require('../app/PDOFactory.php');
    session_start();
    if (isset($_SESSION['userAxaAmazigh'])) {
        ob_start();
    ?>
    <style type="text/css">p,h1,h2,h4{text-align: center;font-family : Arial;font-weight: 100;margin-bottom: 0px;} h1,h2{font-size: 16px;} table{border-collapse: collapse;width:100%;} table,th,td{border: 1px solid black;} td,th{padding : 5px;} th{background-color: grey;}</style>
    <page backtop="5mm" backbottom="20mm" backleft="10mm" backright="10mm">
    	<h1>Liste expert</h1>
    	<p>Imprimé le <?= date('d/m/Y') ?> | <?= date('h:i') ?> </p>
    	<table>
    		<tr>
    			<th></th>
    		</tr>
    	<?php
    	//foreach($component as $element){
    	?>    
    		<tr>
    			<td></td>
    		</tr>
    	<?php
    	//}
    	?>
    	</table>
    </page>
    <?php
        $content = ob_get_clean();
        
        require('../lib/html2pdf/html2pdf.class.php');
        try{
            $pdf = new HTML2PDF('P', 'A4', 'fr');
            $pdf->pdf->SetDisplayMode('fullpage');
            $pdf->writeHTML($content);
            $fileName = "Liste$componentName-".date('Ymdhi').'.pdf';
            $pdf->Output($fileName);
        }
        catch(HTML2PDF_exception $e){
            die($e->getMessage());
        }
    }
    else {
        header('Location:../index.php');
    }
