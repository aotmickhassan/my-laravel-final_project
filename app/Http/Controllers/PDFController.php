<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use App\Models\BillDetail;
use Illuminate\Http\Request;
use App\Models\BillingSessionGroup;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function generateBanglaPDF(Request $request) 
    {
        $id = $request->get('id');

        // 1. Fetch the session group with its department & creator
        $billSessionGroup = BillingSessionGroup::with(['department', 'creator'])
            ->findOrFail($id);

        // 2. Authorization
        if (Auth::id() !== $billSessionGroup->created_by
        && Auth::user()->role !== 'admin') { 
            abort(403, 'Access Denied');
        }

        // 3. Pull details
        $details = BillDetail::with('billingSector')
            ->where('billing_session_group', $id)
            ->get()
            ->map(fn($item, $i) => [
                'serial'      => $i + 1,
                'bn_name'     => $item->billingSector->bn_name,
                'course_code' => $item->course->course_code, // ensure you eager-load course if needed
                'count'       => $item->count,
                'paper_type'  => $item->is_full_paper ? 'পূর্ণপত্র' : 'অর্ধপত্র',
                'rate'        => number_format($item->rate, 2),
                'total'       => number_format($item->count * $item->quantity * $item->rate, 2),
            ]);

        $grandTotal = number_format(
            array_sum($details->pluck('total')->map(fn($t)=> (float)str_replace(',', '', $t))->toArray()),
            2
        );

        // 4. Prepare mPDF with Kalpurush
        $config   = (new ConfigVariables())->getDefaults();
        $fontDirs = array_merge($config['fontDir'], [resource_path('fonts')]);
        $fontCFG  = (new FontVariables())->getDefaults()['fontdata'] + [
            'kalpurush' => ['R'=>'kalpurush.ttf','useOTL'=>0xFF,'useKashida'=>75],
        ];

        $mpdf = new Mpdf([
            'mode'        => 'utf-8',
            'format'      => 'A4',
            'fontDir'     => $fontDirs,
            'fontdata'    => $fontCFG,
            'default_font'=> 'kalpurush',
        ]);

        // 5. CSS
        $css = "
        <style>
        body { font-family: kalpurush; }
        h2, h3, h4 { margin: 4px 0; }
        table { width:100%; border-collapse: collapse; margin-top:12px; }
        th, td { border:1px solid #000; padding:6px; text-align:center; font-size:14px; }
        .total-row td { background:#fff; color:#000; font-weight:bold; }
        </style>
        ";

        // 6. Bangla header with dynamic values
        $creatorName = $billSessionGroup->creator->name;
        $deptName    = $billSessionGroup->department->name;
        $sessionName = $billSessionGroup->session;

        $html = "
        <h2>নামঃ {$creatorName}</h2>
        <h3>বিভাগঃ {$deptName}</h3>
        <h4>সেশনঃ {$sessionName}</h4>
        <h2 style='text-align:center; margin-top:12px;'>পরীক্ষা সংক্রান্ত পারিতোষিক কাজের বিবরণ</h2>
        <table>
            <tr>
            <th>ক্র.নং</th>
            <th>কাজের নাম</th>
            <th>কোর্স কোড</th>
            <th>সংখ্যা</th>
            <th>অর্ধপত্র/পূর্ণপত্র</th>
            <th>পারিতোষিকের হার (৳)</th>
            <th>মোট টাকা (৳)</th>
            </tr>
        ";

        foreach ($details as $row) {
            $html .= "
            <tr>
            <td>{$row['serial']}</td>
            <td>{$row['bn_name']}</td>
            <td>{$row['course_code']}</td>
            <td>{$row['count']}</td>
            <td>{$row['paper_type']}</td>
            <td>{$row['rate']}</td>
            <td>{$row['total']}</td>
            </tr>";
        }

        $html .= "
        <tr class='total-row'>
            <td colspan='6' style='text-align:right;'>সর্বমোট খরচ</td>
            <td>{$grandTotal}</td>
        </tr>
        </table>
        ";

        // 7. Render PDF
        $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

        return response($mpdf->Output('', 'S'))
            ->header('Content-Type', 'application/pdf');
    }
}
// public function generateBanglaPDF(Request $request)
// {
//     $id = $request->get('id');
//     $billSessionGroup = BillingSessionGroup::with('department')->findOrFail($id);

//     if (Auth::id() !== $billSessionGroup->created_by && Auth::user()->role !== 'admin') {
//         abort(403, 'Access Denied');
//     }

//     $details = BillDetail::with('billingSector')
//         ->where('billing_session_group', $id)
//         ->get()
//         ->map(function($item, $i) {
//             $total = $item->count * $item->quantity * (float)$item->rate;
//             return [
//                 'serial'       => $i + 1,
//                 'bn_name'      => $item->billingSector->bn_name,
//                 'course_code'  => $item->course->course_code,
//                 'count'        => $item->count,
//                 'paper_type'   => $item->is_full_paper ? 'পূর্ণপত্র' : 'অর্ধপত্র',
//                 'rate'         => number_format($item->rate, 2),
//                 'total'        => number_format($total, 2),
//             ];
//         });
//     $grandTotal = number_format($details->sum(fn($d)=>floatval(str_replace(',', '', $d['total']))), 2);

//     // 3. mPDF + font config
//     $config   = (new ConfigVariables())->getDefaults();
//     $fontDirs = array_merge($config['fontDir'], [resource_path('fonts')]);
//     $fontCFG  = (new FontVariables())->getDefaults()['fontdata'] + [
//         'kalpurush' => ['R'=>'kalpurush.ttf','useOTL'=>0xFF,'useKashida'=>75],
//     ];
//     $mpdf = new Mpdf([
//         'mode'       => 'utf-8',
//         'format'     => 'A4',
//         'fontDir'    => $fontDirs,
//         'fontdata'   => $fontCFG,
//         'default_font'=> 'kalpurush',
//     ]);

//     // 4. CSS + HTML
//     $css = "
//     <style>
//       body { font-family: kalpurush; }
//       table { width:100%; border-collapse: collapse; }
//       th, td { border:1px solid #000; padding:6px; text-align:center; font-size:14px; }
//       .total-row td { background:#000; color:#fff; font-weight:bold; }
//     </style>
//     ";

//     $html = '<h2 style="font-family:kalpurush; text-align:center;">পরীক্ষা সংক্রান্ত পারিতোষিক কাজের বিবরণ</h2>';
//     $html .= '<table>';
//     $html .= '<tr>
//                 <th>ক্র.নং</th>
//                 <th>কাজের নাম</th>
//                 <th>কোর্স কোড</th>
//                 <th>সংখ্যা</th>
//                 <th>অর্ধপত্র/পূর্ণপত্র</th>
//                 <th>পারিতোষিকের হার (৳)</th>
//                 <th>মোট টাকা (৳)</th>
//               </tr>';
//     foreach ($details as $row) {
//         $html .= '<tr>
//                     <td>'.$row['serial'].'</td>
//                     <td>'.$row['bn_name'].'</td>
//                     <td>'.$row['course_code'].'</td>
//                     <td>'.$row['count'].'</td>
//                     <td>'.$row['paper_type'].'</td>
//                     <td>'.$row['rate'].'</td>
//                     <td>'.$row['total'].'</td>
//                   </tr>';
//     }
//     $html .= '<tr class="total-row">
//                 <td colspan="6" style="text-align:right;">সর্বমোট খরচ</td>
//                 <td>'.$grandTotal.'</td>
//               </tr>';
//     $html .= '</table>';

//     // 5. Output
//     $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
//     $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
//     return response($mpdf->Output('', 'S'))
//            ->header('Content-Type', 'application/pdf');
// }