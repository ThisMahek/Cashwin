<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Excel_export extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login'))
            redirect(site_url("admin/login"));
    }

    function matka($matka_id = 2)
    {
        if ($matka_id == "")
            return false;
        $this->load->model("excel_export_model");
        $this->load->library("excel");

        $game_data = $this->excel_export_model->fetch_data($matka_id);
        // print_r($game_data);exit;
        $filename = $this->excel_export_model->genrate_file_name($matka_id);
        $this->excel->getProperties()->setTitle("Game Excel Report")->setDescription("Game Excel Report with date.");

        // Assign cell values
        $this->excel->setActiveSheetIndex(0);

        // Assign Active sheet Title
        $this->excel->getActiveSheet()->setTitle("MATKA");

        $style_center_bold = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
            'font' => array(
                'bold' => true
            )
        );
        $style_font8 = array(
            'font' => array(
                'size' => 8
            )
        );
        $style_bold = array(
            'font' => array(
                'bold' => true
            )
        );
        $style_solid_background = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '00B0F0')
            )
        );

        $cells = array("A2:AE2", "A15:AE15", "A29:AE29");
        foreach ($cells as $cell):
            $this->excel->getActiveSheet()->getStyle($cell)->getAlignment()->setWrapText(true);
        endforeach;

        $sub_total = array(
            "jodi_digits" => 0,
            "single_digit" => 0,
            "open_single_pana" => 0,
            "open_double_pana" => 0,
            "open_triple_pana" => 0,
            "open_half_sangam" => 0,
            "close_single_pana" => 0,
            "close_double_pana" => 0,
            "close_triple_pana" => 0,
            "close_half_sangam" => 0,
            "common_full_sangam" => 0
        );

        $table_column_round = 10;
        $table_column_round_single = 2;
        $table_column_round_open_close = 1;
        $table_columns = array("A", "B", "C");
        $table_columns_w_space = array("A", "B", "C", "D");

        // table_column_title setup for Jodi
        $table_column_title = "For Jodi Number";
        $table_column_title_cells = 'B1:AE1';
        $jodi_column_cells = 'B1:AE13';
        $this->excel->getActiveSheet()->mergeCells($table_column_title_cells);
        $this->excel->getActiveSheet()->getStyle($table_column_title_cells)->applyFromArray($style_center_bold);

        // $style_solid_background
        // $cell = $this->excel->getActiveSheet()->getCellByColumnAndRow(2, 4);
        // $colIndex = PHPExcel_Cell::stringFromColumnIndex(1);
        // print_r($game_data);//exit;

        $table_column_headings = array("Jodi Num", "Total Points Betting", "Total winning Value");
        $table_column_headings_cells = 'B2:AE2';
        $this->excel->getActiveSheet()->getStyle($table_column_headings_cells)->applyFromArray($style_font8);
        $column = 1;
        $row = 2;
        for ($k = 0; $k < $table_column_round; $k++): foreach ($table_column_headings as $field):
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $field);
                $column++;
            endforeach;
        endfor;
        $row++;
        for ($i = 0; $i < $table_column_round; $i++):
            $column = 1;
            for ($j = 0; $j < $table_column_round; $j++): foreach ($table_columns as $field):
                    $data = $j . $i;
                    $game_name = "jodi_digits";
                    $type = "common";
                    $points = $game_data[$game_name]["points"];
                    $res = (isset($game_data[$game_name][$type]["'" . $j . $i . "'"])) ? $game_data[$game_name][$type]["'" . $j . $i . "'"] : 0;
                    if (!isset($sub_total_digits[$j]))
                        $sub_total_digits[$j] = 0;
                    if ($field == "B"):
                        $data = $res;
                        $sub_total_digits[$j] += (int) $res;
                    endif;
                    if ($field == "C")
                        $data = $points * $res;
                    if ($field == "A"):
                        $c_cell = PHPExcel_Cell::stringFromColumnIndex($column) . $row;
                        if ($c_cell)
                            $this->excel->getActiveSheet()->getStyle($c_cell)->applyFromArray($style_solid_background);
                    endif;
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $data);
                    $column++;
                endforeach;
            endfor;
            $row++;
        endfor;

        // Sub Total Section for Jodi
        $sub_total_title = true;
        $column = 0;
        for ($k = 0; $k < $table_column_round; $k++): foreach ($table_columns as $field):
                $data = "";
                if ($field == "A" && $sub_total_title):
                    $data = "Sub Total";
                    $sub_total_title = false;
                endif;
                if ($field == "C"):
                    $data = (isset($sub_total_digits[$k])) ? $sub_total_digits[$k] : 0;
                    $sub_total["jodi_digits"] += $data;
                endif;
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $data);
                $column++;
            endforeach;
        endfor;
        $row++;

        // table_column_title setup for single
        $table_column_title_single = "For Open and Close";
        $table_column_title_single_cells = 'B14:G14';
        $this->excel->getActiveSheet()->mergeCells($table_column_title_single_cells);
        $this->excel->getActiveSheet()->getStyle($table_column_title_single_cells)->applyFromArray($style_center_bold);
        $table_column_single_headings = array("Close", "Total Points Betting", "Total winning Value");
        $table_column_single_heading_cell1 = 'B15';
        $table_column_single_heading_cell2 = 'E15';
        $table_column_single_headings_cells1 = 'C15:D15';
        $table_column_single_headings_cells2 = 'F15:G15';
        $this->excel->getActiveSheet()->getStyle($table_column_single_headings_cells1)->applyFromArray($style_font8);
        $this->excel->getActiveSheet()->getStyle($table_column_single_headings_cells2)->applyFromArray($style_font8);
        $this->excel->getActiveSheet()->getStyle($table_column_single_heading_cell1)->applyFromArray($style_solid_background);
        $this->excel->getActiveSheet()->getStyle($table_column_single_heading_cell2)->applyFromArray($style_solid_background);

        //IF ANY CONDITION
        //PHP CONDITION REQUIRE
        $open_games = array();
        $close_games = array();
        $open_close_games = array(
            "single_pana" => "Single Panna",
            "double_pana" => "Double Panna",
            "triple_pana" => "Triple Panna",
            "half_sangam" => "Half Sangam",
            "full_sangam" => "Full Sangam"
        ); foreach ($open_close_games as $game_name => $open_close_game):
            if ($game_name == "full_sangam"):
                if (!empty($game_data[$game_name]["common"]))
                    $open_games[$game_name] = $open_close_game;
                break;
            endif;
            if (!empty($game_data[$game_name]["open"]) || !empty($game_data[$game_name]["close"])):
                $open_games[$game_name] = $open_close_game;
                $close_games[$game_name] = $open_close_game;
            endif;
        endforeach;

        $column = 8;
        $open_games_height = $table_column_round;
        $temp_row = $row; foreach ($open_games as $game_name => $open_game):
            $actual_column = $column;
            $temp_row = $row;
            $temp_cell_row = $temp_row;
            $temp_next_cell_row = $temp_row + 1;
            // Table Title setup
            $table_column_title_games = "For Open " . $open_game;
            if ($game_name == "full_sangam")
                $table_column_title_games = "For " . $open_game;
            $table_column_title_games_cells1 = PHPExcel_Cell::stringFromColumnIndex($column) . $temp_cell_row . ":" . PHPExcel_Cell::stringFromColumnIndex($column + 2) . $temp_cell_row;
            //Put title on cell
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_cell_row, $table_column_title_games);
            // $table_column_title_games_cells1 = 'B14:G14';
            $table_column_games_headings_cells1 = PHPExcel_Cell::stringFromColumnIndex($column + 1) . $temp_next_cell_row . ":" . PHPExcel_Cell::stringFromColumnIndex($column + 2) . $temp_next_cell_row;
            // $table_column_games_headings_cells = 'C15:D15';
            $table_column_games_heading_cell1 = PHPExcel_Cell::stringFromColumnIndex($column) . $temp_next_cell_row;
            $this->excel->getActiveSheet()->getStyle($table_column_games_headings_cells1)->applyFromArray($style_font8);
            $this->excel->getActiveSheet()->mergeCells($table_column_title_games_cells1);
            $this->excel->getActiveSheet()->getStyle($table_column_title_games_cells1)->applyFromArray($style_center_bold);
            $this->excel->getActiveSheet()->getStyle($table_column_games_heading_cell1)->applyFromArray($style_solid_background);
            $temp_row++;
            $type = "open";
            for ($k = 0; $k < $table_column_round_open_close; $k++): foreach ($table_column_single_headings as $field):
                    $data = $field;
                    if ($field == "Close"):
                        $data = $open_game . " Digit";
                    endif;
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_row, $data);
                    $column++;
                endforeach;
            endfor;
            $temp_row++;
            $game_data_new = array();
            $game_data_count = 0;
            if ($game_name == "full_sangam")
                $type = "common";
            if (isset($game_data[$game_name][$type])): foreach ($game_data[$game_name][$type] as $digit => $game_data_type):
                    $digit = (string) trim($digit, "'");
                    $game_data_new[] = array("digit" => (string) $digit, "val" => $game_data_type);
                    $game_data_count++;
                endforeach;
            endif;
            $table_column_round_game = ($game_data_count > $open_games_height) ? $game_data_count : $open_games_height;
            $open_games_height = ($game_data_count > $open_games_height) ? $game_data_count : $open_games_height;
            $game_height[$game_name][$type] = $table_column_round_game;
            for ($i = 0; $i < $table_column_round_game; $i++):
                $tmp_column = $actual_column;
                for ($j = 0; $j < $table_column_round_open_close; $j++): foreach ($table_columns as $field):
                        $game_data_arr = (isset($game_data_new[$i])) ? $game_data_new[$i] : array("digit" => 0, "val" => 0);
                        $data = $game_data_arr["digit"];
                        // echo $data."<br>";
                        $points = $game_data[$game_name]["points"];
                        $res = $game_data_arr["val"];
                        $sub_total_game = "sub_total_" . $type . '_' . $game_name;
                        if (!isset($$sub_total_game[$j]))
                            $$sub_total_game[$j] = 0;
                        if ($field == "B"):
                            $data = $res;
                            $$sub_total_game[$j] += (int) $res;
                        endif;
                        if ($field == "C")
                            $data = $points * $res;
                        if ($field == "A"):
                            $sc_cell = PHPExcel_Cell::stringFromColumnIndex($tmp_column) . $temp_row;
                            if ($sc_cell)
                                $this->excel->getActiveSheet()->getStyle($sc_cell)->applyFromArray($style_solid_background);
                        endif;
                        if ($data === 0)
                            $data = "";
                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($tmp_column, $temp_row, $data);
                        $tmp_column++;
                    endforeach;
                endfor;
                $temp_row++;
            endfor;
            $column++;
        endforeach;

        $column = 8;
        $close_games_height = $table_column_round;
        $temp_row_close_game = $temp_row + 2; //($open_games_height-$table_column_round);
        foreach ($close_games as $game_name => $close_game):
            $actual_column = $column;
            // $temp_row = 28;
            $temp_row = $temp_row_close_game;
            $temp_cell_row = $temp_row;
            $temp_next_cell_row = $temp_row + 1;
            // Table Title setup
            $table_column_title_games = "For Close " . $close_game;
            $table_column_title_games_cells2 = PHPExcel_Cell::stringFromColumnIndex($column) . $temp_cell_row . ":" . PHPExcel_Cell::stringFromColumnIndex($column + 2) . $temp_cell_row;
            //Put title on cell
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_cell_row, $table_column_title_games);
            // $table_column_title_games_cells2 = 'B14:G14';
            $table_column_games_headings_cells2 = PHPExcel_Cell::stringFromColumnIndex($column + 1) . $temp_next_cell_row . ":" . PHPExcel_Cell::stringFromColumnIndex($column + 2) . $temp_next_cell_row;
            // $table_column_games_headings_cells2 = 'C15:D15';
            $table_column_games_heading_cell2 = PHPExcel_Cell::stringFromColumnIndex($column) . $temp_next_cell_row;
            $this->excel->getActiveSheet()->getStyle($table_column_games_headings_cells2)->applyFromArray($style_font8);
            $this->excel->getActiveSheet()->mergeCells($table_column_title_games_cells2);
            $this->excel->getActiveSheet()->getStyle($table_column_title_games_cells2)->applyFromArray($style_center_bold);
            $this->excel->getActiveSheet()->getStyle($table_column_games_heading_cell2)->applyFromArray($style_solid_background);
            $temp_row++;
            $type = "close";
            for ($k = 0; $k < $table_column_round_open_close; $k++): foreach ($table_column_single_headings as $field):
                    $data = $field;
                    if ($field == "Close"):
                        $data = $close_game . " Digit";
                    endif;
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_row, $data);
                    $column++;
                endforeach;
            endfor;
            $temp_row++;
            $game_data_new = array();
            $game_data_count = 0;
            if (isset($game_data[$game_name][$type])): foreach ($game_data[$game_name][$type] as $digit => $game_data_type):
                    // if($game_data_count==10)
                    //     break;
                    $digit = (string) trim($digit, "'");
                    $game_data_new[] = array("digit" => (string) $digit, "val" => $game_data_type);
                    $game_data_count++;
                endforeach;
            endif;
            $table_column_round_game = ($game_data_count > $close_games_height) ? $game_data_count : $close_games_height;
            $close_games_height = ($game_data_count > $close_games_height) ? $game_data_count : $close_games_height;
            $game_height[$game_name][$type] = $table_column_round_game;
            for ($i = 0; $i < $table_column_round_game; $i++):
                $tmp_column = $actual_column;
                for ($j = 0; $j < $table_column_round_open_close; $j++): foreach ($table_columns as $field):
                        // print_r($game_data_new);
                        $game_data_arr = (isset($game_data_new[$i])) ? $game_data_new[$i] : array("digit" => 0, "val" => 0);
                        $data = $game_data_arr["digit"];
                        $points = $game_data[$game_name]["points"];
                        $res = $game_data_arr["val"];
                        $sub_total_game = "sub_total_" . $type . '_' . $game_name;
                        if (!isset($$sub_total_game[$j]))
                            $$sub_total_game[$j] = 0;
                        if ($field == "B"):
                            $data = $res;
                            $$sub_total_game[$j] += (int) $res;
                        endif;
                        if ($field == "C")
                            $data = $points * $res;
                        if ($field == "A"):
                            $sc_cell = PHPExcel_Cell::stringFromColumnIndex($tmp_column) . $temp_row;
                            if ($sc_cell)
                                $this->excel->getActiveSheet()->getStyle($sc_cell)->applyFromArray($style_solid_background);
                        endif;
                        if ($data === 0)
                            $data = "";
                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($tmp_column, $temp_row, $data);
                        $tmp_column++;
                    endforeach;
                endfor;
                $temp_row++;
            endfor;
            $column++;
        endforeach;

        $row++;
        $temp_row = $row;
        $column = 1;
        $open_close = true;
        for ($k = 0; $k < $table_column_round_single; $k++): foreach ($table_column_single_headings as $field):
                $data = $field;
                if ($field == "Close" && $open_close):
                    $data = "Open";
                    $open_close = false;
                endif;
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_row, $data);
                $column++;
            endforeach;
        endfor;
        $temp_row++;

        for ($i = 0; $i < $table_column_round; $i++):
            $column = 1;
            $type = "open";
            for ($j = 0; $j < $table_column_round_single; $j++): foreach ($table_columns as $field):
                    $data = $i;
                    $game_name = "single_digit";
                    $points = $game_data[$game_name]["points"];
                    $res = (isset($game_data[$game_name][$type]["'" . $i . "'"])) ? $game_data[$game_name][$type]["'" . $i . "'"] : 0;
                    if (!isset($sub_total_single[$j]))
                        $sub_total_single[$j] = 0;
                    if ($field == "B"):
                        $data = $res;
                        $sub_total_single[$j] += (int) $res;
                    endif;
                    if ($field == "C")
                        $data = $points * $res;
                    if ($field == "A"):
                        $sc_cell = PHPExcel_Cell::stringFromColumnIndex($column) . $temp_row;
                        if ($sc_cell)
                            $this->excel->getActiveSheet()->getStyle($sc_cell)->applyFromArray($style_solid_background);
                    endif;
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_row, $data);
                    $column++;
                endforeach;
                $type = "close";
            endfor;
            $temp_row++;
        endfor;

        // Sub Total Section for Single
        $sub_total_title = true;
        $column = 0;
        for ($k = 0; $k < $table_column_round_single; $k++): foreach ($table_columns as $field):
                $data = "";
                if ($field == "A" && $sub_total_title):
                    $data = "Sub Total";
                    $sub_total_title = false;
                endif;
                if ($field == "C"):
                    $data = (isset($sub_total_single[$k])) ? $sub_total_single[$k] : 0;
                    $sub_total["single_digit"] += $data;
                endif;
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_row, $data);
                $column++;
            endforeach;
        endfor;

        // Sub Total Section for Open Game
        $column = 7;
        $type = "open";
        $temp_row += ($open_games_height - $table_column_round); foreach ($open_games as $game_name => $open_game):
            if ($game_name == "full_sangam")
                $type = "common";
            for ($k = 0; $k < $table_column_round_open_close; $k++): foreach ($table_columns_w_space as $field):
                    $data = "";
                    $sub_total_game = "sub_total_" . $type . '_' . $game_name;
                    if ($field == "C"):
                        $data = (isset($$sub_total_game[$k])) ? $$sub_total_game[$k] : 0;
                        $sub_total[$type . '_' . $game_name] += $data;
                    endif;
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_row, $data);
                    $column++;
                endforeach;
            endfor;
        endforeach;

        // Sub Total Section for Close Game
        $column = 7;
        // $temp_row = 40;
        $temp_row += ($close_games_height + 4);
        $type = "close"; foreach ($close_games as $game_name => $close_game):
            for ($k = 0; $k < $table_column_round_open_close; $k++): foreach ($table_columns_w_space as $field):
                    $data = "";
                    $sub_total_game = "sub_total_" . $type . '_' . $game_name;
                    if ($field == "C"):
                        $data = (isset($$sub_total_game[$k])) ? $$sub_total_game[$k] : 0;
                        $sub_total[$type . '_' . $game_name] += $data;
                    endif;
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_row, $data);
                    $column++;
                endforeach;
            endfor;
        endforeach;

        $grand_total = 0; foreach ($sub_total as $sub_totals):
            $grand_total += $sub_totals;
        endforeach;
        // table_column_grand_total setup
        $table_column_grand_total = "Grand Total Betting";
        $table_column_grand_total_cells = 'A28:C28';
        $this->excel->getActiveSheet()->mergeCells($table_column_grand_total_cells);
        $this->excel->getActiveSheet()->getStyle($table_column_grand_total_cells)->applyFromArray($style_center_bold);

        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, $table_column_title);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, 14, $table_column_title_single);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 28, $table_column_grand_total);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, 28, $grand_total);

        // Save it as an excel 2003 file
        $object_writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        // $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
        $object_writer->save('php://output');
        $object_writer->save("nameoffile.xls");
    }

    function starline($starline_id = 2)
    {
        if ($starline_id == "")
            return false;
        $this->load->model("excel_export_model");
        $this->load->library("excel");
        $g_type = "starline";
        $game_data = $this->excel_export_model->fetch_data($starline_id, NULL, $g_type);
        $filename = $this->excel_export_model->genrate_file_name($starline_id, $g_type);
        $this->excel->getProperties()->setTitle("Game Excel Report")->setDescription("Game Excel Report with date.");

        // Assign cell values
        $this->excel->setActiveSheetIndex(0);

        // Assign Active sheet Title
        $this->excel->getActiveSheet()->setTitle("STARLINE");
        $starline = true;

        $style_center_bold = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
            'font' => array(
                'bold' => true
            )
        );
        $style_font8 = array(
            'font' => array(
                'size' => 8
            )
        );
        $style_bold = array(
            'font' => array(
                'bold' => true
            )
        );
        $style_solid_background = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '00B0F0')
            )
        );

        $cells = array("A2:AE2", "A15:AE15", "A29:AE29");
        foreach ($cells as $cell):
            $this->excel->getActiveSheet()->getStyle($cell)->getAlignment()->setWrapText(true);
        endforeach;

        $sub_total = array(
            "jodi_digits" => 0,
            "single_digit" => 0,
            "open_single_pana" => 0,
            "open_double_pana" => 0,
            "open_triple_pana" => 0,
            "open_half_sangam" => 0,
            "close_single_pana" => 0,
            "close_double_pana" => 0,
            "close_triple_pana" => 0,
            "close_half_sangam" => 0,
            "open_full_sangam" => 0
        );
        if ($starline):
            $sub_total = array(
                "single_digit" => 0,
                "open_single_pana" => 0,
                "open_double_pana" => 0,
                "open_triple_pana" => 0,
                "open_half_sangam" => 0
            );
        endif;

        $table_column_round = 10;
        $table_column_round_single = 2;
        if ($starline)
            $table_column_round_single = 1;
        $table_column_round_open_close = 1;
        $table_columns = array("A", "B", "C");
        $table_columns_w_space = array("A", "B", "C", "D");

        $column = 1;
        $row = 1;
        if (!$starline):
            $row = 2;
            // table_column_title setup for Jodi
            $table_column_title = "For Jodi Number";
            $table_column_title_cells = 'B1:AE1';
            $jodi_column_cells = 'B1:AE13';
            $this->excel->getActiveSheet()->mergeCells($table_column_title_cells);
            $this->excel->getActiveSheet()->getStyle($table_column_title_cells)->applyFromArray($style_center_bold);
            $table_column_headings = array("Jodi Num", "Total Points Betting", "Total winning Value");
            $table_column_headings_cells = 'B2:AE2';
            $this->excel->getActiveSheet()->getStyle($table_column_headings_cells)->applyFromArray($style_font8);
            for ($k = 0; $k < $table_column_round; $k++): foreach ($table_column_headings as $field):
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $field);
                    $column++;
                endforeach;
            endfor;
            $row++;
            for ($i = 0; $i < $table_column_round; $i++):
                $column = 1;
                for ($j = 0; $j < $table_column_round; $j++): foreach ($table_columns as $field):
                        $data = $j . $i;
                        $game_name = "jodi_digits";
                        $type = "common";
                        $points = $game_data[$game_name]["points"];
                        $res = (isset($game_data[$game_name][$type]["'" . $j . $i . "'"])) ? $game_data[$game_name][$type]["'" . $j . $i . "'"] : 0;
                        if (!isset($sub_total_digits[$j]))
                            $sub_total_digits[$j] = 0;
                        if ($field == "B"):
                            $data = $res;
                            $sub_total_digits[$j] += (int) $res;
                        endif;
                        if ($field == "C")
                            $data = $points * $res;
                        if ($field == "A"):
                            $c_cell = PHPExcel_Cell::stringFromColumnIndex($column) . $row;
                            if ($c_cell)
                                $this->excel->getActiveSheet()->getStyle($c_cell)->applyFromArray($style_solid_background);
                        endif;
                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $data);
                        $column++;
                    endforeach;
                endfor;
                $row++;
            endfor;

            // Sub Total Section for Jodi
            $sub_total_title = true;
            $column = 0;
            for ($k = 0; $k < $table_column_round; $k++): foreach ($table_columns as $field):
                    $data = "";
                    if ($field == "A" && $sub_total_title):
                        $data = "Sub Total";
                        $sub_total_title = false;
                    endif;
                    if ($field == "C"):
                        $data = (isset($sub_total_digits[$k])) ? $sub_total_digits[$k] : 0;
                        $sub_total["jodi_digits"] += $data;
                    endif;
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $data);
                    $column++;
                endforeach;
            endfor;
            $row++;
        endif;

        // table_column_title setup for single
        $table_column_title_single = "For Open and Close";
        $table_column_title_single_cells = 'B14:G14';
        if ($starline):
            $table_column_title_single = "For Open";
            $table_column_title_single_cells = 'B1:D1';
        endif;
        $this->excel->getActiveSheet()->mergeCells($table_column_title_single_cells);
        $this->excel->getActiveSheet()->getStyle($table_column_title_single_cells)->applyFromArray($style_center_bold);
        $table_column_single_headings = array("Close", "Total Points Betting", "Total winning Value");
        $table_column_single_heading_cell1 = 'B15';
        $table_column_single_headings_cells1 = 'C15:D15';
        if ($starline):
            $table_column_single_heading_cell1 = 'B2';
            $table_column_single_headings_cells1 = 'C2:D2';
        endif;
        $this->excel->getActiveSheet()->getStyle($table_column_single_headings_cells1)->applyFromArray($style_font8);
        $this->excel->getActiveSheet()->getStyle($table_column_single_heading_cell1)->applyFromArray($style_solid_background);
        if (!$starline):
            $table_column_single_heading_cell2 = 'E15';
            $table_column_single_headings_cells2 = 'F15:G15';
            $this->excel->getActiveSheet()->getStyle($table_column_single_headings_cells2)->applyFromArray($style_font8);
            $this->excel->getActiveSheet()->getStyle($table_column_single_heading_cell2)->applyFromArray($style_solid_background);
        endif;

        //IF ANY CONDITION
        //PHP CONDITION REQUIRE
        $open_games = array();
        $close_games = array();
        $open_close_games = array(
            "single_pana" => "Single Panna",
            "double_pana" => "Double Panna",
            "triple_pana" => "Triple Panna",
            "half_sangam" => "Half Sangam"
        );
        if (!$starline)
            $open_close_games["full_sangam"] = "Full Sangam"; foreach ($open_close_games as $game_name => $open_close_game):
            if ($game_name == "full_sangam"):
                if (!empty($game_data[$game_name]["common"]))
                    $open_games[$game_name] = $open_close_game;
                break;
            endif;
            if (!empty($game_data[$game_name]["open"]) || !empty($game_data[$game_name]["close"])):
                $open_games[$game_name] = $open_close_game;
                if (!$starline)
                    $close_games[$game_name] = $open_close_game;
            endif;
        endforeach;

        $column = 5; //8
        $open_games_height = $table_column_round;
        $temp_row = $row; foreach ($open_games as $game_name => $open_game):
            $actual_column = $column;
            $temp_row = $row;
            $temp_cell_row = $temp_row;
            $temp_next_cell_row = $temp_row + 1;
            // Table Title setup
            $table_column_title_games = "For Open " . $open_game;
            if ($open_game == "full_sangam")
                $table_column_title_games = "For " . $open_game;
            $table_column_title_games_cells1 = PHPExcel_Cell::stringFromColumnIndex($column) . $temp_cell_row . ":" . PHPExcel_Cell::stringFromColumnIndex($column + 2) . $temp_cell_row;
            //Put title on cell
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_cell_row, $table_column_title_games);
            // $table_column_title_games_cells1 = 'B14:G14';
            $table_column_games_headings_cells1 = PHPExcel_Cell::stringFromColumnIndex($column + 1) . $temp_next_cell_row . ":" . PHPExcel_Cell::stringFromColumnIndex($column + 2) . $temp_next_cell_row;
            // $table_column_games_headings_cells = 'C15:D15';
            $table_column_games_heading_cell1 = PHPExcel_Cell::stringFromColumnIndex($column) . $temp_next_cell_row;
            $this->excel->getActiveSheet()->getStyle($table_column_games_headings_cells1)->applyFromArray($style_font8);
            $this->excel->getActiveSheet()->mergeCells($table_column_title_games_cells1);
            $this->excel->getActiveSheet()->getStyle($table_column_title_games_cells1)->applyFromArray($style_center_bold);
            $this->excel->getActiveSheet()->getStyle($table_column_games_heading_cell1)->applyFromArray($style_solid_background);
            $temp_row++;
            $type = "open";
            for ($k = 0; $k < $table_column_round_open_close; $k++): foreach ($table_column_single_headings as $field):
                    $data = $field;
                    if ($field == "Close"):
                        $data = $open_game . " Digit";
                    endif;
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_row, $data);
                    $column++;
                endforeach;
            endfor;
            $temp_row++;
            $game_data_new = array();
            $game_data_count = 0;
            if (isset($game_data[$game_name][$type])): foreach ($game_data[$game_name][$type] as $digit => $game_data_type):
                    $digit = (string) trim($digit, "'");
                    $game_data_new[] = array("digit" => (string) $digit, "val" => $game_data_type);
                    $game_data_count++;
                endforeach;
            endif;
            $table_column_round_game = ($game_data_count > $open_games_height) ? $game_data_count : $open_games_height;
            $open_games_height = ($game_data_count > $open_games_height) ? $game_data_count : $open_games_height;
            $game_height[$game_name][$type] = $table_column_round_game;
            for ($i = 0; $i < $table_column_round_game; $i++):
                $tmp_column = $actual_column;
                for ($j = 0; $j < $table_column_round_open_close; $j++): foreach ($table_columns as $field):
                        $game_data_arr = (isset($game_data_new[$i])) ? $game_data_new[$i] : array("digit" => 0, "val" => 0);
                        $data = $game_data_arr["digit"];
                        $points = $game_data[$game_name]["points"];
                        $res = $game_data_arr["val"];
                        $sub_total_game = "sub_total_" . $type . '_' . $game_name;
                        if (!isset($$sub_total_game[$j]))
                            $$sub_total_game[$j] = 0;
                        if ($field == "B"):
                            $data = $res;
                            $$sub_total_game[$j] += (int) $res;
                        endif;
                        if ($field == "C")
                            $data = $points * $res;
                        if ($field == "A"):
                            $sc_cell = PHPExcel_Cell::stringFromColumnIndex($tmp_column) . $temp_row;
                            if ($sc_cell)
                                $this->excel->getActiveSheet()->getStyle($sc_cell)->applyFromArray($style_solid_background);
                        endif;
                        if ($data === 0)
                            $data = "";
                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($tmp_column, $temp_row, $data);
                        $tmp_column++;
                    endforeach;
                endfor;
                $temp_row++;
            endfor;
            $column++;
        endforeach;

        $column = 5; //8
        $close_games_height = $table_column_round;
        $temp_row_close_game = $temp_row + 2; //($open_games_height-$table_column_round);
        foreach ($close_games as $game_name => $close_game):
            $actual_column = $column;
            // $temp_row = 28;
            $temp_row = $temp_row_close_game;
            $temp_cell_row = $temp_row;
            $temp_next_cell_row = $temp_row + 1;
            // Table Title setup
            $table_column_title_games = "For Close " . $close_game;
            $table_column_title_games_cells2 = PHPExcel_Cell::stringFromColumnIndex($column) . $temp_cell_row . ":" . PHPExcel_Cell::stringFromColumnIndex($column + 2) . $temp_cell_row;
            //Put title on cell
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_cell_row, $table_column_title_games);
            // $table_column_title_games_cells2 = 'B14:G14';
            $table_column_games_headings_cells2 = PHPExcel_Cell::stringFromColumnIndex($column + 1) . $temp_next_cell_row . ":" . PHPExcel_Cell::stringFromColumnIndex($column + 2) . $temp_next_cell_row;
            // $table_column_games_headings_cells2 = 'C15:D15';
            $table_column_games_heading_cell2 = PHPExcel_Cell::stringFromColumnIndex($column) . $temp_next_cell_row;
            $this->excel->getActiveSheet()->getStyle($table_column_games_headings_cells2)->applyFromArray($style_font8);
            $this->excel->getActiveSheet()->mergeCells($table_column_title_games_cells2);
            $this->excel->getActiveSheet()->getStyle($table_column_title_games_cells2)->applyFromArray($style_center_bold);
            $this->excel->getActiveSheet()->getStyle($table_column_games_heading_cell2)->applyFromArray($style_solid_background);
            $temp_row++;
            $type = "close";
            for ($k = 0; $k < $table_column_round_open_close; $k++): foreach ($table_column_single_headings as $field):
                    $data = $field;
                    if ($field == "Close"):
                        $data = $close_game . " Digit";
                    endif;
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_row, $data);
                    $column++;
                endforeach;
            endfor;
            $temp_row++;
            $game_data_new = array();
            $game_data_count = 0;
            if (isset($game_data[$game_name][$type])): foreach ($game_data[$game_name][$type] as $digit => $game_data_type):
                    // if($game_data_count==10)
                    //     break;
                    $digit = (string) trim($digit, "'");
                    $game_data_new[] = array("digit" => (string) $digit, "val" => $game_data_type);
                    $game_data_count++;
                endforeach;
            endif;
            $table_column_round_game = ($game_data_count > $close_games_height) ? $game_data_count : $close_games_height;
            $close_games_height = ($game_data_count > $close_games_height) ? $game_data_count : $close_games_height;
            $game_height[$game_name][$type] = $table_column_round_game;
            for ($i = 0; $i < $table_column_round_game; $i++):
                $tmp_column = $actual_column;
                for ($j = 0; $j < $table_column_round_open_close; $j++): foreach ($table_columns as $field):
                        // print_r($game_data_new);
                        $game_data_arr = (isset($game_data_new[$i])) ? $game_data_new[$i] : array("digit" => 0, "val" => 0);
                        $data = $game_data_arr["digit"];
                        $points = $game_data[$game_name]["points"];
                        $res = $game_data_arr["val"];
                        $sub_total_game = "sub_total_" . $type . '_' . $game_name;
                        if (!isset($$sub_total_game[$j]))
                            $$sub_total_game[$j] = 0;
                        if ($field == "B"):
                            $data = $res;
                            $$sub_total_game[$j] += (int) $res;
                        endif;
                        if ($field == "C")
                            $data = $points * $res;
                        if ($field == "A"):
                            $sc_cell = PHPExcel_Cell::stringFromColumnIndex($tmp_column) . $temp_row;
                            if ($sc_cell)
                                $this->excel->getActiveSheet()->getStyle($sc_cell)->applyFromArray($style_solid_background);
                        endif;
                        if ($data === 0)
                            $data = "";
                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($tmp_column, $temp_row, $data);
                        $tmp_column++;
                    endforeach;
                endfor;
                $temp_row++;
            endfor;
            $column++;
        endforeach;

        $row++;
        $temp_row = $row;
        $column = 1;
        $open_close = true;
        for ($k = 0; $k < $table_column_round_single; $k++): foreach ($table_column_single_headings as $field):
                $data = $field;
                if ($field == "Close" && $open_close):
                    $data = "Open";
                    $open_close = false;
                endif;
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_row, $data);
                $column++;
            endforeach;
        endfor;
        $temp_row++;

        for ($i = 0; $i < $table_column_round; $i++):
            $column = 1;
            $type = "open";
            for ($j = 0; $j < $table_column_round_single; $j++): foreach ($table_columns as $field):
                    $data = $i;
                    $game_name = "single_digit";
                    $points = $game_data[$game_name]["points"];
                    $res = (isset($game_data[$game_name][$type]["'" . $i . "'"])) ? $game_data[$game_name][$type]["'" . $i . "'"] : 0;
                    if (!isset($sub_total_single[$j]))
                        $sub_total_single[$j] = 0;
                    if ($field == "B"):
                        $data = $res;
                        $sub_total_single[$j] += (int) $res;
                    endif;
                    if ($field == "C")
                        $data = $points * $res;
                    if ($field == "A"):
                        $sc_cell = PHPExcel_Cell::stringFromColumnIndex($column) . $temp_row;
                        if ($sc_cell)
                            $this->excel->getActiveSheet()->getStyle($sc_cell)->applyFromArray($style_solid_background);
                    endif;
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_row, $data);
                    $column++;
                endforeach;
                $type = "close";
            endfor;
            $temp_row++;
        endfor;

        // Sub Total Section for Single
        $sub_total_title = true;
        $column = 0;
        for ($k = 0; $k < $table_column_round_single; $k++): foreach ($table_columns as $field):
                $data = "";
                if ($field == "A" && $sub_total_title):
                    $data = "Sub Total";
                    $sub_total_title = false;
                endif;
                if ($field == "C"):
                    $data = (isset($sub_total_single[$k])) ? $sub_total_single[$k] : 0;
                    $sub_total["single_digit"] += $data;
                endif;
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_row, $data);
                $column++;
            endforeach;
        endfor;

        // Sub Total Section for Open Game
        $column = 4; //7
        $type = "open";
        $temp_row += ($open_games_height - $table_column_round); foreach ($open_games as $game_name => $open_game):
            for ($k = 0; $k < $table_column_round_open_close; $k++): foreach ($table_columns_w_space as $field):
                    $data = "";
                    $sub_total_game = "sub_total_" . $type . '_' . $game_name;
                    if ($field == "C"):
                        $data = (isset($$sub_total_game[$k])) ? $$sub_total_game[$k] : 0;
                        $sub_total[$type . '_' . $game_name] += $data;
                    endif;
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_row, $data);
                    $column++;
                endforeach;
            endfor;
        endforeach;

        // Sub Total Section for Close Game
        $column = 4; //7
        // $temp_row = 40;
        $temp_row += ($close_games_height + 4);
        $type = "close"; foreach ($close_games as $game_name => $close_game):
            for ($k = 0; $k < $table_column_round_open_close; $k++): foreach ($table_columns_w_space as $field):
                    $data = "";
                    $sub_total_game = "sub_total_" . $type . '_' . $game_name;
                    if ($field == "C"):
                        $data = (isset($$sub_total_game[$k])) ? $$sub_total_game[$k] : 0;
                        $sub_total[$type . '_' . $game_name] += $data;
                    endif;
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, $temp_row, $data);
                    $column++;
                endforeach;
            endfor;
        endforeach;

        $grand_total = 0; foreach ($sub_total as $sub_totals):
            $grand_total += $sub_totals;
        endforeach;
        // table_column_grand_total setup
        $table_column_grand_total = "Grand Total Betting";
        $table_column_grand_total_cells = 'A28:C28';
        $this->excel->getActiveSheet()->mergeCells($table_column_grand_total_cells);
        $this->excel->getActiveSheet()->getStyle($table_column_grand_total_cells)->applyFromArray($style_center_bold);

        if (!$starline):
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, $table_column_title);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, 14, $table_column_title_single);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 28, $table_column_grand_total);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, 28, $grand_total);
        else:
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, $table_column_title_single);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 16, $table_column_grand_total);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, 16, $grand_total);
        endif;

        // Save it as an excel 2003 file
        $object_writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        // $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
        $object_writer->save('php://output');
        $object_writer->save("nameoffile.xls");
    }
}