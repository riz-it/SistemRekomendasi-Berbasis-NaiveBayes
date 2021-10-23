<?php

namespace App\Http\Controllers;

use App\Models\Database;
use Illuminate\Http\Request;

class OutputController extends Controller
{
    public function output($id = 0)
    {
        if ($id == 0) {

            $data = Database::distinct()->get(['data_to']);

            return view('contents.output', [
                'data' => $data
            ]);
        } else {

            $data = array();
            $sample = Database::where('data_to', $id)->get();
            if (count($sample) == 0) {
                return redirect('output')->with('toast_error', 'Hayo mau ngapain :)');
            }
            if (count($sample) < 2) {
                return redirect('output')->with('toast_error', 'Data tidak boleh kurang dari 2!');
            } else {
                foreach ($sample as $key => $value) {
                    $data[$key]['data_to'] = $value->data_to;
                    $data[$key]['stock_name'] = $value->stock_name;
                    $data[$key]['stock_key1'] = $value->first_stock;
                    $data[$key]['stock_key2'] = $value->stock_in;
                    $data[$key]['stock_key3'] = $value->stock_out;
                    $data[$key]['stock_key4'] = $value->last_stock;
                    if ($value->stock_out > 0 &&  $value->stock_out >= $value->stock_in) {
                        $data[$key]['class'] = "BELI";
                    } else {
                        $data[$key]['class'] = "TIDAK";
                    }
                }


                $rata_rata[0]['data'] = $data;
                $rata_rata[1]['data'] = $data;
                $rata_rata[0]['key'] = "TIDAK";
                $rata_rata[1]['key'] = "BELI";



                for ($z = 0; $z < 2; $z++) {
                    for ($i = 0; $i < count($data); $i++) {
                        if ($rata_rata[$z]['data'][$i]['class'] !== $rata_rata[$z]['key']) {
                            unset($rata_rata[$z]['data'][$i]);
                        }
                    }

                    $rata_rata[$z]['data'] = array_values($rata_rata[$z]['data']);
                }


                for ($i = 0; $i < 2; $i++) {
                    if (count($rata_rata[$i]['data']) < 1) {
                        return redirect('output')->with('toast_error', 'Data tidak valid!');
                    }
                }

                for ($v = 0; $v < 2; $v++) {
                    $x = count($rata_rata[$v]['data']);
                    for ($i = 1; $i < 5; $i++) {
                        $rata_rata_sementara = 0;

                        for ($y = 0; $y < $x; $y++) {
                            $rata_rata_sementara += $rata_rata[$v]['data'][$y]["stock_key" . $i];
                        }

                        $rata_rata[$v]["AV" . $i] = ($rata_rata_sementara / $x);
                    }
                }


                $deviasi[0]['data'] = $data;
                $deviasi[1]['data'] = $data;
                $deviasi[0]['key'] = "TIDAK";
                $deviasi[1]['key'] = "BELI";

                // dd($data);
                for ($z = 0; $z < 2; $z++) {
                    for ($i = 0; $i < count($data); $i++) {
                        if ($deviasi[$z]['data'][$i]['class'] !== $deviasi[$z]['key']) {
                            unset($deviasi[$z]['data'][$i]);
                        }
                    }

                    $deviasi[$z]['data'] = array_values($deviasi[$z]['data']);
                }


                for ($v = 0; $v < 2; $v++) {
                    $x = count($deviasi[$v]['data']);
                    for ($i = 1; $i < 5; $i++) {
                        $rata_deviasi = 0;
                        $sigma = 0;

                        for ($y = 0; $y < $x; $y++) {
                            $rata_deviasi += $deviasi[$v]['data'][$y]["stock_key" . $i];
                        }

                        $dv = $rata_deviasi / $x;

                        for ($w = 0; $w < $x; $w++) {
                            $perhitungan = ($deviasi[$v]['data'][$w]["stock_key" . $i] - $dv) ** 2;
                            $sigma += $perhitungan;
                        }

                        $pembagian = $sigma / $x;
                        $standarDeviasi = $pembagian ** 0.5;
                        $deviasi[$v]["DV" . $i] = ($standarDeviasi);
                    }
                }

                $count = count($data);

                $probabilitas[0]['key'] = "TIDAK";
                $probabilitas[1]['key'] = "BELI";
                $count_probability = 0;
                for ($i = 0; $i < 2; $i++) {
                    $probabilitas[$i]['value'] = count($rata_rata[$i]['data']) / $count;
                    $count_probability += $probabilitas[$i]['value'];
                }


                $output = $data;

                for ($x = 0; $x < 2; $x++) {
                    for ($y = 1; $y < 5; $y++) {
                        for ($i = 0; $i < count($output); $i++) {

                            $pi = pi();


                            $a = (1 / ($deviasi[$x]["DV" . $y] * sqrt(2 * $pi)) * (exp((-1 / 2) * (($output[$i]['stock_key' . $y] - $rata_rata[$x]['AV' . $y]) / $deviasi[$x]["DV" . $y]) ** 2)));

                            $output[$i]['P-' . $x . '-' . $y] = $a;
                        }
                    }
                }

                for ($i = 0; $i < 2; $i++) {
                    for ($x = 0; $x < count($output); $x++) {
                        $z = 1;
                        for ($y = 1; $y < 5; $y++) {
                            $z *= $output[$x]['P-' . $i . '-' . $y] * $probabilitas[$i]['value'];
                        }
                        $output[$x]['out-' . $i] = $z;
                    }
                }

                for ($i = 0; $i < count($output); $i++) {
                    if ($output[$i]['out-1'] >= $output[$i]['out-0']) {
                        $output[$i]['new_class'] = "BELI";
                    } else {
                        $output[$i]['new_class'] = "TIDAK";
                    }
                }

                return view('contents.detailoutput', [
                    'id' => $id,
                    'hasil' => $output
                ]);
            }
        }
    }

