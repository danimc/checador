<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class B_test extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
        $this->load->library("Pdf");
        $this->load->model('consultas');
    }


 
    public function create_pdf() {

        if ($this->session->userdata('logueado')) {
            if ($this->session->userdata('tipo') == 'A' || $this->session->userdata('tipo') == 'C'){
               



$fechaimpresion = $_GET['fechaimpresion'];

// create new PDF document
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Guadalajara');
$pdf->SetTitle('Bitacora');
$pdf->SetSubject('Listado de la Bitacora');

// set default header data
$pdf->setFooterData(array(0,64,0), array(0,64,128));


$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->setPrintHeader(false);

// set margins
$pdf->SetMargins(10, 2, 10);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 11, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));



$rows = '';

$datos = $this->consultas->trae_log($fechaimpresion);

for ($x=0; $x < count($datos) ; $x++) {

    $rows = $rows . '<tr><td>' . $datos[$x]->IdLog . '</td><td>'.$datos[$x]->empleado.'</td><td>'.$datos[$x]->Accion.'</td><td>'.$datos[$x]->usuario.'</td><td>'.$datos[$x]->observaciones.'</td><td>'.$datos[$x]->fecha_modificacion.'</td><td>'.$datos[$x]->FechaCreacion.'</td></tr>';
    
}



// Set some content to print
$html = <<<EOD
<table border="0">
    <tr>
        <th width="25%"><img src="assets/img/logo.jpg" height="90" width="120"></th>
        <th align="center" width="50%">
            <span style="font-size: large;">REGISTRO DE LA BITACORA (LOG)</span>
            <BR>
            <span style="font-size: medium;"  style="color:#808080;">FECHA: $fechaimpresion</span>
        </th>
        <th align="right" width="25%"><img src="assets/img/innovacion.jpeg" height="70" width="180"></th>
    </tr>
</table>

<br>

<table border=".5" style="text-align:center;">
    <tr style="color:#808080;">
        <td width="10%">
            No. Regitro
        </td>
        <td width="20%">
            Empleado
        </td>
        <td width="15%">
            Accion
        </td>       
        <td width="15%">
            Usuario
        </td>
        <td width="20%">
            Observaciones
        </td>
        <td width="10%">
            Fecha Checada
        </td>
        <td width="10%">
            Fecha Modificacion
        </td>               
    </tr>
    $rows
</table>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Registro de Bitacora.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
                } else {
                redirect(base_url() . 'principal');   
            }
            
        } else {
            redirect(base_url() . 'principal');   
        }
    
    }

}
 
/* End of file c_test.php */
/* Location: ./application/controllers/c_test.php */