<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class E_test extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
        $this->load->library("Pdf");
        $this->load->model('consultas');
    }


 
    public function create_pdf() {

        if ($this->session->userdata('logueado')) {
            if ($this->session->userdata('tipo') == 'A' || $this->session->userdata('tipo') == 'C'){
               


$id_empleado = $_GET['id_empleado'];
$fechainicial = $_GET['fechainicial'];
$fechafinal = $_GET['fechafinal'];

// create new PDF document
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Guadalajara');
$pdf->SetTitle('Historial');
$pdf->SetSubject('Historial de Checadas');

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
$pdf->SetFont('dejavusans', '', 9, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));


$nombre = '';
$rows = '';

$datos = $this->consultas->trae_historial_semanal($id_empleado, $fechainicial, $fechafinal);

for ($x=0; $x < count($datos) ; $x++) {
    $nombre = $datos[$x]->nombre;
    $rows = $rows . '<tr><td>' . $datos[$x]->fecha . '</td><td>'.$datos[$x]->dia.'</td><td>'.$datos[$x]->hora_entrada.'</td><td>'.$datos[$x]->estatus_entrada.'</td><td>'.$datos[$x]->obs_entrada.'</td><td><img src="fotos/'.$datos[$x]->foto_entrada.'" height="45" width="55" style="padding:2px"></td><td>' . $datos[$x]->hora_salida . '</td><td>' . $datos[$x]->estatus_salida . '</td><td>' . $datos[$x]->obs_salida . '</td><td><img src="fotos/'.$datos[$x]->foto_salida.'" height="45" width="55" style="padding:2px"></td></tr>';
    
}



// Set some content to print
$html = <<<EOD
<table border="0">
    <tr>
        <th width="25%"><img src="assets/img/logo.jpg" height="90" width="120"></th>
        <th align="center" width="50%">
            <span style="font-size: large;">CHECADAS SEMANALES</span>
            <BR>
            <span style="font-size: medium;"  style="color:#808080;">Del: $fechainicial Al: $fechafinal </span>
        </th>
        <th align="right" width="25%"><img src="assets/img/innovacion.jpeg" height="70" width="180"></th>
    </tr>
</table>

<br>

<table border=".5" style="text-align:center;">
    <tr style="color:#808080;">
        <td width="10%">
            Fecha
        </td>
        <td width="10%">
            Día
        </td>
        <td width="10%">
            Hora Entrada
        </td>       
        <td width="10%">
            Estatus Entrada
        </td>
        <td width="10%">
            Observaciones Entrada
        </td>        
        <td width="10%">
            Foto Entrada
        </td> 
        <td width="10%">
            Hora Salida
        </td>   
        <td width="10%">
            Estatus Salida
        </td>
        <td width="10%">
            Observaciones Salida
        </td>        
        <td width="10%">
            Foto Salida
        </td>                            
    </tr>
    $rows
</table>

<br>
(Estatus = Estatus de la checada) N = Normal R = Ingreso con Retardo A = Salida Anticipada
<br>

<br>

Manifiesto bajo protesta de conducierme con verdad, que son verdaderos y fidedignos los registros de ingresos y salidas plasmados en el presente documento, esto de conformidad con el articulo 56 Fraccion XVIII de la Ley para los Servidores Publicos del Estado de Jalisco y sus Municipios, asi como por lo establecido en el articulo 46 Fracciones I,V y XII de las Condiciones Generales de Trabajo del Ayuntamiento de Guadalajara.  

<br>
<br>

<br>

<table border="0">
    <tr>
        <th width="35%"> </th>
            <th align="center" width="30%">
            <span style="font-size: large;">Firma</span>
            <BR>
            <span style="font-size: medium;"  style="color:#808080;">$nombre</span>
        </th>
        <th align="right" width="35%">  </th>
    </tr>
</table>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Checadas Semanales.pdf', 'I');

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