    public function progress($id = 0)
    {
        if ($id == 0) {
            $data = Database::distinct()->get(['data_to']);

            return view('contents.progress', [
                'data' => $data
            ]);
        } else {

            $data = array();
            $sample = Database::where('data_to', $id)->get();
            if (count($sample) == 0) {
                return redirect('progress')->with('toast_error', 'Hayo mau ngapain :)');
            }
            if (count($sample) < 2) {
                return redirect('progress')->with('toast_error', 'Data tidak boleh kurang dari 2!');
            } else {
                foreach ($sample as $key => $value) {
                    $data[$key]['data_to'] = $value->data_to;
                    $data[$key]['stock_name'] = $value->stock_name;
                    $data[$key]['stock_key1'] = $value->first_stock;
                    $data[$key]['stock_key2'] = $value->stock_in;
                    $data[$key]['stock_key3'] = $value->stock_out;
                    $data[$key]['stock_key4'] = $value->last_stock;
                    if ($value->stock_out > 0 &&  $value->stock_out >= $value->stock_in) {
                        $data[$key]['class'] = "BELI";
                    } else {
                        $data[$key]['class'] = "TIDAK";
                    }
                }


                $rata_rata[0]['data'] = $data;
                $rata_rata[1]['data'] = $data;
                $rata_rata[0]['key'] = "TIDAK";
                $rata_rata[1]['key'] = "BELI";



                for ($z = 0; $z < 2; $z++) {
                    for ($i = 0; $i < count($data); $i++) {
                        if ($rata_rata[$z]['data'][$i]['class'] !== $rata_rata[$z]['key']) {
                            unset($rata_rata[$z]['data'][$i]);
                        }
                    }

                    $rata_rata[$z]['data'] = array_values($rata_rata[$z]['data']);
                }



                for ($i = 0; $i < 2; $i++) {
                    if (count($rata_rata[$i]['data']) < 1) {
                        return redirect('progress')->with('toast_error', 'Data tidak valid!');
                    }
                }

                $asd = array();
                for ($v = 0; $v < 2; $v++) {
                    $x = count($rata_rata[$v]['data']);
                    for ($i = 1; $i < 5; $i++) {
                        $rata_rata_sementara = 0;

                        for ($y = 0; $y < $x; $y++) {
                            $rata_rata_sementara += $rata_rata[$v]['data'][$y]["stock_key" . $i];
                        }

                        $rata_rata[$v]["AV" . $i] = ($rata_rata_sementara / $x);
                        // $asd[$v][$i] = $rata_rata_sementara / $x;
                    }
                }


                $deviasi[0]['data'] = $data;
                $deviasi[1]['data'] = $data;
                $deviasi[0]['key'] = "TIDAK";
                $deviasi[1]['key'] = "BELI";

                // dd($data);
                for ($z = 0; $z < 2; $z++) {
                    for ($i = 0; $i < count($data); $i++) {
                        if ($deviasi[$z]['data'][$i]['class'] !== $deviasi[$z]['key']) {
                            unset($deviasi[$z]['data'][$i]);
                        }
                    }

                    $deviasi[$z]['data'] = array_values($deviasi[$z]['data']);
                }


                for ($v = 0; $v < 2; $v++) {
                    $x = count($deviasi[$v]['data']);
                    for ($i = 1; $i < 5; $i++) {
                        $rata_deviasi = 0;
                        $sigma = 0;

                        for ($y = 0; $y < $x; $y++) {
                            $rata_deviasi += $deviasi[$v]['data'][$y]["stock_key" . $i];
                        }

                        $dv = $rata_deviasi / $x;

                        for ($w = 0; $w < $x; $w++) {
                            $perhitungan = ($deviasi[$v]['data'][$w]["stock_key" . $i] - $dv) ** 2;
                            $sigma += $perhitungan;
                        }

                        $pembagian = $sigma / $x;
                        $standarDeviasi = $pembagian ** 0.5;
                        $deviasi[$v]["DV" . $i] = ($standarDeviasi);
                    }
                }

                $count = count($data);

                $probabilitas[0]['key'] = "TIDAK";
                $probabilitas[1]['key'] = "BELI";
                $count_probability = 0;
                for ($i = 0; $i < 2; $i++) {
                    $probabilitas[$i]['value'] = count($rata_rata[$i]['data']) / $count;
                    $count_probability += $probabilitas[$i]['value'];
                }

                return view('contents.detailprogress', [
                    'rata_rata' => $rata_rata,
                    'deviasi' => $deviasi,
                    'id' => $id,
                    'probabilitas' => $probabilitas,
                    'count_probability' => $count_probability
                ]);
            }
        }
    }
}
